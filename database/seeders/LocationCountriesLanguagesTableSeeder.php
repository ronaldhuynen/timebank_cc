<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationCountriesLanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('location_countries_languages')->delete();
        
        \DB::table('location_countries_languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 1,
                'code' => 'nl',
            ),
            1 => 
            array (
                'id' => 4,
                'country_id' => 2,
                'code' => 'de',
            ),
            2 => 
            array (
                'id' => 3,
                'country_id' => 2,
                'code' => 'fr',
            ),
            3 => 
            array (
                'id' => 2,
                'country_id' => 2,
                'code' => 'nl',
            ),
        ));
        
        
    }
}