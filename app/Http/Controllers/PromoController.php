<?php 

namespace App\Http\Controllers\V1;

use Sellout\Promo;
use App\Http\Requests;
use Sellout\PromoHandler;
use App\Http\Requests\PromoRequest;
use App\Http\Controllers\Controller;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $promos = Promo::with('catalog', 'codes')->get();
        return response()->json(['promos' => $promos]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PromoRequest $request)
    {
        $p = new PromoHandler($request->all());
        $promo = $p->create();
        return response()->json(['promo' => $promo]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $promos = Promo::with('catalog', 'codes')
            ->where('catalog_id', '=', $id)
            ->get();
        return response()->json(['promos' => $promos]);
    }
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function destroy($id)
    // {
    //     $promo = Bus::dispatch(new Cmd\DeletePromoCommand($id, true));
    //     return response()->json(['status' => $promo]);
    // }
    public function invalidate($id)
    {
        $promo = Promo::where('mid', $id)->first();
        $invalidated = $promo->invalidate();
        $codes = $promo->invalidateCodes();
        return response()->json(['status' => $promo]);
    }
}
