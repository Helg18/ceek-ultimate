<?php

namespace Ceek\Http\Controllers\Api;

use Auth;
use Sellout\Catalog;
use App\Http\Controllers\Controller;
use Ceek\Http\Requests\Api\PaymentUpdateRequest;
use Ceek\Http\Requests\Api\PaymentChargeRequest;


class PaymentController extends Controller
{
    public function ready()
    {
        if(Auth::user()->hasStripeId())
        {
            if(Auth::user()->asStripeCustomer()->id === Auth::user()->stripe_id)
            {
                return response()->json(['payment_ready' => true]);
            }
        }
        return response()->json(['payment_ready' => false]);
    }

    public function update(PaymentUpdateRequest $request)
    {
        if(!Auth::user()->hasStripeId())
        {
            $su = Auth::user()->createAsStripeCustomer($request->stripeToken);
            return response()->json(['payment_ready' => $su === Auth::user()->stripe_id]);
        }
        Auth::user()->updateCard($request->stripeToken);
        return response()->json(['payment_ready' => true]);
    }

    public function charge(PaymentChargeRequest $request)
    {
        if(!Auth::user()->hasStripeId())
        {
            return response()->json(['status' => 'User has no billing details on file'], 403);
        }
        $c = Catalog::where('mid', $request->mid)->firstOrFail();
        $receipt = Auth::user()->charge($c->cost, ['description' => $c->name]);
        return response()->json(['status' => $receipt['status']]);
    }
}
