<?php

namespace Sellout;

use Carbon\Carbon;
use Sellout\PromoCode;
use Sellout\Base;

/**
 * Describes promotion details of a catalog item
 */

class Promo extends Base
{
    protected $fillable = [
        'catalog_id',
        'project_id',
        'team_id',
        'name',
        'description',
        'starts',
        'expires',
        'promo_cost',
        'admin_invalidated',
        'cogen_updated_at',
        'cogen_created_at'
    ];

    protected $casts = [
        'admin_invalidated' => 'boolean',
        'promo_cost' => 'integer',
    ];
    protected $hidden = [
    ];

    protected $dates = ['starts', 'expires', 'cogen_updated_at', 'cogen_created_at'];

    public function setStartsAttribute($starts)
    {
        $epoch = strtotime($starts);
        $this->attributes['starts'] = date('Y-m-d H:i:s', $epoch);
    }
    public function setExpiresAttribute($expires)
    {
        if($expires === null || $expires === false || $expires === 'never')
        {
            $this->attributes['expires'] = "1970-01-02 00:00:00";
        }
        else
        {
            $epoch = strtotime($expires);
            $this->attributes['expires'] = date('Y-m-d H:i:s', $epoch);
        }
    }
    public function getExpiresAttribute($expires)
    {
        if($expires === "1970-01-02 00:00:00" || $expires === -1 || $expires === 'never')
        {
            return false;
        }
        else
        {
            return \Carbon\Carbon::parse($expires);
        }
    }
    public function user()
    {
        return $this->belongsTo('Sellout\User');
    }

    public function catalog()
    {
        return $this->belongsTo('Sellout\Catalog', null, 'mid');
    }

    public function promoCodes()
    {
        return $this->hasMany('Sellout\PromoCode');
    }

    public function codes()
    {
        return $this->promoCodes();
    }
    public function isValid()
    {
        if($this->admin_invalidated === false)
        {
            $now = \Carbon\Carbon::now();
            $started = $now->gt($this->starts);
            $expired = $this->expires
                ? $now->gt($this->expires)
                : false;
            if($started && !$expired)
            {
                return true;
            }
        }
        return false;
    }
    public function invalidate()
    {
        $this->admin_invalidated = true;
        $this->save();
        return $this->admin_invalidated;
    }
    public function invalidateCodes()
    {
        return PromoCode::where('promo_id', $this->id)
            ->update(['admin_invalidated' => true]);
    }
}
