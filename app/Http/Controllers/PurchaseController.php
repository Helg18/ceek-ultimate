<?php

namespace App\Http\Controllers\V1;

use Auth;
use Sellout\Purchase;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Auth::user()->load('purchases');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function buy($id)
    {
        $purchase = Purchase::buy(Auth::user(), $id);
        return response()->json(['user' => Auth::user()->load('purchases')]);
    }
    public function buyDirect($id)
    {
        $purchase = Purchase::buyDirect(Auth::user(), $id);
        return response()->json(['user' => Auth::user()->load('purchases')]);
    }
    public function buyDirectFull($id)
    {
        $purchase = Purchase::buyDirectFull(Auth::user(), $id);
        return response()->json(['user' => Auth::user()->load('purchases')]);
    }

}
