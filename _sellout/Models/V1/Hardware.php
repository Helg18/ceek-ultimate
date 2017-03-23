<?php

namespace Sellout;

use Sellout\Base;

/**
 * Describes a hardware asset
 */

class Hardware extends Base
{
    public function catalogs()
    {
        return $this->morphToMany('Sellout\Catalog', 'catalogable');
    }
}
