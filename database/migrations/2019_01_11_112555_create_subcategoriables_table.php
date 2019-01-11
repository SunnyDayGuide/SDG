<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategoriables', function (Blueprint $table) {
            $table->primary(['subcategory_id', 'subcategoriable_id', 'subcategoriable_type'], 'subcategoriable_index');
            
            $table->unsignedInteger('subcategory_id');
            $table->unsignedInteger('subcategoriable_id');
            $table->string('subcategoriable_type');
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
        Schema::dropIfExists('subcategoriables');
    }
}
