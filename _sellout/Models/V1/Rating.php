<?php

namespace Sellout;

use Sellout\Base;

/**
 * Describes ratings for video content.
 */

class Rating extends Base
{
    public function agency()
    {
        return $this->hasOne('Sellout\RatingAgency', 'id', 'rating_agency_id');
    }
    public function videos()
    {
        return $this->hasMany('Sellout\Video');
    }
}
