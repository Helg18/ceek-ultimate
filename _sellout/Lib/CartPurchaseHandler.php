<?php

namespace Sellout;

use DB;
use Event;
use Sqlnest;
use Exception;
use Sellout\User;
use Sellout\Cart;
// use Sellout\Catalog;
use Sellout\PlayRight;
// use Sellout\PromoCode;
// use Sellout\CashierHandler;
// use Sellout\SqlNestedFieldAdapter;
use Sellout\CartBuilder;
use App\Events\CartPurchased;
use Illuminate\Database\Eloquent\Collection;

/**
 * Library to handle logic for the purchases of content.
 */

class CartPurchaseHandler
{

    public $cart = null;
    public $user = null;
    protected $catalogs = null;
    protected $promo_codes = null;

    public function buyCart($object = null)
    {
        $this->_setUserAndCart($object);
        $this->_setCatalogs();
        $this->_setPromoCodes();
        DB::beginTransaction();
        $purchases = $this->_createPurchases();
        $this->_addPlayRights($this->catalogs);
        $this->_consumeUserCredits($this->cart->total);
        $this->_consumePromoCodes();
        $transaction = null;
        $this->_firePurchaseEvents($this->cart, $purchases, $transaction);
        (new CartBuilder)->emptyCart($this->user);
        DB::commit();
        return true;
    }
    private function _firePurchaseEvents(Cart $cart, $purchases, Transaction $transaction = null)
    {
        Event::fire(new CartPurchased($this->user, $cart, $purchases, $transaction));
    }
    private function _consumePromoCodes()
    {
        if($this->cart->hasPromos())
        {
            foreach($this->promo_codes as $code)
            {
                $code->update(['used' => true]);
            }
            return true;
        }
        return false;
    }
    private function _userHasTheCredits($cost)
    {
        if($this->user->credits >= $cost)
        {
            return true;
        }
        return false;
    }
    private function _consumeUserCredits($cost)
    {
        if($this->_userHasTheCredits($cost))
        {
            if($cost === 0) return true;
            $this->user->credits = $this->user->credits - $cost;
            if($this->user->isDirty()) $this->user->save();
            return true;
        }
        throw new Exception("Insufficient credits. You have ".$this->user->credits." out of ".$cost." required credits.");
    }
    private function _updatePlayRights(Collection $rights, Array $playRightsUpdate)
    {
        if(count($playRightsUpdate) === 0 || $rights->count() === 0) return;
        foreach($rights as $right)
        {
            $right->plays_left = $right->plays_left + $playRightsUpdate[$right->video_id]['play_count'];
            $right->save();
        }
    }
    private function _createPlayRights(Array $definitions)
    {
        if(count($definitions) === 0) return;
        foreach($definitions as $definition)
        {
            $right = new PlayRight;
            $right->plays_left = $definition['play_count'];
            $right->plays_unlimited = $definition['plays_unlimited'];
            $right->user_id = $this->user->id;
            $right->video_id = $definition['video_id'];
            $right->save();
        }
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
    private function _separatePlayRights(Collection $rights, Array $definitions)
    {
        $playRights['create'] = [];
        $playRights['update'] = [];
        foreach($definitions as $definition)
        {
            if($rights->where('video_id', $definition['video_id'])->first() instanceof PlayRight)
            {
                $playRights['update'][$definition['video_id']] = $this->_setPlayCount($definition);
            }
            else
            {
                $playRights['create'][] = $this->_setPlayCount($definition);
            }
        }
        return $playRights;
    }
    private function _getCurrentPlayRights($ids)
    {
        return PlayRight::whereIn('video_id', $ids)
            ->where('user_id', $this->user->id)
            ->get();
    }
    private function _concantonateRights(Array $rights)
    {
        if(count($rights) === 0) return [];
        $playRights = [];
        foreach($rights as $right)
        {
        if(!isset($playRights[$right['video_id']]))
            {
                $playRights[$right['video_id']] = [
                    'video_id' => $right['video_id'],
                    'play_count' => 0,
                    'plays_unlimited' => false,
                ];
            }
        }
        foreach($playRights as $id => &$playRight)
        {
            foreach($rights as $right)
            {
                if($id === $right['video_id'])
                {
                    if($right['plays_unlimited'] === true)
                    {
                        $playRight['plays_unlimited'] = true;
                    }
                    $playRight['play_count'] += $right['play_count'];
                }
            }
        }
        return $playRights;
    }
    private function _getVideoDefinitions($catalogs)
    {
        $nest = new Sqlnest;
        $ids = [];
        $definition = [];
        $definitions = [
            'ids' => [],
            'details' => [],
        ];
        foreach($catalogs as $catalog)
        {
            foreach($catalog->videos as $video)
            {
                $ids = [
                    'video_id' => $video->id,
                    'mid' => $video->mid,
                ];
                $definitions['ids'][] = $video->id;
                $definition = $nest->toArray($video->pivot->definition);
                $definitions['details'][] = array_merge($ids, $definition);
            }
        }
        return $definitions;
    }
    private function _addPlayRights($catalogs)
    {
        $videoDefinitions = $this->_getVideoDefinitions($catalogs);
        $definitions = $this->_concantonateRights($videoDefinitions['details']);
        $currentPlayRights = $this->_getCurrentPlayRights($videoDefinitions['ids']);
        $playRightsToAdd = $this->_separatePlayRights($currentPlayRights, $definitions);
        $this->_createPlayRights($playRightsToAdd['create']);
        $this->_updatePlayRights($currentPlayRights, $playRightsToAdd['update']);
    }
    private function _storePurchases(Array $purchases)
    {
        $purchaseCollection = collect();
        foreach($purchases as $purchase)
        {
            $p = new Purchase;
            foreach($purchase as $k => $v)
            {
                $p->$k = $v;
            }
            $p->save();
            $purchaseCollection->push($p);
        }
        return $purchaseCollection;
    }
    private function _stripCatalogMids(Array $purchases)
    {
        foreach($purchases as &$purchase)
        {
            if(isset($purchase['catalog_mid'])) unset($purchase['catalog_mid']);
        }
        return $purchases;
    }
    private function _applyPromoValues(PromoCode $code, Array &$purchases)
    {
        foreach($purchases as &$purchase)
        {
            if($purchase['catalog_mid'] === $code->promo->catalog_id)
            {
                $promo_cost = $code->promo->promo_cost;
                $path = $promo_cost >= 1
                    ? 'promo'
                    : 'freepromo';
                $purchase['paid'] = $promo_cost;
                $purchase['purchasePath'] = $path;
                $purchase['promo_code'] = $code->code;
                return true;
            }
        }
        return false;
    }
    private function _applyPromosToPurchases(Array $purchases)
    {
        if($this->cart->hasPromos())
        {
            foreach($this->promo_codes as $code)
            {
                $this->_applyPromoValues($code, $purchases);
            }
        }
        return $purchases;
    }
    private function _createPurchases()
    {
        $purchases = [];
        foreach($this->catalogs as $catalog)
        {
            $path = $catalog->cost >= 1
                ? 'credits'
                : 'free';
            $purchases[] = [
                'catalog_mid' => $catalog->mid,
                'user_id' => $this->user->id,
                'catalog_id' => $catalog->id,
                'paid' => $catalog->cost,
                'purchasePath' => 'credits',
            ];
        }
        $purchases = $this->_applyPromosToPurchases($purchases);
        $purchases = $this->_stripCatalogMids($purchases);
        return $this->_storePurchases($purchases);
    }
    private function _getPromoCodeRecords(Array $ids)
    {
        return PromoCode::wherein('id', $ids)->get();
    }
    private function _getPromoCodeIds(Array $codes)
    {
        $ids = false;
        if(count($codes) >= 1)
        {
            foreach($codes as $code)
            {
                $ids[] = $code->id;
            }
        }
        return $ids;
    }
    private function _setPromoCodes()
    {
        if($this->cart->hasPromos())
        {
            $code_ids = $this->_getPromoCodeIds($this->cart->promos);
            $promo_codes = $this->_getPromoCodeRecords($code_ids);
            $this->promo_codes = collect();
            foreach($promo_codes as $code)
            {
                if($code->isValid() && $code->promo->isValid())
                {
                    $this->promo_codes->push($code);
                }
                else
                {
                    throw new Exception("Promo ".$code->code." is invalid.", 1);
                }
            }
        }
    }
    private function _setCatalogs()
    {
        $this->catalogs = collect();
        if(!count($this->cart->catalogs) >= 1) throw new Exception("Cart is empty", 1);
        foreach($this->cart->catalogs as $catalog)
        {
            if($catalog->isValid())
            {
                $this->catalogs->push($catalog);
            }
            else
            {
                throw new Exception("Catalog ".$catalog->mid." is invalid.", 1);
            }
        }
    }
    private function _getCartUser($cart)
    {
        $user = User::where('id', $cart->user_id)->first();
        return $user;
    }
    private function _getUserCart($user)
    {
        $cart = Cart::where('user_id', $user->id)->first();
        return $cart;
    }
    private function _setUserAndCart($object)
    {
        if(!is_null($object))
        {
            if($object instanceof Cart)
            {
                $this->cart = $object;
            }
            elseif($object instanceof User)
            {
                $this->user = $object;
                $this->cart = $this->_getUserCart($object);
            }
        }
        if($this->cart instanceof Cart)
        {
            $this->user = $this->_getCartUser($this->cart);
        }
        elseif($this->user instanceof User)
        {
            $this->cart = $this->_getUserCart($this->user);
        }
        else
        {
            throw new Exception("User or cart required", 1);
        }
        return true;
    }
}


