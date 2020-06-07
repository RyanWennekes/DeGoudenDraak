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
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Bami en Nasi',
            'type_en' => 'Chow Mein and Fried Rice Dishes',
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Combinatiegerechten', // met witte rijst...
            'type_en' => 'Combination Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Mihoengerechten',
            'type_en' => 'Rice-noodle Dishes',
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Chinese Bamigerechten',
            'type_en' => 'Chow Mein Dishes',
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Indische gerechten',
            'type_en' => 'Indian Dishes',
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Eiergerechten',
            'type_en' => 'Egg Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Groentegerechten',
            'type_en' => 'Vegetable Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Vleesgerechten',
            'type_en' => 'Meat Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Kipgerechten',
            'type_en' => 'Chicken Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Garnalengerechten',
            'type_en' => 'Shrimp Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Ossenhaasgerechten',
            'type_en' => 'Tenderloin Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Visgerechten',
            'type_en' => 'Fish Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Pekingeendgerechten',
            'type_en' => 'Peking Duck Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Tiepan Specialiteiten',
            'type_en' => 'Taipan Specialties',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Vegetarische Gerechten',
            'type_en' => 'Vegetarian Dishes',
            'has_rice' => 1,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => "Kindermenu's",
            'type_en' => "Children's Menus",
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Rijsttafel',
            'type_en' => 'Rice Table', // Serieus, er is geen goede vertaling voor rijsttafel...
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Warm buffet',
            'type_en' => 'Hot buffet',
            'has_rice' => 0,
        ]);

        DB::table('product_types')->insert([
            'type_nl' => 'Diversen',
            'type_en' => 'Various',
            'has_rice' => 0,
        ]);
    }
}
