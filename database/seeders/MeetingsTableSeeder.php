<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MeetingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('meetings')->delete();
        
        \DB::table('meetings')->insert(array (
            0 => 
            array (
                'id' => 4,
                'post_id' => 14,
                'address' => '3',
                'meetingable_id' => NULL,
                'meetingable_type' => NULL,
                'status' => 1,
                'from' => '2023-07-01 23:00:00',
                'till' => NULL,
                'created_at' => '2023-07-29 22:19:38',
                'updated_at' => '2023-07-29 23:09:36',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 5,
                'post_id' => 15,
                'address' => NULL,
                'meetingable_id' => NULL,
                'meetingable_type' => NULL,
                'status' => 1,
                'from' => NULL,
                'till' => NULL,
                'created_at' => '2023-07-29 22:30:08',
                'updated_at' => '2023-07-29 22:30:08',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 6,
                'post_id' => 13,
                'address' => NULL,
                'meetingable_id' => NULL,
                'meetingable_type' => NULL,
                'status' => 1,
                'from' => '2023-07-20 22:30:00',
                'till' => NULL,
                'created_at' => '2023-07-29 22:30:58',
                'updated_at' => '2023-07-29 22:57:03',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}