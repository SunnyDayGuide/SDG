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

        Category::create(['name' => 'Attractions & Activities', 'slug' => 'attractions-activities']);
        Category::create(['name' => 'Restaurants', 'slug' => 'restaurants']);
        Category::create(['name' => 'Shopping', 'slug' => 'shopping']);
        Category::create(['name' => 'Entertainment', 'slug' => 'entertainment']);
        Category::create(['name' => 'Accommodations', 'slug' => 'accommodations']);
    }
}
