<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurrences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id');
            $table->datetime('dtstart');
            $table->datetime('until')->nullable();
            $table->unsignedInteger('count')->nullable();
            $table->string('freq');
            $table->unsignedInteger('interval')->default(1);
            $table->string('bysetpos')->nullable();
            $table->string('byweekday')->nullable();
            $table->string('bymonthday')->nullable();
            $table->string('bymonth')->nullable();

            $table->timestamps();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurrences');
    }
}
