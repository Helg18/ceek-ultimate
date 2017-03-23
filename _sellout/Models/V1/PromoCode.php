<?php

namespace Sellout;

use Illuminate\Database\Eloquent\Model;

/**
 * Describes a code identifier for promotion redemption.
 */

class PromoCode extends Model
{
    protected $fillable = [
    'code',
    'used',
    'admin_invalidated',
    ];

    protected $casts = [
        'used' => 'boolean',
        'admin_invalidated' => 'boolean',
    ];

    protected $hidden = [
    ];

    public function isValid()
    {
        if($this->admin_invalidated === false && $this->used === false)
        {
            $now = \Carbon\Carbon::now();
            $hasStarted = $now->gt($this->promo->starts);
            $notExpired = $this->promo->expires === false || $now->lt($this->promo->expires);
            if($hasStarted && $notExpired)
            {
                return true;
            }
        }
        return false;
    }

    public function promotion()
    {
        return $this->promo();
    }

    public function promo()
    {
        return $this->belongsTo('Sellout\Promo');
    }
}
