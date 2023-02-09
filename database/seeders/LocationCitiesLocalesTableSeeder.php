<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationCitiesLocalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('location_cities_locales')->delete();
        
        \DB::table('location_cities_locales')->insert(array (
            0 => 
            array (
                'id' => 1,
                'city_id' => 1,
                'name' => 'Aa en Hunze',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            1 => 
            array (
                'id' => 2,
                'city_id' => 2,
                'name' => 'Assen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            2 => 
            array (
                'id' => 3,
                'city_id' => 3,
                'name' => 'Borger-Odoorn',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            3 => 
            array (
                'id' => 4,
                'city_id' => 4,
                'name' => 'Coevorden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            4 => 
            array (
                'id' => 5,
                'city_id' => 5,
                'name' => 'Emmen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            5 => 
            array (
                'id' => 6,
                'city_id' => 6,
                'name' => 'Hoogeveen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            6 => 
            array (
                'id' => 7,
                'city_id' => 7,
                'name' => 'Meppel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            7 => 
            array (
                'id' => 8,
                'city_id' => 8,
                'name' => 'Midden-Drenthe',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            8 => 
            array (
                'id' => 9,
                'city_id' => 9,
                'name' => 'Noordenveld',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            9 => 
            array (
                'id' => 10,
                'city_id' => 10,
                'name' => 'Tynaarlo',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            10 => 
            array (
                'id' => 11,
                'city_id' => 11,
                'name' => 'Westerveld',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            11 => 
            array (
                'id' => 12,
                'city_id' => 12,
                'name' => 'De Wolden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            12 => 
            array (
                'id' => 13,
                'city_id' => 13,
                'name' => 'Almere',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            13 => 
            array (
                'id' => 14,
                'city_id' => 14,
                'name' => 'Dronten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            14 => 
            array (
                'id' => 15,
                'city_id' => 15,
                'name' => 'Lelystad',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            15 => 
            array (
                'id' => 16,
                'city_id' => 16,
                'name' => 'Noordoostpolder',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            16 => 
            array (
                'id' => 17,
                'city_id' => 17,
                'name' => 'Urk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            17 => 
            array (
                'id' => 18,
                'city_id' => 18,
                'name' => 'Zeewolde',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            18 => 
            array (
                'id' => 19,
                'city_id' => 19,
                'name' => 'Achtkarspelen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            19 => 
            array (
                'id' => 20,
                'city_id' => 20,
                'name' => 'Ameland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            20 => 
            array (
                'id' => 21,
                'city_id' => 21,
                'name' => 'Dantumadeel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            21 => 
            array (
                'id' => 22,
                'city_id' => 22,
                'name' => 'De Friese Meren',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            22 => 
            array (
                'id' => 23,
                'city_id' => 23,
                'name' => 'Harlingen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            23 => 
            array (
                'id' => 24,
                'city_id' => 24,
                'name' => 'Heerenveen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            24 => 
            array (
                'id' => 25,
                'city_id' => 25,
                'name' => 'Leeuwarden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            25 => 
            array (
                'id' => 26,
                'city_id' => 26,
                'name' => 'Noordoost-Friesland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            26 => 
            array (
                'id' => 27,
                'city_id' => 27,
                'name' => 'Ooststellingwerf',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            27 => 
            array (
                'id' => 28,
                'city_id' => 28,
                'name' => 'Opsterland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            28 => 
            array (
                'id' => 29,
                'city_id' => 29,
                'name' => 'Schiermonnikoog',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            29 => 
            array (
                'id' => 30,
                'city_id' => 30,
                'name' => 'Smallingerland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            30 => 
            array (
                'id' => 31,
                'city_id' => 31,
                'name' => 'Zuidwest-Friesland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            31 => 
            array (
                'id' => 32,
                'city_id' => 32,
                'name' => 'Terschelling',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            32 => 
            array (
                'id' => 33,
                'city_id' => 33,
                'name' => 'Tietjerksteradeel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            33 => 
            array (
                'id' => 34,
                'city_id' => 34,
                'name' => 'Vlieland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            34 => 
            array (
                'id' => 35,
                'city_id' => 35,
                'name' => 'Waadhoeke',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            35 => 
            array (
                'id' => 36,
                'city_id' => 36,
                'name' => 'Weststellingwerf',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            36 => 
            array (
                'id' => 37,
                'city_id' => 37,
                'name' => 'Aalten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            37 => 
            array (
                'id' => 38,
                'city_id' => 38,
                'name' => 'Apeldoorn',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            38 => 
            array (
                'id' => 39,
                'city_id' => 39,
                'name' => 'Arnhem',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            39 => 
            array (
                'id' => 40,
                'city_id' => 40,
                'name' => 'Barneveld',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            40 => 
            array (
                'id' => 41,
                'city_id' => 41,
                'name' => 'Berg en Dal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            41 => 
            array (
                'id' => 42,
                'city_id' => 42,
                'name' => 'Berkelland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            42 => 
            array (
                'id' => 43,
                'city_id' => 43,
                'name' => 'Beuningen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            43 => 
            array (
                'id' => 44,
                'city_id' => 44,
                'name' => 'Bronckhorst',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            44 => 
            array (
                'id' => 45,
                'city_id' => 45,
                'name' => 'Brummen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            45 => 
            array (
                'id' => 46,
                'city_id' => 46,
                'name' => 'Buren',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            46 => 
            array (
                'id' => 47,
                'city_id' => 47,
                'name' => 'Culemborg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            47 => 
            array (
                'id' => 48,
                'city_id' => 48,
                'name' => 'Doesburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            48 => 
            array (
                'id' => 49,
                'city_id' => 49,
                'name' => 'Doetinchem',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            49 => 
            array (
                'id' => 50,
                'city_id' => 50,
                'name' => 'Druten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            50 => 
            array (
                'id' => 51,
                'city_id' => 51,
                'name' => 'Duiven',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            51 => 
            array (
                'id' => 52,
                'city_id' => 52,
                'name' => 'Ede',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            52 => 
            array (
                'id' => 53,
                'city_id' => 53,
                'name' => 'Elburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            53 => 
            array (
                'id' => 54,
                'city_id' => 54,
                'name' => 'Epe',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            54 => 
            array (
                'id' => 55,
                'city_id' => 55,
                'name' => 'Ermelo',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            55 => 
            array (
                'id' => 56,
                'city_id' => 56,
                'name' => 'Harderwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            56 => 
            array (
                'id' => 57,
                'city_id' => 57,
                'name' => 'Hattem',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            57 => 
            array (
                'id' => 58,
                'city_id' => 58,
                'name' => 'Heerde',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            58 => 
            array (
                'id' => 59,
                'city_id' => 59,
                'name' => 'Heumen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            59 => 
            array (
                'id' => 60,
                'city_id' => 60,
                'name' => 'Lingewaard',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            60 => 
            array (
                'id' => 61,
                'city_id' => 61,
                'name' => 'Lochem',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            61 => 
            array (
                'id' => 62,
                'city_id' => 62,
                'name' => 'Maasdriel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            62 => 
            array (
                'id' => 63,
                'city_id' => 63,
                'name' => 'Montferland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            63 => 
            array (
                'id' => 64,
                'city_id' => 64,
                'name' => 'Neder-Betuwe',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            64 => 
            array (
                'id' => 65,
                'city_id' => 65,
                'name' => 'Nijkerk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            65 => 
            array (
                'id' => 66,
                'city_id' => 66,
                'name' => 'Nijmegen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            66 => 
            array (
                'id' => 67,
                'city_id' => 67,
                'name' => 'Nunspeet',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            67 => 
            array (
                'id' => 68,
                'city_id' => 68,
                'name' => 'Oldebroek',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            68 => 
            array (
                'id' => 69,
                'city_id' => 69,
                'name' => 'Oost Gelre',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            69 => 
            array (
                'id' => 70,
                'city_id' => 70,
                'name' => 'Oude IJsselstreek',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            70 => 
            array (
                'id' => 71,
                'city_id' => 71,
                'name' => 'Overbetuwe',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            71 => 
            array (
                'id' => 72,
                'city_id' => 72,
                'name' => 'Putten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            72 => 
            array (
                'id' => 73,
                'city_id' => 73,
                'name' => 'Renkum',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            73 => 
            array (
                'id' => 74,
                'city_id' => 74,
                'name' => 'Rheden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            74 => 
            array (
                'id' => 75,
                'city_id' => 75,
                'name' => 'Rozendaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            75 => 
            array (
                'id' => 76,
                'city_id' => 76,
                'name' => 'Scherpenzeel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            76 => 
            array (
                'id' => 77,
                'city_id' => 77,
                'name' => 'Tiel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            77 => 
            array (
                'id' => 78,
                'city_id' => 78,
                'name' => 'Voorst',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            78 => 
            array (
                'id' => 79,
                'city_id' => 79,
                'name' => 'Wageningen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            79 => 
            array (
                'id' => 80,
                'city_id' => 80,
                'name' => 'West Betuwe',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            80 => 
            array (
                'id' => 81,
                'city_id' => 81,
                'name' => 'West Maas en Waal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            81 => 
            array (
                'id' => 82,
                'city_id' => 82,
                'name' => 'Westervoort',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            82 => 
            array (
                'id' => 83,
                'city_id' => 83,
                'name' => 'Wijchen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            83 => 
            array (
                'id' => 84,
                'city_id' => 84,
                'name' => 'Winterswijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            84 => 
            array (
                'id' => 85,
                'city_id' => 85,
                'name' => 'Zaltbommel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            85 => 
            array (
                'id' => 86,
                'city_id' => 86,
                'name' => 'Zevenaar',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            86 => 
            array (
                'id' => 87,
                'city_id' => 87,
                'name' => 'Zutphen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            87 => 
            array (
                'id' => 88,
                'city_id' => 88,
                'name' => 'Eemsdelta',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            88 => 
            array (
                'id' => 89,
                'city_id' => 89,
                'name' => 'Groningen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            89 => 
            array (
                'id' => 90,
                'city_id' => 90,
                'name' => 'Het Hogeland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            90 => 
            array (
                'id' => 91,
                'city_id' => 91,
                'name' => 'Midden-Groningen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            91 => 
            array (
                'id' => 92,
                'city_id' => 92,
                'name' => 'Oldambt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            92 => 
            array (
                'id' => 93,
                'city_id' => 93,
                'name' => 'Pekela',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            93 => 
            array (
                'id' => 94,
                'city_id' => 94,
                'name' => 'Stadskanaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            94 => 
            array (
                'id' => 95,
                'city_id' => 95,
                'name' => 'Veendam',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            95 => 
            array (
                'id' => 96,
                'city_id' => 96,
                'name' => 'Westerkwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            96 => 
            array (
                'id' => 97,
                'city_id' => 97,
                'name' => 'Westerwolde',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            97 => 
            array (
                'id' => 98,
                'city_id' => 98,
                'name' => 'Beek',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            98 => 
            array (
                'id' => 99,
                'city_id' => 99,
                'name' => 'Beekdaelen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            99 => 
            array (
                'id' => 100,
                'city_id' => 100,
                'name' => 'Beesel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            100 => 
            array (
                'id' => 101,
                'city_id' => 101,
            'name' => 'Bergen (L.)',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            101 => 
            array (
                'id' => 102,
                'city_id' => 102,
                'name' => 'Brunssum',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            102 => 
            array (
                'id' => 103,
                'city_id' => 103,
                'name' => 'Echt-Susteren',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            103 => 
            array (
                'id' => 104,
                'city_id' => 104,
                'name' => 'Eijsden-Margraten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            104 => 
            array (
                'id' => 105,
                'city_id' => 105,
                'name' => 'Gennep',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            105 => 
            array (
                'id' => 106,
                'city_id' => 106,
                'name' => 'Gulpen-Wittem',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            106 => 
            array (
                'id' => 107,
                'city_id' => 107,
                'name' => 'Heerlen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            107 => 
            array (
                'id' => 108,
                'city_id' => 108,
                'name' => 'Horst aan de Maas',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            108 => 
            array (
                'id' => 109,
                'city_id' => 109,
                'name' => 'Kerkrade',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            109 => 
            array (
                'id' => 110,
                'city_id' => 110,
                'name' => 'Landgraaf',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            110 => 
            array (
                'id' => 111,
                'city_id' => 111,
                'name' => 'Leudal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            111 => 
            array (
                'id' => 112,
                'city_id' => 112,
                'name' => 'Maasgouw',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            112 => 
            array (
                'id' => 113,
                'city_id' => 113,
                'name' => 'Maastricht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            113 => 
            array (
                'id' => 114,
                'city_id' => 114,
                'name' => 'Meerssen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            114 => 
            array (
                'id' => 115,
                'city_id' => 115,
                'name' => 'Mook en Middelaar',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            115 => 
            array (
                'id' => 116,
                'city_id' => 116,
                'name' => 'Nederweert',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            116 => 
            array (
                'id' => 117,
                'city_id' => 117,
                'name' => 'Peel en Maas',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            117 => 
            array (
                'id' => 118,
                'city_id' => 118,
                'name' => 'Roerdalen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            118 => 
            array (
                'id' => 119,
                'city_id' => 119,
                'name' => 'Roermond',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            119 => 
            array (
                'id' => 120,
                'city_id' => 120,
                'name' => 'Simpelveld',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            120 => 
            array (
                'id' => 121,
                'city_id' => 121,
                'name' => 'Sittard-Geleen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            121 => 
            array (
                'id' => 122,
                'city_id' => 122,
                'name' => 'Stein',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            122 => 
            array (
                'id' => 123,
                'city_id' => 123,
                'name' => 'Vaals',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            123 => 
            array (
                'id' => 124,
                'city_id' => 124,
                'name' => 'Valkenburg aan de Geul',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            124 => 
            array (
                'id' => 125,
                'city_id' => 125,
                'name' => 'Venlo',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            125 => 
            array (
                'id' => 126,
                'city_id' => 126,
                'name' => 'Venray',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            126 => 
            array (
                'id' => 127,
                'city_id' => 127,
                'name' => 'Voerendaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            127 => 
            array (
                'id' => 128,
                'city_id' => 128,
                'name' => 'Weert',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            128 => 
            array (
                'id' => 129,
                'city_id' => 129,
                'name' => 'Alphen-Chaam',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            129 => 
            array (
                'id' => 130,
                'city_id' => 130,
                'name' => 'Altena',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            130 => 
            array (
                'id' => 131,
                'city_id' => 131,
                'name' => 'Asten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            131 => 
            array (
                'id' => 132,
                'city_id' => 132,
                'name' => 'Baarle-Nassau',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            132 => 
            array (
                'id' => 133,
                'city_id' => 133,
                'name' => 'Bergeijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            133 => 
            array (
                'id' => 134,
                'city_id' => 134,
                'name' => 'Bergen op Zoom',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            134 => 
            array (
                'id' => 135,
                'city_id' => 135,
                'name' => 'Bernheze',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            135 => 
            array (
                'id' => 136,
                'city_id' => 136,
                'name' => 'Best',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            136 => 
            array (
                'id' => 137,
                'city_id' => 137,
                'name' => 'Bladel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            137 => 
            array (
                'id' => 138,
                'city_id' => 138,
                'name' => 'Boekel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            138 => 
            array (
                'id' => 139,
                'city_id' => 139,
                'name' => 'Boxtel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            139 => 
            array (
                'id' => 140,
                'city_id' => 140,
                'name' => 'Breda',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            140 => 
            array (
                'id' => 141,
                'city_id' => 141,
                'name' => 'Cranendonck',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            141 => 
            array (
                'id' => 142,
                'city_id' => 142,
                'name' => 'Deurne',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            142 => 
            array (
                'id' => 143,
                'city_id' => 143,
                'name' => 'Dongen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            143 => 
            array (
                'id' => 144,
                'city_id' => 144,
                'name' => 'Drimmelen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            144 => 
            array (
                'id' => 145,
                'city_id' => 145,
                'name' => 'Eersel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            145 => 
            array (
                'id' => 146,
                'city_id' => 146,
                'name' => 'Eindhoven',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            146 => 
            array (
                'id' => 147,
                'city_id' => 147,
                'name' => 'Etten-Leur',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            147 => 
            array (
                'id' => 148,
                'city_id' => 148,
                'name' => 'Geertruidenberg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            148 => 
            array (
                'id' => 149,
                'city_id' => 149,
                'name' => 'Geldrop-Mierlo',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            149 => 
            array (
                'id' => 150,
                'city_id' => 150,
                'name' => 'Gemert-Bakel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            150 => 
            array (
                'id' => 151,
                'city_id' => 151,
                'name' => 'Gilze en Rijen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            151 => 
            array (
                'id' => 152,
                'city_id' => 152,
                'name' => 'Goirle',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            152 => 
            array (
                'id' => 153,
                'city_id' => 153,
                'name' => 'Halderberge',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            153 => 
            array (
                'id' => 154,
                'city_id' => 154,
                'name' => 'Heeze-Leende',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            154 => 
            array (
                'id' => 155,
                'city_id' => 155,
                'name' => 'Helmond',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            155 => 
            array (
                'id' => 156,
                'city_id' => 156,
                'name' => '\'s-Hertogenbosch',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            156 => 
            array (
                'id' => 157,
                'city_id' => 157,
                'name' => 'Heusden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            157 => 
            array (
                'id' => 158,
                'city_id' => 158,
                'name' => 'Hilvarenbeek',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            158 => 
            array (
                'id' => 159,
                'city_id' => 159,
                'name' => 'Laarbeek',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            159 => 
            array (
                'id' => 160,
                'city_id' => 160,
                'name' => 'Land van Cuijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            160 => 
            array (
                'id' => 161,
                'city_id' => 161,
                'name' => 'Loon op Zand',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            161 => 
            array (
                'id' => 162,
                'city_id' => 162,
                'name' => 'Maashorst',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            162 => 
            array (
                'id' => 163,
                'city_id' => 163,
                'name' => 'Meierijstad',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            163 => 
            array (
                'id' => 164,
                'city_id' => 164,
                'name' => 'Moerdijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            164 => 
            array (
                'id' => 165,
                'city_id' => 165,
                'name' => 'Nuenen, Gerwen en Nederwetten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            165 => 
            array (
                'id' => 166,
                'city_id' => 166,
                'name' => 'Oirschot',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            166 => 
            array (
                'id' => 167,
                'city_id' => 167,
                'name' => 'Oisterwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            167 => 
            array (
                'id' => 168,
                'city_id' => 168,
                'name' => 'Oosterhout',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            168 => 
            array (
                'id' => 169,
                'city_id' => 169,
                'name' => 'Oss',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            169 => 
            array (
                'id' => 170,
                'city_id' => 170,
                'name' => 'Reusel-De Mierden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            170 => 
            array (
                'id' => 171,
                'city_id' => 171,
                'name' => 'Roosendaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            171 => 
            array (
                'id' => 172,
                'city_id' => 172,
                'name' => 'Rucphen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            172 => 
            array (
                'id' => 173,
                'city_id' => 173,
                'name' => 'Sint-Michielsgestel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            173 => 
            array (
                'id' => 174,
                'city_id' => 174,
                'name' => 'Someren',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            174 => 
            array (
                'id' => 175,
                'city_id' => 175,
                'name' => 'Son en Breugel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            175 => 
            array (
                'id' => 176,
                'city_id' => 176,
                'name' => 'Steenbergen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            176 => 
            array (
                'id' => 177,
                'city_id' => 177,
                'name' => 'Tilburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            177 => 
            array (
                'id' => 178,
                'city_id' => 178,
                'name' => 'Valkenswaard',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            178 => 
            array (
                'id' => 179,
                'city_id' => 179,
                'name' => 'Veldhoven',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            179 => 
            array (
                'id' => 180,
                'city_id' => 180,
                'name' => 'Vught',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            180 => 
            array (
                'id' => 181,
                'city_id' => 181,
                'name' => 'Waalre',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            181 => 
            array (
                'id' => 182,
                'city_id' => 182,
                'name' => 'Waalwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            182 => 
            array (
                'id' => 183,
                'city_id' => 183,
                'name' => 'Woensdrecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            183 => 
            array (
                'id' => 184,
                'city_id' => 184,
                'name' => 'Zundert',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            184 => 
            array (
                'id' => 185,
                'city_id' => 185,
                'name' => 'Aalsmeer',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            185 => 
            array (
                'id' => 186,
                'city_id' => 186,
                'name' => 'Alkmaar',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            186 => 
            array (
                'id' => 187,
                'city_id' => 187,
                'name' => 'Amstelveen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            187 => 
            array (
                'id' => 188,
                'city_id' => 188,
                'name' => 'Amsterdam',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            188 => 
            array (
                'id' => 189,
                'city_id' => 189,
                'name' => 'Bergen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            189 => 
            array (
                'id' => 190,
                'city_id' => 190,
                'name' => 'Beverwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            190 => 
            array (
                'id' => 191,
                'city_id' => 191,
                'name' => 'Blaricum',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            191 => 
            array (
                'id' => 192,
                'city_id' => 192,
                'name' => 'Bloemendaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            192 => 
            array (
                'id' => 193,
                'city_id' => 193,
                'name' => 'Castricum',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            193 => 
            array (
                'id' => 194,
                'city_id' => 194,
                'name' => 'Diemen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            194 => 
            array (
                'id' => 195,
                'city_id' => 195,
                'name' => 'Dijk en Waard',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            195 => 
            array (
                'id' => 196,
                'city_id' => 196,
                'name' => 'Drechterland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            196 => 
            array (
                'id' => 197,
                'city_id' => 197,
                'name' => 'Edam-Volendam',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            197 => 
            array (
                'id' => 198,
                'city_id' => 198,
                'name' => 'Enkhuizen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            198 => 
            array (
                'id' => 199,
                'city_id' => 199,
                'name' => 'Gooise Meren',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            199 => 
            array (
                'id' => 200,
                'city_id' => 200,
                'name' => 'Haarlem',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            200 => 
            array (
                'id' => 201,
                'city_id' => 201,
                'name' => 'Haarlemmermeer',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            201 => 
            array (
                'id' => 202,
                'city_id' => 202,
                'name' => 'Heemskerk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            202 => 
            array (
                'id' => 203,
                'city_id' => 203,
                'name' => 'Heemstede',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            203 => 
            array (
                'id' => 204,
                'city_id' => 204,
                'name' => 'Heiloo',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            204 => 
            array (
                'id' => 205,
                'city_id' => 205,
                'name' => 'Den Helder',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            205 => 
            array (
                'id' => 206,
                'city_id' => 206,
                'name' => 'Hilversum',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            206 => 
            array (
                'id' => 207,
                'city_id' => 207,
                'name' => 'Hollands Kroon',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            207 => 
            array (
                'id' => 208,
                'city_id' => 208,
                'name' => 'Hoorn',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            208 => 
            array (
                'id' => 209,
                'city_id' => 209,
                'name' => 'Huizen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            209 => 
            array (
                'id' => 210,
                'city_id' => 210,
                'name' => 'Koggenland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            210 => 
            array (
                'id' => 211,
                'city_id' => 211,
                'name' => 'Landsmeer',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            211 => 
            array (
                'id' => 212,
                'city_id' => 212,
                'name' => 'Laren',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            212 => 
            array (
                'id' => 213,
                'city_id' => 213,
                'name' => 'Medemblik',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            213 => 
            array (
                'id' => 214,
                'city_id' => 214,
                'name' => 'Oostzaan',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            214 => 
            array (
                'id' => 215,
                'city_id' => 215,
                'name' => 'Opmeer',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            215 => 
            array (
                'id' => 216,
                'city_id' => 216,
                'name' => 'Ouder-Amstel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            216 => 
            array (
                'id' => 217,
                'city_id' => 217,
                'name' => 'Purmerend',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            217 => 
            array (
                'id' => 218,
                'city_id' => 218,
                'name' => 'Schagen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            218 => 
            array (
                'id' => 219,
                'city_id' => 219,
                'name' => 'Stede Broec',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            219 => 
            array (
                'id' => 220,
                'city_id' => 220,
                'name' => 'Texel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            220 => 
            array (
                'id' => 221,
                'city_id' => 221,
                'name' => 'Uitgeest',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            221 => 
            array (
                'id' => 222,
                'city_id' => 222,
                'name' => 'Uithoorn',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            222 => 
            array (
                'id' => 223,
                'city_id' => 223,
                'name' => 'Velsen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            223 => 
            array (
                'id' => 224,
                'city_id' => 224,
                'name' => 'Waterland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            224 => 
            array (
                'id' => 225,
                'city_id' => 225,
                'name' => 'Wijdemeren',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            225 => 
            array (
                'id' => 226,
                'city_id' => 226,
                'name' => 'Wormerland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            226 => 
            array (
                'id' => 227,
                'city_id' => 227,
                'name' => 'Zaanstad',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            227 => 
            array (
                'id' => 228,
                'city_id' => 228,
                'name' => 'Zandvoort',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            228 => 
            array (
                'id' => 229,
                'city_id' => 229,
                'name' => 'Almelo',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            229 => 
            array (
                'id' => 230,
                'city_id' => 230,
                'name' => 'Borne',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            230 => 
            array (
                'id' => 231,
                'city_id' => 231,
                'name' => 'Dalfsen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            231 => 
            array (
                'id' => 232,
                'city_id' => 232,
                'name' => 'Deventer',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            232 => 
            array (
                'id' => 233,
                'city_id' => 233,
                'name' => 'Dinkelland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            233 => 
            array (
                'id' => 234,
                'city_id' => 234,
                'name' => 'Enschede',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            234 => 
            array (
                'id' => 235,
                'city_id' => 235,
                'name' => 'Haaksbergen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            235 => 
            array (
                'id' => 236,
                'city_id' => 236,
                'name' => 'Hardenberg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            236 => 
            array (
                'id' => 237,
                'city_id' => 237,
                'name' => 'Hellendoorn',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            237 => 
            array (
                'id' => 238,
                'city_id' => 238,
                'name' => 'Hengelo',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            238 => 
            array (
                'id' => 239,
                'city_id' => 239,
                'name' => 'Hof van Twente',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            239 => 
            array (
                'id' => 240,
                'city_id' => 240,
                'name' => 'Kampen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            240 => 
            array (
                'id' => 241,
                'city_id' => 241,
                'name' => 'Losser',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            241 => 
            array (
                'id' => 242,
                'city_id' => 242,
                'name' => 'Oldenzaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            242 => 
            array (
                'id' => 243,
                'city_id' => 243,
                'name' => 'Olst-Wijhe',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            243 => 
            array (
                'id' => 244,
                'city_id' => 244,
                'name' => 'Ommen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            244 => 
            array (
                'id' => 245,
                'city_id' => 245,
                'name' => 'Raalte',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            245 => 
            array (
                'id' => 246,
                'city_id' => 246,
                'name' => 'Rijssen-Holten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            246 => 
            array (
                'id' => 247,
                'city_id' => 247,
                'name' => 'Staphorst',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            247 => 
            array (
                'id' => 248,
                'city_id' => 248,
                'name' => 'Steenwijkerland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            248 => 
            array (
                'id' => 249,
                'city_id' => 249,
                'name' => 'Tubbergen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            249 => 
            array (
                'id' => 250,
                'city_id' => 250,
                'name' => 'Twenterand',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            250 => 
            array (
                'id' => 251,
                'city_id' => 251,
                'name' => 'Wierden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            251 => 
            array (
                'id' => 252,
                'city_id' => 252,
                'name' => 'Zwartewaterland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            252 => 
            array (
                'id' => 253,
                'city_id' => 253,
                'name' => 'Zwolle',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            253 => 
            array (
                'id' => 254,
                'city_id' => 254,
                'name' => 'Amersfoort',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            254 => 
            array (
                'id' => 255,
                'city_id' => 255,
                'name' => 'Baarn',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            255 => 
            array (
                'id' => 256,
                'city_id' => 256,
                'name' => 'De Bilt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            256 => 
            array (
                'id' => 257,
                'city_id' => 257,
                'name' => 'Bunnik',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            257 => 
            array (
                'id' => 258,
                'city_id' => 258,
                'name' => 'Bunschoten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            258 => 
            array (
                'id' => 259,
                'city_id' => 259,
                'name' => 'Eemnes',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            259 => 
            array (
                'id' => 260,
                'city_id' => 260,
                'name' => 'Houten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            260 => 
            array (
                'id' => 261,
                'city_id' => 261,
                'name' => 'IJsselstein',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            261 => 
            array (
                'id' => 262,
                'city_id' => 262,
                'name' => 'Leusden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            262 => 
            array (
                'id' => 263,
                'city_id' => 263,
                'name' => 'Lopik',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            263 => 
            array (
                'id' => 264,
                'city_id' => 264,
                'name' => 'Montfoort',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            264 => 
            array (
                'id' => 265,
                'city_id' => 265,
                'name' => 'Nieuwegein',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            265 => 
            array (
                'id' => 266,
                'city_id' => 266,
                'name' => 'Oudewater',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            266 => 
            array (
                'id' => 267,
                'city_id' => 267,
                'name' => 'Renswoude',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            267 => 
            array (
                'id' => 268,
                'city_id' => 268,
                'name' => 'Rhenen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            268 => 
            array (
                'id' => 269,
                'city_id' => 269,
                'name' => 'De Ronde Venen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            269 => 
            array (
                'id' => 270,
                'city_id' => 270,
                'name' => 'Soest',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            270 => 
            array (
                'id' => 271,
                'city_id' => 271,
                'name' => 'Stichtse Vecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            271 => 
            array (
                'id' => 272,
                'city_id' => 272,
                'name' => 'Utrecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            272 => 
            array (
                'id' => 273,
                'city_id' => 273,
                'name' => 'Utrechtse Heuvelrug',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            273 => 
            array (
                'id' => 274,
                'city_id' => 274,
                'name' => 'Veenendaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            274 => 
            array (
                'id' => 275,
                'city_id' => 275,
                'name' => 'Vijfheerenlanden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            275 => 
            array (
                'id' => 276,
                'city_id' => 276,
                'name' => 'Wijk bij Duurstede',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            276 => 
            array (
                'id' => 277,
                'city_id' => 277,
                'name' => 'Woerden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            277 => 
            array (
                'id' => 278,
                'city_id' => 278,
                'name' => 'Woudenberg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            278 => 
            array (
                'id' => 279,
                'city_id' => 279,
                'name' => 'Zeist',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            279 => 
            array (
                'id' => 280,
                'city_id' => 280,
                'name' => 'Borsele',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            280 => 
            array (
                'id' => 281,
                'city_id' => 281,
                'name' => 'Goes',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            281 => 
            array (
                'id' => 282,
                'city_id' => 282,
                'name' => 'Hulst',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            282 => 
            array (
                'id' => 283,
                'city_id' => 283,
                'name' => 'Kapelle',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            283 => 
            array (
                'id' => 284,
                'city_id' => 284,
                'name' => 'Middelburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            284 => 
            array (
                'id' => 285,
                'city_id' => 285,
                'name' => 'Noord-Beveland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            285 => 
            array (
                'id' => 286,
                'city_id' => 286,
                'name' => 'Reimerswaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            286 => 
            array (
                'id' => 287,
                'city_id' => 287,
                'name' => 'Schouwen-Duiveland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            287 => 
            array (
                'id' => 288,
                'city_id' => 288,
                'name' => 'Sluis',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            288 => 
            array (
                'id' => 289,
                'city_id' => 289,
                'name' => 'Terneuzen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            289 => 
            array (
                'id' => 290,
                'city_id' => 290,
                'name' => 'Tholen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            290 => 
            array (
                'id' => 291,
                'city_id' => 291,
                'name' => 'Veere',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            291 => 
            array (
                'id' => 292,
                'city_id' => 292,
                'name' => 'Vlissingen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            292 => 
            array (
                'id' => 293,
                'city_id' => 293,
                'name' => 'Alblasserdam',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            293 => 
            array (
                'id' => 294,
                'city_id' => 294,
                'name' => 'Albrandswaard',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            294 => 
            array (
                'id' => 295,
                'city_id' => 295,
                'name' => 'Alphen aan den Rijn',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            295 => 
            array (
                'id' => 296,
                'city_id' => 296,
                'name' => 'Barendrecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            296 => 
            array (
                'id' => 297,
                'city_id' => 297,
                'name' => 'Bodegraven-Reeuwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            297 => 
            array (
                'id' => 298,
                'city_id' => 298,
                'name' => 'Brielle',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            298 => 
            array (
                'id' => 299,
                'city_id' => 299,
                'name' => 'Capelle aan den IJssel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            299 => 
            array (
                'id' => 300,
                'city_id' => 300,
                'name' => 'Delft',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            300 => 
            array (
                'id' => 301,
                'city_id' => 301,
                'name' => 'Dordrecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            301 => 
            array (
                'id' => 302,
                'city_id' => 302,
                'name' => 'Goeree-Overflakkee',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            302 => 
            array (
                'id' => 303,
                'city_id' => 303,
                'name' => 'Gorinchem',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            303 => 
            array (
                'id' => 304,
                'city_id' => 304,
                'name' => 'Gouda',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            304 => 
            array (
                'id' => 305,
                'city_id' => 305,
                'name' => 'The Hague',
                'alias' => NULL,
                'locale' => 'en',
            ),
            305 => 
            array (
                'id' => 306,
                'city_id' => 305,
                'name' => 'Den Haag',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            306 => 
            array (
                'id' => 307,
                'city_id' => 305,
                'name' => 'La Haye',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            307 => 
            array (
                'id' => 308,
                'city_id' => 306,
                'name' => 'Hardinxveld-Giessendam',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            308 => 
            array (
                'id' => 309,
                'city_id' => 307,
                'name' => 'Hellevoetsluis',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            309 => 
            array (
                'id' => 310,
                'city_id' => 308,
                'name' => 'Hendrik-Ido-Ambacht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            310 => 
            array (
                'id' => 311,
                'city_id' => 309,
                'name' => 'Hillegom',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            311 => 
            array (
                'id' => 312,
                'city_id' => 310,
                'name' => 'Hoeksche Waard',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            312 => 
            array (
                'id' => 313,
                'city_id' => 311,
                'name' => 'Kaag en Braassem',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            313 => 
            array (
                'id' => 314,
                'city_id' => 312,
                'name' => 'Katwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            314 => 
            array (
                'id' => 315,
                'city_id' => 313,
                'name' => 'Krimpen aan den IJssel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            315 => 
            array (
                'id' => 316,
                'city_id' => 314,
                'name' => 'Krimpenerwaard',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            316 => 
            array (
                'id' => 317,
                'city_id' => 315,
                'name' => 'Lansingerland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            317 => 
            array (
                'id' => 318,
                'city_id' => 316,
                'name' => 'Leiden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            318 => 
            array (
                'id' => 319,
                'city_id' => 317,
                'name' => 'Leiderdorp',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            319 => 
            array (
                'id' => 320,
                'city_id' => 318,
                'name' => 'Leidschendam-Voorburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            320 => 
            array (
                'id' => 321,
                'city_id' => 319,
                'name' => 'Lisse',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            321 => 
            array (
                'id' => 322,
                'city_id' => 320,
                'name' => 'Maassluis',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            322 => 
            array (
                'id' => 323,
                'city_id' => 321,
                'name' => 'Midden-Delfland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            323 => 
            array (
                'id' => 324,
                'city_id' => 322,
                'name' => 'Molenlanden',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            324 => 
            array (
                'id' => 325,
                'city_id' => 323,
                'name' => 'Nieuwkoop',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            325 => 
            array (
                'id' => 326,
                'city_id' => 324,
                'name' => 'Nissewaard',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            326 => 
            array (
                'id' => 327,
                'city_id' => 325,
                'name' => 'Noordwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            327 => 
            array (
                'id' => 328,
                'city_id' => 326,
                'name' => 'Oegstgeest',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            328 => 
            array (
                'id' => 329,
                'city_id' => 327,
                'name' => 'Papendrecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            329 => 
            array (
                'id' => 330,
                'city_id' => 328,
                'name' => 'Pijnacker-Nootdorp',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            330 => 
            array (
                'id' => 331,
                'city_id' => 329,
                'name' => 'Ridderkerk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            331 => 
            array (
                'id' => 332,
                'city_id' => 330,
                'name' => 'Rijswijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            332 => 
            array (
                'id' => 333,
                'city_id' => 331,
                'name' => 'Rotterdam',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            333 => 
            array (
                'id' => 334,
                'city_id' => 332,
                'name' => 'Schiedam',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            334 => 
            array (
                'id' => 335,
                'city_id' => 333,
                'name' => 'Sliedrecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            335 => 
            array (
                'id' => 336,
                'city_id' => 334,
                'name' => 'Teylingen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            336 => 
            array (
                'id' => 337,
                'city_id' => 335,
                'name' => 'Vlaardingen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            337 => 
            array (
                'id' => 338,
                'city_id' => 336,
                'name' => 'Voorschoten',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            338 => 
            array (
                'id' => 339,
                'city_id' => 337,
                'name' => 'Waddinxveen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            339 => 
            array (
                'id' => 340,
                'city_id' => 338,
                'name' => 'Wassenaar',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            340 => 
            array (
                'id' => 341,
                'city_id' => 339,
                'name' => 'Westland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            341 => 
            array (
                'id' => 342,
                'city_id' => 340,
                'name' => 'Westvoorne',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            342 => 
            array (
                'id' => 343,
                'city_id' => 341,
                'name' => 'Zoetermeer',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            343 => 
            array (
                'id' => 344,
                'city_id' => 342,
                'name' => 'Zoeterwoude',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            344 => 
            array (
                'id' => 345,
                'city_id' => 343,
                'name' => 'Zuidplas',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            345 => 
            array (
                'id' => 346,
                'city_id' => 344,
                'name' => 'Zwijndrecht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            346 => 
            array (
                'id' => 347,
                'city_id' => 345,
                'name' => 'Brussel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            347 => 
            array (
                'id' => 348,
                'city_id' => 345,
                'name' => 'Bruxelles',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            348 => 
            array (
                'id' => 349,
                'city_id' => 345,
                'name' => 'Brussels',
                'alias' => NULL,
                'locale' => 'en',
            ),
            349 => 
            array (
                'id' => 350,
                'city_id' => 346,
                'name' => 'Antwerpen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            350 => 
            array (
                'id' => 351,
                'city_id' => 346,
                'name' => 'Anvers',
                'alias' => NULL,
                'locale' => 'fr',
            ),
            351 => 
            array (
                'id' => 352,
                'city_id' => 346,
                'name' => 'Antwerp',
                'alias' => NULL,
                'locale' => 'en',
            ),
        ));
        
        
    }
}