<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->foreign('table_id')->references('id')->on('tables');
            $table->integer('reservation_id')->unsigned();
            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_tables');
    }
}
