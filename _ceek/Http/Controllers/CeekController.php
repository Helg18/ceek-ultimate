<?php

namespace Ceek\Http\Controllers;

use DB;
use Auth;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sellout\User;
use Sellout\Token;
use Sellout\Promo;
use Sellout\Video;
use Sellout\Catalog;
use Sellout\Avatar;
use Sellout\Rating;
use Sellout\Address;
use Sellout\Category;
use Sellout\Purchase;
use Sellout\PlayRight;
use Sellout\CartBuilder;
use Sellout\PromoHandler;
use Sellout\CashierHandler;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\PromoRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\AddCardRequest;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\AddCreditsRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\MegadethRegBuyRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;

class CeekController extends Controller
{
    use ResetsPasswords;

    //  /special/megadeth methods
    public function megadethRegBuy(MegadethRegBuyRequest $request)
    {
        DB::beginTransaction();
        $user = User::create($request->all());
        // $avatar = Avatar::generate($user);
        $token = Token::generate($user, $request->header('deviceid'));
        if(is_null($user->stripe_id))
        {
            $cashier = new CashierHandler($user);
            $results = $cashier->addCard($request->all());
        }
        $promo = Request::input('promo', false);
        $special = Request::input('special', false);
        $mid = ($promo)
            ? $promo
            : $special;
        $purchase = Purchase::buyDirect($user, $mid);
        DB::commit();
        return response()->json(['user' => $user->load('purchases', 'receipts')]);
    }
    public function megadethIndex()
    {
        // $videos = Video::with('playrights')
        //     ->whereHas('playrights', function ($query) {
        //         $query->where('user_id', '=', Auth::user()->id);
        //     })->where('slug', 'like', 'video-megadeth-%')
        //     ->get();
        $cat = Catalog::with('videos')->where('slug', 'megadeth-2016-bundle')->first();
        // $return = $videos->count() > 0
        //     ? ['videos' => $videos]
        //     : ['status' => false];
        // return response()->json($return);
        return response()->json([$cat->videos]);
    }
    public function megadethRightsIndex()
    {
        return response()->json(Auth::user()->hasVideoContent('megadeth_2016_%'));
    }

    public function megadethQuickBuy(AddCardRequest $request)
    {
        $user = Auth::user();
        if(is_null($user->stripe_id))
        {
            $cashier = new CashierHandler($user);
            $results = $cashier->addCard($request->all());
        }
        $promo = Request::input('promo', false);
        $special = Request::input('special', false);
        $mid = ($promo)
            ? $promo
            : $special;
        $purchase = Purchase::buyDirect($user, $mid);
        return response()->json(['user' => $user->load('purchases', 'receipts')]);
    }
    public function megadethBuy()
    {
        $promo = Request::input('promo', false);
        $special = Request::input('special', false);
        $mid = (!$promo && $special)
            ? Catalog::where('slug', '=', 'megadeth-2016-bundle')
                ->first()->mid
            : $promo;
        $purchase = Purchase::buy(Auth::user(), $mid);
        return response()->json(['user' => Auth::user()->load('purchases', 'receipts')]);
    }


