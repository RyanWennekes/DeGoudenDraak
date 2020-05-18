<?php

use App\User;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $waitresses = User::where('role', 3)->get();

        foreach($waitresses as $i => $waitress) {
            $checkInTime = rand(time() - 180, time());

            DB::table('tables')->insert([
                'menu_id' => $i + 1, // TODO: Find out relevance of this column
                'table_number' => $i + 1,
                'check_in_time' => date('Y-m-d H:i:s', $checkInTime),
                'waitress_id' => $waitress->id,
                'created_at' => new DateTime()
            ]);
        }
    }
}
