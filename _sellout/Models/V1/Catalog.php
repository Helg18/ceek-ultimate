<?php

namespace Sellout;

use Sellout\Base;

/**
 * Catalog that describes sellable assets and their attributes.
 */
class Catalog extends Base
{
    protected $guarded = ['id'];
    protected $casts = [
        'ships' => 'boolean',
        'digital_only' => 'boolean',
        'is_valid' => 'boolean',
        'admin_disabled' => 'boolean',
        'cost' => 'integer',
    ];
    protected $appends = ['items'];

    public function hardwares()
    {
        return $this->morphedByMany('Sellout\Hardware', 'catalogable')->withPivot('definition');
    }
    public function videos()
    {
        return $this->morphedByMany('Sellout\Video', 'catalogable')->withPivot('definition');
    }
    public function isValid()
    {
        return ($this->is_valid && !($this->admin_disabled));
    }
    /**
     * Get all of the hardware and video models belonging to the catalog.
     */
    public function getItemsAttribute()
    {
        return $this->videos->merge($this->hardwares->all());
    }
    public function items_list()
    {
        return $this->videos->merge($this->hardwares->all());
    }
    public function promo()
    {
        return $this->hasMany('Sellout\Promo');
    }
    public function carts()
    {
        return $this->belongsToMany('Sellout\Cart');
    }
    public function receipts()
    {
        return $this->belongsToMany('Sellout\Receipt');
    }
}
