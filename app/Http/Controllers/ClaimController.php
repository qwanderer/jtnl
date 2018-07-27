<?php

namespace App\Http\Controllers;

use App\Filters\ClaimFilters;
use App\Category;
use App\Claim;

class ClaimController extends Controller
{
    //

    public function index(Category $category, ClaimFilters $filters)
    {
        $claims = $this->getClaims($category, $filters);
        return view("claim.list", ['claims'=>$claims, 'request_filters'=>ClaimFilters::$filters]);
    } // func



    public function show(Claim $claim)
    {
        return view('claim.show', compact($claim));
    }


    protected function getClaims(Category $category, ClaimFilters $filters)
    {
        $claims = Claim::latest()->with('category')->filter($filters);

        if($category->exists){
            $claims->where('category_id', $category->id);
        }
        //dd($claims->toSql());
        return $claims->paginate(3);
    } // func

} // class
