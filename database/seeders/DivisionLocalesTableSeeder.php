<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivisionLocalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('division_locales')->delete();

        \DB::table('division_locales')->insert(array (
            0 =>
            array (
                'id' => 1,
                'division_id' => 1,
                'name' => 'Drenthe',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            1 =>
            array (
                'id' => 2,
                'division_id' => 2,
                'name' => 'Flevoland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            2 =>
            array (
                'id' => 3,
                'division_id' => 3,
                'name' => 'Friesland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            3 =>
            array (
                'id' => 4,
                'division_id' => 4,
                'name' => 'Gelderland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            4 =>
            array (
                'id' => 5,
                'division_id' => 5,
                'name' => 'Groningen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            5 =>
            array (
                'id' => 6,
                'division_id' => 6,
                'name' => 'Limburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            6 =>
            array (
                'id' => 7,
                'division_id' => 7,
                'name' => 'Noord-Brabant',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            7 =>
            array (
                'id' => 8,
                'division_id' => 8,
                'name' => 'Noord-Holland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            8 =>
            array (
                'id' => 9,
                'division_id' => 9,
                'name' => 'Overijssel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            9 =>
            array (
                'id' => 10,
                'division_id' => 10,
                'name' => 'Utrecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            10 =>
            array (
                'id' => 11,
                'division_id' => 11,
                'name' => 'Zeeland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            11 =>
            array (
                'id' => 12,
                'division_id' => 12,
                'name' => 'Zuid-Holland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            12 =>
            array (
                'id' => 13,
                'division_id' => 13,
                'name' => 'Antwerpen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            13 =>
            array (
                'id' => 14,
                'division_id' => 14,
                'name' => 'Brussel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            14 =>
            array (
                'id' => 15,
                'division_id' => 17,
                'name' => 'Henegouwen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            15 =>
            array (
                'id' => 16,
                'division_id' => 19,
                'name' => 'Limburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            16 =>
            array (
                'id' => 17,
                'division_id' => 18,
                'name' => 'Luik',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            17 =>
            array (
                'id' => 18,
                'division_id' => 20,
                'name' => 'Luxenburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            18 =>
            array (
                'id' => 19,
                'division_id' => 21,
                'name' => 'Namen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            19 =>
            array (
                'id' => 20,
                'division_id' => 15,
                'name' => 'Oost-Vlaanderen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            20 =>
            array (
                'id' => 21,
                'division_id' => 16,
                'name' => 'Vlaams-Brabant',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            21 =>
            array (
                'id' => 22,
                'division_id' => 22,
                'name' => 'Waals-Brabant',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            22 =>
            array (
                'id' => 23,
                'division_id' => 23,
                'name' => 'West-Vlaanderen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            23 =>
            array (
                'id' => 24,
                'division_id' => 1,
                'name' => 'Drenthe',
                'alias' => NULL,
                'locale' => 'en',
            ),
            24 =>
            array (
                'id' => 25,
                'division_id' => 2,
                'name' => 'Flevoland',
                'alias' => NULL,
                'locale' => 'en',
            ),
            25 =>
            array (
                'id' => 26,
                'division_id' => 3,
                'name' => 'Friesland',
                'alias' => NULL,
                'locale' => 'en',
            ),
            26 =>
            array (
                'id' => 27,
                'division_id' => 4,
                'name' => 'Gelderland',
                'alias' => NULL,
                'locale' => 'en',
            ),
            27 =>
            array (
                'id' => 28,
                'division_id' => 5,
                'name' => 'Groningen',
                'alias' => NULL,
                'locale' => 'en',
            ),
            28 =>
            array (
                'id' => 29,
                'division_id' => 6,
                'name' => 'Limburg',
                'alias' => NULL,
                'locale' => 'en',
            ),
            29 =>
            array (
                'id' => 30,
                'division_id' => 7,
                'name' => 'North Brabant',
                'alias' => NULL,
                'locale' => 'en',
            ),
            30 =>
            array (
                'id' => 31,
                'division_id' => 8,
                'name' => 'North Holland',
                'alias' => NULL,
                'locale' => 'en',
            ),
            31 =>
            array (
                'id' => 32,
                'division_id' => 9,
                'name' => 'Overijssel',
                'alias' => NULL,
                'locale' => 'en',
            ),
            32 =>
            array (
                'id' => 33,
                'division_id' => 10,
                'name' => 'Utrecht',
                'alias' => NULL,
                'locale' => 'en',
            ),
            33 =>
            array (
                'id' => 34,
                'division_id' => 11,
                'name' => 'Zeeland',
                'alias' => NULL,
                'locale' => 'en',
            ),
            34 =>
            array (
                'id' => 35,
                'division_id' => 12,
                'name' => 'South Holland',
                'alias' => NULL,
                'locale' => 'en',
            ),
            35 =>
            array (
                'id' => 36,
                'division_id' => 13,
                'name' => 'Antwerp',
                'alias' => NULL,
                'locale' => 'en',
            ),
            36 =>
            array (
                'id' => 37,
                'division_id' => 14,
                'name' => 'Brussels',
                'alias' => NULL,
                'locale' => 'en',
            ),
            37 =>
            array (
                'id' => 38,
                'division_id' => 17,
                'name' => 'Hainaut',
                'alias' => NULL,
                'locale' => 'en',
            ),
            38 =>
            array (
                'id' => 39,
                'division_id' => 19,
                'name' => 'Limburg',
                'alias' => NULL,
                'locale' => 'en',
            ),
            39 =>
            array (
                'id' => 40,
                'division_id' => 18,
                'name' => 'Liège',
                'alias' => NULL,
                'locale' => 'en',
            ),
            40 =>
            array (
                'id' => 41,
                'division_id' => 20,
                'name' => 'Luxenbourg',
                'alias' => NULL,
                'locale' => 'en',
            ),
            41 =>
            array (
                'id' => 42,
                'division_id' => 21,
                'name' => 'Namur',
                'alias' => NULL,
                'locale' => 'en',
            ),
            42 =>
            array (
                'id' => 43,
                'division_id' => 15,
                'name' => 'East Flanders',
                'alias' => NULL,
                'locale' => 'en',
            ),
            43 =>
            array (
                'id' => 44,
                'division_id' => 16,
                'name' => 'Flemish Brabant',
                'alias' => NULL,
                'locale' => 'en',
            ),
            44 =>
            array (
                'id' => 45,
                'division_id' => 22,
                'name' => 'Walloon Brabant',
                'alias' => NULL,
                'locale' => 'en',
            ),
            45 =>
            array (
                'id' => 46,
                'division_id' => 23,
                'name' => 'West Flanders',
                'alias' => NULL,
                'locale' => 'en',
            ),
            46 =>
            array (
                'id' => 47,
                'division_id' => 1,
                'name' => 'Drenthe',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            47 =>
            array (
                'id' => 48,
                'division_id' => 2,
                'name' => 'Flevoland',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            48 =>
            array (
                'id' => 49,
                'division_id' => 3,
                'name' => 'Frise',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            49 =>
            array (
                'id' => 50,
                'division_id' => 4,
                'name' => 'Gueldre',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            50 =>
            array (
                'id' => 51,
                'division_id' => 5,
                'name' => 'Groningue',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            51 =>
            array (
                'id' => 52,
                'division_id' => 6,
                'name' => 'Limbourg',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            52 =>
            array (
                'id' => 53,
                'division_id' => 7,
                'name' => 'Brabant-Septentrional',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            53 =>
            array (
                'id' => 54,
                'division_id' => 8,
                'name' => 'Hollande-Septentrionale',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            54 =>
            array (
                'id' => 55,
                'division_id' => 9,
                'name' => 'Overijssel',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            55 =>
            array (
                'id' => 56,
                'division_id' => 10,
                'name' => 'Utrecht',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            56 =>
            array (
                'id' => 57,
                'division_id' => 11,
                'name' => 'Zélande',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            57 =>
            array (
                'id' => 58,
                'division_id' => 12,
                'name' => 'Hollande-Méridionale',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            58 =>
            array (
                'id' => 59,
                'division_id' => 13,
                'name' => 'Anvers',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            59 =>
            array (
                'id' => 60,
                'division_id' => 23,
                'name' => 'Flandre-Occidentale',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            60 =>
            array (
                'id' => 61,
                'division_id' => 15,
                'name' => 'Flandre-Orientale',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            61 =>
            array (
                'id' => 62,
                'division_id' => 17,
                'name' => 'Hainaut',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            62 =>
            array (
                'id' => 63,
                'division_id' => 18,
                'name' => 'Liège',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            63 =>
            array (
                'id' => 64,
                'division_id' => 19,
                'name' => 'Limbourg',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            64 =>
            array (
                'id' => 65,
                'division_id' => 20,
                'name' => 'Luxenbourg',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            65 =>
            array (
                'id' => 66,
                'division_id' => 21,
                'name' => 'Namur',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            66 =>
            array (
                'id' => 67,
                'division_id' => 16,
                'name' => 'Brabant flamand',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            67 =>
            array (
                'id' => 68,
                'division_id' => 22,
                'name' => 'Brabant wallon',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            68 =>
            array (
                'id' => 69,
                'division_id' => 14,
                'name' => 'Bruxelles',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            69 =>
            array (
                'id' => 70,
                'division_id' => 13,
                'name' => 'Antwerpen',
                'alias' => NULL,
                'locale' => 'de',
            ),
            70 =>
            array (
                'id' => 71,
                'division_id' => 14,
                'name' => 'Brüssel',
                'alias' => NULL,
                'locale' => 'de',
            ),
            71 =>
            array (
                'id' => 72,
                'division_id' => 15,
                'name' => 'Ostflandern',
                'alias' => NULL,
                'locale' => 'de',
            ),
            72 =>
            array (
                'id' => 73,
                'division_id' => 16,
                'name' => 'Flämisch-Brabant',
                'alias' => NULL,
                'locale' => 'de',
            ),
            73 =>
            array (
                'id' => 74,
                'division_id' => 17,
                'name' => 'Hennegau',
                'alias' => NULL,
                'locale' => 'de',
            ),
            74 =>
            array (
                'id' => 75,
                'division_id' => 18,
                'name' => 'Lüttich',
                'alias' => NULL,
                'locale' => 'de',
            ),
            75 =>
            array (
                'id' => 76,
                'division_id' => 19,
                'name' => 'Limburg',
                'alias' => NULL,
                'locale' => 'de',
            ),
            76 =>
            array (
                'id' => 77,
                'division_id' => 20,
                'name' => 'Luxemburg',
                'alias' => NULL,
                'locale' => 'de',
            ),
            77 =>
            array (
                'id' => 78,
                'division_id' => 21,
                'name' => 'Namur',
                'alias' => NULL,
                'locale' => 'de',
            ),
            78 =>
            array (
                'id' => 79,
                'division_id' => 22,
                'name' => 'Wallonisch-Brabant',
                'alias' => NULL,
                'locale' => 'de',
            ),
            79 =>
            array (
                'id' => 80,
                'division_id' => 23,
                'name' => 'Westflandern',
                'alias' => NULL,
                'locale' => 'de',
            ),
        ));


    }
}