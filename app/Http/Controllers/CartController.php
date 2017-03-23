<?php

namespace App\Http\Controllers\V1;

use Auth;
use Sellout\CartBuilder;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function buy()
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->buy();
        return $cart
            ? response()->json(['status' => 'success'])
            : response()->json(['status' => 'failed']);
    }
    public function remove($mid)
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->remove($mid);
        return response()->json($cart->load('catalogs'));
    }
    public function add($mid)
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->add($mid);
        return $cart === false
            ? abort(404, 'Catalog item not found')
            : response()->json($cart->load('catalogs'));
    }
    public function emptyCart()
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->emptyCart();
        return response()->json($cart->load('catalogs'));
    }
    public function index()
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->index();
        return response()->json($cart->load('catalogs'));
    }
}
