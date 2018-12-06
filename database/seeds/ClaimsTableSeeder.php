<?php

use Illuminate\Database\Seeder;

class ClaimsTableSeeder extends Seeder
{

    public function run()
    {
        factory('App\Claim', 10)->create();
        factory('App\Claim', 10)->create(['rail_id'=>10]);
    }
}
