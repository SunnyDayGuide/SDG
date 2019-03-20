<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('formatted_address');
            $table->string('street_number');
            $table->string('route');
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country')->default('US');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('telephone')->nullable();
            $table->unsignedInteger('advertiser_id');

            $table->timestamps();

            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
