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

        \DB::table('categories')->insert(array(
            0 =>
            array(
                'id' => 1,
                'type' => 'App\\Models\\FrontPage',
                'categoryable_id' => 12,
                'categoryable_type' => 'App\\Models\\Locations\\Division',
                'parent_id' => null,
                'color' => null,
                'created_at' => '2023-06-02 16:15:10',
                'updated_at' => '2023-06-02 16:15:10',
                'deleted_at' => null,
            ),
            1 =>
            array(
                'id' => 2,
                'type' => 'App\\Models\\News',
                'categoryable_id' => 305,
                'categoryable_type' => 'App\\Models\\Locations\\City',
                'parent_id' => null,
                'color' => null,
                'created_at' => '2023-06-02 16:15:10',
                'updated_at' => '2023-06-02 16:15:10',
                'deleted_at' => null,
            ),
            2 =>
            array(
                'id' => 3,
                'type' => 'App\\Models\\SystemAnnouncement',
                'categoryable_id' => 3,
                'categoryable_type' => 'App\\Models\\Post',
                'parent_id' => null,
                'color' => null,
                'created_at' => '2023-06-02 16:20:59',
                'updated_at' => '2023-06-02 16:20:59',
                'deleted_at' => null,
            ),
            3 =>
            array(
                'id' => 4,
                'type' => 'App\\Models\\Meeting',
                'categoryable_id' => 305,
                'categoryable_type' => 'App\\Models\\Locations\\City',
                'parent_id' => null,
                'color' => null,
                'created_at' => '2023-07-04 09:00:02',
                'updated_at' => '2023-07-04 09:00:02',
                'deleted_at' => null,
            ),
            4 =>
            array(
                'id' => 5,
                'type' => 'App\\Models\\Meeting',
                'categoryable_id' => 13,
                'categoryable_type' => 'App\\Models\\Locations\\Division',
                'parent_id' => null,
                'color' => null,
                'created_at' => '2023-08-04 14:00:54',
                'updated_at' => '2023-08-04 14:00:54',
                'deleted_at' => '2023-08-04 14:00:54',
            ),
            5 =>
            array(
                'id' => 6,
                'type' => 'App\\Models\\Meeting',
                'categoryable_id' => 3,
                'categoryable_type' => 'App\\Models\\Locations\\Country',
                'parent_id' => null,
                'color' => null,
                'created_at' => '2023-08-04 14:38:11',
                'updated_at' => '2023-08-04 14:38:11',
                'deleted_at' => '2023-08-04 14:38:11',
            ),
            6 =>
            array(
                'id' => 7,
                'type' => 'App\\Models\\News',
                'categoryable_id' => 13,
                'categoryable_type' => 'App\\Models\\Locations\\Division',
                'parent_id' => null,
                'color' => null,
                'created_at' => '2023-08-04 16:18:51',
                'updated_at' => '2023-08-04 16:18:51',
                'deleted_at' => '2023-08-04 16:18:51',
            ),
            7 =>
            array(
                'id' => 8,
                'type' => 'App\\Models\\News',
                'categoryable_id' => 3,
                'categoryable_type' => 'App\\Models\\Locations\\Country',
                'parent_id' => null,
                'color' => null,
                'created_at' => '2023-08-04 16:18:51',
                'updated_at' => '2023-08-04 16:18:51',
                'deleted_at' => '2023-08-04 16:18:51',
            ),
            8 =>
            array(
                'id' => 9,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'red',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            9 =>
            array(
                'id' => 10,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'orange',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            10 =>
            array(
                'id' => 11,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'amber',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            11 =>
            array(
                'id' => 12,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'yellow',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            12 =>
            array(
                'id' => 13,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'lime',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            13 =>
            array(
                'id' => 14,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'green',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            14 =>
            array(
                'id' => 15,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'emerald',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            15 =>
            array(
                'id' => 16,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'teal',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            16 =>
            array(
                'id' => 17,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'cyan',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            17 =>
            array(
                'id' => 18,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'sky',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            18 =>
            array(
                'id' => 19,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'blue',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            19 =>
            array(
                'id' => 20,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'indigo',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            20 =>
            array(
                'id' => 21,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'violet',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            21 =>
            array(
                'id' => 22,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'purple',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            22 =>
            array(
                'id' => 23,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'fuchsia',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            23 =>
            array(
                'id' => 24,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => null,
                'color' => 'pink',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            24 =>
            array(
                'id' => 25,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 9,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            25 =>
            array(
                'id' => 26,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 9,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            26 =>
            array(
                'id' => 27,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 9,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            27 =>
            array(
                'id' => 28,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 10,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            28 =>
            array(
                'id' => 29,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 10,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            29 =>
            array(
                'id' => 30,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 10,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            30 =>
            array(
                'id' => 31,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 10,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            31 =>
            array(
                'id' => 32,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 10,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            32 =>
            array(
                'id' => 33,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 10,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            33 =>
            array(
                'id' => 34,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 11,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            34 =>
            array(
                'id' => 35,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 11,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            35 =>
            array(
                'id' => 36,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 11,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            36 =>
            array(
                'id' => 37,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 11,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            37 =>
            array(
                'id' => 38,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 12,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            38 =>
            array(
                'id' => 39,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 12,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            39 =>
            array(
                'id' => 40,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 12,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            40 =>
            array(
                'id' => 41,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 12,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            41 =>
            array(
                'id' => 42,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 13,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            42 =>
            array(
                'id' => 43,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 13,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            43 =>
            array(
                'id' => 44,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 13,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            44 =>
            array(
                'id' => 45,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 13,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            45 =>
            array(
                'id' => 46,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 13,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            46 =>
            array(
                'id' => 47,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 13,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            47 =>
            array(
                'id' => 48,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 14,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            48 =>
            array(
                'id' => 49,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 14,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            49 =>
            array(
                'id' => 50,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 14,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            50 =>
            array(
                'id' => 51,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 15,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            51 =>
            array(
                'id' => 52,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 15,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            52 =>
            array(
                'id' => 53,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 15,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            53 =>
            array(
                'id' => 54,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 15,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            54 =>
            array(
                'id' => 55,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 15,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            55 =>
            array(
                'id' => 56,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 15,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            56 =>
            array(
                'id' => 57,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 15,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            57 =>
            array(
                'id' => 58,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 16,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            58 =>
            array(
                'id' => 59,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 16,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            59 =>
            array(
                'id' => 60,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 16,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            60 =>
            array(
                'id' => 61,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 16,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            61 =>
            array(
                'id' => 62,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 16,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            62 =>
            array(
                'id' => 63,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 17,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            63 =>
            array(
                'id' => 64,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 17,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            64 =>
            array(
                'id' => 65,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 19,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            65 =>
            array(
                'id' => 66,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 19,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            66 =>
            array(
                'id' => 67,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 19,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            67 =>
            array(
                'id' => 68,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 20,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            68 =>
            array(
                'id' => 69,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 20,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            69 =>
            array(
                'id' => 70,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 20,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            70 =>
            array(
                'id' => 71,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 20,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            71 =>
            array(
                'id' => 72,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 20,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            72 =>
            array(
                'id' => 73,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 21,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            73 =>
            array(
                'id' => 74,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 21,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            74 =>
            array(
                'id' => 75,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 22,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            75 =>
            array(
                'id' => 76,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 22,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            76 =>
            array(
                'id' => 77,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 22,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            77 =>
            array(
                'id' => 78,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 22,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            78 =>
            array(
                'id' => 79,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 23,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            79 =>
            array(
                'id' => 80,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 23,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            80 =>
            array(
                'id' => 81,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 23,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            81 =>
            array(
                'id' => 82,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 23,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            82 =>
            array(
                'id' => 83,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 24,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            83 =>
            array(
                'id' => 84,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 24,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
            84 =>
            array(
                'id' => 85,
                'type' => 'App\\Models\\Tag',
                'categoryable_id' => null,
                'categoryable_type' => null,
                'parent_id' => 24,
                'color' => null,
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2007-09-23 13:04:00',
                'deleted_at' => null,
            ),
        ));


    }
}
