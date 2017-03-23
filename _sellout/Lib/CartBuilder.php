<?php

namespace Sellout;

use Sellout\User;
use Sellout\Cart;
use Sellout\Catalog;
use Sellout\PromoCode;
use Sellout\PromoHandler;
use Sellout\CartPurchaseHandler;

class CartBuilder
{
    public $user;
    private $promoCode = null;

    public function buy(User $user = null)
    {
        $this->_setUser($user);
        $cart = $this->_getUserCart();
        $purchased = $this->_buyCart($cart);
        return $purchased;
    }
    public function remove($mid, User $user = null)
    {
        $this->_setUser($user);
        $cart = $this->_getUserCart();
        $this->_removeCartItem($mid, $cart);
        $cart = $this->_refreshCart();
        return $cart;
    }
    public function emptyCart(User $user = null)
    {
        $this->_setUser($user);
        $cart = $this->_getUserCart();
        $this->_removeCatalogsFromCart($cart);
        $this->_removePromosFromCart($cart);
        $cart = $this->_refreshCart();
        return $cart;
    }
    public function add($catalog_mid, User $user = null)
    {
        $this->_setUser($user);
        $catalog = $this->_getCatalog($catalog_mid);
        $cart = $this->_getUserCart();
        $this->_addCatalogToCart($catalog, $cart);
        if(!is_null($this->promoCode)) $this->_addPromoToCart($cart);
        $cart = $this->_refreshCart();
        return $cart;
    }
    public function index(User $user = null)
    {
        $this->_setUser($user);
        return $this->_refreshCart();
    }
    private function _buyCart(Cart $cart)
    {
        $handler = new CartPurchaseHandler;
        $handler->cart = $cart;
        $purchase = $handler->buyCart();
        return $purchase;
    }
    private function _removeCartItem($mid, Cart $cart)
    {
        $catalog = $this->_getCatalog($mid);
        if($this->promoCode instanceof PromoCode)
        {
            $promoRemoved = $this->_removePromoFromCart($this->promoCode, $cart);
            if(!$promoRemoved) return abort(400, 'Promo '.$this->promoCode->code.' could not be removed from the cart.');
        }
        $catalogRemoved = $this->_removeCatalogFromCart($catalog, $cart);
        $cart = $catalogRemoved
            ? $this->_refreshCart()
            : abort(400, 'Catalog '.$catalog->mid.' could not be removed from the cart.');
        return $cart;
    }
    private function _catalogIsRequiredForPromo(Catalog $catalog, Cart $cart)
    {
        if(count($cart->promos) === 0) return false;
        $catalog_mid = $catalog->mid;
        $cart_count = 0;
        $promo_count = 0;
        foreach($cart->promos as $promo)
        {
            if($promo->promo->catalog_id === $catalog_mid) $promo_count++;
        }
        foreach($cart->catalogs as $cartItem)
        {
            if($cartItem->mid === $catalog_mid) $cart_count++;
        }
        return ($promo_count >= $cart_count);
    }
    private function _removeCatalogFromCart(Catalog $catalog, Cart $cart)
    {
        if(count($cart->catalogs) === 0) return false;
        if($this->_catalogIsRequiredForPromo($catalog, $cart)) return false;
        foreach($cart->catalogs as $cartItem)
        {
            if($cartItem->mid === $catalog->mid)
            {
                \DB::table('cart_catalog')
                    ->where('cart_id', $cart->id)
                    ->where('catalog_id', $catalog->id)
                    ->limit(1)
                    ->delete();
                return true;
            }
        }
        return false;
    }
    private function _removePromoFromCart(PromoCode $code, Cart $cart)
    {
        if(count($cart->promos) === 0) return false;
        foreach($cart->promos as $i => $promo)
        {
            if($promo->code === $code->code)
            {
                $cart_promos = $cart->promos;
                unset($cart_promos[$i]);
                $cart->promos = count($cart_promos) > 0
                    ? $cart_promos
                    : null;
                if($cart->isDirty()) $cart->save();
                return true;
            }
        }
        return false;
    }
    private function _removePromosFromCart(Cart $cart)
    {
        $cart->promos = null;
        if($cart->isDirty()) $cart->save();
    }
    private function _alreadyHasPromo($promos)
    {
        if(!is_null($promos))
        {
            foreach($promos as $promo)
            {
                if($promo->code === $this->promoCode->code) return true;
            }
        }
        return false;
    }
    private function _buildPromoArray($promoCodes)
    {
        $codes = [];
        foreach($promoCodes as $code)
        {
            $codes[] = $code;
        }
        return $codes;
    }
    private function _addPromoToCart($cart)
    {
        if($this->_alreadyHasPromo($cart->promos))
        {
            return abort(403, 'Promo '.$this->promoCode->code.' is already in your cart.');
        }
        $count = count($cart->promos);
        $promoCodes = $count > 0
            ? $this->_buildPromoArray($cart->promos)
            : null;
        $promoCodes[$count] = $this->promoCode;
        $cart->promos = $promoCodes;
        if($cart->isDirty()) $cart->save();
    }
    private function _applyPromoPrice(&$items, $code)
    {
        foreach($items as &$item)
        {
            if($item['mid'] === $code->promo->catalog_id && $item['promo_price'] === false)
            {
                $item['cost'] = $code->promo->promo_cost;
                $item['promo_price'] = true;
                return;
            }
        }
    }
    private function _calculateCartTotal($cart)
    {
        $cart_total = 0;
        $items = [];
        foreach($cart->catalogs as $catalog)
        {
            $items[] = [
                'mid' => $catalog->mid,
                'cost' => $catalog->cost,
                'promo_price' => false,
            ];
        };
        if($cart->hasPromos())
        {
            foreach($cart->promos as $code)
            {
                $this->_applyPromoPrice($items, $code);
            }
        }
        foreach($items as $item)
        {
            $cart_total += $item['cost'];
        }
        return $cart_total;
    }
    private function _calculateCartCatalogCount($cart)
    {
        return count($cart->catalogs);
    }
    private function _refreshCart()
    {
        $cart = $this->_getUserCart();
        $cart->count = $this->_calculateCartCatalogCount($cart);
        $cart->total = $this->_calculateCartTotal($cart);
        if($cart->isDirty()) $cart->save();
        return $cart;
    }
    private function _removeCatalogsFromCart($cart)
    {
        foreach($cart->catalogs as $catalog)
        {
            $cart->catalogs()->detach($catalog);
        }
        if($cart->isDirty()) $cart->save();
    }
    private function _addCatalogToCart(Catalog $catalog, Cart $cart)
    {
        $cart->catalogs()->attach($catalog);
        if($cart->isDirty()) $cart->save();
    }
    private function _userNeedsCart()
    {
        $cart = Cart::create([]);
        $this->user->cart()->save($cart);
        return $cart;
    }
    private function _getUserCart()
    {
        if(is_null($this->user->cart))
        {
            $this->_userNeedsCart();
        }
        $cart = Cart::where('user_id', $this->user->id)->first();
        return $cart;
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
            if($this->promoCode->promo->admin_invalidated)
            {
                throw new \Exception('The promotion for the follow code is not valid: '.$this->promoCode->code, 1);
            }
        }
    }
    private function _setupPromo(PromoCode $promoCode)
    {
        if($promoCode->promo instanceof Promo)
        {
            return $this->promoCode;
        }
        return false;
    }
    private function _getCatalog($mid)
    {
        if($mid instanceof Catalog) return $mid;
        $model = $this->_getPurchaseModel($mid);
        if($model !== 'catalog')
        {
            // It's not a catalog mid, assume it's a promo code.
            $this->promoCode = (new PromoHandler)->resolvePromoCode($mid);
            if($this->promoCode instanceof PromoCode)
            {
                $this->_setupPromo($this->promoCode);
                $mid = $this->promoCode->promo->catalog_id;
            }
            else
            {
                throw new \Exception('Item or promo code '.$mid.' is not valid.', 1);
            }
        }
        $catalog = Catalog::where('mid', '=', $mid)->first();
        if($catalog instanceof Catalog)
        {
            $this->_validate($catalog);
            return $catalog;
        }
        return abort(404, 'Catalog not found.');
    }
    private function _getPurchaseModel($id)
    {
        return strToLower(explode('-', $id)[0]);
    }
    private function _setUser($user)
    {
        if(!is_null($user)) $this->user = $user;
        if(is_null($this->user))
        {
            throw new \Exception("User required", 1);
        }
    }
}
