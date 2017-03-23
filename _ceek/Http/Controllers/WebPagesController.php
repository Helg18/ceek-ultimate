<?php

namespace Ceek\Http\Controllers;

use Mail;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Product;
use App\Orders;
use App\OrdersDetails;
use App\Http\Controllers\Controller;

use Stripe\Charge;
use Stripe\Stripe;

class WebPagesController extends Controller
{
    public function index()
    {
        return view('ceek.home');
    }

    public function listCountries()
    {
        return view('ceek.list-countries');
    }

    public function listStates()
    {
        return view('ceek.list-states');
    }

    public function dashboard()
    {
        return view('ceek.dashboard');
    }

    public function ceekars()
    {
        return view('ceek.ceekars.index');
    }

    public function megadeth()
    {
        return view('ceek.megadeth.index');
    }

    public function help()
    {
        return view('ceek.help');
    }
    public function contact()
    {
        return view('ceek.contact');
    }

    public function privacyPolicy()
    {
        return view('ceek.privacy-policy');
    }

    public function terms()
    {
        return view('ceek.terms');
    }

    public function healthSafety()
    {
        return view('ceek.health-safety');
    }

    public function careers()
    {
        return view('ceek.careers');
    }

    public function aboutUs()
    {
        return view('ceek.about-us');
    }

    public function vrHeadset() {
        return view('ceek.vr-headset');
    }

    public function vrLabs() {
        return view('ceek.vr-labs');
    }

    public function blogPage() {
        return view('ceek.blog');
    }

    public function finalStep($id) {
        
        return view('ceek.final-step', ['product' => Product::find($id)]); 
    }

    public function finalstepPost(Request $request) {

        if (app()->environment('local')) {
            Stripe::setApiKey('sk_test_PhCKBvdZ1O6ZgEF6Os7EddY4');
        }
        else {
            Stripe::setApiKey('sk_live_76dcv2vgYhgCQUd55t3UdWfX');
        }
        
        $product = Product::find($request->input('product_id'));
        
        $shipping = 5.95;

        if ($request->input('shipping_state') === 'US' || $request->input('shipping_state') === 'CA') {
            $final_price = number_format($product->price + $shipping, 2);
        }
        else
        {
            $shipping = 7.95;
            $final_price = number_format($product->price + $shipping, 2);   
        }

        $client = $request->input('shipping_name').' '.$request->input('shipping_lastname');
        $address = $request->input('shipping_address').' '.$request->input('shipping_address_two').', '.$request->input('shipping_state').' '.$request->input('shipping_zipcode').', '.$request->input('shipping_city').'-'.$request->input('country_name');

        $address_short = $request->input('shipping_address').' '.$request->input('shipping_address_two');

        try {
            $charge = Charge::create(array(
              "amount" => $final_price * 100,
              "currency" => "usd",
              "source" => $request->input('stripeToken'),
              "description" => $product->title
            ));

            $order = new Orders();
            $order->client = $client;
            $order->address = $address;
            $order->email = $request->input('billing_email');
            $order->total = $final_price;
            $order->payment_id = $charge->id;
            $order->save();
            $lastOrderId = $order->id;

            $details = new OrdersDetails();
            $details->pro_id = $product->id;
            $details->ord_id = $lastOrderId;
            $details->price = $product->price;
            $details->shipping = $shipping;
            $details->quantity = 1;
            $details->save();

        } catch (\Exception $e) {
            dd($e->getMessage());
            //return redirect()->route('pages.final-step', $product)->with('error', $e->getMessage());
        }
        
        $data = array(
                        'name' => $client, 
                        'address' => $address_short, 
                        'zipcode' => $request->input('shipping_state').' / '.$request->input('shipping_zipcode'),
                        'city' => $request->input('shipping_city'), 
                        'country' => $request->input('country_name'),
                        'product' => $product->title, 
                        'details' => $product->description,
                        'order' => $lastOrderId, 
                        'price' => '$ ' . $final_price,
                        'lastfourDigit' => $request->input('lastfour')
        );

        Mail::send('emails.customer', $data, function ($message) use ($request) {

            $message->from('sales@ceek.com', 'Ceek');

            $message->to($request->input('billing_email'), $request->input('billing_name').' '.$request->input('billing_lastname'))->subject('Success purchase');

        });

        Mail::send('emails.provider', $data, function ($message) {

            $message->from('sales@ceek.com', 'Ceek');

            $message->to('sales@ceek.com', 'Providers')->subject('Process Sell');

        });
        
        return redirect()->route('pages.order-confirmed');
        
    }
    
    public function orderConfirmed() {
        return view('ceek.order-confirmed');
    }

    public function zombieChase()
    {
        return view('ceek.games.zombie');
    }

}