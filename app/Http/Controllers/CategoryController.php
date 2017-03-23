<?php

namespace App\Http\Controllers\V1;

use Sellout\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $eagerLoad = [];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['categories' => Category::with($this->eagerLoad)->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json(['category' => Category::with($this->eagerLoad)
            ->where('mid', '=', $id)->first()]);
    }
}
