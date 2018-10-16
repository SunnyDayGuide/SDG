<?php

use Illuminate\Database\Seeder;
use App\Market;

class MarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('markets')->truncate();
        Schema::enableForeignKeyConstraints();

        Market::create([
            'code' => 'BR', 
            'name' => 'Branson', 
            'name_alt' => NULL, 
            'cities' => NULL, 
            'state_id' => '30', 
            'slug' => 'branson',
            'brand_id' => '1'
        ]);
        Market::create([
            'code' => 'GS', 
            'name' => 'Myrtle Beach', 
            'name_alt' => 'The Grand Strand', 
            'state_id' => '48', 
            'cities' => NULL, 
            'slug' => 'myrtle-beach',
            'brand_id' => '1'
        ]);
        Market::create([
            'code' => 'HO', 
            'name' => 'Hatteras-Ocracoke', 
            'name_alt' => 'Hatteras & Ocracoke Islands', 
            'state_id' => '38',
            'cities' => NULL, 
            'slug' => 'hatteras-ocracoke',
            'brand_id' => '1'
        ]);  
        Market::create([
            'code' => 'OB', 
            'name' => 'Outer Banks', 
            'name_alt' => 'Outer Banks of North Carolina', 
            'state_id' => '38',
            'cities' => 'Corolla, Duck & Southern Shores, Kitty Hawk, Kill Devil Hills, Nags Head, Roanoke Island, and the Currituck Mainland', 
            'slug' => 'outer-banks',
            'brand_id' => '1'
        ]);
        Market::create([
            'code' => 'OC', 
            'name' => 'Ocean City', 
            'name_alt' => NULL, 
            'state_id' => '25',
            'cities' => NULL, 
            'slug' => 'ocean-city',
            'brand_id' => '1'
        ]);
        Market::create([
            'code' => 'RH', 
            'name' => 'Delaware Beaches', 
            'name_alt' => 'Coastal Delaware', 
            'state_id' => '9',
            'cities' => 'Fenwick, Bethany, Dewey, Rehoboth & Lewes', 
            'slug' => 'delaware-beaches',
            'brand_id' => '1'
        ]);
        Market::create([
            'code' => 'SA', 
            'name' => 'Florida Suncoast', 
            'name_alt' => 'Bradenton & Sarasota Area Beaches', 
            'state_id' => '12',
            'cities' => 'Anna Maria Island, Bradenton, Longboat Key, Sarasota, Lido Key, Siesta Key & Venice', 
            'slug' => 'sarasota-bradenton',
            'brand_id' => '1'
        ]);
        Market::create([
            'code' => 'SC', 
            'name' => 'Sanibel-Captiva & Fort Myers Beach', 
            'name_alt' => NULL, 
            'state_id' => '12',
            'cities' => NULL, 
            'slug' => 'sanibel-captiva',
            'brand_id' => '1'
        ]);
        Market::create([
            'code' => 'VB', 
            'name' => 'Virginia Beach', 
            'name_alt' => NULL, 
            'state_id' => '55',
            'cities' => NULL, 
            'slug' => 'virginia-beach',
            'brand_id' => '1'
        ]);
        Market::create([
            'code' => 'SM', 
            'name' => 'Smoky Mountains', 
            'name_alt' => 'Smoky Mountains of Tennessee', 
            'state_id' => '50',
            'cities' => 'Sevierville, Pigeon Forge & Gatlinburg', 
            'slug' => 'smoky-mountains',
            'brand_id' => '2'
        ]);
        Market::create([
            'code' => 'CG', 
            'name' => 'Williamsburg', 
            'name_alt' => 'Virginia\'s Historic Triangle', 
            'state_id' => '55',
            'cities' => 'Williamsburg, Jamestown, Yorktown, Hampton & Newport News', 
            'slug' => 'williamsburg',
            'brand_id' => '3'
        ]);
    }
}
