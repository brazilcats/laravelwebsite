<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        //User::factory(10)->create();
       
        $this->call(UsersTableSeeder::class);

      // factory(\App\User::class, 40)->create()->each(function($user){
       // $user->store()->save(factory(\App\Store::class)->make());
    //});


    }
}
