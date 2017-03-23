<?php

namespace Ceek\Http\Controllers\Api;

use Hash;
use Session;
use Validator;
use Sellout\User;
use Sellout\Token;
use App\Http\Controllers\Controller;
use Ceek\Http\Requests\Api\FacebookUserRequest;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as Facebook;

class FacebookAuthController extends Controller
{
    public function login(Facebook $fb, FacebookUserRequest $request)
    {
        $ug = $this->_getFacebookUserGraph($fb, $request->facebook_access_token);
        if(!isset($ug['id'])) return abort(401, 'Could not retrieve user id from graph');

        if(!$user = $this->_getUserFromFacebookId($ug['id']))
        {
            $user = $this->_createUser($request, $ug);
        }
        return response()->json(['user' => $user->load('token', 'avatar')]);
    }

    private function _createUser($request, $ug)
    {
        $data = $this->_validateNewUserFields($request, $ug);
        $user = User::create([
            'email' => $data['email'],
            'username' => $data['username'],
            'fb_id' => $ug['id'],
            'password' => md5(json_encode($request->all()))
        ]);
        $token = Token::generate($user, $request->header('deviceid'));
        return $user;
    }

    private function _validateNewUserFields($request, $ug)
    {
        if(!$request->username && !$this->_normalizeEmail($request, $ug))
        {
            return abort(400, 'User not registered');
        }

        if(!$username = $request->username) return abort(422, 'The username field is required.');
        if(!$email = $this->_normalizeEmail($request, $ug)) return abort(422, 'The email field is required.');
        if(User::where('email', $email)->count() > 0) return abort(409, 'The email is already in use.');

        return ['email' => $email, 'username' => $username];
    }

    private function _normalizeEmail($request, $ug)
    {
        $email = '';
        if($request->email)
        {
            $email = $request->email;
        }
        else
        {
            if(isset($ug['email']))
            {
                $email = $ug['email'];
            }
            else {
                $email = null;
            }
        }

        return $email;
    }

    private function _getUserFromFacebookId($fb_id)
    {
        return User::where('fb_id', $fb_id)->first();
    }

    private function _getFacebookUserGraph(Facebook $fb, $fb_token)
    {
        $token = Session::get('facebook_access_token');
        if(!$token)
        {
            //$fb = new Facebook;
            try {
                $token = $fb_token;
                Session::put('facebook_access_token', (string) $fb_token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                // Failed to obtain access token
                return abort(401, $e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);
        $gu = $fb->get('/me?fields=id,email')->getGraphUser();
        return ['id' => $gu->getId(), 'email' => $gu->getEmail()];
    }
}
