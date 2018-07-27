<?php

use Illuminate\Database\Seeder;

class RailTableSeeder extends Seeder
{

    public function run()
    {
        factory('App\Rail', 50)->create();
    }
}
