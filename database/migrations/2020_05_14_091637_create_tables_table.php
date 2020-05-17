<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id');
            $table->tinyInteger('table_number');
            $table->dateTime('check_in_time')->nullable();
            $table->unsignedBigInteger('waitress_id')->nullable();
            $table->timestamps();

            $table->foreign('waitress_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
