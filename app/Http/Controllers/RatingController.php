<?php

namespace App\Http\Controllers\V1;

use Sellout\Rating;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    protected $eagerLoad = [
    'agency'
];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Rating::with($this->eagerLoad)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json(Rating::with($this->eagerLoad)
            ->where('mid', '=', $id)->first());
    }

}
