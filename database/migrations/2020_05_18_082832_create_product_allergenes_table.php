<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAllergenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_allergenes', function (Blueprint $table) {
            $table->string('product_id')->nullable();
            $table->unsignedBigInteger('allergene_id')->nullable();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('allergene_id')->references('id')->on('allergenes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_allergenes');
    }
}
