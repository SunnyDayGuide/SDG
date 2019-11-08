<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_id');
            $table->string('name');
            $table->string('slug');
            $table->text('write_up')->nullable();
            $table->string('toll_free')->nullable();
            $table->string('website_url')->nullable();
            $table->string('reservation_url')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('yelp')->nullable();
            $table->string('tripadvisor')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('level_id');
            $table->unsignedInteger('logo_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('market_id')
                ->references('id')
                ->on('markets');

            $table->foreign('level_id')
                ->references('id')
                ->on('levels');

            $table->foreign('logo_id')
                ->references('id')
                ->on('logos')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributors');
    }
}
