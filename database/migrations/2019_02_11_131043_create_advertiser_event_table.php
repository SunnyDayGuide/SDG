<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertiserEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_event', function (Blueprint $table) {
            $table->primary(['advertiser_id', 'event_id']);
            $table->unsignedInteger('advertiser_id');
            $table->unsignedInteger('event_id');

            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onDelete('cascade');
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
        Schema::dropIfExists('advertiser_event');
    }
}
