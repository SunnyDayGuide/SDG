<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYelpAndTripadvisorColumnsToAdvertisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisers', function (Blueprint $table) {
            $table->string('yelp')->after('pinterest')->nullable();
            $table->string('tripadvisor')->after('pinterest')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisers', function (Blueprint $table) {
            $table->dropColumn('yelp');
            $table->dropColumn('tripadvisor');
        });
    }
}
