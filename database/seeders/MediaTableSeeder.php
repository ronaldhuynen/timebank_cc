<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('media')->delete();
        
        \DB::table('media')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Facebook',
                'icon' => 'app-images/facebook.svg',
                'url_structure' => 'https://facebook.com/',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Instagram',
                'icon' => 'app-images/instagram.svg',
                'url_structure' => 'https://instagram.com/',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Twitter',
                'icon' => 'app-images/twitter.svg',
                'url_structure' => 'https://twitter.com/',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mastodon',
                'icon' => 'app-images/mastodon.svg',
                'url_structure' => 'https://#/@',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'LinkedIn',
                'icon' => 'app-images/linkedin.svg',
                'url_structure' => 'https://linkedin.com/in/',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'YouTube',
                'icon' => 'app-images/youtube.svg',
                'url_structure' => 'https://youtube.com/@',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'WhatsApp',
                'icon' => 'app-images/whatsapp.svg',
                'url_structure' => 'https://api.whatsapp.com/send?phone=',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Vimeo',
                'icon' => 'app-images/vimeo.svg',
                'url_structure' => 'https://vimeo.com/',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Github',
                'icon' => 'app-images/github.svg',
                'url_structure' => 'https://github.com/',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Snappcar',
                'icon' => 'app-images/snappcar.svg',
                'url_structure' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Peerby',
                'icon' => 'app-images/peerby.svg',
                'url_structure' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}