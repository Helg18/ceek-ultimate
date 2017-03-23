<?php

namespace Sellout;

use Sellout\User;
use Sellout\Base;

/**
 * Describes a video asset
 */

class Video extends Base
{
    protected $fillable = [
        'slug', 'name', 'format', 'show_time', 'url',
    ];

    public function play(User $user)
    {
        $player = new VideoHandler($user, $this);
        return $player->play();
    }
    public function image()
    {
        return $this->hasOne('Sellout\Image');
    }
    public function rating()
    {
        return $this->belongsTo('Sellout\Rating');
    }
    public function categories()
    {
        return $this->belongsToMany('Sellout\Category');
    }
    public function playrights()
    {
        return $this->hasMany('Sellout\PlayRight');
    }
    public function rights()
    {
        return $this->playrights();
    }
    public function catalogs()
    {
        return $this->morphToMany('Sellout\Catalog', 'catalogable');
    }
}