    //  /cart methods
    public function cartBuy()
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->buy();
        return $cart
            ? response()->json(['status' => 'success'])
            : response()->json(['status' => 'failed']);
    }
    public function cartRemove($mid)
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->remove($mid);
        return response()->json($cart->load('catalogs'));
    }
    public function cartAdd($mid)
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->add($mid);
        return $cart === false
            ? abort(404, 'Catalog item not found')
            : response()->json($cart->load('catalogs'));
    }
    public function cartEmpty()
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->emptyCart();
        return response()->json($cart->load('catalogs'));
    }
    public function cartIndex()
    {
        $cartBuilder = new CartBuilder;
        $cartBuilder->user = Auth::user();
        $cart = $cartBuilder->index();
        return response()->json($cart->load('catalogs'));
    }


    //  /address methods
    public function addressStore(AddressRequest $request)
    {
        $user = Auth::user();
        $address = Address::create($request->all());
        $address->user()->associate($user);
        $address->save();
        return response()->json($address);
    }


    //  /promo methods
    public function promoIndex()
    {
        $promos = Promo::with('catalog', 'codes')->get();
        return response()->json(['promos' => $promos]);
    }
    public function promoStore(PromoRequest $request)
    {
        $p = new PromoHandler($request->all());
        $promo = $p->create();
        return response()->json(['promo' => $promo[0]->load('codes')]);
    }
    public function promoShow($id)
    {
        $promos = Promo::with('catalog', 'codes')
            ->where('catalog_id', '=', $id)
            ->get();
        return response()->json(['promo' => $promos]);
    }
    public function promoInvalidate($id)
    {
        $promo = Promo::where('mid', $id)->first();
        $invalidated = $promo->invalidate();
        $codes = $promo->invalidateCodes();
        return response()->json(['status' => $promo]);
    }
    public function promoCodesInvalidate($id)
    {
        $promo = Promo::where('mid', $id)->first();
        $codes = $promo->invalidateCodes();
        return response()->json(['status' => $promo]);
    }


    //  /cashier methods
    public function cashierStore(AddCreditsRequest $request)
    {
        $cashier = new CashierHandler(Auth::user());
        return $cashier->addCredits($request->all());
    }

    public function cashierAddcard(AddCardRequest $request)
    {
        $cashier = new CashierHandler(Auth::user());
        return $cashier->addCard($request->all());
    }


    //  /purchase methods
    public function purchasePlay()
    {
        $mid = Request::input('video');
        $video = Video::where('mid', '=', $mid)->firstOrFail();
        return $video->play(Auth::user());
    }
    public function purchaseIndex()
    {
        return Auth::user()->load('purchases');
    }
    public function purchaseStore()
    {
        $id = is_null(Request::input('promo'))
            ? Request::input('video')
            : Request::input('promo');
        if(strtolower(substr($id, 0, 6)) === 'video-' && substr($id, 20, 1) === '4') return abort(400, 'You must use a catalog mid to make a purchase.');
        $purchase = Purchase::buy(Auth::user(), $id);
        return response()->json(['user' => Auth::user()->load('purchases')]);
    }


    //  /rating methods
    public function ratingIndex()
    {
        return response()->json(['ratings' => Rating::with('agency')
            ->get()]);
    }
    public function ratingShow($id)
    {
        return response()->json(['rating' => Rating::with('agency')
            ->where('mid', '=', $id)
            ->first()]);
    }


    //  /category methods
    public function categoryIndex()
    {
        return response()->json(['categories' => Category::all()]);
    }
    public function categoryShow($id)
    {
        return response()->json(['category' => Category::where('mid', '=', $id)
            ->first()]);
    }


    //  /video methods
    public function videoIndex()
    {
        return response()->json(['videos' => Catalog::with('videos','hardwares','videos.rating.agency','videos.categories','videos.image')
            ->get()]);
        // return response()->json(['videos' => Video::with('rating.agency','categories','image')
        //     ->get()]);
    }
    public function videoShow($id)
    {
        return response()->json(['videos' => Catalog::with('videos','hardwares','videos.rating.agency','videos.categories','videos.image')
            ->where('mid', '=', $id)
            ->first()]);
        // return response()->json(['video' => Video::with('rating.agency','categories','image')
        //     ->where('mid', '=', $id)
        //     ->first()]);
    }
    public function videoStoreImage(ImageRequest $input, $id)
    {
        $video = Video::findOrFail( $id );
        $image = Image::create( $input->all() );
        $image->video()->associate( $video )->save();
        return response()->json(['video' => Video::with('rating.agency','categories','image')
            ->where('mid', '=', $id)
            ->first()]);
    }


    //  /avatar methods
    public function avatarUpdate(AvatarRequest $request)
    {
        $avatar = Auth::user()->avatar;
        $avatar->update($request->all());
        return Auth::user()->load('profileImage', 'avatar', 'images');
    }


    //  /session methods
    public function sessionStore(LoginRequest $request)
    {
        $credentials = [
            'login_name' => strToLower($request->input('email')),
            'password' => $request->input('password')
        ];
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            Token::generate($user, $request->header('deviceid'));
            return response()->json(['user' => $user->load('token', 'avatar')]);
        }
        return abort(403, 'Login failed');
    }
    public function sessionDestroy()
    {
        $return = 'You are not logged in.';
        if(Auth::check())
        {
            $tokenModel = new Token;
            $tokenModel->deleteOldTokens(Auth::user());
            Auth::logout();
            $return = ['message' => 'Logged out'];
        }
        return response()->json(['status' => $return]);
    }


    //  /user methods
    public function userCount()
    {
        $authorizedUsers = [
            'spiome@yahoo.com',
            'lee.hilton@leezilla.net',
        ];
        if(env('APP_ENV') === 'local')
        {
            $devUsers = [
                'johnny@test.com',
            ];
            $authorizedUsers = array_merge($authorizedUsers, $devUsers);
        }
        return in_array(Auth::user()->email, $authorizedUsers, true)
            ? User::all()->count()
            : abort(403);
    }
    public function userStore(UserRequest $request)
    {
        $user = User::create($request->all());
        // $avatar = Avatar::generate($user);
        $token = Token::generate($user, $request->header('deviceid'));
        return response()->json(['user' => $user->load('token', 'avatar')]);
    }
    public function userUpdate(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        return response()->json(['user' => $user->load('profileImage', 'avatar', 'images')]);
    }


    //  /reset methods
    public function requestPasswordReset(PasswordResetRequest $request)
    {
        return $this->sendResetLinkEmail($request);
    }
    /**
     * Get the response for after a successful password reset.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetSuccessResponse($response)
    {
        return response()->json(['message' => 'success']);
    }
    /**
     * Get the response for after a failing password reset.
     *
     * @param  Request  $request
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetFailureResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset request failed.'], 500);
    }
    /**
     * Get the response for after the reset link has been successfully sent.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getSendResetLinkEmailSuccessResponse($response)
    {
        return response()->json(['message' => 'success']);
    }

    /**
     * Get the response for after the reset link could not be sent.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getSendResetLinkEmailFailureResponse($response)
    {
        return response()->json(['message' => 'Password reset request failed.'], 500);
    }
}
