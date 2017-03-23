<?php

namespace App\Http\Controllers\V1;

use Auth;
// use App\Http\Requests;
use App\Http\Requests\AddCreditsRequest;
use App\Http\Requests\AddCardRequest;
use App\Http\Controllers\Controller;
use Sellout\CashierHandler;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $user = Bus::dispatch(new Cmd\GetStripeInfoCommand(Auth::user()));
        // return response()->json(['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AddCreditsRequest $request)
    {
        $cashier = new CashierHandler(Auth::user());
        return $cashier->addCredits($request->all());
    }

    public function addcard(AddCardRequest $request)
    {
        $cashier = new CashierHandler(Auth::user());
        return $cashier->addCard($request->all());
    }
}
