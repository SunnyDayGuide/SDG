<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('brands')->truncate();
        Schema::enableForeignKeyConstraints();

        Brand::create(['name' => 'Sunny Day Guide', 'logo' => 'SDG.jpg']);
        Brand::create(['name' => 'What-to-Do', 'logo' => 'WTD.jpg']);
        Brand::create(['name' => 'Colonial Guide', 'logo' => 'CG.jpg']);
    }
}
