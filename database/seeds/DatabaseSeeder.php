<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    protected $toTruncate = ["users", "claims", 'rails', 'categories'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach($this->toTruncate as $table)
        {
            DB::table($table)->truncate();
        }

        $this->call(UsersTableSeeder::class);
        $this->call(RailTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ClaimsTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    } // func
}
