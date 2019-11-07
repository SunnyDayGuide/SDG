<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteDayColumnsFromHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hours', function (Blueprint $table) {
            $table->dropColumn(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'exceptions']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hours', function (Blueprint $table) {
            $table->text('monday');
            $table->text('tuesday');
            $table->text('wednesday');
            $table->text('thursday');
            $table->text('friday');
            $table->text('saturday');
            $table->text('sunday');
            $table->text('exceptions');
        });
    }
}
