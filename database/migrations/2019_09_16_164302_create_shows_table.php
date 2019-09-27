<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('theater_FPO')->nullable();
            $table->string('local_phone')->nullable();
            $table->string('toll_free')->nullable();
            $table->string('website_url')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('advertiser_id')->nullable();
            $table->unsignedBigInteger('theater_id')->nullable();
            $table->unsignedBigInteger('gadget_id')->nullable();

            $table->foreign('advertiser_id')->references('id')->on('advertisers')->onDelete(NULL);
            $table->foreign('theater_id')->references('id')->on('theaters')->onDelete(NULL);
            $table->foreign('gadget_id')->references('id')->on('gadgets')->onDelete(NULL);
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
        Schema::dropIfExists('shows');
    }
}