    // public function __construct(User $user, $id, $direct=false, $useExistingCredits=true)
    // {
    //     $this->user = $user;
    //     if($direct)
    //     {
    //         $this->directPurchaseContent($user, $id, $useExistingCredits);
    //     }
    //     else
    //     {
    //         $this->purchaseContent($user, $id);
    //     }
    // }
    // public function directPurchaseContent(User $user, $id, $useExistingCredits=true)
    // {
    //     $catalog = $this->_getCatalog($id);
    //     $this->_validate($catalog);
    //     $cost = $this->_getPurchaseCost($catalog);
    //     $this->_setPurchasePath($cost);
    //     $toCharge = $useExistingCredits
    //         ? $cost - $this->user->credits
    //         : $cost;
    //     $videoDefinitions = $this->_getVideoDefinitions($catalog);
    //     $currentPlayRights = $this->_getCurrentPlayRights($videoDefinitions['ids'], $user);
    //     $playRightsToAdd = $this->_separatePlayRights($currentPlayRights, $videoDefinitions['details']);
    //     DB::beginTransaction();
    //     if($useExistingCredits && ($cost - $toCharge > 0))
    //     {
    //         $this->_chargeUser($catalog, ($cost - $toCharge));
    //     }
    //     $this->_consumePromoCode();
    //     $purchase = $this->_addPurchase($catalog, $cost);
    //     $this->_addPlayRights($currentPlayRights, $playRightsToAdd);
    //     $transaction = $this->_chargeUserCard($toCharge);
    //     DB::commit();
    //     $this->_firePurchaseEvents($catalog, $purchase, $transaction);
    //     return true;
    // }
    // public function purchaseContent(User $user, $id)
    // {
    //     $catalog = $this->_getCatalog($id);
    //     $this->_validate($catalog);
    //     $cost = $this->_getPurchaseCost($catalog);
    //     $this->_setPurchasePath($cost);
    //     $videoDefinitions = $this->_getVideoDefinitions($catalog);
    //     $currentPlayRights = $this->_getCurrentPlayRights($videoDefinitions['ids'], $user);
    //     $playRightsToAdd = $this->_separatePlayRights($currentPlayRights, $videoDefinitions['details']);
    //     DB::beginTransaction();
    //     $this->_chargeUser($catalog, $cost);
    //     $this->_consumePromoCode();
    //     $purchase = $this->_addPurchase($catalog, $cost);
    //     $this->_addPlayRights($currentPlayRights, $playRightsToAdd);
    //     DB::commit();
    //     $this->_firePurchaseEvents($catalog, $purchase);
    //     return true;
    // }
    // private function _chargeUserCard($toCharge)
    // {
    //     if(!$toCharge > 0) return;
    //     $cashier = new CashierHandler($this->user);
    //     return $cashier->addCredits(['credits' => $toCharge], false);
    // }
