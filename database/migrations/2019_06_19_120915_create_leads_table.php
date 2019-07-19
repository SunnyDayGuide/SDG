<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('market_id');
            $table->string('request_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('email');
            $table->string('postal_code')->nullable();
            $table->date('visit_date')->nullable();
            $table->string('visit_length', 15)->nullable();
            $table->string('num_adults', 15)->nullable();
            $table->string('num_children', 15)->nullable();
            $table->json('interests')->nullable();
            $table->boolean('cookie_consent');
            $table->boolean('freemail_consent')->default(false);
            $table->boolean('sdg_consent')->default(false);
            $table->timestamp('sdg_export')->nullable();
            $table->timestamp('freemail_export')->nullable();

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
        Schema::dropIfExists('leads');
    }
}
