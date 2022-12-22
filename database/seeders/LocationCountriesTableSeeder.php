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
                'abbr' => 'NL',
                'flag' => NULL,
                'callingcode' => '31',
            ),
            1 => 
            array (
                'id' => 2,
                'abbr' => 'BE',
                'flag' => NULL,
                'callingcode' => '32',
            ),
        ));
        
        
    }
}