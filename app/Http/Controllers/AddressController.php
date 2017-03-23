<?php

namespace App\Http\Controllers\V1;

use Auth;
use Sellout\Address;
use App\Http\Requests;
use App\Http\Requests\AddressRequest;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function store(AddressRequest $request)
    {
        $user = Auth::user();
        $address = Address::create($request->all());
        $address->user()->associate($user);
        $address->save();
        return response()->json($address);
    }
}
