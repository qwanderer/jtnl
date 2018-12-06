<?php

namespace App\Filters;

use App\Rail;
use phpDocumentor\Reflection\Types\Boolean;

class ClaimFilters extends Filters
{

    public static $filters = ['by_day', 'by_rail', 'wi'];

    protected function wi($flag)
    {
        if($flag==true){
            return $this->builder;
        }
        return $this->builder;
    }

    protected function by_day($days)
    {
        return $this->builder;
    }


    protected function by_rail($rail_id)
    {
        $rail = Rail::findOrFail($rail_id);
        return $this->builder->where('rail_id', $rail->id);
    }

} // class