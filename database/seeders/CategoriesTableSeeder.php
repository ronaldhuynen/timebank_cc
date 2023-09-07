<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'App\\Models\\FrontPage',
                'categoryable_id' => 12,
                'categoryable_type' => 'App\\Models\\Locations\\Division',
                'parent_id' => NULL,
                'created_at' => '2023-06-02 16:15:10',
                'updated_at' => '2023-06-02 16:15:10',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'App\\Models\\News',
                'categoryable_id' => 305,
                'categoryable_type' => 'App\\Models\\Locations\\City',
                'parent_id' => NULL,
                'created_at' => '2023-06-02 16:15:10',
                'updated_at' => '2023-06-02 16:15:10',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'type' => 'App\\Models\\SystemAnnouncement',
                'categoryable_id' => 3,
                'categoryable_type' => 'App\\Models\\Post',
                'parent_id' => NULL,
                'created_at' => '2023-06-02 16:20:59',
                'updated_at' => '2023-06-02 16:20:59',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'type' => 'App\\Models\\Meeting',
                'categoryable_id' => 305,
                'categoryable_type' => 'App\\Models\\Locations\\City',
                'parent_id' => NULL,
                'created_at' => '2023-07-04 09:00:02',
                'updated_at' => '2023-07-04 09:00:02',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'type' => 'App\\Models\\Meeting',
                'categoryable_id' => 13,
                'categoryable_type' => 'App\\Models\\Locations\\Division',
                'parent_id' => NULL,
                'created_at' => '2023-08-04 14:00:54',
                'updated_at' => '2023-08-04 14:00:54',
                'deleted_at' => '2023-08-04 14:00:54',
            ),
            5 => 
            array (
                'id' => 6,
                'type' => 'App\\Models\\Meeting',
                'categoryable_id' => 3,
                'categoryable_type' => 'App\\Models\\Locations\\Country',
                'parent_id' => NULL,
                'created_at' => '2023-08-04 14:38:11',
                'updated_at' => '2023-08-04 14:38:11',
                'deleted_at' => '2023-08-04 14:38:11',
            ),
            6 => 
            array (
                'id' => 7,
                'type' => 'App\\Models\\News',
                'categoryable_id' => 13,
                'categoryable_type' => 'App\\Models\\Locations\\Division',
                'parent_id' => NULL,
                'created_at' => '2023-08-04 16:18:51',
                'updated_at' => '2023-08-04 16:18:51',
                'deleted_at' => '2023-08-04 16:18:51',
            ),
            7 => 
            array (
                'id' => 8,
                'type' => 'App\\Models\\News',
                'categoryable_id' => 3,
                'categoryable_type' => 'App\\Models\\Locations\\Country',
                'parent_id' => NULL,
                'created_at' => '2023-08-04 16:18:51',
                'updated_at' => '2023-08-04 16:18:51',
                'deleted_at' => '2023-08-04 16:18:51',
            ),
            8 => 
            array (
                'id' => 9,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => NULL,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 9,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 9,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 9,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 10,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 10,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 10,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 10,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 10,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 10,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 11,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 11,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 11,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 11,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 12,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 12,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 12,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 12,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 13,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 13,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 13,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 13,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 13,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 13,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 14,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 14,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 14,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 15,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 15,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 15,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 15,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 15,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 15,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 15,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 16,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 16,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 16,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 16,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 16,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 17,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 17,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 19,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 19,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 19,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 20,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 20,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 20,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 20,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 20,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 21,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 21,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 22,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 22,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 22,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 22,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 23,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 23,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 23,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 23,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 24,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 24,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => NULL,
                'categoryable_type' => NULL,
                'parent_id' => 24,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}