<?php

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
        $this->call([
            UsersTableSeeder::class,
            TableSeeder::class,
            ReservationsTableSeeder::class,
            OrderSeeder::class,
            ProductTypeSeeder::class,
            ProductSeeder::class,
            OfferSeeder::class,
            AllergenesSeeder::class,
            ProductAllergenesSeeder::class
        ]);
    }
}
