<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->string('product_id', 45);
            $table->unsignedBigInteger('order_id');
            $table->decimal('price', 10, 2);
            $table->smallInteger('amount');
            $table->string('allergene_nl', 255);
            $table->string('allergene_en', 255);
            $table->timestamps();

            $table->primary(array('product_id', 'order_id'));
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
