<?php

use App\ProductType;
use Illuminate\Database\Seeder;

class ProductAllergenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meatCategories = ProductType::where('id', 10)->get();
        $glutenCategories = ProductType::whereIn('id', [3, 4, 5, 6])->get();
        $eggCategories = ProductType::where('id', 8)->get();

        foreach($meatCategories as $category) {
            foreach ($category->products as $dish) {
                DB::table('product_allergenes')->insert([
                    'product_id' => $dish->id,
                    'allergene_id' => 3
                ]);
            }
        }

        foreach($eggCategories as $category) {
            foreach ($category->products as $dish) {
                DB::table('product_allergenes')->insert([
                    'product_id' => $dish->id,
                    'allergene_id' => 2
                ]);
            }
        }

        foreach($glutenCategories as $category) {
            foreach ($category->products as $dish) {
                DB::table('product_allergenes')->insert([
                    'product_id' => $dish->id,
                    'allergene_id' => 1
                ]);
            }
        }
    }
}
