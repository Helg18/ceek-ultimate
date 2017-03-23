<?php

namespace Ceek\Http\Controllers\Auth;

use Auth;
use Validator;
use Socialite;
use Sellout\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'redirectToProvider', 'handleProviderCallback']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'signup-username' => 'required',
            'signup-email' => 'required|unique:users,email|email',
            'signup-password' => 'required|min:6|confirmed',
            'signup-bday-month' => 'required|numeric|min:1|max:12',
            'signup-bday-day' => 'required|numeric|min:1|max:31',
            'signup-bday-year' => 'required|numeric|min:1900',
            'signup-gender' => 'required|numeric|min:0|max:1',
            'signup-country' => 'string',
            'signup-state' => 'string',
            'signup-zipcode' => 'numeric'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $dob = $data['signup-bday-month'].'/'.$data['signup-bday-day'].'/'.$data['signup-bday-year'];
        return User::create([
            'username' => $data['signup-username'],
            'email' => $data['signup-email'],
            'password' => $data['signup-password'],
            'gender' => $data['signup-gender'],
            'country' => $this->_isset($data, 'signup-country', null),
            'state' => $this->_isset($data, 'signup-state', null),
            'zipcode' => $this->_isset($data, 'signup-zipcode', null),
            'dob' => $dob,
        ]);
    }

    private function _isset($data, $key, $default)
    {
        return isset($data[$key]) ? $data[$key] : $default;
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->scopes(['email', 'public_profile'])->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $fbUser = Socialite::driver('facebook')->user();
        if($fbUser->getEmail() === null)
        {
            return redirect('/');
        }
        $username = $fbUser->getNickname() ? $fbUser->getNickname() : $fbUser->getName();
        $gender = isset($fbUser->user['gender']) && $fbUser->user['gender'] === 'male'
            ? 1
            : 0;
        $user = User::facebookFindOrCreate($fbUser->getId(), $fbUser->token, $username, $fbUser->getEmail(), $gender);
        Auth::login($user);
        return redirect('/dashboard');
    }
}
