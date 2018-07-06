<?php

use App\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('value');
        });
        Setting::create(['name' => 'events_per_page', 'value' => 5]);
        Setting::create(['name' => 'bands_per_page', 'value' => 10]);
        Setting::create(['name' => 'galleries_per_page', 'value' => 10]);
        Setting::create(['name' => 'summerbreak', 'value' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
