<?php

namespace App\Providers;

use App\Category;
use App\Rail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \View::composer('*', function($view){
            $rails = \Cache::remember('rails', 60, function(){ return Rail::all(); });
            $categories = \Cache::remember('categories', 60, function(){ return Category::all(); });
            $view->with(["rails"=>$rails, 'categories'=>$categories]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
