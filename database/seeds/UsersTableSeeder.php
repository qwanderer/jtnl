<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->factory

        factory('App\User', 50)->create();
        factory('App\User')->create([
            "email"=>"admin1@mail.ru",
            "password"=>bcrypt("admin1"),
            "name"=>"admin1"
        ]);
    }
}
