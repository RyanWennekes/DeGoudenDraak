<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_options', function (Blueprint $table) {
            $table->string('product_id', 45);
            $table->integer('order_id');
            $table->string('description_nl', 255);
            $table->string('description_en', 255);
            $table->decimal('price', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_options');
    }
}
