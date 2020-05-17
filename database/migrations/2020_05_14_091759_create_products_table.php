<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id', 45);
            $table->primary('id');
            $table->unsignedBigInteger('product_type_id');
            $table->string('name', 60);
            $table->decimal('price', 10, 2);
            $table->tinyInteger('spiciness')->nullable();
            $table->string('description_nl')->nullable();
            $table->string('description_en')->nullable();
            $table->integer('minimum_amount')->nullable();

            $table->foreign('product_type_id')->references('id')->on('product_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
