<?php

namespace Sellout;

use Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Base model.
 */
class Base extends Authenticatable
{
    //Hide these values from all model returns unless
    //overridden in $baseShow
    protected $baseHidden = [
        'id',
        'updated_at',
        'created_at',
        'user_id',
        'profile_image_id',
        'file_updated_at',
        'login_name',
        'pivot',
        'billing_address_id',
        'shipping_address_id',
    ];

    //Override of $baseHidden
    protected $baseShow = [];

    public function __construct(array $attributes = []) {
        foreach($this->baseShow as $show)
        {
            foreach($this->baseHidden as $key => $value)
            {
                if($value === $show)
                {
                    unset($this->baseHidden[$key]);
                }
            }
        }
        $this->hidden = array_merge($this->baseHidden, $this->hidden);
        return parent::__construct($attributes);
    }

    public static function boot()
    {
        static::creating(function($model)
        {
            $base = count(explode('\\', get_called_class())) > 0
                ? explode('\\', get_called_class())[count(explode('\\', get_called_class())) - 1] . "-"
                : '';
            $model->mid = $base . Uuid::generate(4)->string;
        });
    }
    public function generateMid()
    {
        return Self::modelBasename() . Uuid::generate(4)->string;
    }
    public function modelBasename()
    {
        return count(explode('\\', get_called_class())) > 0
            ? explode('\\', get_called_class())[count(explode('\\', get_called_class())) - 1] . "-"
            : '';
    }
}
