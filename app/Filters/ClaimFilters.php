<?php

namespace App\Filters;

use App\Rail;

class ClaimFilters extends Filters
{

    public static $filters = ['by_day', 'by_rail'];

    protected function by_time($days)
    {
        return $this->builder;
    }


    protected function by_rail($rail_id)
    {
        $rail = Rail::findOrFail($rail_id);
        return $this->builder->where('rail_id', $rail->id);
    }

} // class