<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePicsGalleryIdToPicsEventId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function(Blueprint $table) {
            $table->dropForeign(['gallery_id']);
            $table->dropColumn('gallery_id');
        });
        Schema::table('pics', function (Blueprint $table) {
            $table->dropForeign(['gallery_id']);
            $table->renameColumn('gallery_id', 'event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function(Blueprint $table) {
            $table->integer('gallery_id')->unsigned()->nullable();
            $table->foreign('gallery_id')->references('id')->on('galleries');
        });
        Schema::table('pics', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->renameColumn('event_id', 'gallery_id');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });
    }
}
