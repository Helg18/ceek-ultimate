<?php

namespace Sellout;

use DB;
use Event;
use Sqlnest;
use Sellout\User;
use Sellout\Catalog;
use Sellout\PlayRight;
use Sellout\PromoCode;
use Sellout\CashierHandler;
use Sellout\SqlNestedFieldAdapter;
use App\Events\PurchaseCompleted;
use Illuminate\Database\Eloquent\Collection;

/**
 * Library to handle logic for the purchases of content.
 */

class PurchaseHandler
{
    protected $user;
    protected $purchasePath = false;
    protected $promo = false;
    protected $promoCode = false;

    public function __construct(User $user, $id, $direct=false, $useExistingCredits=true)
    {
        $this->user = $user;
        if($direct)
        {
            $this->directPurchaseContent($user, $id, $useExistingCredits);
        }
        else
        {
            $this->purchaseContent($user, $id);
        }
    }
    public function directPurchaseContent(User $user, $id, $useExistingCredits=true)
    {
        $catalog = $this->_getCatalog($id);
        $this->_validate($catalog);
        $cost = $this->_getPurchaseCost($catalog);
        $this->_setPurchasePath($cost);
        $toCharge = $useExistingCredits
            ? $cost - $this->user->credits
            : $cost;
        $videoDefinitions = $this->_getVideoDefinitions($catalog);
        $currentPlayRights = $this->_getCurrentPlayRights($videoDefinitions['ids'], $user);
        $playRightsToAdd = $this->_separatePlayRights($currentPlayRights, $videoDefinitions['details']);
        DB::beginTransaction();
        if($useExistingCredits && ($cost - $toCharge > 0))
        {
            $this->_chargeUser($catalog, ($cost - $toCharge));
        }
        $this->_consumePromoCode();
        $purchase = $this->_addPurchase($catalog, $cost);
        $this->_addPlayRights($currentPlayRights, $playRightsToAdd);
        $transaction = $this->_chargeUserCard($toCharge);
        DB::commit();
        $this->_firePurchaseEvents($catalog, $purchase, $transaction);
        return true;
    }
    public function purchaseContent(User $user, $id)
    {
        $catalog = $this->_getCatalog($id);
        $this->_validate($catalog);
        $cost = $this->_getPurchaseCost($catalog);
        $this->_setPurchasePath($cost);
        $videoDefinitions = $this->_getVideoDefinitions($catalog);
        $currentPlayRights = $this->_getCurrentPlayRights($videoDefinitions['ids'], $user);
        $playRightsToAdd = $this->_separatePlayRights($currentPlayRights, $videoDefinitions['details']);
        DB::beginTransaction();
        $this->_chargeUser($catalog, $cost);
        $this->_consumePromoCode();
        $purchase = $this->_addPurchase($catalog, $cost);
        $this->_addPlayRights($currentPlayRights, $playRightsToAdd);
        DB::commit();
        $this->_firePurchaseEvents($catalog, $purchase);
        return true;
    }
    private function _firePurchaseEvents(Catalog $catalog, Purchase $purchase, Transaction $transaction = null)
    {
        Event::fire(new PurchaseCompleted($this->user, $catalog, $purchase, $transaction));
    }
    private function _chargeUserCard($toCharge)
    {
        if(!$toCharge > 0) return;
        $cashier = new CashierHandler($this->user);
        return $cashier->addCredits(['credits' => $toCharge], false);
    }
    private function _setPlayCount($definition)
    {
        if(!isset($definition['play_count']) || is_null($definition['play_count']))
        {
            $definition['play_count'] = 0;
        }
        if(!isset($definition['plays_unlimited']) || is_null($definition['plays_unlimited']))
        {
            $definition['plays_unlimited'] = false;
        }
        return $definition;
    }
    private function _addNewPlayRights(Array $definitions)
    {
        foreach($definitions as $definition)
        {
            $right = new PlayRight;
            $right->mid = $right->generateMid();
            $right->plays_left = $definition['play_count'];
            $right->plays_unlimited = $definition['plays_unlimited'];
            $right->user_id = $this->user->id;
            $right->video_id = $definition['id'];
            $right->save();
        }
    }
    private function _addPurchase(Catalog $catalog, $cost)
    {
        $purchase = new Purchase;
        $purchase->catalog_id = $catalog->id;
        $purchase->paid = $cost;
        $purchase->purchasePath = $this->purchasePath;
        $purchase->promo_code = $this->promo instanceof Promo
            ? $this->promoCode->code
            : null;
        $purchase->user_id = $this->user->id;
        $purchase->save();
        return $purchase;
    }
    private function _userHasTheCredits($cost)
    {
        if($this->user->credits >= $cost)
        {
            return true;
        }
        return false;
    }
    private function _consumePromoCode()
    {
        if($this->promoCode instanceof PromoCode)
        {
            $this->promoCode->update(['used' => true]);
        }
    }
    private function _chargeUser(Catalog $catalog, $cost)
    {
        if($this->_userHasTheCredits($cost))
        {
            $this->user->credits = $this->user->credits - $cost;
            return $this->user->save();
        }
        throw new \Exception("Insufficient credit for purchase. You have " . $this->user->credits . " credits. " . $catalog->name . " requires " . $cost . ".");
    }
    private function _updateOldPlayRights(Collection $rights, Array $playRightsUpdate)
    {
        foreach($rights as $right)
        {
            $right->plays_left = $right->plays_left + $playRightsUpdate[$right->video_id]['play_count'];
            $right->save();
        }
    }
    private function _addPlayRights(Collection $rights, Array $playRightsToAdd)
    {
        $this->_updateOldPlayRights($rights, $playRightsToAdd['update']);
        $this->_addNewPlayRights($playRightsToAdd['create']);
    }
    private function _separatePlayRights(Collection $rights, Array $definitions)
    {
        $playRights['create'] = [];
        $playRights['update'] = [];
        foreach($definitions as $definition)
        {
            if($rights->where('video_id', $definition['id'])->first() instanceof PlayRight)
            {
                $playRights['update'][$definition['id']] = $this->_setPlayCount($definition);
            }
            else
            {
                $playRights['create'][] = $this->_setPlayCount($definition);
            }
        }
        return $playRights;
    }
    private function _getCurrentPlayRights($ids, User $user)
    {
        return PlayRight::whereIn('video_id', $ids)->where('user_id', $user->id)->get();
    }
    private function _getVideoDefinitions(Catalog $catalog)
    {
        $nest = new Sqlnest;
        $ids = [];
        $definition = [];
        $definitions['ids'] = [];
        $definitions['details'] = [];
        foreach($catalog->videos as $video)
        {
            $ids = [
                'id' => $video->id,
                'mid' => $video->mid,
            ];
            $definitions['ids'][] = $video->id;
            $definition = $nest->toArray($video->pivot->definition);
            $definitions['details'][] = array_merge($ids, $definition);
        }
        return $definitions;
    }
    private function _setPurchasePath($cost)
    {
        $free = ($cost === 0);
        if($this->promo instanceof Promo)
        {
            $this->purchasePath = $free
                ? 'freepromo'
                : 'promo';
        }
        else
        {
            $this->purchasePath = $free
                ? 'free'
                : 'credits';
        }
    }
    private function _getPurchaseCost(Catalog $catalog)
    {
        if($this->promo instanceof Promo)
        {
            return $this->promo->promo_cost;
        }
        return $catalog->cost;
    }
    private function _getPurchaseModel($id)
    {
        return strToLower(explode('-', $id)[0]);
    }
    private function _validate(Catalog $catalog)
    {
        if(!$catalog->isValid())
        {
            throw new \Exception('Catalog item '.$catalog->mid. ' is not valid.', 1);
        }
        if($this->promoCode instanceof PromoCode)
        {
            if($this->promoCode->used)
            {
                throw new \Exception('Code: '.$this->promoCode->code.' has already been used.', 1);
            }
            if($this->promoCode->admin_invalidated)
            {
                throw new \Exception('Code: '.$this->promoCode->code.' is not valid.', 1);
            }
            if($this->promo->admin_invalidated)
            {
                throw new \Exception('The promotion for the follow code is not valid: '.$this->promoCode->code, 1);
            }
        }
    }
    private function _setupPromo()
    {
        $this->promo = $this->promoCode->promo()->first();
    }
    private function _getCatalog($id)
    {
        $model = $this->_getPurchaseModel($id);
        if($model !== 'catalog')
        {
            // If it's not a catalog mid, assume it's a promo code.
            $this->promoCode = (new PromoHandler)->resolvePromoCode($id);
            if($this->promoCode instanceof PromoCode)
            {
                $this->_setupPromo();
                $id = $this->promo->catalog_id;
            }
            else
            {
                throw new \Exception('Item or promo code '.$id.' is not valid.', 1);
            }
        }
        return Catalog::where('mid', '=', $id)->first();
    }
}
