<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        //Empty the countries table
        Schema::disableForeignKeyConstraints();
        DB::table('countries')->truncate();
        Schema::enableForeignKeyConstraints();

        // Get all of the countries
        $json = File::get('database/data/countries.json');
        $data = json_decode($json);
        $countries = (array) $data;

        foreach ($countries as $countryId => $country){
            DB::table('countries')->insert(array(
                'id' => $countryId,
                'capital' => ((isset($country->capital)) ? $country->capital : null),
                'country_code' => $country->country_code,
                'full_name' => ((isset($country->full_name)) ? $country->full_name : null),
                'iso_3166_2' => $country->iso_3166_2,
                'iso_3166_3' => $country->iso_3166_3,
                'name' => $country->name,
            ));
        }
    }

}
