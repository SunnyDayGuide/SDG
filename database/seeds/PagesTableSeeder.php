<?php

use App\Market;
use App\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('pages')->truncate();
        Schema::enableForeignKeyConstraints();

        $markets = Market::all();

        foreach ($markets as $market) {
        	Page::create([
	            'market_id' => $market->id, 
	            'title' => 'FREE Digital ' .$market->name. ' Vacation Guide', 
	            'slug' => 'vacation-guide'
	        ]);
	        Page::create([
	            'market_id' => $market->id, 
	            'title' => 'Request More Information About ' .$market->name, 
	            'slug' => 'request-information'
	        ]);
	        Page::create([
	            'market_id' => $market->id, 
	            'title' => $market->name . ' Coupons', 
	            'slug' => 'coupons'
	        ]);
	        Page::create([
	            'market_id' => $market->id, 
	            'title' => $market->name . ' Trip Ideas', 
	            'slug' => 'articles'
	        ]);
        }

    }
}
