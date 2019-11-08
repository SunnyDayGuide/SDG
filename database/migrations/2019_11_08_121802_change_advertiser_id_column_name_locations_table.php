<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAdvertiserIdColumnNameLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign('locations_advertiser_id_foreign');
            $table->renameColumn('advertiser_id', 'locationable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->renameColumn('locationable_id', 'advertiser_id');
            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onDelete('cascade');
        });
    }
}
