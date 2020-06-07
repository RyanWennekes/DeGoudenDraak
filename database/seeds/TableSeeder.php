<?php

use App\Enums\UserRoles;
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
        $waitresses = User::where('role', UserRoles::Waitress)->get();

        foreach ($waitresses as $i => $waitress) {
            DB::table('tables')->insert([
                'menu_id'      => $i + 1, // TODO: Find out relevance of this column
                'table_number' => $i + 1,
                'waitress_id'  => $waitress->id,
                'created_at'   => new DateTime(),
            ]);
        }
    }
}
