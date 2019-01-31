<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_id');
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->text('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('website_url')->nullable();
            $table->string('ticket_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('is_recurring')->default(false);
            $table->date('end_of_recurring')->nullable();
            $table->unsignedInteger('frequency_number_of_recurring')->nullable();
            $table->string('frequency_type_of_recurring')->nullable();
            $table->json('frequency_options');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('market_id')
                ->references('id')
                ->on('markets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
