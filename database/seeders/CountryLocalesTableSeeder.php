<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountryLocalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('country_locales')->delete();
        
        \DB::table('country_locales')->insert(array (
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
                'name' => 'Netherlands',
                'alias' => NULL,
                'locale' => 'en',
            ),
            3 => 
            array (
                'id' => 4,
                'country_id' => 1,
                'name' => 'Países Bajos',
                'alias' => NULL,
                'locale' => 'es',
            ),
            4 => 
            array (
                'id' => 5,
                'country_id' => 2,
                'name' => 'België',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            5 => 
            array (
                'id' => 6,
                'country_id' => 2,
                'name' => 'Belgique',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            6 => 
            array (
                'id' => 7,
                'country_id' => 2,
                'name' => 'Belgium',
                'alias' => NULL,
                'locale' => 'en',
            ),
            7 => 
            array (
                'id' => 8,
                'country_id' => 2,
                'name' => 'Belgien',
                'alias' => NULL,
                'locale' => 'es',
            ),
            8 => 
            array (
                'id' => 9,
                'country_id' => 3,
                'name' => 'Duitsland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            9 => 
            array (
                'id' => 10,
                'country_id' => 3,
                'name' => 'Allemand',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            10 => 
            array (
                'id' => 11,
                'country_id' => 3,
                'name' => 'Germany',
                'alias' => NULL,
                'locale' => 'en',
            ),
            11 => 
            array (
                'id' => 12,
                'country_id' => 3,
                'name' => 'Alemania',
                'alias' => NULL,
                'locale' => 'es',
            ),
            12 => 
            array (
                'id' => 13,
                'country_id' => 4,
                'name' => 'Verenigd Koninkrijk',
                'alias' => 'Groot-Brittanië',
                'locale' => 'nl',
            ),
            13 => 
            array (
                'id' => 14,
                'country_id' => 4,
                'name' => 'Royaume-Uni',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            14 => 
            array (
                'id' => 15,
                'country_id' => 4,
                'name' => 'United Kingdom',
                'alias' => NULL,
                'locale' => 'en',
            ),
            15 => 
            array (
                'id' => 16,
                'country_id' => 4,
                'name' => 'Reino Unido',
                'alias' => NULL,
                'locale' => 'es',
            ),
            16 => 
            array (
                'id' => 17,
                'country_id' => 5,
                'name' => 'Frankrijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            17 => 
            array (
                'id' => 18,
                'country_id' => 5,
                'name' => 'France',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            18 => 
            array (
                'id' => 19,
                'country_id' => 5,
                'name' => 'France',
                'alias' => NULL,
                'locale' => 'en',
            ),
            19 => 
            array (
                'id' => 20,
                'country_id' => 5,
                'name' => 'Francia',
                'alias' => NULL,
                'locale' => 'es',
            ),
            20 => 
            array (
                'id' => 21,
                'country_id' => 6,
                'name' => 'Spanje',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            21 => 
            array (
                'id' => 22,
                'country_id' => 6,
                'name' => 'Espagne',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            22 => 
            array (
                'id' => 23,
                'country_id' => 6,
                'name' => 'Spain',
                'alias' => NULL,
                'locale' => 'en',
            ),
            23 => 
            array (
                'id' => 24,
                'country_id' => 6,
                'name' => 'España',
                'alias' => NULL,
                'locale' => 'es',
            ),
            24 => 
            array (
                'id' => 25,
                'country_id' => 7,
                'name' => 'Portugal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            25 => 
            array (
                'id' => 26,
                'country_id' => 7,
                'name' => 'Portugal',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            26 => 
            array (
                'id' => 27,
                'country_id' => 7,
                'name' => 'Portugal',
                'alias' => NULL,
                'locale' => 'en',
            ),
            27 => 
            array (
                'id' => 28,
                'country_id' => 7,
                'name' => 'Portugal',
                'alias' => NULL,
                'locale' => 'es',
            ),
            28 => 
            array (
                'id' => 29,
                'country_id' => 8,
                'name' => 'Italië',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            29 => 
            array (
                'id' => 30,
                'country_id' => 8,
                'name' => 'Italie',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            30 => 
            array (
                'id' => 31,
                'country_id' => 8,
                'name' => 'Italy',
                'alias' => NULL,
                'locale' => 'en',
            ),
            31 => 
            array (
                'id' => 32,
                'country_id' => 8,
                'name' => 'Italia',
                'alias' => NULL,
                'locale' => 'es',
            ),
            32 => 
            array (
                'id' => 33,
                'country_id' => 9,
                'name' => 'Polen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            33 => 
            array (
                'id' => 34,
                'country_id' => 9,
                'name' => 'Pologne',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            34 => 
            array (
                'id' => 35,
                'country_id' => 9,
                'name' => 'Poland',
                'alias' => NULL,
                'locale' => 'en',
            ),
            35 => 
            array (
                'id' => 36,
                'country_id' => 9,
                'name' => 'Polonia',
                'alias' => NULL,
                'locale' => 'es',
            ),
        ));
        
        
    }
}