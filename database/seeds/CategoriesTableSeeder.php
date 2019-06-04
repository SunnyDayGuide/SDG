<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints(); 

        Category::create(['name' => 'Attractions & Activities', 'parent_id' => NULL]);
        Category::create(['name' => 'Restaurants', 'parent_id' => NULL]);
        Category::create(['name' => 'Shopping', 'parent_id' => NULL]);
        Category::create(['name' => 'Entertainment', 'parent_id' => NULL]);
        Category::create(['name' => 'Accommodations', 'parent_id' => NULL]);
    }
}
