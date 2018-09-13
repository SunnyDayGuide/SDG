<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BrandsTableSeeder::class);
        $this->call(MarketsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ArticleTypesTableSeeder::class);
    }
}
