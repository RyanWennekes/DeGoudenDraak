<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            'type_nl' => 'Soep',
            'type_en' => 'Soup',
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Voorgerecht',
            'type_en' => 'Appetizer',
            'hasRice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Bami en Nasi',
            'type_en' => 'Chow Mein and Fried Rice Dishes',
            'hasRice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Combinatiegerechten', // met witte rijst...
            'type_en' => 'Combination Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Mihoengerechten',
            'type_en' => 'Rice-noodle Dishes',
            'hasRice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Chinese Bamigerechten',
            'type_en' => 'Chow Mein Dishes',
            'hasRice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Indische gerechten',
            'type_en' => 'Indian Dishes',
            'hasRice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Eiergerechten',
            'type_en' => 'Egg Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Groentegerechten',
            'type_en' => 'Vegetable Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Vleesgerechten',
            'type_en' => 'Meat Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Kipgerechten',
            'type_en' => 'Chicken Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Garnalengerechten',
            'type_en' => 'Shrimp Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Ossenhaasgerechten',
            'type_en' => 'Tenderloin Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Visgerechten',
            'type_en' => 'Fish Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Pekingeendgerechten',
            'type_en' => 'Peking Duck Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Tiepan Specialiteiten',
            'type_en' => 'Taipan Specialties',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Vegetarische Gerechten',
            'type_en' => 'Vegetarian Dishes',
            'hasRice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => "Kindermenu's",
            'type_en' => "Children's Menus",
            'hasRice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Rijsttafel',
            'type_en' => 'Rice Table', // Serieus, er is geen goede vertaling voor rijsttafel...
            'hasRice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Warm buffet',
            'type_en' => 'Hot buffet',
            'hasRice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Diversen',
            'type_en' => 'Various',
            'hasRice' => 0,
        ]);
    }
}
