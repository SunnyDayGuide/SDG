<?php

use Illuminate\Database\Migrations\Migration;

class SetupCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return  void
	 */
	public function up()
	{
		// Creates the users table
		Schema::create('countries', function($table)
		{
		    $table->unsignedInteger('id')->index();
		    $table->string('name', 255)->default('');
		    $table->char('country_code', 3)->default('');
		    $table->string('full_name', 255)->nullable();
		    $table->char('iso_3166_2', 2)->default('');
		    $table->char('iso_3166_3', 3)->default('');
		    $table->string('capital', 255)->nullable();

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
		Schema::drop('countries');
	}

}
