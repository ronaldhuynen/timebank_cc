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
                'id' => 9,
                'category_id' => 4,
                'locale' => 'nl',
                'slug' => 'den-haag-evenementen',
                'name' => 'Den Haag evenementen',
                'created_at' => '2023-07-25 12:45:20',
                'updated_at' => '2023-07-25 12:45:26',
            ),
            9 => 
            array (
                'id' => 12,
                'category_id' => 5,
                'locale' => 'nl',
                'slug' => 'provincie-antwerpen',
                'name' => 'Antwerpen provincie evenementen',
                'created_at' => '2023-08-04 14:06:00',
                'updated_at' => '2023-08-04 14:06:00',
            ),
            10 => 
            array (
                'id' => 13,
                'category_id' => 5,
                'locale' => 'en',
                'slug' => 'division-antwerp',
                'name' => 'Antwerp division events',
                'created_at' => '2023-08-04 14:07:50',
                'updated_at' => '2023-08-04 14:07:50',
            ),
            11 => 
            array (
                'id' => 14,
                'category_id' => 6,
                'locale' => 'en',
                'slug' => 'germany-events',
                'name' => 'Germany events',
                'created_at' => '2023-08-04 14:40:23',
                'updated_at' => '2023-08-04 14:40:23',
            ),
            12 => 
            array (
                'id' => 15,
                'category_id' => 7,
                'locale' => 'en',
                'slug' => 'antwerp-division-news',
                'name' => 'Antwerp division news',
                'created_at' => '2023-08-04 16:20:46',
                'updated_at' => '2023-08-04 16:20:46',
            ),
            13 => 
            array (
                'id' => 16,
                'category_id' => 8,
                'locale' => 'en',
                'slug' => 'germany-news',
                'name' => 'Germany news',
                'created_at' => '2023-08-04 16:20:46',
                'updated_at' => '2023-08-04 16:20:46',
            ),
            14 => 
            array (
                'id' => 17,
                'category_id' => 9,
                'locale' => 'en',
                'slug' => 'en-advice',
                'name' => 'Advice',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            15 => 
            array (
                'id' => 18,
                'category_id' => 10,
                'locale' => 'en',
                'slug' => 'en-care',
                'name' => 'Care',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            16 => 
            array (
                'id' => 19,
                'category_id' => 11,
                'locale' => 'en',
                'slug' => 'en-communication',
                'name' => 'Communication',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            17 => 
            array (
                'id' => 20,
                'category_id' => 12,
                'locale' => 'en',
                'slug' => 'en-community',
                'name' => 'Community',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            18 => 
            array (
                'id' => 21,
                'category_id' => 13,
                'locale' => 'en',
                'slug' => 'en-construction',
                'name' => 'Construction',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            19 => 
            array (
                'id' => 22,
                'category_id' => 14,
                'locale' => 'en',
                'slug' => 'en-culinary',
                'name' => 'Culinary',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            20 => 
            array (
                'id' => 23,
                'category_id' => 15,
                'locale' => 'en',
                'slug' => 'en-culture',
                'name' => 'Culture',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            21 => 
            array (
                'id' => 24,
                'category_id' => 16,
                'locale' => 'en',
                'slug' => 'en-education',
                'name' => 'Education',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            22 => 
            array (
                'id' => 25,
                'category_id' => 17,
                'locale' => 'en',
                'slug' => 'en-entertainment',
                'name' => 'Entertainment',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            23 => 
            array (
                'id' => 26,
                'category_id' => 18,
                'locale' => 'en',
                'slug' => 'en-farming-and-gardening',
                'name' => 'Farming & Gardening',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            24 => 
            array (
                'id' => 27,
                'category_id' => 19,
                'locale' => 'en',
                'slug' => 'en-maintenance',
                'name' => 'Maintenance',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            25 => 
            array (
                'id' => 28,
                'category_id' => 20,
                'locale' => 'en',
                'slug' => 'en-organization',
                'name' => 'Organization',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            26 => 
            array (
                'id' => 29,
                'category_id' => 21,
                'locale' => 'en',
                'slug' => 'en-recreation',
                'name' => 'Recreation',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            27 => 
            array (
                'id' => 30,
                'category_id' => 22,
                'locale' => 'en',
                'slug' => 'en-research',
                'name' => 'Research',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            28 => 
            array (
                'id' => 31,
                'category_id' => 23,
                'locale' => 'en',
                'slug' => 'en-technology',
                'name' => 'Technology',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            29 => 
            array (
                'id' => 32,
                'category_id' => 24,
                'locale' => 'en',
                'slug' => 'en-transportation',
                'name' => 'Transportation',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            30 => 
            array (
                'id' => 33,
                'category_id' => 25,
                'locale' => 'en',
                'slug' => 'en-personal-advice',
                'name' => 'Personal Advice',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            31 => 
            array (
                'id' => 34,
                'category_id' => 26,
                'locale' => 'en',
                'slug' => 'en-professional-advice',
                'name' => 'Professional Advice',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            32 => 
            array (
                'id' => 35,
                'category_id' => 27,
                'locale' => 'en',
                'slug' => 'en-sustainability-advice',
                'name' => 'Sustainability Advice',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            33 => 
            array (
                'id' => 36,
                'category_id' => 28,
                'locale' => 'en',
                'slug' => 'en-child-care',
                'name' => 'Child Care',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            34 => 
            array (
                'id' => 37,
                'category_id' => 29,
                'locale' => 'en',
                'slug' => 'en-elderly-care',
                'name' => 'Elderly Care',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            35 => 
            array (
                'id' => 38,
                'category_id' => 30,
                'locale' => 'en',
                'slug' => 'en-health-care',
                'name' => 'Health Care',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            36 => 
            array (
                'id' => 39,
                'category_id' => 31,
                'locale' => 'en',
                'slug' => 'en-hopitality',
                'name' => 'Hopitality',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            37 => 
            array (
                'id' => 40,
                'category_id' => 32,
                'locale' => 'en',
                'slug' => 'en-pet-care',
                'name' => 'Pet Care',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            38 => 
            array (
                'id' => 41,
                'category_id' => 33,
                'locale' => 'en',
                'slug' => 'en-wellness',
                'name' => 'Wellness',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            39 => 
            array (
                'id' => 42,
                'category_id' => 34,
                'locale' => 'en',
                'slug' => 'en-language',
                'name' => 'Language',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            40 => 
            array (
                'id' => 43,
                'category_id' => 35,
                'locale' => 'en',
                'slug' => 'en-media',
                'name' => 'Media',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            41 => 
            array (
                'id' => 44,
                'category_id' => 36,
                'locale' => 'en',
                'slug' => 'en-presentation',
                'name' => 'Presentation',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            42 => 
            array (
                'id' => 45,
                'category_id' => 37,
                'locale' => 'en',
                'slug' => 'en-writing-and-content',
                'name' => 'Writing & Content',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            43 => 
            array (
                'id' => 46,
                'category_id' => 38,
                'locale' => 'en',
                'slug' => 'en-activism-and-politics',
                'name' => 'Activism & Politics',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            44 => 
            array (
                'id' => 47,
                'category_id' => 39,
                'locale' => 'en',
                'slug' => 'en-community-events',
                'name' => 'Community Events',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            45 => 
            array (
                'id' => 48,
                'category_id' => 40,
                'locale' => 'en',
                'slug' => 'en-community-projects',
                'name' => 'Community Projects',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            46 => 
            array (
                'id' => 49,
                'category_id' => 41,
                'locale' => 'en',
                'slug' => 'en-governance',
                'name' => 'Governance',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            47 => 
            array (
                'id' => 50,
                'category_id' => 42,
                'locale' => 'en',
                'slug' => 'en-building',
                'name' => 'Building',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            48 => 
            array (
                'id' => 51,
                'category_id' => 43,
                'locale' => 'en',
                'slug' => 'en-home-improvement',
                'name' => 'Home Improvement',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            49 => 
            array (
                'id' => 52,
                'category_id' => 44,
                'locale' => 'en',
                'slug' => 'en-painting-craft',
            'name' => 'Painting (Craft)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            50 => 
            array (
                'id' => 53,
                'category_id' => 45,
                'locale' => 'en',
                'slug' => 'en-metal-working',
                'name' => 'Metal Working',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            51 => 
            array (
                'id' => 54,
                'category_id' => 46,
                'locale' => 'en',
                'slug' => 'en-plumbing',
                'name' => 'Plumbing',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            52 => 
            array (
                'id' => 55,
                'category_id' => 47,
                'locale' => 'en',
                'slug' => 'en-wood-working',
                'name' => 'Wood Working',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            53 => 
            array (
                'id' => 56,
                'category_id' => 48,
                'locale' => 'en',
                'slug' => 'en-culinary-events',
                'name' => 'Culinary Events',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            54 => 
            array (
                'id' => 57,
                'category_id' => 49,
                'locale' => 'en',
                'slug' => 'en-Food-or-drinks-preparation',
                'name' => 'Food / Drinks Preparation',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            55 => 
            array (
                'id' => 58,
                'category_id' => 50,
                'locale' => 'en',
                'slug' => 'en-restaurant-service',
                'name' => 'Restaurant Service',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            56 => 
            array (
                'id' => 59,
                'category_id' => 51,
                'locale' => 'en',
                'slug' => 'en-acting',
                'name' => 'Acting',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            57 => 
            array (
                'id' => 60,
                'category_id' => 52,
                'locale' => 'en',
                'slug' => 'en-art-and-creativity',
                'name' => 'Art & Creativity',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            58 => 
            array (
                'id' => 61,
                'category_id' => 53,
                'locale' => 'en',
                'slug' => 'en-dance',
                'name' => 'Dance',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            59 => 
            array (
                'id' => 62,
                'category_id' => 54,
                'locale' => 'en',
                'slug' => 'en-design-and-architecture',
                'name' => 'Design & Architecture',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            60 => 
            array (
                'id' => 63,
                'category_id' => 55,
                'locale' => 'en',
                'slug' => 'en-literature-and-poetry',
                'name' => 'Literature & Poetry',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            61 => 
            array (
                'id' => 64,
                'category_id' => 56,
                'locale' => 'en',
                'slug' => 'en-music',
                'name' => 'Music',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            62 => 
            array (
                'id' => 65,
                'category_id' => 57,
                'locale' => 'en',
                'slug' => 'en-video-and-photography',
                'name' => 'Video & Photography',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            63 => 
            array (
                'id' => 66,
                'category_id' => 58,
                'locale' => 'en',
                'slug' => 'en-general-education',
                'name' => 'General Education',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            64 => 
            array (
                'id' => 67,
                'category_id' => 59,
                'locale' => 'en',
                'slug' => 'en-primary-school-education',
                'name' => 'Primary School Education',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            65 => 
            array (
                'id' => 68,
                'category_id' => 60,
                'locale' => 'en',
                'slug' => 'en-profesional-education',
                'name' => 'Profesional Education',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            66 => 
            array (
                'id' => 69,
                'category_id' => 61,
                'locale' => 'en',
                'slug' => 'en-secondary-school-education',
                'name' => 'Secondary School Education',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            67 => 
            array (
                'id' => 70,
                'category_id' => 62,
                'locale' => 'en',
                'slug' => 'en-university-education',
                'name' => 'University Education',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            68 => 
            array (
                'id' => 71,
                'category_id' => 63,
                'locale' => 'en',
                'slug' => 'en-entertainment-and-performances',
                'name' => 'Entertainment & Performances',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            69 => 
            array (
                'id' => 72,
                'category_id' => 64,
                'locale' => 'en',
                'slug' => 'en-games',
                'name' => 'Games',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            70 => 
            array (
                'id' => 73,
                'category_id' => 65,
                'locale' => 'en',
                'slug' => 'en-cleaning-and-tidying',
                'name' => 'Cleaning & Tidying',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            71 => 
            array (
                'id' => 74,
                'category_id' => 66,
                'locale' => 'en',
                'slug' => 'en-errands',
                'name' => 'Errands',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            72 => 
            array (
                'id' => 75,
                'category_id' => 67,
                'locale' => 'en',
                'slug' => 'en-repairs',
                'name' => 'Repairs',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            73 => 
            array (
                'id' => 76,
                'category_id' => 68,
                'locale' => 'en',
                'slug' => 'en-accounting-and-administration-non-profit',
            'name' => 'Accounting and Administration (non-profit)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            74 => 
            array (
                'id' => 77,
                'category_id' => 69,
                'locale' => 'en',
                'slug' => 'en-event-organization',
                'name' => 'Event Organization',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            75 => 
            array (
                'id' => 78,
                'category_id' => 70,
                'locale' => 'en',
                'slug' => 'en-finance',
                'name' => 'Finance',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            76 => 
            array (
                'id' => 79,
                'category_id' => 71,
                'locale' => 'en',
                'slug' => 'en-marketing',
                'name' => 'Marketing',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            77 => 
            array (
                'id' => 80,
                'category_id' => 72,
                'locale' => 'en',
                'slug' => 'en-project-management',
                'name' => 'Project Management',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            78 => 
            array (
                'id' => 81,
                'category_id' => 73,
                'locale' => 'en',
                'slug' => 'en-hobby',
                'name' => 'Hobby',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            79 => 
            array (
                'id' => 82,
                'category_id' => 74,
                'locale' => 'en',
                'slug' => 'en-sports',
                'name' => 'Sports',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            80 => 
            array (
                'id' => 83,
                'category_id' => 75,
                'locale' => 'en',
                'slug' => 'en-data-science-and-analysis',
                'name' => 'Data Science and Analysis',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            81 => 
            array (
                'id' => 84,
                'category_id' => 76,
                'locale' => 'en',
                'slug' => 'en-field-work',
                'name' => 'Field Work',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            82 => 
            array (
                'id' => 85,
                'category_id' => 77,
                'locale' => 'en',
                'slug' => 'en-philosophy',
                'name' => 'Philosophy',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            83 => 
            array (
                'id' => 86,
                'category_id' => 78,
                'locale' => 'en',
                'slug' => 'en-research-and-development',
                'name' => 'Research & Development',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            84 => 
            array (
                'id' => 87,
                'category_id' => 79,
                'locale' => 'en',
                'slug' => 'en-automation-and-robotics',
                'name' => 'Automation and Robotics',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            85 => 
            array (
                'id' => 88,
                'category_id' => 80,
                'locale' => 'en',
                'slug' => 'en-computers-and-it',
                'name' => 'Computers & IT',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            86 => 
            array (
                'id' => 89,
                'category_id' => 81,
                'locale' => 'en',
                'slug' => 'en-electronics',
                'name' => 'Electronics',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            87 => 
            array (
                'id' => 90,
                'category_id' => 82,
                'locale' => 'en',
                'slug' => 'en-mechanics',
                'name' => 'Mechanics',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            88 => 
            array (
                'id' => 91,
                'category_id' => 83,
                'locale' => 'en',
                'slug' => 'en-delivery',
                'name' => 'Delivery',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            89 => 
            array (
                'id' => 92,
                'category_id' => 84,
                'locale' => 'en',
                'slug' => 'en-driver-services',
                'name' => 'Driver Services',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            90 => 
            array (
                'id' => 93,
                'category_id' => 85,
                'locale' => 'en',
                'slug' => 'en-moving-services',
                'name' => 'Moving Services',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            91 => 
            array (
                'id' => 94,
                'category_id' => 9,
                'locale' => 'nl',
                'slug' => 'nl-advies',
                'name' => 'Advies',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            92 => 
            array (
                'id' => 95,
                'category_id' => 10,
                'locale' => 'nl',
                'slug' => 'nl-zorg',
                'name' => 'Zorg',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            93 => 
            array (
                'id' => 96,
                'category_id' => 11,
                'locale' => 'nl',
                'slug' => 'nl-communicatie',
                'name' => 'Communicatie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            94 => 
            array (
                'id' => 97,
                'category_id' => 12,
                'locale' => 'nl',
                'slug' => 'nl-gemeenschap',
                'name' => 'Gemeenschap',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            95 => 
            array (
                'id' => 98,
                'category_id' => 13,
                'locale' => 'nl',
                'slug' => 'nl-bouw',
                'name' => 'Bouw',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            96 => 
            array (
                'id' => 99,
                'category_id' => 14,
                'locale' => 'nl',
                'slug' => 'nl-culinair',
                'name' => 'Culinair',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            97 => 
            array (
                'id' => 100,
                'category_id' => 15,
                'locale' => 'nl',
                'slug' => 'nl-cultuur',
                'name' => 'Cultuur',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            98 => 
            array (
                'id' => 101,
                'category_id' => 16,
                'locale' => 'nl',
                'slug' => 'nl-onderwijs',
                'name' => 'Onderwijs',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            99 => 
            array (
                'id' => 102,
                'category_id' => 17,
                'locale' => 'nl',
                'slug' => 'nl-amusement',
                'name' => 'Amusement',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            100 => 
            array (
                'id' => 103,
                'category_id' => 18,
                'locale' => 'nl',
                'slug' => 'nl-landbouw-en-tuinieren',
                'name' => 'Landbouw & Tuinieren',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            101 => 
            array (
                'id' => 104,
                'category_id' => 19,
                'locale' => 'nl',
                'slug' => 'nl-onderhoud',
                'name' => 'Onderhoud',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            102 => 
            array (
                'id' => 105,
                'category_id' => 20,
                'locale' => 'nl',
                'slug' => 'nl-organisatie',
                'name' => 'Organisatie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            103 => 
            array (
                'id' => 106,
                'category_id' => 21,
                'locale' => 'nl',
                'slug' => 'nl-recreatie',
                'name' => 'Recreatie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            104 => 
            array (
                'id' => 107,
                'category_id' => 22,
                'locale' => 'nl',
                'slug' => 'nl-onderzoek',
                'name' => 'Onderzoek',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            105 => 
            array (
                'id' => 108,
                'category_id' => 23,
                'locale' => 'nl',
                'slug' => 'nl-technologie',
                'name' => 'Technologie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            106 => 
            array (
                'id' => 109,
                'category_id' => 24,
                'locale' => 'nl',
                'slug' => 'nl-vervoer',
                'name' => 'Vervoer',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            107 => 
            array (
                'id' => 110,
                'category_id' => 25,
                'locale' => 'nl',
                'slug' => 'nl-persoonlijk advies',
                'name' => 'Persoonlijk Advies',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            108 => 
            array (
                'id' => 111,
                'category_id' => 26,
                'locale' => 'nl',
                'slug' => 'nl-professioneel advies',
                'name' => 'Professioneel Advies',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            109 => 
            array (
                'id' => 112,
                'category_id' => 27,
                'locale' => 'nl',
                'slug' => 'nl-advies duurzaamheid',
                'name' => 'Advies Duurzaamheid',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            110 => 
            array (
                'id' => 113,
                'category_id' => 28,
                'locale' => 'nl',
                'slug' => 'nl-kinder-en-jeugdzorg',
                'name' => 'Kinder & Jeugdzorg',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            111 => 
            array (
                'id' => 114,
                'category_id' => 29,
                'locale' => 'nl',
                'slug' => 'nl-ouderenzorg',
                'name' => 'Ouderenzorg',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            112 => 
            array (
                'id' => 115,
                'category_id' => 30,
                'locale' => 'nl',
                'slug' => 'nl-gezondheidszorg',
                'name' => 'Gezondheidszorg',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            113 => 
            array (
                'id' => 116,
                'category_id' => 31,
                'locale' => 'nl',
                'slug' => 'nl-gastvrijheid',
                'name' => 'Gastvrijheid',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            114 => 
            array (
                'id' => 117,
                'category_id' => 32,
                'locale' => 'nl',
                'slug' => 'nl-dierenverzorging',
                'name' => 'Dierenverzorging',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            115 => 
            array (
                'id' => 118,
                'category_id' => 33,
                'locale' => 'nl',
                'slug' => 'nl-welzijn',
                'name' => 'Welzijn',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            116 => 
            array (
                'id' => 119,
                'category_id' => 34,
                'locale' => 'nl',
                'slug' => 'nl-taal',
                'name' => 'Taal',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            117 => 
            array (
                'id' => 120,
                'category_id' => 35,
                'locale' => 'nl',
                'slug' => 'nl-media',
                'name' => 'Media',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            118 => 
            array (
                'id' => 121,
                'category_id' => 36,
                'locale' => 'nl',
                'slug' => 'nl-presentatie',
                'name' => 'Presentatie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            119 => 
            array (
                'id' => 122,
                'category_id' => 37,
                'locale' => 'nl',
                'slug' => 'nl-schrijven-en-content-creatie',
                'name' => 'Schrijven & Content-creatie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            120 => 
            array (
                'id' => 123,
                'category_id' => 38,
                'locale' => 'nl',
                'slug' => 'nl-activisme-en-politiek',
                'name' => 'Activisme & Politiek',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            121 => 
            array (
                'id' => 124,
                'category_id' => 39,
                'locale' => 'nl',
                'slug' => 'nl-gemeenschapsevenementen',
                'name' => 'Gemeenschapsevenementen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            122 => 
            array (
                'id' => 125,
                'category_id' => 40,
                'locale' => 'nl',
                'slug' => 'nl-gemeenschapsprojecten',
                'name' => 'Gemeenschapsprojecten',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            123 => 
            array (
                'id' => 126,
                'category_id' => 41,
                'locale' => 'nl',
                'slug' => 'nl-bestuur',
                'name' => 'Bestuur',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            124 => 
            array (
                'id' => 127,
                'category_id' => 42,
                'locale' => 'nl',
                'slug' => 'nl-bouwen',
                'name' => 'Bouwen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            125 => 
            array (
                'id' => 128,
                'category_id' => 43,
                'locale' => 'nl',
                'slug' => 'nl-woningverbetering',
                'name' => 'Woningverbetering',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            126 => 
            array (
                'id' => 129,
                'category_id' => 44,
                'locale' => 'nl',
                'slug' => 'nl-schilderen ambacht',
            'name' => 'Schilderen (Ambacht)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            127 => 
            array (
                'id' => 130,
                'category_id' => 45,
                'locale' => 'nl',
                'slug' => 'nl-metaalbewerking',
                'name' => 'Metaalbewerking',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            128 => 
            array (
                'id' => 131,
                'category_id' => 46,
                'locale' => 'nl',
                'slug' => 'nl-loodgieterswerk',
                'name' => 'Loodgieterswerk',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            129 => 
            array (
                'id' => 132,
                'category_id' => 47,
                'locale' => 'nl',
                'slug' => 'nl-houtbewerking',
                'name' => 'Houtbewerking',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            130 => 
            array (
                'id' => 133,
                'category_id' => 48,
                'locale' => 'nl',
                'slug' => 'nl-culinaire evenementen',
                'name' => 'Culinaire Evenementen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            131 => 
            array (
                'id' => 134,
                'category_id' => 49,
                'locale' => 'nl',
                'slug' => 'nl-voedsel- / drankbereiding',
                'name' => 'Voedsel- / Drankbereiding',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            132 => 
            array (
                'id' => 135,
                'category_id' => 50,
                'locale' => 'nl',
                'slug' => 'nl-restaurantbediening',
                'name' => 'Restaurantbediening',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            133 => 
            array (
                'id' => 136,
                'category_id' => 51,
                'locale' => 'nl',
                'slug' => 'nl-acteren',
                'name' => 'Acteren',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            134 => 
            array (
                'id' => 137,
                'category_id' => 52,
                'locale' => 'nl',
                'slug' => 'nl-kunst-en-creativiteit',
                'name' => 'Kunst & Creativiteit',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            135 => 
            array (
                'id' => 138,
                'category_id' => 53,
                'locale' => 'nl',
                'slug' => 'nl-dans',
                'name' => 'Dans',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            136 => 
            array (
                'id' => 139,
                'category_id' => 54,
                'locale' => 'nl',
                'slug' => 'nl-ontwerp-en-architectuur',
                'name' => 'Ontwerp & Architectuur',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            137 => 
            array (
                'id' => 140,
                'category_id' => 55,
                'locale' => 'nl',
                'slug' => 'nl-literatuur-en-poëzie',
                'name' => 'Literatuur & Poëzie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            138 => 
            array (
                'id' => 141,
                'category_id' => 56,
                'locale' => 'nl',
                'slug' => 'nl-muziek',
                'name' => 'Muziek',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            139 => 
            array (
                'id' => 142,
                'category_id' => 57,
                'locale' => 'nl',
                'slug' => 'nl-video-en-fotografie',
                'name' => 'Video & Fotografie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            140 => 
            array (
                'id' => 143,
                'category_id' => 58,
                'locale' => 'nl',
                'slug' => 'nl-algemeen onderwijs',
                'name' => 'Algemeen Onderwijs',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            141 => 
            array (
                'id' => 144,
                'category_id' => 59,
                'locale' => 'nl',
                'slug' => 'nl-basisschool onderwijs',
                'name' => 'Basisschool Onderwijs',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            142 => 
            array (
                'id' => 145,
                'category_id' => 60,
                'locale' => 'nl',
                'slug' => 'nl-beroepsonderwijs',
                'name' => 'Beroepsonderwijs',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            143 => 
            array (
                'id' => 146,
                'category_id' => 61,
                'locale' => 'nl',
                'slug' => 'nl-voortgezet onderwijs',
                'name' => 'Voortgezet Onderwijs',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            144 => 
            array (
                'id' => 147,
                'category_id' => 62,
                'locale' => 'nl',
                'slug' => 'nl-universitair onderwijs',
                'name' => 'Universitair Onderwijs',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            145 => 
            array (
                'id' => 148,
                'category_id' => 63,
                'locale' => 'nl',
                'slug' => 'nl-amusement-en-optredens',
                'name' => 'Amusement & Optredens',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            146 => 
            array (
                'id' => 149,
                'category_id' => 64,
                'locale' => 'nl',
                'slug' => 'nl-spellen',
                'name' => 'Spellen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            147 => 
            array (
                'id' => 150,
                'category_id' => 65,
                'locale' => 'nl',
                'slug' => 'nl-schoonmaken-en-opruimen',
                'name' => 'Schoonmaken & Opruimen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            148 => 
            array (
                'id' => 151,
                'category_id' => 66,
                'locale' => 'nl',
                'slug' => 'nl-klusjes',
                'name' => 'Klusjes',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            149 => 
            array (
                'id' => 152,
                'category_id' => 67,
                'locale' => 'nl',
                'slug' => 'nl-reparaties',
                'name' => 'Reparaties',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            150 => 
            array (
                'id' => 153,
                'category_id' => 68,
                'locale' => 'nl',
                'slug' => 'nl-boekhouding en administratie nonprofit',
            'name' => 'Boekhouding en Administratie (non-profit)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            151 => 
            array (
                'id' => 154,
                'category_id' => 69,
                'locale' => 'nl',
                'slug' => 'nl-evenementenorganisatie',
                'name' => 'Evenementenorganisatie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            152 => 
            array (
                'id' => 155,
                'category_id' => 70,
                'locale' => 'nl',
                'slug' => 'nl-financiën',
                'name' => 'Financiën',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            153 => 
            array (
                'id' => 156,
                'category_id' => 71,
                'locale' => 'nl',
                'slug' => 'nl-marketing',
                'name' => 'Marketing',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            154 => 
            array (
                'id' => 157,
                'category_id' => 72,
                'locale' => 'nl',
                'slug' => 'nl-projectmanagement',
                'name' => 'Projectmanagement',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            155 => 
            array (
                'id' => 158,
                'category_id' => 73,
                'locale' => 'nl',
                'slug' => 'nl-hobby',
                'name' => 'Hobby',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            156 => 
            array (
                'id' => 159,
                'category_id' => 74,
                'locale' => 'nl',
                'slug' => 'nl-sport',
                'name' => 'Sport',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            157 => 
            array (
                'id' => 160,
                'category_id' => 75,
                'locale' => 'nl',
                'slug' => 'nl-statistiek en analyse',
                'name' => 'Statistiek en Analyse',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            158 => 
            array (
                'id' => 161,
                'category_id' => 76,
                'locale' => 'nl',
                'slug' => 'nl-veldwerk',
                'name' => 'Veldwerk',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            159 => 
            array (
                'id' => 162,
                'category_id' => 77,
                'locale' => 'nl',
                'slug' => 'nl-filosofie',
                'name' => 'Filosofie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            160 => 
            array (
                'id' => 163,
                'category_id' => 78,
                'locale' => 'nl',
                'slug' => 'nl-onderzoek-en-ontwikkeling',
                'name' => 'Onderzoek & Ontwikkeling',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            161 => 
            array (
                'id' => 164,
                'category_id' => 79,
                'locale' => 'nl',
                'slug' => 'nl-automatisering en robotica',
                'name' => 'Automatisering en Robotica',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            162 => 
            array (
                'id' => 165,
                'category_id' => 80,
                'locale' => 'nl',
                'slug' => 'nl-computers-en-it',
                'name' => 'Computers & IT',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            163 => 
            array (
                'id' => 166,
                'category_id' => 81,
                'locale' => 'nl',
                'slug' => 'nl-elektronica',
                'name' => 'Elektronica',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            164 => 
            array (
                'id' => 167,
                'category_id' => 82,
                'locale' => 'nl',
                'slug' => 'nl-mechanica',
                'name' => 'Mechanica',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            165 => 
            array (
                'id' => 168,
                'category_id' => 83,
                'locale' => 'nl',
                'slug' => 'nl-bezorging',
                'name' => 'Bezorging',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            166 => 
            array (
                'id' => 169,
                'category_id' => 84,
                'locale' => 'nl',
                'slug' => 'nl-chauffeursdiensten',
                'name' => 'Chauffeursdiensten',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            167 => 
            array (
                'id' => 170,
                'category_id' => 85,
                'locale' => 'nl',
                'slug' => 'nl-verhuizen',
                'name' => 'Verhuizen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            168 => 
            array (
                'id' => 171,
                'category_id' => 9,
                'locale' => 'fr',
                'slug' => 'fr-conseil',
                'name' => 'Conseil,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            169 => 
            array (
                'id' => 172,
                'category_id' => 10,
                'locale' => 'fr',
                'slug' => 'fr-soins',
                'name' => 'Soins,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            170 => 
            array (
                'id' => 173,
                'category_id' => 11,
                'locale' => 'fr',
                'slug' => 'fr-communication',
                'name' => 'Communication,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            171 => 
            array (
                'id' => 174,
                'category_id' => 12,
                'locale' => 'fr',
                'slug' => 'fr-communauté',
                'name' => 'Communauté,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            172 => 
            array (
                'id' => 175,
                'category_id' => 13,
                'locale' => 'fr',
                'slug' => 'fr-construction',
                'name' => 'Construction,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            173 => 
            array (
                'id' => 176,
                'category_id' => 14,
                'locale' => 'fr',
                'slug' => 'fr-culinaire',
                'name' => 'Culinaire,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            174 => 
            array (
                'id' => 177,
                'category_id' => 15,
                'locale' => 'fr',
                'slug' => 'fr-culture',
                'name' => 'Culture,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            175 => 
            array (
                'id' => 178,
                'category_id' => 16,
                'locale' => 'fr',
                'slug' => 'fr-éducation',
                'name' => 'Éducation,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            176 => 
            array (
                'id' => 179,
                'category_id' => 17,
                'locale' => 'fr',
                'slug' => 'fr-divertissement',
                'name' => 'Divertissement,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            177 => 
            array (
                'id' => 180,
                'category_id' => 18,
                'locale' => 'fr',
                'slug' => 'fr-agriculture-et-jardinage',
                'name' => 'Agriculture et Jardinage,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            178 => 
            array (
                'id' => 181,
                'category_id' => 19,
                'locale' => 'fr',
                'slug' => 'fr-entretien',
                'name' => 'Entretien,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            179 => 
            array (
                'id' => 182,
                'category_id' => 20,
                'locale' => 'fr',
                'slug' => 'fr-organisation',
                'name' => 'Organisation,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            180 => 
            array (
                'id' => 183,
                'category_id' => 21,
                'locale' => 'fr',
                'slug' => 'fr-loisirs',
                'name' => 'Loisirs,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            181 => 
            array (
                'id' => 184,
                'category_id' => 22,
                'locale' => 'fr',
                'slug' => 'fr-recherche',
                'name' => 'Recherche,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            182 => 
            array (
                'id' => 185,
                'category_id' => 23,
                'locale' => 'fr',
                'slug' => 'fr-technologie',
                'name' => 'Technologie,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            183 => 
            array (
                'id' => 186,
                'category_id' => 24,
                'locale' => 'fr',
                'slug' => 'fr-transport',
                'name' => 'Transport,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            184 => 
            array (
                'id' => 187,
                'category_id' => 25,
                'locale' => 'fr',
                'slug' => 'fr-conseil-personnel',
                'name' => 'Conseil personnel,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            185 => 
            array (
                'id' => 188,
                'category_id' => 26,
                'locale' => 'fr',
                'slug' => 'fr-conseil-professionnel',
                'name' => 'Conseil professionnel,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            186 => 
            array (
                'id' => 189,
                'category_id' => 27,
                'locale' => 'fr',
                'slug' => 'fr-conseil-en-durabilité',
                'name' => 'Conseil en durabilité,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            187 => 
            array (
                'id' => 190,
                'category_id' => 28,
                'locale' => 'fr',
                'slug' => 'fr-garde-d\'enfants',
                'name' => 'Garde d\'enfants,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            188 => 
            array (
                'id' => 191,
                'category_id' => 29,
                'locale' => 'fr',
                'slug' => 'fr-soins-aux-personnes-âgées',
                'name' => 'Soins aux personnes âgées,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            189 => 
            array (
                'id' => 192,
                'category_id' => 30,
                'locale' => 'fr',
                'slug' => 'fr-soins-de-santé',
                'name' => 'Soins de santé,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            190 => 
            array (
                'id' => 193,
                'category_id' => 31,
                'locale' => 'fr',
                'slug' => 'fr-hospitalité',
                'name' => 'Hospitalité,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            191 => 
            array (
                'id' => 194,
                'category_id' => 32,
                'locale' => 'fr',
                'slug' => 'fr-soins-des-animaux',
                'name' => 'Soins des animaux,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            192 => 
            array (
                'id' => 195,
                'category_id' => 33,
                'locale' => 'fr',
                'slug' => 'fr-bien-être',
                'name' => 'Bien-être,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            193 => 
            array (
                'id' => 196,
                'category_id' => 34,
                'locale' => 'fr',
                'slug' => 'fr-langue',
                'name' => 'Langue,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            194 => 
            array (
                'id' => 197,
                'category_id' => 35,
                'locale' => 'fr',
                'slug' => 'fr-médias',
                'name' => 'Médias,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            195 => 
            array (
                'id' => 198,
                'category_id' => 36,
                'locale' => 'fr',
                'slug' => 'fr-présentation',
                'name' => 'Présentation,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            196 => 
            array (
                'id' => 199,
                'category_id' => 37,
                'locale' => 'fr',
                'slug' => 'fr-écriture-et-contenu',
                'name' => 'Écriture et Contenu,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            197 => 
            array (
                'id' => 200,
                'category_id' => 38,
                'locale' => 'fr',
                'slug' => 'fr-activisme-et-politique',
                'name' => 'Activisme et Politique,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            198 => 
            array (
                'id' => 201,
                'category_id' => 39,
                'locale' => 'fr',
                'slug' => 'fr-événements-communautaires',
                'name' => 'Événements communautaires,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            199 => 
            array (
                'id' => 202,
                'category_id' => 40,
                'locale' => 'fr',
                'slug' => 'fr-projets-communautaires',
                'name' => 'Projets communautaires,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            200 => 
            array (
                'id' => 203,
                'category_id' => 41,
                'locale' => 'fr',
                'slug' => 'fr-gouvernance',
                'name' => 'Gouvernance,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            201 => 
            array (
                'id' => 204,
                'category_id' => 42,
                'locale' => 'fr',
                'slug' => 'fr-bâtiment',
                'name' => 'Bâtiment',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            202 => 
            array (
                'id' => 205,
                'category_id' => 43,
                'locale' => 'fr',
                'slug' => 'fr-amélioration-de-l\'habitat',
                'name' => 'Amélioration de l\'habitat',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            203 => 
            array (
                'id' => 206,
                'category_id' => 44,
                'locale' => 'fr',
                'slug' => 'fr-peinture-artisanat',
            'name' => 'Peinture (Artisanat)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            204 => 
            array (
                'id' => 207,
                'category_id' => 45,
                'locale' => 'fr',
                'slug' => 'fr-travail-du-métal',
                'name' => 'Travail du Métal',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            205 => 
            array (
                'id' => 208,
                'category_id' => 46,
                'locale' => 'fr',
                'slug' => 'fr-plomberie',
                'name' => 'Plomberie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            206 => 
            array (
                'id' => 209,
                'category_id' => 47,
                'locale' => 'fr',
                'slug' => 'fr-travail-du-bois',
                'name' => 'Travail du bois,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            207 => 
            array (
                'id' => 210,
                'category_id' => 48,
                'locale' => 'fr',
                'slug' => 'fr-événements-culinaires',
                'name' => 'Événements culinaires,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            208 => 
            array (
                'id' => 211,
                'category_id' => 49,
                'locale' => 'fr',
                'slug' => 'fr-préparation-de-nourriture-ou-boissons',
                'name' => 'Préparation de nourriture / boissons,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            209 => 
            array (
                'id' => 212,
                'category_id' => 50,
                'locale' => 'fr',
                'slug' => 'fr-service-de-restaurant',
                'name' => 'Service de restaurant,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            210 => 
            array (
                'id' => 213,
                'category_id' => 51,
                'locale' => 'fr',
                'slug' => 'fr-acte',
                'name' => 'Acte,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            211 => 
            array (
                'id' => 214,
                'category_id' => 52,
                'locale' => 'fr',
                'slug' => 'fr-art-et-créativité',
                'name' => 'Art et Créativité,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            212 => 
            array (
                'id' => 215,
                'category_id' => 53,
                'locale' => 'fr',
                'slug' => 'fr-danse',
                'name' => 'Danse,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            213 => 
            array (
                'id' => 216,
                'category_id' => 54,
                'locale' => 'fr',
                'slug' => 'fr-design-et-architecture',
                'name' => 'Design et Architecture,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            214 => 
            array (
                'id' => 217,
                'category_id' => 55,
                'locale' => 'fr',
                'slug' => 'fr-littérature-et-poésie',
                'name' => 'Littérature et Poésie,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            215 => 
            array (
                'id' => 218,
                'category_id' => 56,
                'locale' => 'fr',
                'slug' => 'fr-musique',
                'name' => 'Musique,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            216 => 
            array (
                'id' => 219,
                'category_id' => 57,
                'locale' => 'fr',
                'slug' => 'fr-vidéo-et-photographie',
                'name' => 'Vidéo et Photographie,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            217 => 
            array (
                'id' => 220,
                'category_id' => 58,
                'locale' => 'fr',
                'slug' => 'fr-éducation-générale',
                'name' => 'Éducation générale,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            218 => 
            array (
                'id' => 221,
                'category_id' => 59,
                'locale' => 'fr',
                'slug' => 'fr-éducation-primaire',
                'name' => 'Éducation primaire,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            219 => 
            array (
                'id' => 222,
                'category_id' => 60,
                'locale' => 'fr',
                'slug' => 'fr-éducation-professionnelle',
                'name' => 'Éducation professionnelle,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            220 => 
            array (
                'id' => 223,
                'category_id' => 61,
                'locale' => 'fr',
                'slug' => 'fr-éducation-secondaire',
                'name' => 'Éducation secondaire,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            221 => 
            array (
                'id' => 224,
                'category_id' => 62,
                'locale' => 'fr',
                'slug' => 'fr-éducation-universitaire',
                'name' => 'Éducation universitaire,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            222 => 
            array (
                'id' => 225,
                'category_id' => 63,
                'locale' => 'fr',
                'slug' => 'fr-divertissements-et-performances',
                'name' => 'Divertissements et Performances,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            223 => 
            array (
                'id' => 226,
                'category_id' => 64,
                'locale' => 'fr',
                'slug' => 'fr-jeux',
                'name' => 'Jeux,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            224 => 
            array (
                'id' => 227,
                'category_id' => 65,
                'locale' => 'fr',
                'slug' => 'fr-nettoyage-et-rangement',
                'name' => 'Nettoyage et Rangement,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            225 => 
            array (
                'id' => 228,
                'category_id' => 66,
                'locale' => 'fr',
                'slug' => 'fr-courses',
                'name' => 'Courses,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            226 => 
            array (
                'id' => 229,
                'category_id' => 67,
                'locale' => 'fr',
                'slug' => 'fr-réparations',
                'name' => 'Réparations,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            227 => 
            array (
                'id' => 230,
                'category_id' => 68,
                'locale' => 'fr',
                'slug' => 'fr-comptabilité-et-administration-à-but-non-lucratif',
            'name' => 'Comptabilité et administration (à but non lucratif),',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            228 => 
            array (
                'id' => 231,
                'category_id' => 69,
                'locale' => 'fr',
                'slug' => 'fr-organisation-d\'événements',
                'name' => 'Organisation d\'événements,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            229 => 
            array (
                'id' => 232,
                'category_id' => 70,
                'locale' => 'fr',
                'slug' => 'fr-finance',
                'name' => 'Finance,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            230 => 
            array (
                'id' => 233,
                'category_id' => 71,
                'locale' => 'fr',
                'slug' => 'fr-marketing',
                'name' => 'Marketing,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            231 => 
            array (
                'id' => 234,
                'category_id' => 72,
                'locale' => 'fr',
                'slug' => 'fr-gestion-de-projets',
                'name' => 'Gestion de projets,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            232 => 
            array (
                'id' => 235,
                'category_id' => 73,
                'locale' => 'fr',
                'slug' => 'fr-passe-temps',
                'name' => 'Passe-temps,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            233 => 
            array (
                'id' => 236,
                'category_id' => 74,
                'locale' => 'fr',
                'slug' => 'fr-sports',
                'name' => 'Sports,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            234 => 
            array (
                'id' => 237,
                'category_id' => 75,
                'locale' => 'fr',
                'slug' => 'fr-science-des-données-et-analyse',
                'name' => 'Science des données et analyse,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            235 => 
            array (
                'id' => 238,
                'category_id' => 76,
                'locale' => 'fr',
                'slug' => 'fr-travail-de-terrain',
                'name' => 'Travail de terrain,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            236 => 
            array (
                'id' => 239,
                'category_id' => 77,
                'locale' => 'fr',
                'slug' => 'fr-philosophie',
                'name' => 'Philosophie,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            237 => 
            array (
                'id' => 240,
                'category_id' => 78,
                'locale' => 'fr',
                'slug' => 'fr-recherche-et-développement',
                'name' => 'Recherche et Développement,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            238 => 
            array (
                'id' => 241,
                'category_id' => 79,
                'locale' => 'fr',
                'slug' => 'fr-automatisation-et-robotique',
                'name' => 'Automatisation et robotique,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            239 => 
            array (
                'id' => 242,
                'category_id' => 80,
                'locale' => 'fr',
                'slug' => 'fr-informatique-et-ti',
                'name' => 'Informatique et TI,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            240 => 
            array (
                'id' => 243,
                'category_id' => 81,
                'locale' => 'fr',
                'slug' => 'fr-électronique',
                'name' => 'Électronique,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            241 => 
            array (
                'id' => 244,
                'category_id' => 82,
                'locale' => 'fr',
                'slug' => 'fr-mécanique',
                'name' => 'Mécanique,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            242 => 
            array (
                'id' => 245,
                'category_id' => 83,
                'locale' => 'fr',
                'slug' => 'fr-livraison',
                'name' => 'Livraison,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            243 => 
            array (
                'id' => 246,
                'category_id' => 84,
                'locale' => 'fr',
                'slug' => 'fr-services-de-chauffeur',
                'name' => 'Services de chauffeur,',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            244 => 
            array (
                'id' => 247,
                'category_id' => 85,
                'locale' => 'fr',
                'slug' => 'fr-services-de-déménagement',
                'name' => 'Services de déménagement',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            245 => 
            array (
                'id' => 248,
                'category_id' => 9,
                'locale' => 'de',
                'slug' => 'de-beratung',
                'name' => 'Beratung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            246 => 
            array (
                'id' => 249,
                'category_id' => 10,
                'locale' => 'de',
                'slug' => 'de-betreuung',
                'name' => 'Betreuung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            247 => 
            array (
                'id' => 250,
                'category_id' => 11,
                'locale' => 'de',
                'slug' => 'de-kommunikation',
                'name' => 'Kommunikation',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            248 => 
            array (
                'id' => 251,
                'category_id' => 12,
                'locale' => 'de',
                'slug' => 'de-gemeinschaft',
                'name' => 'Gemeinschaft',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            249 => 
            array (
                'id' => 252,
                'category_id' => 13,
                'locale' => 'de',
                'slug' => 'De-konstruktion',
                'name' => 'Konstruktion',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            250 => 
            array (
                'id' => 253,
                'category_id' => 14,
                'locale' => 'de',
                'slug' => 'de-kulinarik',
                'name' => 'Kulinarik',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            251 => 
            array (
                'id' => 254,
                'category_id' => 15,
                'locale' => 'de',
                'slug' => 'de-kultur',
                'name' => 'Kultur',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            252 => 
            array (
                'id' => 255,
                'category_id' => 16,
                'locale' => 'de',
                'slug' => 'De-ausbildung',
                'name' => 'Ausbildung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            253 => 
            array (
                'id' => 256,
                'category_id' => 17,
                'locale' => 'de',
                'slug' => 'de-unterhaltung',
                'name' => 'Unterhaltung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            254 => 
            array (
                'id' => 257,
                'category_id' => 18,
                'locale' => 'de',
                'slug' => 'de-landwirtschaft-und-gartenarbeit',
                'name' => 'Landwirtschaft & Gartenarbeit',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            255 => 
            array (
                'id' => 258,
                'category_id' => 19,
                'locale' => 'de',
                'slug' => 'de-wartung',
                'name' => 'Wartung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            256 => 
            array (
                'id' => 259,
                'category_id' => 20,
                'locale' => 'de',
                'slug' => 'de-organisation',
                'name' => 'Organisation',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            257 => 
            array (
                'id' => 260,
                'category_id' => 21,
                'locale' => 'de',
                'slug' => 'de-freizeit',
                'name' => 'Freizeit',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            258 => 
            array (
                'id' => 261,
                'category_id' => 22,
                'locale' => 'de',
                'slug' => 'de-forschung',
                'name' => 'Forschung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            259 => 
            array (
                'id' => 262,
                'category_id' => 23,
                'locale' => 'de',
                'slug' => 'de-technologie',
                'name' => 'Technologie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            260 => 
            array (
                'id' => 263,
                'category_id' => 24,
                'locale' => 'de',
                'slug' => 'de-transport',
                'name' => 'Transport',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            261 => 
            array (
                'id' => 264,
                'category_id' => 25,
                'locale' => 'de',
                'slug' => 'de-persönliche-beratung',
                'name' => 'Persönliche Beratung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            262 => 
            array (
                'id' => 265,
                'category_id' => 26,
                'locale' => 'de',
                'slug' => 'de-berufliche-beratung',
                'name' => 'Berufliche Beratung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            263 => 
            array (
                'id' => 266,
                'category_id' => 27,
                'locale' => 'de',
                'slug' => 'de-nachhaltigkeitsberatung',
                'name' => 'Nachhaltigkeitsberatung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            264 => 
            array (
                'id' => 267,
                'category_id' => 28,
                'locale' => 'de',
                'slug' => 'de-kinderbetreuung',
                'name' => 'Kinderbetreuung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            265 => 
            array (
                'id' => 268,
                'category_id' => 29,
                'locale' => 'de',
                'slug' => 'de-seniorenbetreuung',
                'name' => 'Seniorenbetreuung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            266 => 
            array (
                'id' => 269,
                'category_id' => 30,
                'locale' => 'de',
                'slug' => 'de-gesundheitswesen',
                'name' => 'Gesundheitswesen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            267 => 
            array (
                'id' => 270,
                'category_id' => 31,
                'locale' => 'de',
                'slug' => 'de-gastfreundschaft',
                'name' => 'Gastfreundschaft',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            268 => 
            array (
                'id' => 271,
                'category_id' => 32,
                'locale' => 'de',
                'slug' => 'de-tierbetreuung',
                'name' => 'Tierbetreuung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            269 => 
            array (
                'id' => 272,
                'category_id' => 33,
                'locale' => 'de',
                'slug' => 'de-wellness',
                'name' => 'Wellness',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            270 => 
            array (
                'id' => 273,
                'category_id' => 34,
                'locale' => 'de',
                'slug' => 'de-sprache',
                'name' => 'Sprache',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            271 => 
            array (
                'id' => 274,
                'category_id' => 35,
                'locale' => 'de',
                'slug' => 'de-medien',
                'name' => 'Medien',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            272 => 
            array (
                'id' => 275,
                'category_id' => 36,
                'locale' => 'de',
                'slug' => 'de-präsentation',
                'name' => 'Präsentation',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            273 => 
            array (
                'id' => 276,
                'category_id' => 37,
                'locale' => 'de',
                'slug' => 'de-schreiben-und-inhalt',
                'name' => 'Schreiben & Inhalt',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            274 => 
            array (
                'id' => 277,
                'category_id' => 38,
                'locale' => 'de',
                'slug' => 'de-aktivismus-und-politik',
                'name' => 'Aktivismus & Politik',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            275 => 
            array (
                'id' => 278,
                'category_id' => 39,
                'locale' => 'de',
                'slug' => 'de-gemeindeveranstaltungen',
                'name' => 'Gemeindeveranstaltungen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            276 => 
            array (
                'id' => 279,
                'category_id' => 40,
                'locale' => 'de',
                'slug' => 'de-gemeinschaftsprojekte',
                'name' => 'Gemeinschaftsprojekte',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            277 => 
            array (
                'id' => 280,
                'category_id' => 41,
                'locale' => 'de',
                'slug' => 'de-verwaltung',
                'name' => 'Verwaltung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            278 => 
            array (
                'id' => 281,
                'category_id' => 42,
                'locale' => 'de',
                'slug' => 'de-bau',
                'name' => 'Bau',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            279 => 
            array (
                'id' => 282,
                'category_id' => 43,
                'locale' => 'de',
                'slug' => 'de-heimwerken',
                'name' => 'Heimwerken',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            280 => 
            array (
                'id' => 283,
                'category_id' => 44,
                'locale' => 'de',
                'slug' => 'de-malerei-handwerk',
            'name' => 'Malerei (Handwerk)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            281 => 
            array (
                'id' => 284,
                'category_id' => 45,
                'locale' => 'de',
                'slug' => 'de-metallverarbeitung',
                'name' => 'Metallverarbeitung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            282 => 
            array (
                'id' => 285,
                'category_id' => 46,
                'locale' => 'de',
                'slug' => 'de-sanitär',
                'name' => 'Sanitär',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            283 => 
            array (
                'id' => 286,
                'category_id' => 47,
                'locale' => 'de',
                'slug' => 'de-holzbearbeitung',
                'name' => 'Holzbearbeitung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            284 => 
            array (
                'id' => 287,
                'category_id' => 48,
                'locale' => 'de',
                'slug' => 'de-kulinarische-veranstaltungen',
                'name' => 'Kulinarische Veranstaltungen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            285 => 
            array (
                'id' => 288,
                'category_id' => 49,
                'locale' => 'de',
                'slug' => 'de-lebensmittel--oder-getränkezubereitung',
                'name' => 'Lebensmittel- / Getränkezubereitung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            286 => 
            array (
                'id' => 289,
                'category_id' => 50,
                'locale' => 'de',
                'slug' => 'de-restaurantdienst',
                'name' => 'Restaurantdienst',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            287 => 
            array (
                'id' => 290,
                'category_id' => 51,
                'locale' => 'de',
                'slug' => 'de-schauspielerei',
                'name' => 'Schauspielerei',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            288 => 
            array (
                'id' => 291,
                'category_id' => 52,
                'locale' => 'de',
                'slug' => 'de-kunst-und-kreativität',
                'name' => 'Kunst & Kreativität',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            289 => 
            array (
                'id' => 292,
                'category_id' => 53,
                'locale' => 'de',
                'slug' => 'de-tanz',
                'name' => 'Tanz',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            290 => 
            array (
                'id' => 293,
                'category_id' => 54,
                'locale' => 'de',
                'slug' => 'de-design-und-architektur',
                'name' => 'Design & Architektur',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            291 => 
            array (
                'id' => 294,
                'category_id' => 55,
                'locale' => 'de',
                'slug' => 'de-literatur-und-poesie',
                'name' => 'Literatur & Poesie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            292 => 
            array (
                'id' => 295,
                'category_id' => 56,
                'locale' => 'de',
                'slug' => 'de-musik',
                'name' => 'Musik',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            293 => 
            array (
                'id' => 296,
                'category_id' => 57,
                'locale' => 'de',
                'slug' => 'de-video-und-fotografie',
                'name' => 'Video & Fotografie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            294 => 
            array (
                'id' => 297,
                'category_id' => 58,
                'locale' => 'de',
                'slug' => 'de-allgemeinbildung',
                'name' => 'Allgemeinbildung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            295 => 
            array (
                'id' => 298,
                'category_id' => 59,
                'locale' => 'de',
                'slug' => 'de-grundschulbildung',
                'name' => 'Grundschulbildung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            296 => 
            array (
                'id' => 299,
                'category_id' => 60,
                'locale' => 'de',
                'slug' => 'de-berufsbildung',
                'name' => 'Berufsbildung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            297 => 
            array (
                'id' => 300,
                'category_id' => 61,
                'locale' => 'de',
                'slug' => 'de-sekundarschulbildung',
                'name' => 'Sekundarschulbildung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            298 => 
            array (
                'id' => 301,
                'category_id' => 62,
                'locale' => 'de',
                'slug' => 'de-hochschulbildung',
                'name' => 'Hochschulbildung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            299 => 
            array (
                'id' => 302,
                'category_id' => 63,
                'locale' => 'de',
                'slug' => 'de-unterhaltung-und-darbietungen',
                'name' => 'Unterhaltung & Darbietungen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            300 => 
            array (
                'id' => 303,
                'category_id' => 64,
                'locale' => 'de',
                'slug' => 'de-spiele',
                'name' => 'Spiele',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            301 => 
            array (
                'id' => 304,
                'category_id' => 65,
                'locale' => 'de',
                'slug' => 'de-reinigung-und-aufräumen',
                'name' => 'Reinigung & Aufräumen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            302 => 
            array (
                'id' => 305,
                'category_id' => 66,
                'locale' => 'de',
                'slug' => 'de-besorgungen',
                'name' => 'Besorgungen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            303 => 
            array (
                'id' => 306,
                'category_id' => 67,
                'locale' => 'de',
                'slug' => 'de-reparaturen',
                'name' => 'Reparaturen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            304 => 
            array (
                'id' => 307,
                'category_id' => 68,
                'locale' => 'de',
                'slug' => 'de-buchhaltung-und-verwaltung-gemeinnützig',
            'name' => 'Buchhaltung und Verwaltung (gemeinnützig)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            305 => 
            array (
                'id' => 308,
                'category_id' => 69,
                'locale' => 'de',
                'slug' => 'de-veranstaltungsorganisation',
                'name' => 'Veranstaltungsorganisation',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            306 => 
            array (
                'id' => 309,
                'category_id' => 70,
                'locale' => 'de',
                'slug' => 'de-finanzen',
                'name' => 'Finanzen',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            307 => 
            array (
                'id' => 310,
                'category_id' => 71,
                'locale' => 'de',
                'slug' => 'de-marketing',
                'name' => 'Marketing',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            308 => 
            array (
                'id' => 311,
                'category_id' => 72,
                'locale' => 'de',
                'slug' => 'de-projektmanagement',
                'name' => 'Projektmanagement',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            309 => 
            array (
                'id' => 312,
                'category_id' => 73,
                'locale' => 'de',
                'slug' => 'de-hobby',
                'name' => 'Hobby',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            310 => 
            array (
                'id' => 313,
                'category_id' => 74,
                'locale' => 'de',
                'slug' => 'de-sport',
                'name' => 'Sport',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            311 => 
            array (
                'id' => 314,
                'category_id' => 75,
                'locale' => 'de',
                'slug' => 'de-datenwissenschaft-und-analyse',
                'name' => 'Datenwissenschaft und Analyse',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            312 => 
            array (
                'id' => 315,
                'category_id' => 76,
                'locale' => 'de',
                'slug' => 'de-feldarbeit',
                'name' => 'Feldarbeit',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            313 => 
            array (
                'id' => 316,
                'category_id' => 77,
                'locale' => 'de',
                'slug' => 'de-philosophie',
                'name' => 'Philosophie',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            314 => 
            array (
                'id' => 317,
                'category_id' => 78,
                'locale' => 'de',
                'slug' => 'de-forschung-und-entwicklung',
                'name' => 'Forschung & Entwicklung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            315 => 
            array (
                'id' => 318,
                'category_id' => 79,
                'locale' => 'de',
                'slug' => 'de-automatisierung-und-robotik',
                'name' => 'Automatisierung und Robotik',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            316 => 
            array (
                'id' => 319,
                'category_id' => 80,
                'locale' => 'de',
                'slug' => 'de-computer-und-it',
                'name' => 'Computer & IT',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            317 => 
            array (
                'id' => 320,
                'category_id' => 81,
                'locale' => 'de',
                'slug' => 'de-elektronik',
                'name' => 'Elektronik',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            318 => 
            array (
                'id' => 321,
                'category_id' => 82,
                'locale' => 'de',
                'slug' => 'de-mechanik',
                'name' => 'Mechanik',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            319 => 
            array (
                'id' => 322,
                'category_id' => 83,
                'locale' => 'de',
                'slug' => 'de-lieferung',
                'name' => 'Lieferung',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            320 => 
            array (
                'id' => 323,
                'category_id' => 84,
                'locale' => 'de',
                'slug' => 'de-fahrerdienste',
                'name' => 'Fahrerdienste',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            321 => 
            array (
                'id' => 324,
                'category_id' => 85,
                'locale' => 'de',
                'slug' => 'de-umzugsdienste',
                'name' => 'Umzugsdienste',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            322 => 
            array (
                'id' => 325,
                'category_id' => 9,
                'locale' => 'es',
                'slug' => 'es-asesoramiento',
                'name' => 'Asesoramiento',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            323 => 
            array (
                'id' => 326,
                'category_id' => 10,
                'locale' => 'es',
                'slug' => 'es-cuidado',
                'name' => 'Cuidado',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            324 => 
            array (
                'id' => 327,
                'category_id' => 11,
                'locale' => 'es',
                'slug' => 'es-comunicación',
                'name' => 'Comunicación',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            325 => 
            array (
                'id' => 328,
                'category_id' => 12,
                'locale' => 'es',
                'slug' => 'es-comunidad',
                'name' => 'Comunidad',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            326 => 
            array (
                'id' => 329,
                'category_id' => 13,
                'locale' => 'es',
                'slug' => 'es-construcción',
                'name' => 'Construcción',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            327 => 
            array (
                'id' => 330,
                'category_id' => 14,
                'locale' => 'es',
                'slug' => 'es-culinaria',
                'name' => 'Culinaria',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            328 => 
            array (
                'id' => 331,
                'category_id' => 15,
                'locale' => 'es',
                'slug' => 'es-cultura',
                'name' => 'Cultura',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            329 => 
            array (
                'id' => 332,
                'category_id' => 16,
                'locale' => 'es',
                'slug' => 'es-educación',
                'name' => 'Educación',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            330 => 
            array (
                'id' => 333,
                'category_id' => 17,
                'locale' => 'es',
                'slug' => 'es-entretenimiento',
                'name' => 'Entretenimiento',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            331 => 
            array (
                'id' => 334,
                'category_id' => 18,
                'locale' => 'es',
                'slug' => 'es-agricultura-y-jardinería',
                'name' => 'Agricultura y Jardinería',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            332 => 
            array (
                'id' => 335,
                'category_id' => 19,
                'locale' => 'es',
                'slug' => 'es-mantenimiento',
                'name' => 'Mantenimiento',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            333 => 
            array (
                'id' => 336,
                'category_id' => 20,
                'locale' => 'es',
                'slug' => 'es-organización',
                'name' => 'Organización',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            334 => 
            array (
                'id' => 337,
                'category_id' => 21,
                'locale' => 'es',
                'slug' => 'es-recreación',
                'name' => 'Recreación',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            335 => 
            array (
                'id' => 338,
                'category_id' => 22,
                'locale' => 'es',
                'slug' => 'es-investigación',
                'name' => 'Investigación',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            336 => 
            array (
                'id' => 339,
                'category_id' => 23,
                'locale' => 'es',
                'slug' => 'es-tecnología',
                'name' => 'Tecnología',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            337 => 
            array (
                'id' => 340,
                'category_id' => 24,
                'locale' => 'es',
                'slug' => 'es-transporte',
                'name' => 'Transporte',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            338 => 
            array (
                'id' => 341,
                'category_id' => 25,
                'locale' => 'es',
                'slug' => 'es-asesoramiento-personal',
                'name' => 'Asesoramiento Personal',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            339 => 
            array (
                'id' => 342,
                'category_id' => 26,
                'locale' => 'es',
                'slug' => 'es-asesoramiento-profesional',
                'name' => 'Asesoramiento Profesional',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            340 => 
            array (
                'id' => 343,
                'category_id' => 27,
                'locale' => 'es',
                'slug' => 'es-asesoramiento-en-sostenibilidad',
                'name' => 'Asesoramiento en Sostenibilidad',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            341 => 
            array (
                'id' => 344,
                'category_id' => 28,
                'locale' => 'es',
                'slug' => 'es-cuidado-de-niños',
                'name' => 'Cuidado de Niños',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            342 => 
            array (
                'id' => 345,
                'category_id' => 29,
                'locale' => 'es',
                'slug' => 'es-cuidado-de-ancianos',
                'name' => 'Cuidado de Ancianos',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            343 => 
            array (
                'id' => 346,
                'category_id' => 30,
                'locale' => 'es',
                'slug' => 'es-atención-médica',
                'name' => 'Atención Médica',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            344 => 
            array (
                'id' => 347,
                'category_id' => 31,
                'locale' => 'es',
                'slug' => 'es-hospitalidad',
                'name' => 'Hospitalidad',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            345 => 
            array (
                'id' => 348,
                'category_id' => 32,
                'locale' => 'es',
                'slug' => 'es-cuidado-de-mascotas',
                'name' => 'Cuidado de Mascotas',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            346 => 
            array (
                'id' => 349,
                'category_id' => 33,
                'locale' => 'es',
                'slug' => 'es-bienestar',
                'name' => 'Bienestar',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            347 => 
            array (
                'id' => 350,
                'category_id' => 34,
                'locale' => 'es',
                'slug' => 'es-idioma',
                'name' => 'Idioma',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            348 => 
            array (
                'id' => 351,
                'category_id' => 35,
                'locale' => 'es',
                'slug' => 'es-medios',
                'name' => 'Medios',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            349 => 
            array (
                'id' => 352,
                'category_id' => 36,
                'locale' => 'es',
                'slug' => 'es-presentación',
                'name' => 'Presentación',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            350 => 
            array (
                'id' => 353,
                'category_id' => 37,
                'locale' => 'es',
                'slug' => 'es-escritura-y-contenido',
                'name' => 'Escritura y Contenido',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            351 => 
            array (
                'id' => 354,
                'category_id' => 38,
                'locale' => 'es',
                'slug' => 'es-activismo-y-política',
                'name' => 'Activismo y Política',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            352 => 
            array (
                'id' => 355,
                'category_id' => 39,
                'locale' => 'es',
                'slug' => 'es-eventos-comunitarios',
                'name' => 'Eventos Comunitarios',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            353 => 
            array (
                'id' => 356,
                'category_id' => 40,
                'locale' => 'es',
                'slug' => 'es-proyectos-comunitarios',
                'name' => 'Proyectos Comunitarios',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            354 => 
            array (
                'id' => 357,
                'category_id' => 41,
                'locale' => 'es',
                'slug' => 'es-gobernanza',
                'name' => 'Gobernanza',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            355 => 
            array (
                'id' => 358,
                'category_id' => 42,
                'locale' => 'es',
                'slug' => 'Es-construir',
                'name' => 'Construir',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            356 => 
            array (
                'id' => 359,
                'category_id' => 43,
                'locale' => 'es',
                'slug' => 'es-mejoras-del-hogar',
                'name' => 'Mejoras del hogar',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            357 => 
            array (
                'id' => 360,
                'category_id' => 44,
                'locale' => 'es',
                'slug' => 'es-pintura-artesanía',
            'name' => 'Pintura (Artesanía)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            358 => 
            array (
                'id' => 361,
                'category_id' => 45,
                'locale' => 'es',
                'slug' => 'es-trabajo-de-metal',
                'name' => 'Trabajo de Metal',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            359 => 
            array (
                'id' => 362,
                'category_id' => 46,
                'locale' => 'es',
                'slug' => 'es-fontanería',
                'name' => 'Fontanería',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            360 => 
            array (
                'id' => 363,
                'category_id' => 47,
                'locale' => 'es',
                'slug' => 'es-carpintería',
                'name' => 'Carpintería',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            361 => 
            array (
                'id' => 364,
                'category_id' => 48,
                'locale' => 'es',
                'slug' => 'es-eventos-culinarios',
                'name' => 'Eventos Culinarios',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            362 => 
            array (
                'id' => 365,
                'category_id' => 49,
                'locale' => 'es',
                'slug' => 'es-preparación-de-comida-o-bebidas',
                'name' => 'Preparación de Comida / Bebidas',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            363 => 
            array (
                'id' => 366,
                'category_id' => 50,
                'locale' => 'es',
                'slug' => 'es-servicio-de-restaurante',
                'name' => 'Servicio de Restaurante',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            364 => 
            array (
                'id' => 367,
                'category_id' => 51,
                'locale' => 'es',
                'slug' => 'es-actuación',
                'name' => 'Actuación',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            365 => 
            array (
                'id' => 368,
                'category_id' => 52,
                'locale' => 'es',
                'slug' => 'es-arte-y-creatividad',
                'name' => 'Arte y Creatividad',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            366 => 
            array (
                'id' => 369,
                'category_id' => 53,
                'locale' => 'es',
                'slug' => 'es-danza',
                'name' => 'Danza',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            367 => 
            array (
                'id' => 370,
                'category_id' => 54,
                'locale' => 'es',
                'slug' => 'es-diseño-y-arquitectura',
                'name' => 'Diseño y Arquitectura',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            368 => 
            array (
                'id' => 371,
                'category_id' => 55,
                'locale' => 'es',
                'slug' => 'es-literatura-y-poesía',
                'name' => 'Literatura y Poesía',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            369 => 
            array (
                'id' => 372,
                'category_id' => 56,
                'locale' => 'es',
                'slug' => 'es-música',
                'name' => 'Música',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            370 => 
            array (
                'id' => 373,
                'category_id' => 57,
                'locale' => 'es',
                'slug' => 'es-video-y-fotografía',
                'name' => 'Video y Fotografía',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            371 => 
            array (
                'id' => 374,
                'category_id' => 58,
                'locale' => 'es',
                'slug' => 'es-educación-general',
                'name' => 'Educación General',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            372 => 
            array (
                'id' => 375,
                'category_id' => 59,
                'locale' => 'es',
                'slug' => 'es-educación-primaria',
                'name' => 'Educación Primaria',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            373 => 
            array (
                'id' => 376,
                'category_id' => 60,
                'locale' => 'es',
                'slug' => 'es-educación-profesional',
                'name' => 'Educación Profesional',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            374 => 
            array (
                'id' => 377,
                'category_id' => 61,
                'locale' => 'es',
                'slug' => 'es-educación-secundaria',
                'name' => 'Educación Secundaria',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            375 => 
            array (
                'id' => 378,
                'category_id' => 62,
                'locale' => 'es',
                'slug' => 'es-educación-universitaria',
                'name' => 'Educación Universitaria',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            376 => 
            array (
                'id' => 379,
                'category_id' => 63,
                'locale' => 'es',
                'slug' => 'es-entretenimiento-y-actuaciones',
                'name' => 'Entretenimiento y Actuaciones',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            377 => 
            array (
                'id' => 380,
                'category_id' => 64,
                'locale' => 'es',
                'slug' => 'es-juegos',
                'name' => 'Juegos',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            378 => 
            array (
                'id' => 381,
                'category_id' => 65,
                'locale' => 'es',
                'slug' => 'es-limpieza-y-orden',
                'name' => 'Limpieza y Orden',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            379 => 
            array (
                'id' => 382,
                'category_id' => 66,
                'locale' => 'es',
                'slug' => 'es-recados',
                'name' => 'Recados',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            380 => 
            array (
                'id' => 383,
                'category_id' => 67,
                'locale' => 'es',
                'slug' => 'es-reparaciones',
                'name' => 'Reparaciones',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            381 => 
            array (
                'id' => 384,
                'category_id' => 68,
                'locale' => 'es',
                'slug' => 'es-contabilidad-y-administración-sin-fines-de-lucro',
            'name' => 'Contabilidad y Administración (sin fines de lucro)',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            382 => 
            array (
                'id' => 385,
                'category_id' => 69,
                'locale' => 'es',
                'slug' => 'es-organización-de-eventos',
                'name' => 'Organización de Eventos',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            383 => 
            array (
                'id' => 386,
                'category_id' => 70,
                'locale' => 'es',
                'slug' => 'es-finanzas',
                'name' => 'Finanzas',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            384 => 
            array (
                'id' => 387,
                'category_id' => 71,
                'locale' => 'es',
                'slug' => 'es-marketing',
                'name' => 'Marketing',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            385 => 
            array (
                'id' => 388,
                'category_id' => 72,
                'locale' => 'es',
                'slug' => 'es-gestión-de-proyectos',
                'name' => 'Gestión de Proyectos',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            386 => 
            array (
                'id' => 389,
                'category_id' => 73,
                'locale' => 'es',
                'slug' => 'es-pasatiempo',
                'name' => 'Pasatiempo',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            387 => 
            array (
                'id' => 390,
                'category_id' => 74,
                'locale' => 'es',
                'slug' => 'es-deportes',
                'name' => 'Deportes',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            388 => 
            array (
                'id' => 391,
                'category_id' => 75,
                'locale' => 'es',
                'slug' => 'es-ciencia-de-datos-y-análisis',
                'name' => 'Ciencia de Datos y Análisis',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            389 => 
            array (
                'id' => 392,
                'category_id' => 76,
                'locale' => 'es',
                'slug' => 'es-trabajo-de-campo',
                'name' => 'Trabajo de Campo',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            390 => 
            array (
                'id' => 393,
                'category_id' => 77,
                'locale' => 'es',
                'slug' => 'es-filosofía',
                'name' => 'Filosofía',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            391 => 
            array (
                'id' => 394,
                'category_id' => 78,
                'locale' => 'es',
                'slug' => 'es-investigación-y-desarrollo',
                'name' => 'Investigación y Desarrollo',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            392 => 
            array (
                'id' => 395,
                'category_id' => 79,
                'locale' => 'es',
                'slug' => 'es-automatización-y-robótica',
                'name' => 'Automatización y Robótica',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            393 => 
            array (
                'id' => 396,
                'category_id' => 80,
                'locale' => 'es',
                'slug' => 'es-computadoras-e-informática',
                'name' => 'Computadoras e Informática',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            394 => 
            array (
                'id' => 397,
                'category_id' => 81,
                'locale' => 'es',
                'slug' => 'es-electrónica',
                'name' => 'Electrónica',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            395 => 
            array (
                'id' => 398,
                'category_id' => 82,
                'locale' => 'es',
                'slug' => 'es-mecánica',
                'name' => 'Mecánica',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            396 => 
            array (
                'id' => 399,
                'category_id' => 83,
                'locale' => 'es',
                'slug' => 'es-entrega',
                'name' => 'Entrega',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            397 => 
            array (
                'id' => 400,
                'category_id' => 84,
                'locale' => 'es',
                'slug' => 'es-servicios-de-conductor',
                'name' => 'Servicios de Conductor',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
            398 => 
            array (
                'id' => 401,
                'category_id' => 85,
                'locale' => 'es',
                'slug' => 'es-servicios-de-mudanza',
                'name' => 'Servicios de Mudanza',
                'created_at' => '2023-06-05 00:00:00',
                'updated_at' => '2023-09-07 11:13:27',
            ),
        ));
        
        
    }
}