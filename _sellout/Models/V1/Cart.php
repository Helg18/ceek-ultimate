<?php

namespace Sellout;

use Sellout\Base;

class Cart extends Base
{
    protected $casts = [
        'promos' => 'object',
    ];
    protected $fillable = [
        'total', 'promos',
    ];
    public function user()
    {
        return $this->belongsTo('Sellout\User');
    }
    public function catalogs()
    {
        return $this->belongsToMany('Sellout\Catalog');
    }
    public function hasPromos()
    {
        return !is_null($this->promos);
    }
}
