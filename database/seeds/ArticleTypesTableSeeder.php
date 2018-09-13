<?php

use Illuminate\Database\Seeder;
use App\ArticleType;

class ArticleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Schema::disableForeignKeyConstraints();
    	DB::table('article_types')->truncate();
    	Schema::enableForeignKeyConstraints();

    	ArticleType::create(['name' => 'Trip Ideas', 'description' => 'General Editorial', 'body' => NULL, 'order' => 1]);
    	ArticleType::create(['name' => 'Visitor Info', 'description' => 'Area Services etc', 'body' => NULL, 'order' => 2]);
    	ArticleType::create(['name' => 'Advertiser Spotlights', 'description' => 'Profiles and Advertorials', 'body' => NULL, 'order' => 3]);
    }
}
