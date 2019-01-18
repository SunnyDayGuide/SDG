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

        Category::create(['name' => 'Attractions & Activities']);
        Category::create(['name' => 'Restaurants']);
        Category::create(['name' => 'Shopping']);
        Category::create(['name' => 'Entertainment']);
        Category::create(['name' => 'Accommodations']);
    }
}
