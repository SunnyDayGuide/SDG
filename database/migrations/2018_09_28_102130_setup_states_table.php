<?php

use Illuminate\Database\Migrations\Migration;

class SetupStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return  void
	 */
	public function up()
	{
		// Creates the users table
		Schema::create('states', function($table)
		{		    
		    $table->unsignedInteger('id')->index();
		    $table->char('iso_3166_2', 2)->default('');
		    $table->string('name', 255)->default('');
		    $table->unsignedInteger('country_id')->default('840');
		    
		    $table->primary('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return  void
	 */
	public function down()
	{
		Schema::drop('states');
	}

}