<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDimensionsToPicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pics', function (Blueprint $table) {
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pics', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('width');
        });
    }
}
