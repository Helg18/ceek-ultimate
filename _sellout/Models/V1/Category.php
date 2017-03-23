<?php

namespace Sellout;

use Sellout\Base;
/**
 * Describes the category of a video object.
 */
class Category extends Base
{
    public function videos()
    {
        return $this->belongsToMany('Sellout\Video');
    }
}
