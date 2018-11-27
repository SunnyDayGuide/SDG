<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('departments')->truncate();
        Schema::enableForeignKeyConstraints();

        Department::create(['name' => 'Management']);
        Department::create(['name' => 'Web']);
        Department::create(['name' => 'Art']);
        Department::create(['name' => 'Traffic']);
        Department::create(['name' => 'Sales']);
        Department::create(['name' => 'Distribution']);
        Department::create(['name' => 'Accounting']);
    }
}
