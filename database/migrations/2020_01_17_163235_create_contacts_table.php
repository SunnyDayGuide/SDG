<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('market_id')->nullable();
            $table->string('contact_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('email');
            $table->text('comment');
            $table->boolean('cookie_consent');
            $table->boolean('sdg_consent')->default(false);
            $table->timestamp('sdg_export')->nullable();

            $table->timestamps();

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
        Schema::dropIfExists('contacts');
    }
}
