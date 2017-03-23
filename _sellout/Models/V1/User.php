<?php

namespace Sellout;

use Illuminate\Contracts\Auth\CanResetPassword;
use Laravel\Cashier\Billable;
use Sellout\PasswordHandler;
use Sellout\Avatar;
use Sellout\Base;
use Socialite;
use Hash;
use Auth;

/**
 * Describes a user of Sellout
 */

class User extends Base implements CanResetPassword
{
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'dob', 'gender', 'country', 'state', 'zipcode',
        'fb_id', 'fb_password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'reset_token_created_at'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user)
        {
            if(is_null($user->dob)) $user->dob = 0;
            if(is_null($user->gender)) $user->gender = 254;
        });
        static::created(function($user)
        {
            $avatar = Avatar::create([]);
            $user->avatar()->save($avatar);
            \Event::fire(new \App\Events\UserAccountCreated($user));
        });
    }
    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = $email;
        $this->attributes['login_name'] = strToLower($email);
    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setFbPasswordAttribute($password)
    {
        $this->attributes['fb_password'] = Hash::make($password);
    }

    public function logout()
    {
        if(Auth::check())
        {
            (new Token)->deleteOldTokens(Auth::user());
            Auth::logout();
            return true;
        }
        return abort(401, 'You are not logged in.');
    }
    public function setDobAttribute($dob)
    {
        $this->attributes['dob'] = strtotime($dob);
    }
    public function getCreditsAttribute($credits)
    {
        return is_null($credits)
            ? 0
            : $credits;
    }
    public function token()
    {
        return $this->hasOne('Sellout\Token');
    }
    public function avatar()
    {
        return $this->hasOne('Sellout\Avatar');
    }
    public function cart()
    {
        return $this->hasOne('Sellout\Cart');
    }
    public function profileImage()
    {
        return $this->hasOne('Sellout\Image');
    }
    public function images()
    {
        return $this->hasMany('Sellout\Purchase');
    }
    public function purchases()
    {
        return $this->hasMany('Sellout\Purchase');
    }
    public function receipts()
    {
        return $this->hasMany('Sellout\Receipt');
    }
    public function transactions()
    {
        return $this->hasMany('Sellout\Transaction');
    }
    public function addresses()
    {
        return $this->hasMany('Sellout\Address');
    }
    public function billingAddress()
    {
        return $this->belongsTo('Sellout\Address', 'billing_address_id');
    }
    public function shippingAddress()
    {
        return $this->belongsTo('Sellout\Address', 'shipping_address_id');
    }
    public function hasVideoContent($type = null)
    {
        $videos = is_null($type)
            ? \Sellout\Video::with('playrights')
                ->whereHas('playrights', function ($query) {
                    $query->where('user_id', '=', $this->id);
                })->get()
            : \Sellout\Video::with('playrights')
                ->whereHas('playrights', function ($query) {
                    $query->where('user_id', '=', $this->id);
                })->where('slug', 'like', $type)
                ->get();
        return $videos->count() > 0
            ? ['videos' => $videos]
            : ['status' => false];
    }
    public static function facebookFindOrCreate($facebook_id, $token, $username, $email, $gender)
    {
        $user = User::where('fb_id', $facebook_id)->first();
        if($user === null)
        {
            $user = new User;
            $user->username = $username;
            $user->email = $email;
            $user->password = $token;
            $user->gender = $gender;
            $user->fb_id = $facebook_id;
            $user->save();
        }
        return $user;
    }
}
