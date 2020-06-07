<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        for($i = 0; $i < 3; $i++) {
            $startTime = rand(time() - 604800, time());

            DB::table('offers')->insert([
                'product_id' => random_int(1, count(Product::all())),
                'discount' => 25,
                'date_start' => date('Y-m-d H:i:s', $startTime),
                'date_end' => date('Y-m-d H:i:s', $startTime + 1209600)
            ]);
        }
    }
}
