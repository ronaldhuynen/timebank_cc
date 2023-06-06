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
                'type' => 'FrontPage',
                'country_id' => NULL,
                'division_id' => NULL,
                'city_id' => NULL,
                'district_id' => NULL,
                'created_at' => '2023-06-02 16:15:10',
                'updated_at' => '2023-06-02 16:15:10',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'News',
                'country_id' => NULL,
                'division_id' => NULL,
                'city_id' => 305,
                'district_id' => NULL,
                'created_at' => '2023-06-02 16:15:10',
                'updated_at' => '2023-06-02 16:15:10',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'type' => 'SystemAnnouncement',
                'country_id' => NULL,
                'division_id' => NULL,
                'city_id' => NULL,
                'district_id' => NULL,
                'created_at' => '2023-06-02 16:20:59',
                'updated_at' => '2023-06-02 16:20:59',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}