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
        //create admin user
        factory(App\User::class)->create([
            'name' => 'admin',
            'type' => 'admin',
        ]);

        //create 50 advisor users
        factory(App\User::class, 50)->create([
            'type' => 'advisor',
        ]);
    }
}
