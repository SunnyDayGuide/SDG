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
        $this->call([
            UsersSeeder::class,
            CountriesSeeder::class,
            StatesSeeder::class,
            BrandsTableSeeder::class,
            CategoriesTableSeeder::class,
            MarketsTableSeeder::class,
            MarketCategoryTableSeeder::class,
            ArticleTypesTableSeeder::class,
            DepartmentsTableSeeder::class
        ]);
    }
}
