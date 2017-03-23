<?php

namespace Sellout;

use Sellout\Base;

class PlayRight extends Base
{
    protected $fillable = [
        'plays_left',
        'play_ends',
    ];
    protected $casts = [
        'plays_unlimited' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo('Sellout\User');
    }
    public function video()
    {
        return $this->belongsTo('Sellout\Video');
    }
}
