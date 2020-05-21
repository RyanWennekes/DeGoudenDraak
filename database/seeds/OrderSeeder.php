<?php

use App\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $products = DB::connection('live')->table('sales')->get();
        $tables = Table::all();

        foreach ($products as $product) {
            DB::table('orders')->insert([
                'table_id' => random_int(1, count($tables)),
                'needs_help' => false,
                'created_at' => $product->saleDate
            ]);
        }
    }
}
