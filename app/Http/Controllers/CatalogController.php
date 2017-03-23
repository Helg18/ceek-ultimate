<?php

namespace App\Http\Controllers\V1;

use Sellout\Catalog;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    protected $eagerLoad = [];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['catalogs' => Catalog::with($this->eagerLoad)->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json(['catalog' => Catalog::with($this->eagerLoad)
            ->where('mid', '=', $id)->first()]);
    }
}
