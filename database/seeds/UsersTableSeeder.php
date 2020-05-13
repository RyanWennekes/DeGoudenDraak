<?php

use App\Enums\UserRoles;
use App\User;
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
        // Create dummy-data
        $accounts = [
            0 => [
                'email' => 'admin@degoudendraak.nl',
                'role'  => UserRoles::Admin,
            ],
            1 => [
                'email' => 'employer@degoudendraak.nl',
                'role'  => UserRoles::Employer,
            ],
        ];

        // Loop through all the accounts
        foreach ($accounts as $key => $value) {
            $this->generateUser($value['email'], $value['role']);
        }
    }

    // Generating a single user
    public function generateUser(String $email, int $role): void
    {
        //Checking if user exists
        if (User::where('email', '=', $email)->first() === null) {
            // Using the factory for creating a user with name
            factory(App\User::class, 1)->create([
                'role'     => $role,
                'email'    => $email,
                'password' => bcrypt('password'),
            ]);
        }
    }
}
