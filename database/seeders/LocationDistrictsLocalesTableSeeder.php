<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationDistrictsLocalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('location_districts_locales')->delete();
        
        \DB::table('location_districts_locales')->insert(array (
            0 => 
            array (
                'id' => 1,
                'district_id' => 1,
                'name' => 'Archipelbuurt en Willemspark',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            1 => 
            array (
                'id' => 2,
                'district_id' => 2,
                'name' => 'Centrum',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            2 => 
            array (
                'id' => 3,
                'district_id' => 3,
                'name' => 'Stationsbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            3 => 
            array (
                'id' => 4,
                'district_id' => 4,
                'name' => 'Zeeheldenkwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            4 => 
            array (
                'id' => 5,
                'district_id' => 5,
                'name' => 'Schilderswijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            5 => 
            array (
                'id' => 6,
                'district_id' => 6,
                'name' => 'Transvaal en Groente- en Fruitmarkt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            6 => 
            array (
                'id' => 7,
                'district_id' => 7,
                'name' => 'Bouwlust en Vrederust',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            7 => 
            array (
                'id' => 8,
                'district_id' => 8,
                'name' => 'Leyenburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            8 => 
            array (
                'id' => 9,
                'district_id' => 9,
                'name' => 'Moerwijk en Zuiderpark',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            9 => 
            array (
                'id' => 10,
                'district_id' => 10,
                'name' => 'Morgenstond',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            10 => 
            array (
                'id' => 11,
                'district_id' => 11,
                'name' => 'Rustenburg en Oostbroek',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            11 => 
            array (
                'id' => 12,
                'district_id' => 12,
                'name' => 'Wateringse Veld',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            12 => 
            array (
                'id' => 13,
                'district_id' => 13,
                'name' => 'Leidschenveen en Forepark',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            13 => 
            array (
                'id' => 14,
                'district_id' => 14,
                'name' => 'Ypenburg en Hoornwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            14 => 
            array (
                'id' => 15,
                'district_id' => 15,
                'name' => 'Laakkwartier, Spoorwijk en Binckhorst',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            15 => 
            array (
                'id' => 16,
                'district_id' => 16,
                'name' => 'Loosduinen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            16 => 
            array (
                'id' => 17,
                'district_id' => 17,
                'name' => 'Kraayenstein',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            17 => 
            array (
                'id' => 18,
                'district_id' => 18,
                'name' => 'Kijkduin en Ockenburgh',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            18 => 
            array (
                'id' => 19,
                'district_id' => 19,
                'name' => 'Bohemen en Meer en Bos',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            19 => 
            array (
                'id' => 20,
                'district_id' => 20,
                'name' => 'Waldeck',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            20 => 
            array (
                'id' => 21,
                'district_id' => 21,
                'name' => 'Benoordenhout',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            21 => 
            array (
                'id' => 22,
                'district_id' => 22,
                'name' => 'Mariahoeve en Haagse Bos',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            22 => 
            array (
                'id' => 23,
                'district_id' => 23,
                'name' => 'Marlot',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            23 => 
            array (
                'id' => 24,
                'district_id' => 24,
                'name' => 'Bezuidenhout',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            24 => 
            array (
                'id' => 25,
                'district_id' => 25,
                'name' => 'Duttendel, Belgisch- en Van Stolkpark',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            25 => 
            array (
                'id' => 26,
                'district_id' => 26,
                'name' => 'Duindorp',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            26 => 
            array (
                'id' => 27,
                'district_id' => 27,
                'name' => 'Duinoord en Zorgvliet',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            27 => 
            array (
                'id' => 28,
                'district_id' => 28,
                'name' => 'Geuzen- en Statenkwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            28 => 
            array (
                'id' => 29,
                'district_id' => 29,
                'name' => 'Scheveningen Bad, Dorp en Haven',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            29 => 
            array (
                'id' => 30,
                'district_id' => 30,
                'name' => 'Norfolk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            30 => 
            array (
                'id' => 31,
                'district_id' => 31,
                'name' => 'Zorgvliet',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            31 => 
            array (
                'id' => 32,
                'district_id' => 32,
                'name' => 'Bomenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            32 => 
            array (
                'id' => 33,
                'district_id' => 33,
                'name' => 'Bomen- en Bloemenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            33 => 
            array (
                'id' => 34,
                'district_id' => 34,
                'name' => 'Regentessekwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            34 => 
            array (
                'id' => 35,
                'district_id' => 35,
                'name' => 'Valkenboskwartier en Heesterbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            35 => 
            array (
                'id' => 36,
                'district_id' => 36,
                'name' => 'Vogelwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            36 => 
            array (
                'id' => 37,
                'district_id' => 37,
                'name' => 'Vruchtenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            37 => 
            array (
                'id' => 38,
                'district_id' => 38,
                'name' => 'Cromvliet',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            38 => 
            array (
                'id' => 39,
                'district_id' => 39,
                'name' => 'Leeuwendaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            39 => 
            array (
                'id' => 40,
                'district_id' => 40,
                'name' => 'Oud-Rijswijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            40 => 
            array (
                'id' => 41,
                'district_id' => 41,
                'name' => 'Bomenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            41 => 
            array (
                'id' => 42,
                'district_id' => 42,
                'name' => 'Welgelegen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            42 => 
            array (
                'id' => 43,
                'district_id' => 43,
                'name' => 'Rembrandtkwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            43 => 
            array (
                'id' => 44,
                'district_id' => 44,
                'name' => 'Havenkwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            44 => 
            array (
                'id' => 45,
                'district_id' => 45,
                'name' => 'Julianapark',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            45 => 
            array (
                'id' => 46,
                'district_id' => 46,
                'name' => 'Huis te Lande',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            46 => 
            array (
                'id' => 47,
                'district_id' => 47,
                'name' => 'Stationskwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            47 => 
            array (
                'id' => 48,
                'district_id' => 48,
                'name' => 'Te Werve',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            48 => 
            array (
                'id' => 49,
                'district_id' => 49,
                'name' => 'Spoorzicht',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            49 => 
            array (
                'id' => 50,
                'district_id' => 50,
                'name' => 'Kleurenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            50 => 
            array (
                'id' => 51,
                'district_id' => 51,
                'name' => 'Artiestenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            51 => 
            array (
                'id' => 52,
                'district_id' => 52,
                'name' => 'Overvoorde',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            52 => 
            array (
                'id' => 53,
                'district_id' => 53,
                'name' => 'Strijp',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            53 => 
            array (
                'id' => 54,
                'district_id' => 54,
                'name' => 'Presidentenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            54 => 
            array (
                'id' => 55,
                'district_id' => 55,
                'name' => 'Ministerbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            55 => 
            array (
                'id' => 56,
                'district_id' => 56,
                'name' => 'Stervoorde',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            56 => 
            array (
                'id' => 57,
                'district_id' => 57,
                'name' => 'Eikelenburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            57 => 
            array (
                'id' => 58,
                'district_id' => 58,
                'name' => 'Hoekpolder',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            58 => 
            array (
                'id' => 59,
                'district_id' => 59,
                'name' => 'Sion',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            59 => 
            array (
                'id' => 60,
                'district_id' => 60,
                'name' => 'Muziekbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            60 => 
            array (
                'id' => 61,
                'district_id' => 61,
                'name' => 'Wilhelminapark',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            61 => 
            array (
                'id' => 62,
                'district_id' => 62,
                'name' => 'Plaspoelpolder',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            62 => 
            array (
                'id' => 63,
                'district_id' => 63,
                'name' => 'Elsenburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            63 => 
            array (
                'id' => 64,
                'district_id' => 64,
                'name' => 'Pasgeld',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            64 => 
            array (
                'id' => 65,
                'district_id' => 65,
                'name' => 'Haantje',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            65 => 
            array (
                'id' => 66,
                'district_id' => 66,
                'name' => 'Hoornwijck',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            66 => 
            array (
                'id' => 67,
                'district_id' => 67,
                'name' => 'Broekpolder',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            67 => 
            array (
                'id' => 68,
                'district_id' => 68,
                'name' => 'Kraayenburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            68 => 
            array (
                'id' => 69,
                'district_id' => 69,
                'name' => 'Vrijenban',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            69 => 
            array (
                'id' => 70,
                'district_id' => 70,
                'name' => 'Drie Papegaaien',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            70 => 
            array (
                'id' => 71,
                'district_id' => 71,
                'name' => 'Oud-Wassenaar',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            71 => 
            array (
                'id' => 72,
                'district_id' => 72,
                'name' => 'Nieuw-Wassenaar',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            72 => 
            array (
                'id' => 73,
                'district_id' => 73,
                'name' => 'Duindigt met Groenendaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            73 => 
            array (
                'id' => 74,
                'district_id' => 74,
                'name' => 'Oud-Clingendaal',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            74 => 
            array (
                'id' => 75,
                'district_id' => 75,
                'name' => 'De Kieviet',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            75 => 
            array (
                'id' => 76,
                'district_id' => 76,
                'name' => 'Kerkehout',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            76 => 
            array (
                'id' => 77,
                'district_id' => 77,
                'name' => 'Klingenbosch',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            77 => 
            array (
                'id' => 78,
                'district_id' => 78,
                'name' => 'Verspreide huizen Eikenhorst',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            78 => 
            array (
                'id' => 79,
                'district_id' => 79,
                'name' => 'Verspreide huizen Meijendel',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            79 => 
            array (
                'id' => 80,
                'district_id' => 80,
                'name' => 'De Paauw',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            80 => 
            array (
                'id' => 81,
                'district_id' => 81,
                'name' => 'Dorp Wassenaar',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            81 => 
            array (
                'id' => 82,
                'district_id' => 82,
                'name' => 'Oostdorp',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            82 => 
            array (
                'id' => 83,
                'district_id' => 83,
                'name' => 'Zijlwatering en haven',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            83 => 
            array (
                'id' => 84,
                'district_id' => 84,
                'name' => 'De Deijl',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            84 => 
            array (
                'id' => 85,
                'district_id' => 85,
                'name' => 'Groot Deijleroord en Ter Weer',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            85 => 
            array (
                'id' => 86,
                'district_id' => 86,
                'name' => 'Rijksdorp met De Pan',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            86 => 
            array (
                'id' => 87,
                'district_id' => 87,
                'name' => 'Maaldrift',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            87 => 
            array (
                'id' => 88,
                'district_id' => 88,
                'name' => 'Verspreide huizen Raaphorst en in poldergebied',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            88 => 
            array (
                'id' => 89,
                'district_id' => 89,
                'name' => 'Verspreide huizen Duinrell Wassenaarse Slag',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            89 => 
            array (
                'id' => 90,
                'district_id' => 90,
                'name' => 'Weteringpark',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            90 => 
            array (
                'id' => 91,
                'district_id' => 91,
                'name' => 'Pieterswijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            91 => 
            array (
                'id' => 92,
                'district_id' => 92,
                'name' => 'Academiewijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            92 => 
            array (
                'id' => 93,
                'district_id' => 93,
                'name' => 'Levendaal-West',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            93 => 
            array (
                'id' => 94,
                'district_id' => 94,
                'name' => 'Levendaal-Oost',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            94 => 
            array (
                'id' => 95,
                'district_id' => 95,
                'name' => 'De Camp',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            95 => 
            array (
                'id' => 96,
                'district_id' => 96,
                'name' => 'Marewijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            96 => 
            array (
                'id' => 97,
                'district_id' => 97,
                'name' => 'Pancras-West',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            97 => 
            array (
                'id' => 98,
                'district_id' => 98,
                'name' => 'Pancras-Oost',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            98 => 
            array (
                'id' => 99,
                'district_id' => 99,
                'name' => 'D\'Oude Morsch',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            99 => 
            array (
                'id' => 100,
                'district_id' => 100,
                'name' => 'Noordvest',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            100 => 
            array (
                'id' => 101,
                'district_id' => 101,
                'name' => 'Havenwijk-Noord',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            101 => 
            array (
                'id' => 102,
                'district_id' => 102,
                'name' => 'Havenwijk-Zuid',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            102 => 
            array (
                'id' => 103,
                'district_id' => 103,
                'name' => 'Molenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            103 => 
            array (
                'id' => 104,
                'district_id' => 104,
                'name' => 'De Waard',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            104 => 
            array (
                'id' => 105,
                'district_id' => 105,
                'name' => 'Stationskwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            105 => 
            array (
                'id' => 106,
                'district_id' => 106,
                'name' => 'Groenoord',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            106 => 
            array (
                'id' => 107,
                'district_id' => 107,
                'name' => 'Noorderkwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            107 => 
            array (
                'id' => 108,
                'district_id' => 108,
                'name' => 'De Kooi',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            108 => 
            array (
                'id' => 109,
                'district_id' => 109,
                'name' => 'Meerburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            109 => 
            array (
                'id' => 110,
                'district_id' => 110,
                'name' => 'Rijndijkbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            110 => 
            array (
                'id' => 111,
                'district_id' => 111,
                'name' => 'Professorenwijk-Oost',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            111 => 
            array (
                'id' => 112,
                'district_id' => 112,
                'name' => 'Burgemeesterswijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            112 => 
            array (
                'id' => 113,
                'district_id' => 113,
                'name' => 'Professorenwijk-West',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            113 => 
            array (
                'id' => 114,
                'district_id' => 114,
                'name' => 'Tuinstadwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            114 => 
            array (
                'id' => 115,
                'district_id' => 115,
                'name' => 'Cronestein',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            115 => 
            array (
                'id' => 116,
                'district_id' => 116,
                'name' => 'Klein Cronestein',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            116 => 
            array (
                'id' => 117,
                'district_id' => 117,
                'name' => 'Roomburg',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            117 => 
            array (
                'id' => 118,
                'district_id' => 118,
                'name' => 'Waardeiland',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            118 => 
            array (
                'id' => 119,
                'district_id' => 119,
                'name' => 'Vreewijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            119 => 
            array (
                'id' => 120,
                'district_id' => 120,
                'name' => 'Haagweg-Noord',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            120 => 
            array (
                'id' => 121,
                'district_id' => 121,
                'name' => 'Gasthuiswijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            121 => 
            array (
                'id' => 122,
                'district_id' => 122,
                'name' => 'Fortuinwijk-Noord',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            122 => 
            array (
                'id' => 123,
                'district_id' => 123,
                'name' => 'Boshuizen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            123 => 
            array (
                'id' => 124,
                'district_id' => 124,
                'name' => 'Oostvliet',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            124 => 
            array (
                'id' => 125,
                'district_id' => 125,
                'name' => 'Haagweg-Zuid',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            125 => 
            array (
                'id' => 126,
                'district_id' => 126,
                'name' => 'Fortuinwijk-Zuid',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            126 => 
            array (
                'id' => 127,
                'district_id' => 127,
                'name' => 'Transvaalbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            127 => 
            array (
                'id' => 128,
                'district_id' => 128,
                'name' => 'Lage Mors',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            128 => 
            array (
                'id' => 129,
                'district_id' => 129,
                'name' => 'Hoge Mors',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            129 => 
            array (
                'id' => 130,
                'district_id' => 130,
                'name' => 'Pesthuiswijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            130 => 
            array (
                'id' => 131,
                'district_id' => 131,
                'name' => 'Houtkwartier',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            131 => 
            array (
                'id' => 132,
                'district_id' => 132,
                'name' => 'Raadsherenbuurt',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            132 => 
            array (
                'id' => 133,
                'district_id' => 133,
                'name' => 'Vogelwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            133 => 
            array (
                'id' => 134,
                'district_id' => 134,
                'name' => 'Leeuwenhoek',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            134 => 
            array (
                'id' => 135,
                'district_id' => 135,
                'name' => 'Slaaghwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            135 => 
            array (
                'id' => 136,
                'district_id' => 136,
                'name' => 'Zijlwijk-Zuid',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            136 => 
            array (
                'id' => 137,
                'district_id' => 137,
                'name' => 'Zijlwijk-Noord',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            137 => 
            array (
                'id' => 138,
                'district_id' => 138,
                'name' => 'Merenwijk-Centrum',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            138 => 
            array (
                'id' => 139,
                'district_id' => 139,
                'name' => 'Leedewijk-Zuid',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            139 => 
            array (
                'id' => 140,
                'district_id' => 140,
                'name' => 'Leedewijk-Noord',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            140 => 
            array (
                'id' => 141,
                'district_id' => 141,
                'name' => 'Schenkwijk',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            141 => 
            array (
                'id' => 142,
                'district_id' => 142,
                'name' => 'Kloosterhof',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            142 => 
            array (
                'id' => 143,
                'district_id' => 143,
                'name' => 'Dobbewijk-Noord',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            143 => 
            array (
                'id' => 144,
                'district_id' => 144,
                'name' => 'Dobbewijk-Zuid',
                'alias' => NULL,
                'locale' => 'nl',
            ),
        ));
        
        
    }
}