<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_translations')->delete();
        
        \DB::table('post_translations')->insert(array (
            0 => 
            array (
                'id' => 15,
                'post_id' => 13,
                'locale' => 'en',
                'slug' => 'empty-event',
                'title' => 'Empty event',
                'excerpt' => '',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-07-29 21:44:00',
                'stop' => NULL,
                'created_at' => '2023-07-29 21:44:43',
                'updated_at' => '2023-07-29 22:30:58',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 16,
                'post_id' => 13,
                'locale' => 'nl',
                'slug' => 'leeg-evenement',
                'title' => 'Leeg evenement',
                'excerpt' => '',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-07-29 21:45:00',
                'stop' => NULL,
                'created_at' => '2023-07-29 21:45:06',
                'updated_at' => '2023-07-30 10:12:39',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 17,
                'post_id' => 14,
                'locale' => 'en',
                'slug' => 'empty-event-2',
                'title' => 'Empty event 2',
                'excerpt' => '',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-07-26 21:49:00',
                'stop' => NULL,
                'created_at' => '2023-07-29 21:49:40',
                'updated_at' => '2023-07-29 22:28:58',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 18,
                'post_id' => 14,
                'locale' => 'nl',
                'slug' => 'leeg-evenement-2',
                'title' => 'Leeg evenement 2',
                'excerpt' => '',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-07-26 21:49:00',
                'stop' => NULL,
                'created_at' => '2023-07-29 22:29:28',
                'updated_at' => '2023-07-30 10:11:40',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 19,
                'post_id' => 15,
                'locale' => 'nl',
                'slug' => 'third-event',
                'title' => 'Third event',
                'excerpt' => '',
                'content' => NULL,
                'status' => 1,
                'start' => NULL,
                'stop' => NULL,
                'created_at' => '2023-07-29 22:30:08',
                'updated_at' => '2023-07-29 22:30:08',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 20,
                'post_id' => 16,
                'locale' => 'en',
                'slug' => 'oud-nieuws',
                'title' => 'Oud nieuws',
                'excerpt' => '',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-07-01 23:00:00',
                'stop' => NULL,
                'created_at' => '2023-07-29 23:00:21',
                'updated_at' => '2023-07-30 12:44:49',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 21,
                'post_id' => 17,
                'locale' => 'en',
                'slug' => 'vers-nieuws',
                'title' => 'Vers nieuws',
                'excerpt' => '',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-07-29 23:00:00',
                'stop' => NULL,
                'created_at' => '2023-07-29 23:00:53',
                'updated_at' => '2023-07-30 12:45:18',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 22,
                'post_id' => 18,
                'locale' => 'en',
                'slug' => 'antwerp-division-event-coming-up',
                'title' => 'Antwerp division event coming up!',
                'excerpt' => 'cxnvx,nxv,mvdzm',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-08-04 14:09:00',
                'stop' => NULL,
                'created_at' => '2023-08-04 14:09:47',
                'updated_at' => '2023-08-04 14:09:47',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 23,
                'post_id' => 19,
                'locale' => 'en',
                'slug' => 'germany-national-event',
                'title' => 'Germany national event',
                'excerpt' => 'zcfgjh',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-08-04 14:42:00',
                'stop' => NULL,
                'created_at' => '2023-08-04 14:42:31',
                'updated_at' => '2023-08-04 14:42:31',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 24,
                'post_id' => 20,
                'locale' => 'en',
                'slug' => 'antwerp-division-news',
                'title' => 'Antwerp division News',
                'excerpt' => 'dsjhjfds',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-08-04 16:23:00',
                'stop' => NULL,
                'created_at' => '2023-08-04 16:23:26',
                'updated_at' => '2023-08-04 16:23:56',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 25,
                'post_id' => 21,
                'locale' => 'en',
                'slug' => 'gemany-national-news',
                'title' => 'Gemany National News',
                'excerpt' => '',
                'content' => NULL,
                'status' => 1,
                'start' => '2023-08-04 16:24:00',
                'stop' => NULL,
                'created_at' => '2023-08-04 16:24:25',
                'updated_at' => '2023-08-04 16:24:25',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}