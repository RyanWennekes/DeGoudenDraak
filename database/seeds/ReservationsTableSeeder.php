<?php

use App\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Table::allTables() as $key => $table) {
            for ($x = 0; $x < rand(0, 3); $x++) {
                $reservationDate = Carbon\Carbon::now()->addDays($x);
                $faker = Faker\Factory::create();

                DB::table('reservations')->insert([
                    'check_in'      => $reservationDate->format('Y-m-d H:m:s'),
                    'table_id'      => $table->id,
                    'customer_name' => $faker->unique()->name,
                ]);
            }
        }
    }
}
