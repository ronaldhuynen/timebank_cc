<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationCountriesLocalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('location_countries_locales')->delete();
        
        \DB::table('location_countries_locales')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 1,
                'name' => 'Nederland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            1 => 
            array (
                'id' => 2,
                'country_id' => 1,
                'name' => 'Pays Bas',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            2 => 
            array (
                'id' => 3,
                'country_id' => 1,
                'name' => 'The Netherlands',
                'alias' => NULL,
                'locale' => 'en',
            ),
            3 => 
            array (
                'id' => 4,
                'country_id' => 2,
                'name' => 'België',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            4 => 
            array (
                'id' => 5,
                'country_id' => 2,
                'name' => 'Belgique',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            5 => 
            array (
                'id' => 6,
                'country_id' => 2,
                'name' => 'Belgium',
                'alias' => NULL,
                'locale' => 'en',
            ),
            6 => 
            array (
                'id' => 7,
                'country_id' => 2,
                'name' => 'Belgien',
                'alias' => NULL,
                'locale' => 'de',
            ),
        ));
        
        
    }
}