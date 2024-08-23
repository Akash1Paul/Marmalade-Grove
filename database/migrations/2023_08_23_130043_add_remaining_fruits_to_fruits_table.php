<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemainingFruitsToFruitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fruits', function (Blueprint $table) {
            $table->integer('total_fruits')->after('weight')->nullable();
            $table->integer('remaining_fruits')->after('total_fruits')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fruits', function (Blueprint $table) {
            //
        });
    }
}
