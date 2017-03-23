<?php

namespace Sellout;

use Sellout\User;
use Sellout\Base;

/**
 * Provides token management  for access authorization
 */
class Token extends Base
{
    protected $fillable = [
        'deviceid'
    ];

    public static function generate(User $user, $deviceid, $deleteOldTokens = false)
    {
        $tokenModel = new Token;
        if($deleteOldTokens) $tokenModel->deleteOldTokens($user);
        $token = $tokenModel->createToken($deviceid);
        $user->token()->save($token);
        return $token;
    }
    public function createToken($deviceid)
    {
        $token = [
            'deviceid' => $deviceid,
        ];
        return Token::create($token);
    }
    public function deleteOldTokens(User $user)
    {
        return $this->where('user_id', '=', $user->id)->delete();
    }
    public static function resolveUser($token, $deviceid)
    {
        $user_id = Self::resolveUserId($token, $deviceid);
        return !is_null($user_id)
            ? User::where('id', '=', $user_id)->first()
            : null;
    }
    public static function resolveUserId($token, $deviceid)
    {
        return Self::where('mid', '=', $token)
            ->where('deviceid', '=', $deviceid)
            ->value('user_id');
    }
    public function user()
    {
        return $this->belongsTo('Sellout\User');
    }
}
