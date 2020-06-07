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
         $this->call(UsersTableSeeder::class);
         $this->call(TableSeeder::class);
         $this->call(ReservationsTableSeeder::class);
         $this->call(OrderSeeder::class);
         $this->call(ProductTypeSeeder::class);
         $this->call(ProductSeeder::class);
         $this->call(OfferSeeder::class);
//         $this->call(SaleSeeder::class);
//         $this->call(ExtraOptionSeeder::class);
    }
}
