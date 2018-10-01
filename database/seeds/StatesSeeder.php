<?php

use Illuminate\Database\Seeder;
use App\State;

class StatesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        //Empty the states table
        Schema::disableForeignKeyConstraints();
        DB::table('states')->truncate();
        Schema::enableForeignKeyConstraints();

        // Get all of the states
        $json = File::get('database/data/states.json');
        $data = json_decode($json);
        $states = (array) $data;

        foreach ($states as $stateId => $state){
            DB::table('states')->insert(array(
                'id' => $stateId,
                'iso_3166_2' => $state->iso_3166_2,
                'name' => $state->name,
                'country_id' => $state->country_id,
            ));
        }
    }

}