<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryTranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('category_translations')->delete();
        
        \DB::table('category_translations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_id' => 1,
                'locale' => 'en',
                'slug' => 'public-front-page',
                'name' => 'Public Front Page',
                'created_at' => '2023-06-05 15:29:41',
                'updated_at' => '2023-06-05 15:29:41',
            ),
            1 => 
            array (
                'id' => 2,
                'category_id' => 1,
                'locale' => 'nl',
                'slug' => 'publieke-home-pagina',
                'name' => 'Publieke home-pagina',
                'created_at' => '2023-06-05 15:34:47',
                'updated_at' => '2023-06-05 15:34:47',
            ),
            2 => 
            array (
                'id' => 3,
                'category_id' => 2,
                'locale' => 'en',
                'slug' => 'the-hague-news',
                'name' => 'The Hague news',
                'created_at' => '2023-06-05 15:29:41',
                'updated_at' => '2023-06-05 15:29:41',
            ),
            3 => 
            array (
                'id' => 4,
                'category_id' => 2,
                'locale' => 'nl',
                'slug' => 'den-haag-nieuws',
                'name' => 'Den Haag nieuws',
                'created_at' => '2023-06-05 15:32:44',
                'updated_at' => '2023-06-05 15:32:44',
            ),
            4 => 
            array (
                'id' => 5,
                'category_id' => 3,
                'locale' => 'en',
                'slug' => 'system-announcement',
                'name' => 'System announcement',
                'created_at' => '2023-06-05 15:32:44',
                'updated_at' => '2023-06-05 15:32:44',
            ),
            5 => 
            array (
                'id' => 6,
                'category_id' => 3,
                'locale' => 'nl',
                'slug' => 'systeem-melding',
                'name' => 'Systeem melding',
                'created_at' => '2023-06-05 15:35:50',
                'updated_at' => '2023-06-05 15:35:50',
            ),
            6 => 
            array (
                'id' => 7,
                'category_id' => 2,
                'locale' => 'es',
                'slug' => 'noticias-de-la-haya',
                'name' => 'La Haya Noticias',
                'created_at' => '2023-06-30 11:08:16',
                'updated_at' => '2023-06-30 11:08:16',
            ),
            7 => 
            array (
                'id' => 8,
                'category_id' => 4,
                'locale' => 'en',
                'slug' => 'the-hague-events',
                'name' => 'The Hague events',
                'created_at' => '2023-07-04 09:02:46',
                'updated_at' => '2023-07-04 09:02:46',
            ),
            8 => 
            array (
                'id' => 11,
                'category_id' => 4,
                'locale' => 'nl',
                'slug' => 'den-haag-evenementen',
                'name' => 'Den Haag evenementen',
                'created_at' => '2023-07-25 12:45:20',
                'updated_at' => '2023-07-25 12:45:26',
            ),
        ));
        
        
    }
}