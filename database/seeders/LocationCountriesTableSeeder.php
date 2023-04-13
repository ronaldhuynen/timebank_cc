<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationCountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('location_countries')->delete();
        
        \DB::table('location_countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'NL',
                'flag' => '🇳🇱',
                'phonecode' => '31',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'BE',
                'flag' => '🇧🇪',
                'phonecode' => '32',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'DE',
                'flag' => '🇩🇪',
                'phonecode' => '49',
            ),
        ));
        
        
    }
}