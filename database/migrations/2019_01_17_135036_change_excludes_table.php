<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeExcludesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exclusions', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
        Schema::table('exclusions', function (Blueprint $table) {
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exclusions', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
            $table->timestamp('start');
            $table->timestamp('end');
        });
    }
}
