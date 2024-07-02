<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
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
            3 => 
            array (
                'id' => 4,
                'code' => 'UK',
                'flag' => '🇬🇧',
                'phonecode' => '44',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'FR',
                'flag' => '🇫🇷',
                'phonecode' => '33',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'ES',
                'flag' => '🇪🇸',
                'phonecode' => '34',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'PT',
                'flag' => '🇵🇹',
                'phonecode' => '351',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'IT',
                'flag' => '🇮🇹',
                'phonecode' => '39',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'PL',
                'flag' => '🇵🇱',
                'phonecode' => '48',
            ),
        ));
        
        
    }
}