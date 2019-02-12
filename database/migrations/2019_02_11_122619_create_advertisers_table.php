<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_id');
            $table->string('name');
            $table->string('slug');
            $table->text('write_up')->nullable();
            $table->string('toll_free')->nullable();
            $table->string('website_url')->nullable();
            $table->string('ticket_url')->nullable();
            $table->string('booking_url')->nullable();
            $table->string('reservation_url')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('pinterest')->nullable();
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
                ->on('levels')
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
        Schema::dropIfExists('advertisers');
    }
}
