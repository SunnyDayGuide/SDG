<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        Category::create(['cat_name' => 'Attractions & Activities']);
        Category::create(['cat_name' => 'Dining']);
        Category::create(['cat_name' => 'Shopping']);
        Category::create(['cat_name' => 'Entertainment']);
        Category::create(['cat_name' => 'Lodging']);
    }
}
