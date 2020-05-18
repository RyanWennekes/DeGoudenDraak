<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $products = DB::connection('live')->table('menu')->get();

        foreach($products as $product) {
            DB::table('products')->insert([
                'code' => ($product->menunummer ?? '') . ($product->menu_toevoeging ?? ''),
                'product_type_id' => $this->determineType($product->soortgerecht),
                'name' => $product->naam,
                'price' => $product->price,
                'spiciness' => random_int(1, 3),
                'description_nl' => $product->beschrijving,
                'description_en' => '',
                'minimum_amount' => null,
                'withRice' => 1
            ]);
        }
    }

    public function determineType($type) {
        switch ($type) {
            case "SOEP":
                return 1;
            case "VOORGERECHT":
                return 2;
            case "BAMI EN NASI GERECHTEN":
                return 3;
            case "COMBINATIE GERECHTEN (met witte rijst)":
                return 4;
            case "MIHOEN GERECHTEN":
                return 5;
            case "CHINESE BAMI GERECHTEN":
                return 6;
            case "INDISCHE GERECHTEN":
                return 7;
            case "EIERGERECHTEN (met witte rijst)":
                return 8;
            case "GROENTEN GERECHTEN (met witte rijst)":
                return 9;
            case "VLEES GERECHTEN (met witte rijst)":
                return 10;
            case "KIP GERECHTEN (met witte rijst)":
                return 11;
            case "GARNALEN GERECHTEN (met witte rijst)":
                return 12;
            case "OSSENHAAS GERECHTEN (met witte rijst)":
                return 13;
            case "VISSEN GERECHTEN (met witte rijst)":
                return 14;
            case "PEKING EEND GERECHTEN (met witte rijst)":
                return 15;
            case "TIEPAN SPECIALITEITEN (met witte rijst)":
                return 16;
            case "VEGETARISCHE GERECHTEN (met witte rijst)":
                return 17;
            case "KINDERMENUS":
                return 18;
            case "RIJSTTAFELS":
                return 19;
            case "BUFFET":
                return 20;
            default:
                return 21;
        }
    }
}
