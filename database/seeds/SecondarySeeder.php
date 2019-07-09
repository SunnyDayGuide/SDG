<?php

use Illuminate\Database\Seeder;

class SecondarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PagesTableSeeder::class,
    }
}
