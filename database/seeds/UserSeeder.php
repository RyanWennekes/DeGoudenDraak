<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'role' => 1,
            'email' => 'admin@degoudendraak.nl',
            'password' => Hash::make('password')
        ]);

        factory(\App\User::class, 10)->create();
    }
}
