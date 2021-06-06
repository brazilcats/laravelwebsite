<?php

namespace Database\Seeders;

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

        //\App\Models\User::factory(30)->create();

        \App\Models\User::factory(40)->create()->each(function($user) {
            $user->store()->save(\App\Models\Store::factory()->make());
        });

    }
}
