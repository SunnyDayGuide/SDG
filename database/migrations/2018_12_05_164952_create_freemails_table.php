<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreemailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freemails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_id');
            $table->string('client');
            $table->string('contact_name');
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('freemail_email');
            $table->text('notes')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('consent')->default(false);
            $table->timestamp('consent_date')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('freemail_type_id');

            $table->foreign('market_id')->references('id')->on('markets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('freemail_type_id')->references('id')->on('freemail_types')->onDelete('cascade');

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
        Schema::dropIfExists('freemails');
    }
}
