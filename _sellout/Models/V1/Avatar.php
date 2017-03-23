<?php

namespace Sellout;

use Sellout\Base;
use Sellout\User;

/**
 * Model to describe the user's digital avatar.
 */
class Avatar extends Base
{
    protected $fillable = [
        'Gender',
        'Hair',
        'EyeColor',
        'SkinColor',
        'Tops',
        'Bottoms',
        'Shoes'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public static function generate(User $user)
    {
        $avatarModel = new Avatar;
        $avatar = $avatarModel->create();
        $user->avatar()->save($avatar);
        return $avatar;
    }
}
