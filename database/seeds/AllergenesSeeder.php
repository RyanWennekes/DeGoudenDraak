<?php

use Illuminate\Database\Seeder;

class AllergenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allergenes')->insert([
            'name_nl' => 'Gluten',
            'name_en' => 'Gluten'
        ]);
        DB::table('allergenes')->insert([
            'name_nl' => 'Lactose',
            'name_en' => 'Lactose'
        ]);
        DB::table('allergenes')->insert([
            'name_nl' => 'Varkensvlees',
            'name_en' => 'Pork'
        ]);
    }
}
