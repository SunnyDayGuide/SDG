<?php

use App\FreemailType;
use Illuminate\Database\Seeder;

class FreemailTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('freemail_types')->truncate();
        Schema::enableForeignKeyConstraints();

        FreemailType::create(['name' => 'Banner Ad']);
        FreemailType::create(['name' => 'Distribution']);
        FreemailType::create(['name' => 'Purchased']);
        FreemailType::create(['name' => 'Other']);
    }
}
