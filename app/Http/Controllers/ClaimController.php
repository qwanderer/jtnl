<?php

namespace App\Http\Controllers;

use App\Filters\ClaimFilters;
use App\Category;
use App\Claim;

class ClaimController extends Controller
{

    public function index(Category $category, ClaimFilters $filters)
    {
        $claims = $this->_getClaims($category, $filters);
        return view("claim.list", ['claims'=>$claims, 'request_filters'=>ClaimFilters::$filters]);
    } // func


    private function _getClaims(Category $category, ClaimFilters $filters)
    {
        $claims = Claim::latest()->with('category')->filter($filters);

        if($category->exists){
            $claims->where('category_id', $category->id);
        }
        return $claims->paginate(3);
    } // func


    public function show(Claim $claim)
    {
        dump($claim->toArray());
        //return view('claim.show', compact($claim));
    }

} // class