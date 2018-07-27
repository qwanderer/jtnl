<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
