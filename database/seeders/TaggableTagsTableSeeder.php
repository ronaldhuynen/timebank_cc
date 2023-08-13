<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaggableTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taggable_tags')->delete();
        
        \DB::table('taggable_tags')->insert(array (
            0 => 
            array (
                'tag_id' => 1,
                'name' => 'geel',
                'normalized' => 'geel',
                'created_at' => '2023-08-11 14:42:30',
                'updated_at' => '2023-08-11 14:42:30',
            ),
            1 => 
            array (
                'tag_id' => 2,
                'name' => 'yellow',
                'normalized' => 'yellow',
                'created_at' => '2023-08-11 14:53:56',
                'updated_at' => '2023-08-11 14:53:56',
            ),
            2 => 
            array (
                'tag_id' => 3,
                'name' => 'Gelb',
                'normalized' => 'gelb',
                'created_at' => '2023-08-11 15:12:26',
                'updated_at' => '2023-08-11 15:12:26',
            ),
            3 => 
            array (
                'tag_id' => 4,
                'name' => 'lime',
                'normalized' => 'lime',
                'created_at' => '2023-08-11 15:27:53',
                'updated_at' => '2023-08-11 15:27:53',
            ),
            4 => 
            array (
                'tag_id' => 5,
                'name' => 'green',
                'normalized' => 'green',
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            5 => 
            array (
                'tag_id' => 6,
                'name' => 'groen',
                'normalized' => 'groen',
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            6 => 
            array (
                'tag_id' => 7,
                'name' => 'Grün',
                'normalized' => 'grün',
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            7 => 
            array (
                'tag_id' => 8,
                'name' => 'unexperienced',
                'normalized' => 'unexperienced',
                'created_at' => '2023-08-11 17:08:10',
                'updated_at' => '2023-08-11 17:08:10',
            ),
            8 => 
            array (
                'tag_id' => 9,
                'name' => 'green',
                'normalized' => 'green',
                'created_at' => '2023-08-11 21:07:16',
                'updated_at' => '2023-08-11 21:07:16',
            ),
            9 => 
            array (
                'tag_id' => 10,
                'name' => 'Wood working',
                'normalized' => 'wood working',
                'created_at' => '2023-08-12 00:02:43',
                'updated_at' => '2023-08-12 00:02:43',
            ),
            10 => 
            array (
                'tag_id' => 11,
                'name' => 'houtbewerking',
                'normalized' => 'houtbewerking',
                'created_at' => '2023-08-12 00:13:05',
                'updated_at' => '2023-08-12 00:13:05',
            ),
            11 => 
            array (
                'tag_id' => 13,
                'name' => 'Metal Working',
                'normalized' => 'metal working',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            12 => 
            array (
                'tag_id' => 14,
                'name' => 'Tutoring in Math',
                'normalized' => 'tutoring in math',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            13 => 
            array (
                'tag_id' => 15,
                'name' => 'Meal Delivery',
                'normalized' => 'meal delivery',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            14 => 
            array (
                'tag_id' => 16,
                'name' => 'Dog Walking',
                'normalized' => 'dog walking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            15 => 
            array (
                'tag_id' => 17,
                'name' => 'Childcare',
                'normalized' => 'childcare',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            16 => 
            array (
                'tag_id' => 18,
                'name' => 'Gardening Assistance',
                'normalized' => 'gardening assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            17 => 
            array (
                'tag_id' => 19,
                'name' => 'Home Repairs',
                'normalized' => 'home repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            18 => 
            array (
                'tag_id' => 20,
                'name' => 'Resume Writing',
                'normalized' => 'resume writing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            19 => 
            array (
                'tag_id' => 21,
                'name' => 'Grocery Shopping',
                'normalized' => 'grocery shopping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            20 => 
            array (
                'tag_id' => 22,
                'name' => 'Tech Support',
                'normalized' => 'tech support',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            21 => 
            array (
                'tag_id' => 23,
                'name' => 'Legal Advice',
                'normalized' => 'legal advice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            22 => 
            array (
                'tag_id' => 24,
                'name' => 'Fitness Coaching',
                'normalized' => 'fitness coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            23 => 
            array (
                'tag_id' => 25,
                'name' => 'Art Lessons',
                'normalized' => 'art lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            24 => 
            array (
                'tag_id' => 26,
                'name' => 'Financial Planning',
                'normalized' => 'financial planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            25 => 
            array (
                'tag_id' => 27,
                'name' => 'Home Cleaning',
                'normalized' => 'home cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            26 => 
            array (
                'tag_id' => 28,
                'name' => 'Music Lessons',
                'normalized' => 'music lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            27 => 
            array (
                'tag_id' => 29,
                'name' => 'Helping at Shelter',
                'normalized' => 'helping at shelter',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            28 => 
            array (
                'tag_id' => 30,
                'name' => 'Errand Running',
                'normalized' => 'errand running',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            29 => 
            array (
                'tag_id' => 31,
                'name' => 'Resume Review',
                'normalized' => 'resume review',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            30 => 
            array (
                'tag_id' => 32,
                'name' => 'Online Tech Help',
                'normalized' => 'online tech help',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            31 => 
            array (
                'tag_id' => 33,
                'name' => 'Legal Document Review',
                'normalized' => 'legal document review',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            32 => 
            array (
                'tag_id' => 34,
                'name' => 'Virtual Fitness Classes',
                'normalized' => 'virtual fitness classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            33 => 
            array (
                'tag_id' => 35,
                'name' => 'Craft Workshops',
                'normalized' => 'craft workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            34 => 
            array (
                'tag_id' => 36,
                'name' => 'Tax Filing Assistance',
                'normalized' => 'tax filing assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            35 => 
            array (
                'tag_id' => 37,
                'name' => 'Storytelling for Kids',
                'normalized' => 'storytelling for kids',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            36 => 
            array (
                'tag_id' => 38,
                'name' => 'Elderly Companionship',
                'normalized' => 'elderly companionship',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            37 => 
            array (
                'tag_id' => 39,
                'name' => 'Language Conversation Practice',
                'normalized' => 'language conversation practice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            38 => 
            array (
                'tag_id' => 40,
                'name' => 'Car Maintenance',
                'normalized' => 'car maintenance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            39 => 
            array (
                'tag_id' => 41,
                'name' => 'Social Media Management',
                'normalized' => 'social media management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            40 => 
            array (
                'tag_id' => 42,
                'name' => 'Photography Session',
                'normalized' => 'photography session',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            41 => 
            array (
                'tag_id' => 43,
                'name' => 'Career Coaching',
                'normalized' => 'career coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            42 => 
            array (
                'tag_id' => 44,
                'name' => 'Fitness Accountability Partner',
                'normalized' => 'fitness accountability partner',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            43 => 
            array (
                'tag_id' => 45,
                'name' => 'Technology Workshops for Seniors',
                'normalized' => 'technology workshops for seniors',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            44 => 
            array (
                'tag_id' => 46,
                'name' => 'Legal Consultation',
                'normalized' => 'legal consultation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            45 => 
            array (
                'tag_id' => 47,
                'name' => 'Virtual Study Groups',
                'normalized' => 'virtual study groups',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            46 => 
            array (
                'tag_id' => 48,
                'name' => 'Babysitting',
                'normalized' => 'babysitting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            47 => 
            array (
                'tag_id' => 49,
                'name' => 'Resume Formatting',
                'normalized' => 'resume formatting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            48 => 
            array (
                'tag_id' => 50,
                'name' => 'Meal Planning',
                'normalized' => 'meal planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            49 => 
            array (
                'tag_id' => 51,
                'name' => 'Eco-Friendly Workshops',
                'normalized' => 'eco-friendly workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            50 => 
            array (
                'tag_id' => 52,
                'name' => 'Homework Help',
                'normalized' => 'homework help',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            51 => 
            array (
                'tag_id' => 53,
                'name' => 'DIY Home Improvement Advice',
                'normalized' => 'diy home improvement advice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            52 => 
            array (
                'tag_id' => 54,
                'name' => 'Online Language Lessons',
                'normalized' => 'online language lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            53 => 
            array (
                'tag_id' => 55,
                'name' => 'Legal Aid Clinic',
                'normalized' => 'legal aid clinic',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            54 => 
            array (
                'tag_id' => 56,
                'name' => 'Virtual Art Exhibition',
                'normalized' => 'virtual art exhibition',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            55 => 
            array (
                'tag_id' => 57,
                'name' => 'Homemade Gift Creation',
                'normalized' => 'homemade gift creation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            56 => 
            array (
                'tag_id' => 58,
                'name' => 'Interview Coaching',
                'normalized' => 'interview coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            57 => 
            array (
                'tag_id' => 59,
                'name' => 'Online Fitness Challenges',
                'normalized' => 'online fitness challenges',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            58 => 
            array (
                'tag_id' => 60,
                'name' => 'Tech Workshops for Parents',
                'normalized' => 'tech workshops for parents',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            59 => 
            array (
                'tag_id' => 61,
                'name' => 'Legal Aid Hotline',
                'normalized' => 'legal aid hotline',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            60 => 
            array (
                'tag_id' => 62,
                'name' => 'Writing Workshops',
                'normalized' => 'writing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            61 => 
            array (
                'tag_id' => 63,
                'name' => 'Emergency Childcare',
                'normalized' => 'emergency childcare',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            62 => 
            array (
                'tag_id' => 64,
                'name' => 'Music Serenade',
                'normalized' => 'music serenade',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            63 => 
            array (
                'tag_id' => 65,
                'name' => 'Home Safety Evaluation',
                'normalized' => 'home safety evaluation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            64 => 
            array (
                'tag_id' => 66,
                'name' => 'Personal Shopping',
                'normalized' => 'personal shopping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            65 => 
            array (
                'tag_id' => 67,
                'name' => 'Digital Literacy Workshops',
                'normalized' => 'digital literacy workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            66 => 
            array (
                'tag_id' => 68,
                'name' => 'Emergency Preparedness Training',
                'normalized' => 'emergency preparedness training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            67 => 
            array (
                'tag_id' => 69,
                'name' => 'Virtual Book Club',
                'normalized' => 'virtual book club',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            68 => 
            array (
                'tag_id' => 70,
                'name' => 'Companion Animal Visits',
                'normalized' => 'companion animal visits',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            69 => 
            array (
                'tag_id' => 71,
                'name' => 'Outdoor Adventure Guiding',
                'normalized' => 'outdoor adventure guiding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            70 => 
            array (
                'tag_id' => 72,
                'name' => 'Family History Research',
                'normalized' => 'family history research',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            71 => 
            array (
                'tag_id' => 73,
                'name' => 'Homemade Soup Delivery',
                'normalized' => 'homemade soup delivery',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            72 => 
            array (
                'tag_id' => 74,
                'name' => 'Virtual Music Lessons',
                'normalized' => 'virtual music lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            73 => 
            array (
                'tag_id' => 75,
                'name' => 'Nature Cleanup Events',
                'normalized' => 'nature cleanup events',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            74 => 
            array (
                'tag_id' => 76,
                'name' => 'Handmade Greeting Cards',
                'normalized' => 'handmade greeting cards',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            75 => 
            array (
                'tag_id' => 77,
                'name' => 'Language Learning Exchange',
                'normalized' => 'language learning exchange',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            76 => 
            array (
                'tag_id' => 78,
                'name' => 'Online Mental Health Workshops',
                'normalized' => 'online mental health workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            77 => 
            array (
                'tag_id' => 79,
                'name' => 'Tech Repair Clinics',
                'normalized' => 'tech repair clinics',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            78 => 
            array (
                'tag_id' => 80,
                'name' => 'Community Garden Maintenance',
                'normalized' => 'community garden maintenance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            79 => 
            array (
                'tag_id' => 81,
                'name' => 'Art Therapy Sessions',
                'normalized' => 'art therapy sessions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            80 => 
            array (
                'tag_id' => 82,
                'name' => 'Writing Letters to Soldiers',
                'normalized' => 'writing letters to soldiers',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            81 => 
            array (
                'tag_id' => 83,
                'name' => 'Virtual Cooking Classes',
                'normalized' => 'virtual cooking classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            82 => 
            array (
                'tag_id' => 84,
                'name' => 'Resume Design',
                'normalized' => 'resume design',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            83 => 
            array (
                'tag_id' => 85,
                'name' => 'Local History Tours',
                'normalized' => 'local history tours',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            84 => 
            array (
                'tag_id' => 86,
                'name' => 'Online Music Jam Sessions',
                'normalized' => 'online music jam sessions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            85 => 
            array (
                'tag_id' => 87,
                'name' => 'Outdoor Yoga Workshops',
                'normalized' => 'outdoor yoga workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            86 => 
            array (
                'tag_id' => 88,
                'name' => 'Storytime for Kids',
                'normalized' => 'storytime for kids',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            87 => 
            array (
                'tag_id' => 89,
                'name' => 'Clothing Drives',
                'normalized' => 'clothing drives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            88 => 
            array (
                'tag_id' => 90,
                'name' => 'Virtual Coding Workshops',
                'normalized' => 'virtual coding workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            89 => 
            array (
                'tag_id' => 91,
                'name' => 'Community Cleanup Initiatives',
                'normalized' => 'community cleanup initiatives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            90 => 
            array (
                'tag_id' => 92,
                'name' => 'Homemade Baked Goods',
                'normalized' => 'homemade baked goods',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            91 => 
            array (
                'tag_id' => 93,
                'name' => 'Resume Workshop for Teens',
                'normalized' => 'resume workshop for teens',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            92 => 
            array (
                'tag_id' => 94,
                'name' => 'Volunteer Driver',
                'normalized' => 'volunteer driver',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            93 => 
            array (
                'tag_id' => 95,
                'name' => 'Origami Workshops',
                'normalized' => 'origami workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            94 => 
            array (
                'tag_id' => 96,
                'name' => 'Digital Literacy Support for Seniors',
                'normalized' => 'digital literacy support for seniors',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            95 => 
            array (
                'tag_id' => 97,
                'name' => 'Local Habitat Restoration',
                'normalized' => 'local habitat restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            96 => 
            array (
                'tag_id' => 98,
                'name' => 'Music Playlist Curation',
                'normalized' => 'music playlist curation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            97 => 
            array (
                'tag_id' => 99,
                'name' => 'Online Parenting Workshops',
                'normalized' => 'online parenting workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            98 => 
            array (
                'tag_id' => 100,
                'name' => 'Community Recipe Sharing',
                'normalized' => 'community recipe sharing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            99 => 
            array (
                'tag_id' => 101,
                'name' => 'Pet Adoption Events',
                'normalized' => 'pet adoption events',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            100 => 
            array (
                'tag_id' => 102,
                'name' => 'DIY Home Energy Audits',
                'normalized' => 'diy home energy audits',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            101 => 
            array (
                'tag_id' => 103,
                'name' => 'Support Group Facilitation',
                'normalized' => 'support group facilitation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            102 => 
            array (
                'tag_id' => 104,
                'name' => 'Environmental Education Workshops',
                'normalized' => 'environmental education workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            103 => 
            array (
                'tag_id' => 105,
                'name' => 'Neighborhood Watch Coordinator',
                'normalized' => 'neighborhood watch coordinator',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            104 => 
            array (
                'tag_id' => 106,
                'name' => 'Disaster Relief Fundraising',
                'normalized' => 'disaster relief fundraising',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            105 => 
            array (
                'tag_id' => 107,
                'name' => 'Fitness Equipment Lending',
                'normalized' => 'fitness equipment lending',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            106 => 
            array (
                'tag_id' => 108,
                'name' => 'Emergency First Aid Training',
                'normalized' => 'emergency first aid training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            107 => 
            array (
                'tag_id' => 109,
                'name' => 'Personalized Music Playlists',
                'normalized' => 'personalized music playlists',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            108 => 
            array (
                'tag_id' => 110,
                'name' => 'Community Cookbook Creation',
                'normalized' => 'community cookbook creation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            109 => 
            array (
                'tag_id' => 111,
                'name' => 'Language Tutoring for Kids',
                'normalized' => 'language tutoring for kids',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            110 => 
            array (
                'tag_id' => 112,
                'name' => 'Tech Device Setup Assistance',
                'normalized' => 'tech device setup assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            111 => 
            array (
                'tag_id' => 113,
                'name' => 'Home Energy Conservation Workshops',
                'normalized' => 'home energy conservation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            112 => 
            array (
                'tag_id' => 114,
                'name' => 'Career Mentorship',
                'normalized' => 'career mentorship',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            113 => 
            array (
                'tag_id' => 115,
                'name' => 'Home-cooked Meal Delivery',
                'normalized' => 'home-cooked meal delivery',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            114 => 
            array (
                'tag_id' => 116,
                'name' => 'Teaching Practical Skills',
                'normalized' => 'teaching practical skills',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            115 => 
            array (
                'tag_id' => 117,
                'name' => 'Planting Trees',
                'normalized' => 'planting trees',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            116 => 
            array (
                'tag_id' => 118,
                'name' => 'Community Gardening',
                'normalized' => 'community gardening',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            117 => 
            array (
                'tag_id' => 119,
                'name' => 'Storytelling Sessions',
                'normalized' => 'storytelling sessions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            118 => 
            array (
                'tag_id' => 120,
                'name' => 'Visiting Nursing Homes',
                'normalized' => 'visiting nursing homes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            119 => 
            array (
                'tag_id' => 121,
                'name' => 'Helping at Shelters',
                'normalized' => 'helping at shelters',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            120 => 
            array (
                'tag_id' => 122,
                'name' => 'Mentoring Youth',
                'normalized' => 'mentoring youth',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            121 => 
            array (
                'tag_id' => 123,
                'name' => 'Street Art Beautification',
                'normalized' => 'street art beautification',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            122 => 
            array (
                'tag_id' => 124,
                'name' => 'Organizing Neighborhood Events',
                'normalized' => 'organizing neighborhood events',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            123 => 
            array (
                'tag_id' => 125,
                'name' => 'Supporting Animal Shelters',
                'normalized' => 'supporting animal shelters',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            124 => 
            array (
                'tag_id' => 126,
                'name' => 'Tutoring',
                'normalized' => 'tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            125 => 
            array (
                'tag_id' => 127,
                'name' => 'Emergency Assistance',
                'normalized' => 'emergency assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            126 => 
            array (
                'tag_id' => 128,
                'name' => 'Donating Blood',
                'normalized' => 'donating blood',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            127 => 
            array (
                'tag_id' => 129,
                'name' => 'Park Cleanup',
                'normalized' => 'park cleanup',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            128 => 
            array (
                'tag_id' => 130,
                'name' => 'Supporting Local Libraries',
                'normalized' => 'supporting local libraries',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            129 => 
            array (
                'tag_id' => 131,
                'name' => 'Teaching Art Workshops',
                'normalized' => 'teaching art workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            130 => 
            array (
                'tag_id' => 132,
                'name' => 'Senior Companion',
                'normalized' => 'senior companion',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            131 => 
            array (
                'tag_id' => 133,
                'name' => 'Supporting Veterans',
                'normalized' => 'supporting veterans',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            132 => 
            array (
                'tag_id' => 134,
                'name' => 'Helping at Schools',
                'normalized' => 'helping at schools',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            133 => 
            array (
                'tag_id' => 135,
                'name' => 'Local Charity Drives',
                'normalized' => 'local charity drives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            134 => 
            array (
                'tag_id' => 136,
                'name' => 'Community Sports Coaching',
                'normalized' => 'community sports coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            135 => 
            array (
                'tag_id' => 137,
                'name' => 'Language Exchange',
                'normalized' => 'language exchange',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            136 => 
            array (
                'tag_id' => 138,
                'name' => 'Community Workshops',
                'normalized' => 'community workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            137 => 
            array (
                'tag_id' => 139,
                'name' => 'Outdoor Cleanup',
                'normalized' => 'outdoor cleanup',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            138 => 
            array (
                'tag_id' => 140,
                'name' => 'Volunteer Firefighting',
                'normalized' => 'volunteer firefighting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            139 => 
            array (
                'tag_id' => 141,
                'name' => 'Supporting Single Parents',
                'normalized' => 'supporting single parents',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            140 => 
            array (
                'tag_id' => 142,
                'name' => 'Public Space Renovation',
                'normalized' => 'public space renovation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            141 => 
            array (
                'tag_id' => 143,
                'name' => 'Adopting Shelter Pets',
                'normalized' => 'adopting shelter pets',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            142 => 
            array (
                'tag_id' => 144,
                'name' => 'Assisting the Homeless',
                'normalized' => 'assisting the homeless',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            143 => 
            array (
                'tag_id' => 145,
                'name' => 'Local Music Performances',
                'normalized' => 'local music performances',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            144 => 
            array (
                'tag_id' => 146,
                'name' => 'Supporting Local Farmers',
                'normalized' => 'supporting local farmers',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            145 => 
            array (
                'tag_id' => 147,
                'name' => 'Community Repairs',
                'normalized' => 'community repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            146 => 
            array (
                'tag_id' => 148,
                'name' => 'Teaching Traditional Crafts',
                'normalized' => 'teaching traditional crafts',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            147 => 
            array (
                'tag_id' => 149,
                'name' => 'Neighborhood Watch',
                'normalized' => 'neighborhood watch',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            148 => 
            array (
                'tag_id' => 150,
                'name' => 'Elderly Yard Care',
                'normalized' => 'elderly yard care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            149 => 
            array (
                'tag_id' => 151,
                'name' => 'Supporting School Activities',
                'normalized' => 'supporting school activities',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            150 => 
            array (
                'tag_id' => 152,
                'name' => 'Youth Sports Coaching',
                'normalized' => 'youth sports coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            151 => 
            array (
                'tag_id' => 153,
                'name' => 'Community Newsletter',
                'normalized' => 'community newsletter',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            152 => 
            array (
                'tag_id' => 154,
                'name' => 'Local Environmental Initiatives',
                'normalized' => 'local environmental initiatives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            153 => 
            array (
                'tag_id' => 155,
                'name' => 'Supporting Refugee Families',
                'normalized' => 'supporting refugee families',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            154 => 
            array (
                'tag_id' => 156,
                'name' => 'Neighborhood Beautification',
                'normalized' => 'neighborhood beautification',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            155 => 
            array (
                'tag_id' => 157,
                'name' => 'Assisting Disabled Individuals',
                'normalized' => 'assisting disabled individuals',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            156 => 
            array (
                'tag_id' => 158,
                'name' => 'Community Emergency Response',
                'normalized' => 'community emergency response',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            157 => 
            array (
                'tag_id' => 159,
                'name' => 'Supporting Youth Education',
                'normalized' => 'supporting youth education',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            158 => 
            array (
                'tag_id' => 160,
                'name' => 'Local Cultural Celebrations',
                'normalized' => 'local cultural celebrations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            159 => 
            array (
                'tag_id' => 161,
                'name' => 'Promoting Recycling',
                'normalized' => 'promoting recycling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            160 => 
            array (
                'tag_id' => 162,
                'name' => 'Supporting Local Arts',
                'normalized' => 'supporting local arts',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            161 => 
            array (
                'tag_id' => 163,
                'name' => 'Financial Literacy Workshops',
                'normalized' => 'financial literacy workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            162 => 
            array (
                'tag_id' => 164,
                'name' => 'Healthy Cooking Classes',
                'normalized' => 'healthy cooking classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            163 => 
            array (
                'tag_id' => 165,
                'name' => 'Career Coaching',
                'normalized' => 'career coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            164 => 
            array (
                'tag_id' => 166,
                'name' => 'Language Tutoring',
                'normalized' => 'language tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            165 => 
            array (
                'tag_id' => 167,
                'name' => 'Fitness Training',
                'normalized' => 'fitness training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            166 => 
            array (
                'tag_id' => 168,
                'name' => 'Homesteading Workshops',
                'normalized' => 'homesteading workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            167 => 
            array (
                'tag_id' => 169,
                'name' => 'Study Skills Workshops',
                'normalized' => 'study skills workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            168 => 
            array (
                'tag_id' => 170,
                'name' => 'Parenting Advice Sessions',
                'normalized' => 'parenting advice sessions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            169 => 
            array (
                'tag_id' => 171,
                'name' => 'Nutrition Consultations',
                'normalized' => 'nutrition consultations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            170 => 
            array (
                'tag_id' => 172,
                'name' => 'DIY Home Improvement Workshops',
                'normalized' => 'diy home improvement workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            171 => 
            array (
                'tag_id' => 173,
                'name' => 'Public Speaking Coaching',
                'normalized' => 'public speaking coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            172 => 
            array (
                'tag_id' => 174,
                'name' => 'Academic Subject Tutoring',
                'normalized' => 'academic subject tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            173 => 
            array (
                'tag_id' => 175,
                'name' => 'Life Coaching',
                'normalized' => 'life coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            174 => 
            array (
                'tag_id' => 176,
                'name' => 'Artistic Skill Workshops',
                'normalized' => 'artistic skill workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            175 => 
            array (
                'tag_id' => 177,
                'name' => 'Home Organization Advice',
                'normalized' => 'home organization advice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            176 => 
            array (
                'tag_id' => 178,
                'name' => 'Career Development Seminars',
                'normalized' => 'career development seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            177 => 
            array (
                'tag_id' => 179,
                'name' => 'Financial Planning Consultations',
                'normalized' => 'financial planning consultations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            178 => 
            array (
                'tag_id' => 180,
                'name' => 'Healthy Lifestyle Coaching',
                'normalized' => 'healthy lifestyle coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            179 => 
            array (
                'tag_id' => 181,
                'name' => 'Mindfulness Meditation Workshops',
                'normalized' => 'mindfulness meditation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            180 => 
            array (
                'tag_id' => 182,
                'name' => 'Creative Writing Workshops',
                'normalized' => 'creative writing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            181 => 
            array (
                'tag_id' => 183,
                'name' => 'Personal Branding Workshops',
                'normalized' => 'personal branding workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            182 => 
            array (
                'tag_id' => 184,
                'name' => 'Study Abroad Advising',
                'normalized' => 'study abroad advising',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            183 => 
            array (
                'tag_id' => 185,
                'name' => 'Home Gardening Advice',
                'normalized' => 'home gardening advice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            184 => 
            array (
                'tag_id' => 186,
                'name' => 'Entrepreneurship Coaching',
                'normalized' => 'entrepreneurship coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            185 => 
            array (
                'tag_id' => 187,
                'name' => 'Resume Writing Workshops',
                'normalized' => 'resume writing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            186 => 
            array (
                'tag_id' => 188,
                'name' => 'Relationship Counseling',
                'normalized' => 'relationship counseling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            187 => 
            array (
                'tag_id' => 189,
                'name' => 'Photography Technique Workshops',
                'normalized' => 'photography technique workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            188 => 
            array (
                'tag_id' => 190,
                'name' => 'Time Management Workshops',
                'normalized' => 'time management workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            189 => 
            array (
                'tag_id' => 191,
                'name' => 'Stress Reduction Workshops',
                'normalized' => 'stress reduction workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            190 => 
            array (
                'tag_id' => 192,
                'name' => 'Financial Investment Seminars',
                'normalized' => 'financial investment seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            191 => 
            array (
                'tag_id' => 193,
                'name' => 'Health and Wellness Coaching',
                'normalized' => 'health and wellness coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            192 => 
            array (
                'tag_id' => 194,
                'name' => 'Job Interview Preparation',
                'normalized' => 'job interview preparation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            193 => 
            array (
                'tag_id' => 195,
                'name' => 'Cooking Nutrition Workshops',
                'normalized' => 'cooking nutrition workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            194 => 
            array (
                'tag_id' => 196,
                'name' => 'Study Group Facilitation',
                'normalized' => 'study group facilitation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            195 => 
            array (
                'tag_id' => 197,
                'name' => 'College Application Advising',
                'normalized' => 'college application advising',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            196 => 
            array (
                'tag_id' => 198,
                'name' => 'Mindset Coaching',
                'normalized' => 'mindset coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            197 => 
            array (
                'tag_id' => 199,
                'name' => 'Language Pronunciation Coaching',
                'normalized' => 'language pronunciation coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            198 => 
            array (
                'tag_id' => 200,
                'name' => 'Fitness and Nutrition Consultations',
                'normalized' => 'fitness and nutrition consultations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            199 => 
            array (
                'tag_id' => 201,
                'name' => 'Art Portfolio Review',
                'normalized' => 'art portfolio review',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            200 => 
            array (
                'tag_id' => 202,
                'name' => 'Career Transition Coaching',
                'normalized' => 'career transition coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            201 => 
            array (
                'tag_id' => 203,
                'name' => 'Academic Advising',
                'normalized' => 'academic advising',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            202 => 
            array (
                'tag_id' => 204,
                'name' => 'Wellness Seminars',
                'normalized' => 'wellness seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            203 => 
            array (
                'tag_id' => 205,
                'name' => 'Personal Finance Workshops',
                'normalized' => 'personal finance workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            204 => 
            array (
                'tag_id' => 206,
                'name' => 'Creative Writing Critique',
                'normalized' => 'creative writing critique',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            205 => 
            array (
                'tag_id' => 207,
                'name' => 'Professional Development Coaching',
                'normalized' => 'professional development coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            206 => 
            array (
                'tag_id' => 208,
                'name' => 'Effective Communication Workshops',
                'normalized' => 'effective communication workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            207 => 
            array (
                'tag_id' => 209,
                'name' => 'Resume Review',
                'normalized' => 'resume review',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            208 => 
            array (
                'tag_id' => 210,
                'name' => 'Mock Job Interviews',
                'normalized' => 'mock job interviews',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            209 => 
            array (
                'tag_id' => 211,
                'name' => 'LinkedIn Profile Optimization',
                'normalized' => 'linkedin profile optimization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            210 => 
            array (
                'tag_id' => 212,
                'name' => 'Business Consulting',
                'normalized' => 'business consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            211 => 
            array (
                'tag_id' => 213,
                'name' => 'Financial Planning Consultations',
                'normalized' => 'financial planning consultations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            212 => 
            array (
                'tag_id' => 214,
                'name' => 'Executive Coaching',
                'normalized' => 'executive coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            213 => 
            array (
                'tag_id' => 215,
                'name' => 'Networking Strategy',
                'normalized' => 'networking strategy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            214 => 
            array (
                'tag_id' => 216,
                'name' => 'Entrepreneurship Mentorship',
                'normalized' => 'entrepreneurship mentorship',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            215 => 
            array (
                'tag_id' => 217,
                'name' => 'Interview Preparation',
                'normalized' => 'interview preparation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            216 => 
            array (
                'tag_id' => 218,
                'name' => 'Personal Branding Consultations',
                'normalized' => 'personal branding consultations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            217 => 
            array (
                'tag_id' => 219,
                'name' => 'Career Transition Coaching',
                'normalized' => 'career transition coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            218 => 
            array (
                'tag_id' => 220,
                'name' => 'Strategic Planning Workshops',
                'normalized' => 'strategic planning workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            219 => 
            array (
                'tag_id' => 221,
                'name' => 'Financial Investment Advice',
                'normalized' => 'financial investment advice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            220 => 
            array (
                'tag_id' => 222,
                'name' => 'Business Growth Seminars',
                'normalized' => 'business growth seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            221 => 
            array (
                'tag_id' => 223,
                'name' => 'Professional Development Plans',
                'normalized' => 'professional development plans',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            222 => 
            array (
                'tag_id' => 224,
                'name' => 'Leadership Development',
                'normalized' => 'leadership development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            223 => 
            array (
                'tag_id' => 225,
                'name' => 'Negotiation Skills Training',
                'normalized' => 'negotiation skills training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            224 => 
            array (
                'tag_id' => 226,
                'name' => 'Financial Literacy Workshops',
                'normalized' => 'financial literacy workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            225 => 
            array (
                'tag_id' => 227,
                'name' => 'Business Model Analysis',
                'normalized' => 'business model analysis',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            226 => 
            array (
                'tag_id' => 228,
                'name' => 'Conflict Resolution',
                'normalized' => 'conflict resolution',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            227 => 
            array (
                'tag_id' => 229,
                'name' => 'Public Speaking Coaching',
                'normalized' => 'public speaking coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            228 => 
            array (
                'tag_id' => 230,
                'name' => 'Marketing Strategy Consultations',
                'normalized' => 'marketing strategy consultations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            229 => 
            array (
                'tag_id' => 231,
                'name' => 'IT Consultation',
                'normalized' => 'it consultation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            230 => 
            array (
                'tag_id' => 232,
                'name' => 'Career Path Planning',
                'normalized' => 'career path planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            231 => 
            array (
                'tag_id' => 233,
                'name' => 'Business Process Optimization',
                'normalized' => 'business process optimization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            232 => 
            array (
                'tag_id' => 234,
                'name' => 'Presentation Skills Coaching',
                'normalized' => 'presentation skills coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            233 => 
            array (
                'tag_id' => 235,
                'name' => 'Financial Management Workshops',
                'normalized' => 'financial management workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            234 => 
            array (
                'tag_id' => 236,
                'name' => 'Project Management Consultation',
                'normalized' => 'project management consultation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            235 => 
            array (
                'tag_id' => 237,
                'name' => 'Marketing Campaign Review',
                'normalized' => 'marketing campaign review',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            236 => 
            array (
                'tag_id' => 238,
                'name' => 'Time Management Strategies',
                'normalized' => 'time management strategies',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            237 => 
            array (
                'tag_id' => 239,
                'name' => 'Sales Strategy Workshops',
                'normalized' => 'sales strategy workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            238 => 
            array (
                'tag_id' => 240,
                'name' => 'Business Analytics Advice',
                'normalized' => 'business analytics advice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            239 => 
            array (
                'tag_id' => 241,
                'name' => 'Leadership Assessment',
                'normalized' => 'leadership assessment',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            240 => 
            array (
                'tag_id' => 242,
                'name' => 'Marketing Plan Development',
                'normalized' => 'marketing plan development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            241 => 
            array (
                'tag_id' => 243,
                'name' => 'Financial Goal Setting',
                'normalized' => 'financial goal setting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            242 => 
            array (
                'tag_id' => 244,
                'name' => 'Strategic Partnerships Advice',
                'normalized' => 'strategic partnerships advice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            243 => 
            array (
                'tag_id' => 245,
                'name' => 'Negotiation Strategy Workshops',
                'normalized' => 'negotiation strategy workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            244 => 
            array (
                'tag_id' => 246,
                'name' => 'Business Succession Planning',
                'normalized' => 'business succession planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            245 => 
            array (
                'tag_id' => 247,
                'name' => 'Executive Presence Coaching',
                'normalized' => 'executive presence coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            246 => 
            array (
                'tag_id' => 248,
                'name' => 'IT Security Consultation',
                'normalized' => 'it security consultation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            247 => 
            array (
                'tag_id' => 249,
                'name' => 'Brand Identity Assessment',
                'normalized' => 'brand identity assessment',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            248 => 
            array (
                'tag_id' => 250,
                'name' => 'Supply Chain Optimization',
                'normalized' => 'supply chain optimization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            249 => 
            array (
                'tag_id' => 251,
                'name' => 'Conflict Management Workshops',
                'normalized' => 'conflict management workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            250 => 
            array (
                'tag_id' => 252,
                'name' => 'Professional Ethics Consultation',
                'normalized' => 'professional ethics consultation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            251 => 
            array (
                'tag_id' => 253,
                'name' => 'Business Sustainability Strategy',
                'normalized' => 'business sustainability strategy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            252 => 
            array (
                'tag_id' => 254,
                'name' => 'Brand Positioning Consultation',
                'normalized' => 'brand positioning consultation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            253 => 
            array (
                'tag_id' => 255,
                'name' => 'Change Management Coaching',
                'normalized' => 'change management coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            254 => 
            array (
                'tag_id' => 256,
                'name' => 'Basketball Coaching',
                'normalized' => 'basketball coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            255 => 
            array (
                'tag_id' => 257,
                'name' => 'Soccer Training',
                'normalized' => 'soccer training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            256 => 
            array (
                'tag_id' => 258,
                'name' => 'Tennis Lessons',
                'normalized' => 'tennis lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            257 => 
            array (
                'tag_id' => 259,
                'name' => 'Swimming Instruction',
                'normalized' => 'swimming instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            258 => 
            array (
                'tag_id' => 260,
                'name' => 'Golf Coaching',
                'normalized' => 'golf coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            259 => 
            array (
                'tag_id' => 261,
                'name' => 'Baseball Skill Workshops',
                'normalized' => 'baseball skill workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            260 => 
            array (
                'tag_id' => 262,
                'name' => 'Running Training',
                'normalized' => 'running training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            261 => 
            array (
                'tag_id' => 263,
                'name' => 'Volleyball Clinics',
                'normalized' => 'volleyball clinics',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            262 => 
            array (
                'tag_id' => 264,
                'name' => 'Martial Arts Classes',
                'normalized' => 'martial arts classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            263 => 
            array (
                'tag_id' => 265,
                'name' => 'Cycling Workshops',
                'normalized' => 'cycling workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            264 => 
            array (
                'tag_id' => 266,
                'name' => 'Softball Instruction',
                'normalized' => 'softball instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            265 => 
            array (
                'tag_id' => 267,
                'name' => 'Basketball Shooting Clinics',
                'normalized' => 'basketball shooting clinics',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            266 => 
            array (
                'tag_id' => 268,
                'name' => 'Skiing or Snowboarding Lessons',
                'normalized' => 'skiing or snowboarding lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            267 => 
            array (
                'tag_id' => 269,
                'name' => 'Gymnastics Training',
                'normalized' => 'gymnastics training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            268 => 
            array (
                'tag_id' => 270,
                'name' => 'Rugby Skill Development',
                'normalized' => 'rugby skill development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            269 => 
            array (
                'tag_id' => 271,
                'name' => 'Rock Climbing Lessons',
                'normalized' => 'rock climbing lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            270 => 
            array (
                'tag_id' => 272,
                'name' => 'Surfing Coaching',
                'normalized' => 'surfing coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            271 => 
            array (
                'tag_id' => 273,
                'name' => 'Tennis Workshops',
                'normalized' => 'tennis workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            272 => 
            array (
                'tag_id' => 274,
                'name' => 'Dance Choreography for Sports',
                'normalized' => 'dance choreography for sports',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            273 => 
            array (
                'tag_id' => 275,
                'name' => 'Hiking Guide',
                'normalized' => 'hiking guide',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            274 => 
            array (
                'tag_id' => 276,
                'name' => 'Archery Instruction',
                'normalized' => 'archery instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            275 => 
            array (
                'tag_id' => 277,
                'name' => 'Hockey Skills Training',
                'normalized' => 'hockey skills training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            276 => 
            array (
                'tag_id' => 278,
                'name' => 'Yoga for Athletes',
                'normalized' => 'yoga for athletes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            277 => 
            array (
                'tag_id' => 279,
                'name' => 'Ultimate Frisbee Workshops',
                'normalized' => 'ultimate frisbee workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            278 => 
            array (
                'tag_id' => 280,
                'name' => 'Kayaking or Canoeing Lessons',
                'normalized' => 'kayaking or canoeing lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            279 => 
            array (
                'tag_id' => 281,
                'name' => 'Boxing or Kickboxing Training',
                'normalized' => 'boxing or kickboxing training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            280 => 
            array (
                'tag_id' => 282,
                'name' => 'Football Coaching',
                'normalized' => 'football coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            281 => 
            array (
                'tag_id' => 283,
                'name' => 'Pilates for Athletes',
                'normalized' => 'pilates for athletes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            282 => 
            array (
                'tag_id' => 284,
                'name' => 'Taekwondo Instruction',
                'normalized' => 'taekwondo instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            283 => 
            array (
                'tag_id' => 285,
                'name' => 'Synchronized Swimming Workshops',
                'normalized' => 'synchronized swimming workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            284 => 
            array (
                'tag_id' => 286,
                'name' => 'Racquetball or Squash Lessons',
                'normalized' => 'racquetball or squash lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            285 => 
            array (
                'tag_id' => 287,
                'name' => 'Climbing Techniques Coaching',
                'normalized' => 'climbing techniques coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            286 => 
            array (
                'tag_id' => 288,
                'name' => 'Skateboarding Instruction',
                'normalized' => 'skateboarding instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            287 => 
            array (
                'tag_id' => 289,
                'name' => 'CrossFit Training',
                'normalized' => 'crossfit training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            288 => 
            array (
                'tag_id' => 290,
                'name' => 'Field Hockey Skill Development',
                'normalized' => 'field hockey skill development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            289 => 
            array (
                'tag_id' => 291,
                'name' => 'Paddleboarding Lessons',
                'normalized' => 'paddleboarding lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            290 => 
            array (
                'tag_id' => 292,
                'name' => 'Wrestling Coaching',
                'normalized' => 'wrestling coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            291 => 
            array (
                'tag_id' => 293,
                'name' => 'Parkour Workshops',
                'normalized' => 'parkour workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            292 => 
            array (
                'tag_id' => 294,
                'name' => 'Ice Skating Lessons',
                'normalized' => 'ice skating lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            293 => 
            array (
                'tag_id' => 295,
                'name' => 'Rowing Instruction',
                'normalized' => 'rowing instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            294 => 
            array (
                'tag_id' => 296,
                'name' => 'Karate Training',
                'normalized' => 'karate training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            295 => 
            array (
                'tag_id' => 297,
                'name' => 'Trampoline Skills Coaching',
                'normalized' => 'trampoline skills coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            296 => 
            array (
                'tag_id' => 298,
                'name' => 'Badminton Lessons',
                'normalized' => 'badminton lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            297 => 
            array (
                'tag_id' => 299,
                'name' => 'Mountain Biking Workshops',
                'normalized' => 'mountain biking workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            298 => 
            array (
                'tag_id' => 300,
                'name' => 'Aerobics for Athletes',
                'normalized' => 'aerobics for athletes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            299 => 
            array (
                'tag_id' => 301,
                'name' => 'Beach Volleyball Instruction',
                'normalized' => 'beach volleyball instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            300 => 
            array (
                'tag_id' => 302,
                'name' => 'Skate Skiing Lessons',
                'normalized' => 'skate skiing lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            301 => 
            array (
                'tag_id' => 303,
                'name' => 'Fencing Coaching',
                'normalized' => 'fencing coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            302 => 
            array (
                'tag_id' => 304,
                'name' => 'Mountain Climbing Training',
                'normalized' => 'mountain climbing training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            303 => 
            array (
                'tag_id' => 305,
                'name' => 'Water Polo Skill Workshops',
                'normalized' => 'water polo skill workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            304 => 
            array (
                'tag_id' => 306,
                'name' => 'Ultimate Frisbee Coaching',
                'normalized' => 'ultimate frisbee coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            305 => 
            array (
                'tag_id' => 307,
                'name' => 'Long-distance Running Training',
                'normalized' => 'long-distance running training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            306 => 
            array (
                'tag_id' => 308,
                'name' => 'Rhythmic Gymnastics Lessons',
                'normalized' => 'rhythmic gymnastics lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            307 => 
            array (
                'tag_id' => 309,
                'name' => 'Triathlon Preparation',
                'normalized' => 'triathlon preparation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            308 => 
            array (
                'tag_id' => 310,
                'name' => 'Cricket Skill Development',
                'normalized' => 'cricket skill development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            309 => 
            array (
                'tag_id' => 311,
                'name' => 'Mountain Biking Coaching',
                'normalized' => 'mountain biking coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            310 => 
            array (
                'tag_id' => 312,
                'name' => 'Track and Field Training',
                'normalized' => 'track and field training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            311 => 
            array (
                'tag_id' => 313,
                'name' => 'Handball Instruction',
                'normalized' => 'handball instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            312 => 
            array (
                'tag_id' => 314,
                'name' => 'Powerlifting Coaching',
                'normalized' => 'powerlifting coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            313 => 
            array (
                'tag_id' => 315,
                'name' => 'Bowling Skill Workshops',
                'normalized' => 'bowling skill workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            314 => 
            array (
                'tag_id' => 316,
                'name' => 'Table Tennis Lessons',
                'normalized' => 'table tennis lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            315 => 
            array (
                'tag_id' => 317,
                'name' => 'Rock Climbing Coaching',
                'normalized' => 'rock climbing coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            316 => 
            array (
                'tag_id' => 318,
                'name' => 'Pole Vaulting Training',
                'normalized' => 'pole vaulting training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            317 => 
            array (
                'tag_id' => 319,
                'name' => 'Inline Skating Workshops',
                'normalized' => 'inline skating workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            318 => 
            array (
                'tag_id' => 320,
                'name' => 'Rowing Coaching',
                'normalized' => 'rowing coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            319 => 
            array (
                'tag_id' => 321,
                'name' => 'Mountain Boarding Lessons',
                'normalized' => 'mountain boarding lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            320 => 
            array (
                'tag_id' => 322,
                'name' => 'Snowshoeing Instruction',
                'normalized' => 'snowshoeing instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            321 => 
            array (
                'tag_id' => 323,
                'name' => 'Sailing Skill Workshops',
                'normalized' => 'sailing skill workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            322 => 
            array (
                'tag_id' => 324,
                'name' => 'Box Lacrosse Coaching',
                'normalized' => 'box lacrosse coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            323 => 
            array (
                'tag_id' => 325,
                'name' => 'Squash Instruction',
                'normalized' => 'squash instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            324 => 
            array (
                'tag_id' => 326,
                'name' => 'Canoe Polo Training',
                'normalized' => 'canoe polo training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            325 => 
            array (
                'tag_id' => 327,
                'name' => 'Inline Hockey Coaching',
                'normalized' => 'inline hockey coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            326 => 
            array (
                'tag_id' => 328,
                'name' => 'Paddle Tennis Lessons',
                'normalized' => 'paddle tennis lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            327 => 
            array (
                'tag_id' => 329,
                'name' => 'Freestyle Skiing Workshops',
                'normalized' => 'freestyle skiing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            328 => 
            array (
                'tag_id' => 330,
                'name' => 'Indoor Volleyball Coaching',
                'normalized' => 'indoor volleyball coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            329 => 
            array (
                'tag_id' => 331,
                'name' => 'Field Archery Instruction',
                'normalized' => 'field archery instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            330 => 
            array (
                'tag_id' => 332,
                'name' => 'Rugby Coaching',
                'normalized' => 'rugby coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            331 => 
            array (
                'tag_id' => 333,
                'name' => 'Ultimate Frisbee Skill Clinics',
                'normalized' => 'ultimate frisbee skill clinics',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            332 => 
            array (
                'tag_id' => 334,
                'name' => 'Water Skiing Lessons',
                'normalized' => 'water skiing lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            333 => 
            array (
                'tag_id' => 335,
                'name' => 'Karate Coaching',
                'normalized' => 'karate coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            334 => 
            array (
                'tag_id' => 336,
                'name' => 'Surfing Instruction',
                'normalized' => 'surfing instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            335 => 
            array (
                'tag_id' => 337,
                'name' => 'Basketball Skill Workshops',
                'normalized' => 'basketball skill workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            336 => 
            array (
                'tag_id' => 338,
                'name' => 'Tennis Coaching for Juniors',
                'normalized' => 'tennis coaching for juniors',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            337 => 
            array (
                'tag_id' => 339,
                'name' => 'Martial Arts for Self-defense',
                'normalized' => 'martial arts for self-defense',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            338 => 
            array (
                'tag_id' => 340,
                'name' => 'Piano Lessons',
                'normalized' => 'piano lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            339 => 
            array (
                'tag_id' => 341,
                'name' => 'Guitar Instruction',
                'normalized' => 'guitar instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            340 => 
            array (
                'tag_id' => 342,
                'name' => 'Singing Workshops',
                'normalized' => 'singing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            341 => 
            array (
                'tag_id' => 343,
                'name' => 'Violin Tutoring',
                'normalized' => 'violin tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            342 => 
            array (
                'tag_id' => 344,
                'name' => 'Drumming Lessons',
                'normalized' => 'drumming lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            343 => 
            array (
                'tag_id' => 345,
                'name' => 'Flute Instruction',
                'normalized' => 'flute instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            344 => 
            array (
                'tag_id' => 346,
                'name' => 'Songwriting Workshops',
                'normalized' => 'songwriting workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            345 => 
            array (
                'tag_id' => 347,
                'name' => 'Voice Coaching',
                'normalized' => 'voice coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            346 => 
            array (
                'tag_id' => 348,
                'name' => 'Trumpet Lessons',
                'normalized' => 'trumpet lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            347 => 
            array (
                'tag_id' => 349,
                'name' => 'Bass Guitar Instruction',
                'normalized' => 'bass guitar instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            348 => 
            array (
                'tag_id' => 350,
                'name' => 'Music Theory Classes',
                'normalized' => 'music theory classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            349 => 
            array (
                'tag_id' => 351,
                'name' => 'Cello Tutoring',
                'normalized' => 'cello tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            350 => 
            array (
                'tag_id' => 352,
                'name' => 'Vocal Harmony Workshops',
                'normalized' => 'vocal harmony workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            351 => 
            array (
                'tag_id' => 353,
                'name' => 'Saxophone Instruction',
                'normalized' => 'saxophone instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            352 => 
            array (
                'tag_id' => 354,
                'name' => 'Electronic Music Production',
                'normalized' => 'electronic music production',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            353 => 
            array (
                'tag_id' => 355,
                'name' => 'Keyboard Skills Coaching',
                'normalized' => 'keyboard skills coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            354 => 
            array (
                'tag_id' => 356,
                'name' => 'Clarinet Lessons',
                'normalized' => 'clarinet lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            355 => 
            array (
                'tag_id' => 357,
                'name' => 'Composition Workshops',
                'normalized' => 'composition workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            356 => 
            array (
                'tag_id' => 358,
                'name' => 'Jazz Improvisation Classes',
                'normalized' => 'jazz improvisation classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            357 => 
            array (
                'tag_id' => 359,
                'name' => 'Ukulele Instruction',
                'normalized' => 'ukulele instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            358 => 
            array (
                'tag_id' => 360,
                'name' => 'Music Production Seminars',
                'normalized' => 'music production seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            359 => 
            array (
                'tag_id' => 361,
                'name' => 'Harp Lessons',
                'normalized' => 'harp lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            360 => 
            array (
                'tag_id' => 362,
                'name' => 'Choir Director',
                'normalized' => 'choir director',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            361 => 
            array (
                'tag_id' => 363,
                'name' => 'Acoustic Guitar Instruction',
                'normalized' => 'acoustic guitar instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            362 => 
            array (
                'tag_id' => 364,
                'name' => 'Music Notation Training',
                'normalized' => 'music notation training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            363 => 
            array (
                'tag_id' => 365,
                'name' => 'Percussion Workshops',
                'normalized' => 'percussion workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            364 => 
            array (
                'tag_id' => 366,
                'name' => 'Opera Singing Coaching',
                'normalized' => 'opera singing coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            365 => 
            array (
                'tag_id' => 367,
                'name' => 'Brass Instrument Instruction',
                'normalized' => 'brass instrument instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            366 => 
            array (
                'tag_id' => 368,
                'name' => 'Music Arrangement Classes',
                'normalized' => 'music arrangement classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            367 => 
            array (
                'tag_id' => 369,
                'name' => 'Accordion Lessons',
                'normalized' => 'accordion lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            368 => 
            array (
                'tag_id' => 370,
                'name' => 'Fiddle Instruction',
                'normalized' => 'fiddle instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            369 => 
            array (
                'tag_id' => 371,
                'name' => 'Gospel Choir Director',
                'normalized' => 'gospel choir director',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            370 => 
            array (
                'tag_id' => 372,
                'name' => 'Music Technology Workshops',
                'normalized' => 'music technology workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            371 => 
            array (
                'tag_id' => 373,
                'name' => 'Bassoon Lessons',
                'normalized' => 'bassoon lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            372 => 
            array (
                'tag_id' => 374,
                'name' => 'Music Therapy Sessions',
                'normalized' => 'music therapy sessions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            373 => 
            array (
                'tag_id' => 375,
                'name' => 'Bluegrass Band Coaching',
                'normalized' => 'bluegrass band coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            374 => 
            array (
                'tag_id' => 376,
                'name' => 'Harmony Singing Instruction',
                'normalized' => 'harmony singing instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            375 => 
            array (
                'tag_id' => 377,
                'name' => 'Bagpipe Lessons',
                'normalized' => 'bagpipe lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            376 => 
            array (
                'tag_id' => 378,
                'name' => 'Indian Classical Music Classes',
                'normalized' => 'indian classical music classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            377 => 
            array (
                'tag_id' => 379,
                'name' => 'Music Appreciation Workshops',
                'normalized' => 'music appreciation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            378 => 
            array (
                'tag_id' => 380,
                'name' => 'Steel Drum Instruction',
                'normalized' => 'steel drum instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            379 => 
            array (
                'tag_id' => 381,
                'name' => 'Vocal Ensemble Coaching',
                'normalized' => 'vocal ensemble coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            380 => 
            array (
                'tag_id' => 382,
                'name' => 'Irish Whistle Lessons',
                'normalized' => 'irish whistle lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            381 => 
            array (
                'tag_id' => 383,
                'name' => 'Film Scoring Workshops',
                'normalized' => 'film scoring workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            382 => 
            array (
                'tag_id' => 384,
                'name' => 'Trombone Instruction',
                'normalized' => 'trombone instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            383 => 
            array (
                'tag_id' => 385,
                'name' => 'Latin Percussion Classes',
                'normalized' => 'latin percussion classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            384 => 
            array (
                'tag_id' => 386,
                'name' => 'Country Band Coaching',
                'normalized' => 'country band coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            385 => 
            array (
                'tag_id' => 387,
                'name' => 'Tabla Lessons',
                'normalized' => 'tabla lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            386 => 
            array (
                'tag_id' => 388,
                'name' => 'Choral Arrangement Workshops',
                'normalized' => 'choral arrangement workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            387 => 
            array (
                'tag_id' => 389,
                'name' => 'Baritone Horn Instruction',
                'normalized' => 'baritone horn instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            388 => 
            array (
                'tag_id' => 390,
                'name' => 'Jazz Ensemble Coaching',
                'normalized' => 'jazz ensemble coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            389 => 
            array (
                'tag_id' => 391,
                'name' => 'Music History Seminars',
                'normalized' => 'music history seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            390 => 
            array (
                'tag_id' => 392,
                'name' => 'Piano Lessons',
                'normalized' => 'piano lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            391 => 
            array (
                'tag_id' => 393,
                'name' => 'Guitar Instruction',
                'normalized' => 'guitar instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            392 => 
            array (
                'tag_id' => 394,
                'name' => 'Singing Workshops',
                'normalized' => 'singing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            393 => 
            array (
                'tag_id' => 395,
                'name' => 'Violin Tutoring',
                'normalized' => 'violin tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            394 => 
            array (
                'tag_id' => 396,
                'name' => 'Drumming Lessons',
                'normalized' => 'drumming lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            395 => 
            array (
                'tag_id' => 397,
                'name' => 'Flute Instruction',
                'normalized' => 'flute instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            396 => 
            array (
                'tag_id' => 398,
                'name' => 'Songwriting Workshops',
                'normalized' => 'songwriting workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            397 => 
            array (
                'tag_id' => 399,
                'name' => 'Voice Coaching',
                'normalized' => 'voice coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            398 => 
            array (
                'tag_id' => 400,
                'name' => 'Trumpet Lessons',
                'normalized' => 'trumpet lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            399 => 
            array (
                'tag_id' => 401,
                'name' => 'Bass Guitar Instruction',
                'normalized' => 'bass guitar instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            400 => 
            array (
                'tag_id' => 402,
                'name' => 'Music Theory Classes',
                'normalized' => 'music theory classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            401 => 
            array (
                'tag_id' => 403,
                'name' => 'Cello Tutoring',
                'normalized' => 'cello tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            402 => 
            array (
                'tag_id' => 404,
                'name' => 'Vocal Harmony Workshops',
                'normalized' => 'vocal harmony workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            403 => 
            array (
                'tag_id' => 405,
                'name' => 'Saxophone Instruction',
                'normalized' => 'saxophone instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            404 => 
            array (
                'tag_id' => 406,
                'name' => 'Electronic Music Production',
                'normalized' => 'electronic music production',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            405 => 
            array (
                'tag_id' => 407,
                'name' => 'Keyboard Skills Coaching',
                'normalized' => 'keyboard skills coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            406 => 
            array (
                'tag_id' => 408,
                'name' => 'Clarinet Lessons',
                'normalized' => 'clarinet lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            407 => 
            array (
                'tag_id' => 409,
                'name' => 'Composition Workshops',
                'normalized' => 'composition workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            408 => 
            array (
                'tag_id' => 410,
                'name' => 'Jazz Improvisation Classes',
                'normalized' => 'jazz improvisation classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            409 => 
            array (
                'tag_id' => 411,
                'name' => 'Ukulele Instruction',
                'normalized' => 'ukulele instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            410 => 
            array (
                'tag_id' => 412,
                'name' => 'Music Production Seminars',
                'normalized' => 'music production seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            411 => 
            array (
                'tag_id' => 413,
                'name' => 'Harp Lessons',
                'normalized' => 'harp lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            412 => 
            array (
                'tag_id' => 414,
                'name' => 'Choir Director',
                'normalized' => 'choir director',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            413 => 
            array (
                'tag_id' => 415,
                'name' => 'Acoustic Guitar Instruction',
                'normalized' => 'acoustic guitar instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            414 => 
            array (
                'tag_id' => 416,
                'name' => 'Music Notation Training',
                'normalized' => 'music notation training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            415 => 
            array (
                'tag_id' => 417,
                'name' => 'Percussion Workshops',
                'normalized' => 'percussion workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            416 => 
            array (
                'tag_id' => 418,
                'name' => 'Opera Singing Coaching',
                'normalized' => 'opera singing coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            417 => 
            array (
                'tag_id' => 419,
                'name' => 'Brass Instrument Instruction',
                'normalized' => 'brass instrument instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            418 => 
            array (
                'tag_id' => 420,
                'name' => 'Music Arrangement Classes',
                'normalized' => 'music arrangement classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            419 => 
            array (
                'tag_id' => 421,
                'name' => 'Accordion Lessons',
                'normalized' => 'accordion lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            420 => 
            array (
                'tag_id' => 422,
                'name' => 'Fiddle Instruction',
                'normalized' => 'fiddle instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            421 => 
            array (
                'tag_id' => 423,
                'name' => 'Gospel Choir Director',
                'normalized' => 'gospel choir director',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            422 => 
            array (
                'tag_id' => 424,
                'name' => 'Music Technology Workshops',
                'normalized' => 'music technology workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            423 => 
            array (
                'tag_id' => 425,
                'name' => 'Bassoon Lessons',
                'normalized' => 'bassoon lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            424 => 
            array (
                'tag_id' => 426,
                'name' => 'Music Therapy Sessions',
                'normalized' => 'music therapy sessions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            425 => 
            array (
                'tag_id' => 427,
                'name' => 'Bluegrass Band Coaching',
                'normalized' => 'bluegrass band coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            426 => 
            array (
                'tag_id' => 428,
                'name' => 'Harmony Singing Instruction',
                'normalized' => 'harmony singing instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            427 => 
            array (
                'tag_id' => 429,
                'name' => 'Bagpipe Lessons',
                'normalized' => 'bagpipe lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            428 => 
            array (
                'tag_id' => 430,
                'name' => 'Indian Classical Music Classes',
                'normalized' => 'indian classical music classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            429 => 
            array (
                'tag_id' => 431,
                'name' => 'Music Appreciation Workshops',
                'normalized' => 'music appreciation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            430 => 
            array (
                'tag_id' => 432,
                'name' => 'Steel Drum Instruction',
                'normalized' => 'steel drum instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            431 => 
            array (
                'tag_id' => 433,
                'name' => 'Vocal Ensemble Coaching',
                'normalized' => 'vocal ensemble coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            432 => 
            array (
                'tag_id' => 434,
                'name' => 'Irish Whistle Lessons',
                'normalized' => 'irish whistle lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            433 => 
            array (
                'tag_id' => 435,
                'name' => 'Film Scoring Workshops',
                'normalized' => 'film scoring workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            434 => 
            array (
                'tag_id' => 436,
                'name' => 'Trombone Instruction',
                'normalized' => 'trombone instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            435 => 
            array (
                'tag_id' => 437,
                'name' => 'Latin Percussion Classes',
                'normalized' => 'latin percussion classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            436 => 
            array (
                'tag_id' => 438,
                'name' => 'Country Band Coaching',
                'normalized' => 'country band coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            437 => 
            array (
                'tag_id' => 439,
                'name' => 'Tabla Lessons',
                'normalized' => 'tabla lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            438 => 
            array (
                'tag_id' => 440,
                'name' => 'Choral Arrangement Workshops',
                'normalized' => 'choral arrangement workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            439 => 
            array (
                'tag_id' => 441,
                'name' => 'Baritone Horn Instruction',
                'normalized' => 'baritone horn instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            440 => 
            array (
                'tag_id' => 442,
                'name' => 'Jazz Ensemble Coaching',
                'normalized' => 'jazz ensemble coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            441 => 
            array (
                'tag_id' => 443,
                'name' => 'Music History Seminars',
                'normalized' => 'music history seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            442 => 
            array (
                'tag_id' => 444,
                'name' => 'Graphic Design Workshops',
                'normalized' => 'graphic design workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            443 => 
            array (
                'tag_id' => 445,
                'name' => 'Coding Bootcamps',
                'normalized' => 'coding bootcamps',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            444 => 
            array (
                'tag_id' => 446,
                'name' => 'Video Editing Classes',
                'normalized' => 'video editing classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            445 => 
            array (
                'tag_id' => 447,
                'name' => 'Mobile App Development Courses',
                'normalized' => 'mobile app development courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            446 => 
            array (
                'tag_id' => 448,
                'name' => '3D Modeling Workshops',
                'normalized' => '3d modeling workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            447 => 
            array (
                'tag_id' => 449,
                'name' => 'Data Science Training',
                'normalized' => 'data science training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            448 => 
            array (
                'tag_id' => 450,
                'name' => 'Web Development Bootcamps',
                'normalized' => 'web development bootcamps',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            449 => 
            array (
                'tag_id' => 451,
                'name' => 'UI/UX Design Courses',
                'normalized' => 'ui/ux design courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            450 => 
            array (
                'tag_id' => 452,
                'name' => 'Digital Marketing Workshops',
                'normalized' => 'digital marketing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            451 => 
            array (
                'tag_id' => 453,
                'name' => 'Game Development Classes',
                'normalized' => 'game development classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            452 => 
            array (
                'tag_id' => 454,
                'name' => 'Cybersecurity Training',
                'normalized' => 'cybersecurity training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            453 => 
            array (
                'tag_id' => 455,
                'name' => 'Animation Software Workshops',
                'normalized' => 'animation software workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            454 => 
            array (
                'tag_id' => 456,
                'name' => 'Cloud Computing Courses',
                'normalized' => 'cloud computing courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            455 => 
            array (
                'tag_id' => 457,
                'name' => 'Database Management Classes',
                'normalized' => 'database management classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            456 => 
            array (
                'tag_id' => 458,
            'name' => 'Virtual Reality (VR) Training',
            'normalized' => 'virtual reality (vr) training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            457 => 
            array (
                'tag_id' => 459,
                'name' => 'Digital Illustration Workshops',
                'normalized' => 'digital illustration workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            458 => 
            array (
                'tag_id' => 460,
            'name' => 'IoT (Internet of Things) Courses',
            'normalized' => 'iot (internet of things) courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            459 => 
            array (
                'tag_id' => 461,
                'name' => 'Front-end Development Bootcamps',
                'normalized' => 'front-end development bootcamps',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            460 => 
            array (
                'tag_id' => 462,
                'name' => 'Video Game Design Workshops',
                'normalized' => 'video game design workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            461 => 
            array (
                'tag_id' => 463,
                'name' => 'Network Administration Training',
                'normalized' => 'network administration training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            462 => 
            array (
                'tag_id' => 464,
            'name' => 'Augmented Reality (AR) Courses',
            'normalized' => 'augmented reality (ar) courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            463 => 
            array (
                'tag_id' => 465,
                'name' => 'Digital Photography Workshops',
                'normalized' => 'digital photography workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            464 => 
            array (
                'tag_id' => 466,
                'name' => 'E-commerce Development Classes',
                'normalized' => 'e-commerce development classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            465 => 
            array (
                'tag_id' => 467,
                'name' => 'Data Analytics Bootcamps',
                'normalized' => 'data analytics bootcamps',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            466 => 
            array (
                'tag_id' => 468,
                'name' => '3D Printing Workshops',
                'normalized' => '3d printing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            467 => 
            array (
                'tag_id' => 469,
                'name' => 'Blockchain Development Training',
                'normalized' => 'blockchain development training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            468 => 
            array (
                'tag_id' => 470,
                'name' => 'Audio Production Classes',
                'normalized' => 'audio production classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            469 => 
            array (
                'tag_id' => 471,
                'name' => 'Social Media Marketing Workshops',
                'normalized' => 'social media marketing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            470 => 
            array (
                'tag_id' => 472,
                'name' => 'Software Testing Courses',
                'normalized' => 'software testing courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            471 => 
            array (
                'tag_id' => 473,
                'name' => 'Motion Graphics Design Training',
                'normalized' => 'motion graphics design training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            472 => 
            array (
                'tag_id' => 474,
                'name' => 'Robotic Process Automation Workshops',
                'normalized' => 'robotic process automation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            473 => 
            array (
                'tag_id' => 475,
                'name' => 'DevOps Training',
                'normalized' => 'devops training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            474 => 
            array (
                'tag_id' => 476,
                'name' => 'User Research Courses',
                'normalized' => 'user research courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            475 => 
            array (
                'tag_id' => 477,
                'name' => 'Computer Vision Workshops',
                'normalized' => 'computer vision workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            476 => 
            array (
                'tag_id' => 478,
            'name' => 'App Store Optimization (ASO) Training',
            'normalized' => 'app store optimization (aso) training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            477 => 
            array (
                'tag_id' => 479,
                'name' => 'AR/VR Interaction Design Courses',
                'normalized' => 'ar/vr interaction design courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            478 => 
            array (
                'tag_id' => 480,
                'name' => 'IT Project Management Workshops',
                'normalized' => 'it project management workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            479 => 
            array (
                'tag_id' => 481,
                'name' => 'Automated Testing Training',
                'normalized' => 'automated testing training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            480 => 
            array (
                'tag_id' => 482,
                'name' => 'UX/UI Prototyping Classes',
                'normalized' => 'ux/ui prototyping classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            481 => 
            array (
                'tag_id' => 483,
                'name' => 'Business Intelligence Workshops',
                'normalized' => 'business intelligence workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            482 => 
            array (
                'tag_id' => 484,
                'name' => 'Game Level Design Courses',
                'normalized' => 'game level design courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            483 => 
            array (
                'tag_id' => 485,
                'name' => 'Mobile App Usability Testing',
                'normalized' => 'mobile app usability testing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            484 => 
            array (
                'tag_id' => 486,
                'name' => 'Web Accessibility Training',
                'normalized' => 'web accessibility training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            485 => 
            array (
                'tag_id' => 487,
                'name' => 'IoT Security Workshops',
                'normalized' => 'iot security workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            486 => 
            array (
                'tag_id' => 488,
                'name' => 'AI and Machine Learning Courses',
                'normalized' => 'ai and machine learning courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            487 => 
            array (
                'tag_id' => 489,
                'name' => 'Software Deployment Training',
                'normalized' => 'software deployment training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            488 => 
            array (
                'tag_id' => 490,
                'name' => 'Chatbot Development Workshops',
                'normalized' => 'chatbot development workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            489 => 
            array (
                'tag_id' => 491,
                'name' => 'Web Design Frameworks Courses',
                'normalized' => 'web design frameworks courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            490 => 
            array (
                'tag_id' => 492,
                'name' => 'Game Monetization Strategies',
                'normalized' => 'game monetization strategies',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            491 => 
            array (
                'tag_id' => 493,
                'name' => 'CAD Design Workshops',
                'normalized' => 'cad design workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            492 => 
            array (
                'tag_id' => 494,
                'name' => 'Network Security Training',
                'normalized' => 'network security training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            493 => 
            array (
                'tag_id' => 495,
                'name' => 'WordPress Development Classes',
                'normalized' => 'wordpress development classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            494 => 
            array (
                'tag_id' => 496,
                'name' => 'Agile Software Development Workshops',
                'normalized' => 'agile software development workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            495 => 
            array (
                'tag_id' => 497,
                'name' => 'Embedded Systems Programming Courses',
                'normalized' => 'embedded systems programming courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            496 => 
            array (
                'tag_id' => 498,
                'name' => 'Network Troubleshooting Training',
                'normalized' => 'network troubleshooting training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            497 => 
            array (
                'tag_id' => 499,
                'name' => 'ERP System Implementation Workshops',
                'normalized' => 'erp system implementation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            498 => 
            array (
                'tag_id' => 500,
                'name' => 'Database Query Optimization Classes',
                'normalized' => 'database query optimization classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            499 => 
            array (
                'tag_id' => 501,
                'name' => 'Software Documentation Training',
                'normalized' => 'software documentation training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
        ));
        \DB::table('taggable_tags')->insert(array (
            0 => 
            array (
                'tag_id' => 502,
                'name' => 'Machine Learning Model Deployment',
                'normalized' => 'machine learning model deployment',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            1 => 
            array (
                'tag_id' => 503,
                'name' => 'Agile Project Management Courses',
                'normalized' => 'agile project management courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            2 => 
            array (
                'tag_id' => 504,
                'name' => 'IT Infrastructure Management Training',
                'normalized' => 'it infrastructure management training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            3 => 
            array (
                'tag_id' => 505,
                'name' => 'Web Performance Optimization Workshops',
                'normalized' => 'web performance optimization workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            4 => 
            array (
                'tag_id' => 506,
                'name' => 'Linux System Administration Classes',
                'normalized' => 'linux system administration classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            5 => 
            array (
                'tag_id' => 507,
                'name' => 'CRM Software Implementation Training',
                'normalized' => 'crm software implementation training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            6 => 
            array (
                'tag_id' => 508,
                'name' => 'API Development Workshops',
                'normalized' => 'api development workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            7 => 
            array (
                'tag_id' => 509,
                'name' => 'Data Warehousing Courses',
                'normalized' => 'data warehousing courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            8 => 
            array (
                'tag_id' => 510,
                'name' => 'Version Control System Training',
                'normalized' => 'version control system training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            9 => 
            array (
                'tag_id' => 511,
                'name' => 'Containerization and Docker Workshops',
                'normalized' => 'containerization and docker workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            10 => 
            array (
                'tag_id' => 512,
                'name' => 'CRM Customization Classes',
                'normalized' => 'crm customization classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            11 => 
            array (
                'tag_id' => 513,
                'name' => 'API Security Training',
                'normalized' => 'api security training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            12 => 
            array (
                'tag_id' => 514,
                'name' => 'IT Service Management Workshops',
                'normalized' => 'it service management workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            13 => 
            array (
                'tag_id' => 515,
                'name' => 'Virtualization Technology Courses',
                'normalized' => 'virtualization technology courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            14 => 
            array (
                'tag_id' => 516,
                'name' => 'Software Quality Assurance Training',
                'normalized' => 'software quality assurance training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            15 => 
            array (
                'tag_id' => 517,
                'name' => 'Network Design and Planning Workshops',
                'normalized' => 'network design and planning workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            16 => 
            array (
                'tag_id' => 518,
                'name' => 'Digital Transformation Strategy Classes',
                'normalized' => 'digital transformation strategy classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            17 => 
            array (
                'tag_id' => 519,
                'name' => 'Cloud Architecture Training',
                'normalized' => 'cloud architecture training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            18 => 
            array (
                'tag_id' => 520,
                'name' => 'Business Process Automation Workshops',
                'normalized' => 'business process automation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            19 => 
            array (
                'tag_id' => 521,
                'name' => 'IoT Application Development Courses',
                'normalized' => 'iot application development courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            20 => 
            array (
                'tag_id' => 522,
                'name' => 'Software Licensing and Compliance Training',
                'normalized' => 'software licensing and compliance training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            21 => 
            array (
                'tag_id' => 523,
                'name' => 'Big Data Analytics Workshops',
                'normalized' => 'big data analytics workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            22 => 
            array (
                'tag_id' => 524,
                'name' => 'IT Governance and Compliance Classes',
                'normalized' => 'it governance and compliance classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            23 => 
            array (
                'tag_id' => 525,
                'name' => 'Cloud Migration Strategy Training',
                'normalized' => 'cloud migration strategy training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            24 => 
            array (
                'tag_id' => 526,
                'name' => 'Cybersecurity Framework Workshops',
                'normalized' => 'cybersecurity framework workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            25 => 
            array (
                'tag_id' => 527,
                'name' => 'Blockchain Technology Courses',
                'normalized' => 'blockchain technology courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            26 => 
            array (
                'tag_id' => 528,
                'name' => 'Robotic Process Automation Training',
                'normalized' => 'robotic process automation training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            27 => 
            array (
                'tag_id' => 529,
                'name' => 'Software Architecture Design Workshops',
                'normalized' => 'software architecture design workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            28 => 
            array (
                'tag_id' => 530,
                'name' => 'AI Ethics and Bias Training',
                'normalized' => 'ai ethics and bias training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            29 => 
            array (
                'tag_id' => 531,
                'name' => 'Network Performance Optimization Classes',
                'normalized' => 'network performance optimization classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            30 => 
            array (
                'tag_id' => 532,
                'name' => 'Digital Privacy Workshops',
                'normalized' => 'digital privacy workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            31 => 
            array (
                'tag_id' => 533,
                'name' => 'IoT Data Analytics Courses',
                'normalized' => 'iot data analytics courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            32 => 
            array (
                'tag_id' => 534,
                'name' => 'Software Security Training',
                'normalized' => 'software security training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            33 => 
            array (
                'tag_id' => 535,
                'name' => 'Software Deployment Automation Workshops',
                'normalized' => 'software deployment automation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            34 => 
            array (
                'tag_id' => 536,
                'name' => 'Quantum Computing Classes',
                'normalized' => 'quantum computing classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            35 => 
            array (
                'tag_id' => 537,
                'name' => 'IT Disaster Recovery Training',
                'normalized' => 'it disaster recovery training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            36 => 
            array (
                'tag_id' => 538,
                'name' => 'Furniture Repair',
                'normalized' => 'furniture repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            37 => 
            array (
                'tag_id' => 539,
                'name' => 'Appliance Troubleshooting',
                'normalized' => 'appliance troubleshooting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            38 => 
            array (
                'tag_id' => 540,
                'name' => 'Home Wiring Repair',
                'normalized' => 'home wiring repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            39 => 
            array (
                'tag_id' => 541,
                'name' => 'Minor Plumbing Fixes',
                'normalized' => 'minor plumbing fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            40 => 
            array (
                'tag_id' => 542,
                'name' => 'Wall Hole Patching',
                'normalized' => 'wall hole patching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            41 => 
            array (
                'tag_id' => 543,
                'name' => 'Garden Tool Restoration',
                'normalized' => 'garden tool restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            42 => 
            array (
                'tag_id' => 544,
                'name' => 'Broken Latch Repair',
                'normalized' => 'broken latch repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            43 => 
            array (
                'tag_id' => 545,
                'name' => 'Hinge Tightening',
                'normalized' => 'hinge tightening',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            44 => 
            array (
                'tag_id' => 546,
                'name' => 'Staircase Repair',
                'normalized' => 'staircase repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            45 => 
            array (
                'tag_id' => 547,
                'name' => 'Leaky Roof Patching',
                'normalized' => 'leaky roof patching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            46 => 
            array (
                'tag_id' => 548,
                'name' => 'Squeaky Floor Repair',
                'normalized' => 'squeaky floor repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            47 => 
            array (
                'tag_id' => 549,
                'name' => 'Window Screen Fix',
                'normalized' => 'window screen fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            48 => 
            array (
                'tag_id' => 550,
                'name' => 'Cabinet Door Alignment',
                'normalized' => 'cabinet door alignment',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            49 => 
            array (
                'tag_id' => 551,
                'name' => 'Broken Fence Repair',
                'normalized' => 'broken fence repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            50 => 
            array (
                'tag_id' => 552,
                'name' => 'Rusty Metal Restoration',
                'normalized' => 'rusty metal restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            51 => 
            array (
                'tag_id' => 553,
                'name' => 'Cracked Tile Replacement',
                'normalized' => 'cracked tile replacement',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            52 => 
            array (
                'tag_id' => 554,
                'name' => 'Screen Door Fix',
                'normalized' => 'screen door fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            53 => 
            array (
                'tag_id' => 555,
                'name' => 'Drawer Slide Lubrication',
                'normalized' => 'drawer slide lubrication',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            54 => 
            array (
                'tag_id' => 556,
                'name' => 'Faded Paint Touch-up',
                'normalized' => 'faded paint touch-up',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            55 => 
            array (
                'tag_id' => 557,
                'name' => 'Gutter Cleaning and Repair',
                'normalized' => 'gutter cleaning and repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            56 => 
            array (
                'tag_id' => 558,
                'name' => 'Stuck Window Repair',
                'normalized' => 'stuck window repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            57 => 
            array (
                'tag_id' => 559,
                'name' => 'Doorbell Repair',
                'normalized' => 'doorbell repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            58 => 
            array (
                'tag_id' => 560,
                'name' => 'Sticky Lock Fix',
                'normalized' => 'sticky lock fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            59 => 
            array (
                'tag_id' => 561,
                'name' => 'Dented Metal Repair',
                'normalized' => 'dented metal repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            60 => 
            array (
                'tag_id' => 562,
                'name' => 'Creaky Hinge Fix',
                'normalized' => 'creaky hinge fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            61 => 
            array (
                'tag_id' => 563,
                'name' => 'Rattling Window Fix',
                'normalized' => 'rattling window fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            62 => 
            array (
                'tag_id' => 564,
                'name' => 'Peeling Wallpaper Repair',
                'normalized' => 'peeling wallpaper repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            63 => 
            array (
                'tag_id' => 565,
                'name' => 'Stuck Drawer Repair',
                'normalized' => 'stuck drawer repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            64 => 
            array (
                'tag_id' => 566,
                'name' => 'Stained Wood Restoration',
                'normalized' => 'stained wood restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            65 => 
            array (
                'tag_id' => 567,
                'name' => 'Flickering Light Repair',
                'normalized' => 'flickering light repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            66 => 
            array (
                'tag_id' => 568,
                'name' => 'Sagging Cabinet Shelf Fix',
                'normalized' => 'sagging cabinet shelf fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            67 => 
            array (
                'tag_id' => 569,
                'name' => 'Loose Tile Repair',
                'normalized' => 'loose tile repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            68 => 
            array (
                'tag_id' => 570,
                'name' => 'Rusty Fence Repair',
                'normalized' => 'rusty fence repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            69 => 
            array (
                'tag_id' => 571,
                'name' => 'Water Stain Removal',
                'normalized' => 'water stain removal',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            70 => 
            array (
                'tag_id' => 572,
                'name' => 'Sticky Drawer Repair',
                'normalized' => 'sticky drawer repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            71 => 
            array (
                'tag_id' => 573,
                'name' => 'Worn Cabinet Finish Restoration',
                'normalized' => 'worn cabinet finish restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            72 => 
            array (
                'tag_id' => 574,
                'name' => 'Squeaky Gate Fix',
                'normalized' => 'squeaky gate fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            73 => 
            array (
                'tag_id' => 575,
                'name' => 'Cracked Concrete Patching',
                'normalized' => 'cracked concrete patching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            74 => 
            array (
                'tag_id' => 576,
                'name' => 'Stuck Sliding Door Repair',
                'normalized' => 'stuck sliding door repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            75 => 
            array (
                'tag_id' => 577,
                'name' => 'Dripping Showerhead Fix',
                'normalized' => 'dripping showerhead fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            76 => 
            array (
                'tag_id' => 578,
                'name' => 'Scratched Wood Surface Repair',
                'normalized' => 'scratched wood surface repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            77 => 
            array (
                'tag_id' => 579,
                'name' => 'Loose Banister Fix',
                'normalized' => 'loose banister fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            78 => 
            array (
                'tag_id' => 580,
                'name' => 'Squeaky Floor Repair',
                'normalized' => 'squeaky floor repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            79 => 
            array (
                'tag_id' => 581,
                'name' => 'Damaged Grout Repair',
                'normalized' => 'damaged grout repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            80 => 
            array (
                'tag_id' => 582,
                'name' => 'Unstable Furniture Fix',
                'normalized' => 'unstable furniture fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            81 => 
            array (
                'tag_id' => 583,
                'name' => 'Broken Blind Slats Replacement',
                'normalized' => 'broken blind slats replacement',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            82 => 
            array (
                'tag_id' => 584,
                'name' => 'Loose Cabinet Handle Fix',
                'normalized' => 'loose cabinet handle fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            83 => 
            array (
                'tag_id' => 585,
                'name' => 'Rusty Tool Restoration',
                'normalized' => 'rusty tool restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            84 => 
            array (
                'tag_id' => 586,
                'name' => 'Stuck Zipper Repair',
                'normalized' => 'stuck zipper repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            85 => 
            array (
                'tag_id' => 587,
                'name' => 'Stained Carpet Cleaning',
                'normalized' => 'stained carpet cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            86 => 
            array (
                'tag_id' => 588,
                'name' => 'Fading Outdoor Furniture Restoration',
                'normalized' => 'fading outdoor furniture restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            87 => 
            array (
                'tag_id' => 589,
                'name' => 'Cracked Wall Patching',
                'normalized' => 'cracked wall patching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            88 => 
            array (
                'tag_id' => 590,
                'name' => 'Unresponsive Remote Control Fix',
                'normalized' => 'unresponsive remote control fix',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            89 => 
            array (
                'tag_id' => 591,
                'name' => 'Dull Knife Sharpening',
                'normalized' => 'dull knife sharpening',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            90 => 
            array (
                'tag_id' => 592,
                'name' => 'Home Repair',
                'normalized' => 'home repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            91 => 
            array (
                'tag_id' => 593,
                'name' => 'Appliance Fixing',
                'normalized' => 'appliance fixing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            92 => 
            array (
                'tag_id' => 594,
                'name' => 'Electrical Work',
                'normalized' => 'electrical work',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            93 => 
            array (
                'tag_id' => 595,
                'name' => 'Plumbing Repair',
                'normalized' => 'plumbing repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            94 => 
            array (
                'tag_id' => 596,
                'name' => 'General Handyman Tasks',
                'normalized' => 'general handyman tasks',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            95 => 
            array (
                'tag_id' => 597,
                'name' => 'Furniture Restoration',
                'normalized' => 'furniture restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            96 => 
            array (
                'tag_id' => 598,
                'name' => 'Fixing Doors and Windows',
                'normalized' => 'fixing doors and windows',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            97 => 
            array (
                'tag_id' => 599,
                'name' => 'Household Maintenance',
                'normalized' => 'household maintenance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            98 => 
            array (
                'tag_id' => 600,
                'name' => 'Garden Tool Repairs',
                'normalized' => 'garden tool repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            99 => 
            array (
                'tag_id' => 601,
                'name' => 'Fixing Broken Items',
                'normalized' => 'fixing broken items',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            100 => 
            array (
                'tag_id' => 602,
                'name' => 'Wall and Ceiling Fixes',
                'normalized' => 'wall and ceiling fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            101 => 
            array (
                'tag_id' => 603,
                'name' => 'Basic Woodwork',
                'normalized' => 'basic woodwork',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            102 => 
            array (
                'tag_id' => 604,
                'name' => 'Simple Mechanical Repairs',
                'normalized' => 'simple mechanical repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            103 => 
            array (
                'tag_id' => 605,
                'name' => 'Small Plumbing Fixes',
                'normalized' => 'small plumbing fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            104 => 
            array (
                'tag_id' => 606,
                'name' => 'Household Upkeep',
                'normalized' => 'household upkeep',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            105 => 
            array (
                'tag_id' => 607,
                'name' => 'Home Improvement Tasks',
                'normalized' => 'home improvement tasks',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            106 => 
            array (
                'tag_id' => 608,
                'name' => 'Basic Repairs',
                'normalized' => 'basic repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            107 => 
            array (
                'tag_id' => 609,
                'name' => 'Maintaining Appliances',
                'normalized' => 'maintaining appliances',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            108 => 
            array (
                'tag_id' => 610,
                'name' => 'Household Fixes',
                'normalized' => 'household fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            109 => 
            array (
                'tag_id' => 611,
                'name' => 'Home Maintenance',
                'normalized' => 'home maintenance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            110 => 
            array (
                'tag_id' => 612,
                'name' => 'Fixing Everyday Items',
                'normalized' => 'fixing everyday items',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            111 => 
            array (
                'tag_id' => 613,
                'name' => 'Minor Home Repairs',
                'normalized' => 'minor home repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            112 => 
            array (
                'tag_id' => 614,
                'name' => 'Household Repairs',
                'normalized' => 'household repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            113 => 
            array (
                'tag_id' => 615,
                'name' => 'General Repairs',
                'normalized' => 'general repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            114 => 
            array (
                'tag_id' => 616,
                'name' => 'Simple Fixes',
                'normalized' => 'simple fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            115 => 
            array (
                'tag_id' => 617,
                'name' => 'Basic Home Repairs',
                'normalized' => 'basic home repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            116 => 
            array (
                'tag_id' => 618,
                'name' => 'Home Fixes',
                'normalized' => 'home fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            117 => 
            array (
                'tag_id' => 619,
                'name' => 'Minor Fixes',
                'normalized' => 'minor fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            118 => 
            array (
                'tag_id' => 620,
                'name' => 'Household Problem-Solving',
                'normalized' => 'household problem-solving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            119 => 
            array (
                'tag_id' => 621,
                'name' => 'Quick Repairs',
                'normalized' => 'quick repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            120 => 
            array (
                'tag_id' => 622,
                'name' => 'Home Repairs and Fixes',
                'normalized' => 'home repairs and fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            121 => 
            array (
                'tag_id' => 623,
                'name' => 'Fixing Household Items',
                'normalized' => 'fixing household items',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            122 => 
            array (
                'tag_id' => 624,
                'name' => 'Home Maintenance Tasks',
                'normalized' => 'home maintenance tasks',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            123 => 
            array (
                'tag_id' => 625,
                'name' => 'Household Maintenance',
                'normalized' => 'household maintenance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            124 => 
            array (
                'tag_id' => 626,
                'name' => 'Basic Repairs and Fixes',
                'normalized' => 'basic repairs and fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            125 => 
            array (
                'tag_id' => 627,
                'name' => 'Routine Home Fixes',
                'normalized' => 'routine home fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            126 => 
            array (
                'tag_id' => 628,
                'name' => 'Home Problem-Solving',
                'normalized' => 'home problem-solving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            127 => 
            array (
                'tag_id' => 629,
                'name' => 'Common Household Repairs',
                'normalized' => 'common household repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            128 => 
            array (
                'tag_id' => 630,
                'name' => 'Basic Household Fixes',
                'normalized' => 'basic household fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            129 => 
            array (
                'tag_id' => 631,
                'name' => 'Everyday Repairs',
                'normalized' => 'everyday repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            130 => 
            array (
                'tag_id' => 632,
                'name' => 'Household Fixes and Maintenance',
                'normalized' => 'household fixes and maintenance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            131 => 
            array (
                'tag_id' => 633,
                'name' => 'Simple Household Repairs',
                'normalized' => 'simple household repairs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            132 => 
            array (
                'tag_id' => 634,
                'name' => 'Quick Fixes',
                'normalized' => 'quick fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            133 => 
            array (
                'tag_id' => 635,
                'name' => 'Household Repairs and Upkeep',
                'normalized' => 'household repairs and upkeep',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            134 => 
            array (
                'tag_id' => 636,
                'name' => 'Minor Home Fixes',
                'normalized' => 'minor home fixes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            135 => 
            array (
                'tag_id' => 637,
                'name' => 'Basic Problem-Solving',
                'normalized' => 'basic problem-solving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            136 => 
            array (
                'tag_id' => 638,
                'name' => 'Home Repairs and Maintenance',
                'normalized' => 'home repairs and maintenance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            137 => 
            array (
                'tag_id' => 639,
                'name' => 'Fixing Everyday Home Items',
                'normalized' => 'fixing everyday home items',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            138 => 
            array (
                'tag_id' => 640,
                'name' => 'Neighborhood Cleanup',
                'normalized' => 'neighborhood cleanup',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            139 => 
            array (
                'tag_id' => 641,
                'name' => 'Community Picnic',
                'normalized' => 'community picnic',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            140 => 
            array (
                'tag_id' => 642,
                'name' => 'Outdoor Movie Night',
                'normalized' => 'outdoor movie night',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            141 => 
            array (
                'tag_id' => 643,
                'name' => 'Local Farmers Market',
                'normalized' => 'local farmers market',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            142 => 
            array (
                'tag_id' => 644,
                'name' => 'Block Party',
                'normalized' => 'block party',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            143 => 
            array (
                'tag_id' => 645,
                'name' => 'Community Garden',
                'normalized' => 'community garden',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            144 => 
            array (
                'tag_id' => 646,
                'name' => 'Holiday Decorations',
                'normalized' => 'holiday decorations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            145 => 
            array (
                'tag_id' => 647,
                'name' => 'Yard Sales',
                'normalized' => 'yard sales',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            146 => 
            array (
                'tag_id' => 648,
                'name' => 'Local Art Displays',
                'normalized' => 'local art displays',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            147 => 
            array (
                'tag_id' => 649,
                'name' => 'Sports and Games',
                'normalized' => 'sports and games',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            148 => 
            array (
                'tag_id' => 650,
                'name' => 'Storytelling Sessions',
                'normalized' => 'storytelling sessions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            149 => 
            array (
                'tag_id' => 651,
                'name' => 'Local History Tours',
                'normalized' => 'local history tours',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            150 => 
            array (
                'tag_id' => 652,
                'name' => 'Outdoor Gatherings',
                'normalized' => 'outdoor gatherings',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            151 => 
            array (
                'tag_id' => 653,
                'name' => 'Cooking and Recipe Swaps',
                'normalized' => 'cooking and recipe swaps',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            152 => 
            array (
                'tag_id' => 654,
                'name' => 'Community Workshops',
                'normalized' => 'community workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            153 => 
            array (
                'tag_id' => 655,
                'name' => 'Neighborhood Meetings',
                'normalized' => 'neighborhood meetings',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            154 => 
            array (
                'tag_id' => 656,
                'name' => 'Shared Communal Spaces',
                'normalized' => 'shared communal spaces',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            155 => 
            array (
                'tag_id' => 657,
                'name' => 'Seasonal Celebrations',
                'normalized' => 'seasonal celebrations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            156 => 
            array (
                'tag_id' => 658,
                'name' => 'Local Beautification',
                'normalized' => 'local beautification',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            157 => 
            array (
                'tag_id' => 659,
                'name' => 'Networking Events',
                'normalized' => 'networking events',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            158 => 
            array (
                'tag_id' => 660,
                'name' => 'Neighborhood Initiatives',
                'normalized' => 'neighborhood initiatives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            159 => 
            array (
                'tag_id' => 661,
                'name' => 'Charitable Activities',
                'normalized' => 'charitable activities',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            160 => 
            array (
                'tag_id' => 662,
                'name' => 'Family-Friendly Events',
                'normalized' => 'family-friendly events',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            161 => 
            array (
                'tag_id' => 663,
                'name' => 'Cultural Celebrations',
                'normalized' => 'cultural celebrations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            162 => 
            array (
                'tag_id' => 664,
                'name' => 'Fitness and Wellness',
                'normalized' => 'fitness and wellness',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            163 => 
            array (
                'tag_id' => 665,
                'name' => 'Neighborhood Committees',
                'normalized' => 'neighborhood committees',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            164 => 
            array (
                'tag_id' => 666,
                'name' => 'Outdoor Music Performances',
                'normalized' => 'outdoor music performances',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            165 => 
            array (
                'tag_id' => 667,
                'name' => 'Community Collaboration',
                'normalized' => 'community collaboration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            166 => 
            array (
                'tag_id' => 668,
                'name' => 'Local Business Support',
                'normalized' => 'local business support',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            167 => 
            array (
                'tag_id' => 669,
                'name' => 'Neighborhood Socials',
                'normalized' => 'neighborhood socials',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            168 => 
            array (
                'tag_id' => 670,
                'name' => 'Educational Workshops',
                'normalized' => 'educational workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            169 => 
            array (
                'tag_id' => 671,
                'name' => 'Neighborhood Clean-Up',
                'normalized' => 'neighborhood clean-up',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            170 => 
            array (
                'tag_id' => 672,
                'name' => 'Local Craft Markets',
                'normalized' => 'local craft markets',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            171 => 
            array (
                'tag_id' => 673,
                'name' => 'Neighborhood Welcoming',
                'normalized' => 'neighborhood welcoming',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            172 => 
            array (
                'tag_id' => 674,
                'name' => 'Health and Wellness Initiatives',
                'normalized' => 'health and wellness initiatives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            173 => 
            array (
                'tag_id' => 675,
                'name' => 'Neighborhood Newsletters',
                'normalized' => 'neighborhood newsletters',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            174 => 
            array (
                'tag_id' => 676,
                'name' => 'Cultural Exchanges',
                'normalized' => 'cultural exchanges',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            175 => 
            array (
                'tag_id' => 677,
                'name' => 'Neighborhood Collaborations',
                'normalized' => 'neighborhood collaborations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            176 => 
            array (
                'tag_id' => 678,
                'name' => 'Local Art and Crafts',
                'normalized' => 'local art and crafts',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            177 => 
            array (
                'tag_id' => 679,
                'name' => 'Environmentally Friendly Initiatives',
                'normalized' => 'environmentally friendly initiatives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            178 => 
            array (
                'tag_id' => 680,
                'name' => 'Neighborhood Networking',
                'normalized' => 'neighborhood networking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            179 => 
            array (
                'tag_id' => 681,
                'name' => 'Community Potluck',
                'normalized' => 'community potluck',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            180 => 
            array (
                'tag_id' => 682,
                'name' => 'Local Food Festival',
                'normalized' => 'local food festival',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            181 => 
            array (
                'tag_id' => 683,
                'name' => 'Cooking Workshops',
                'normalized' => 'cooking workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            182 => 
            array (
                'tag_id' => 684,
                'name' => 'Neighborhood BBQ',
                'normalized' => 'neighborhood bbq',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            183 => 
            array (
                'tag_id' => 685,
                'name' => 'Farm-to-Table Dinners',
                'normalized' => 'farm-to-table dinners',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            184 => 
            array (
                'tag_id' => 686,
                'name' => 'Food Swap',
                'normalized' => 'food swap',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            185 => 
            array (
                'tag_id' => 687,
                'name' => 'Community Bake Sale',
                'normalized' => 'community bake sale',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            186 => 
            array (
                'tag_id' => 688,
                'name' => 'Cooking Competitions',
                'normalized' => 'cooking competitions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            187 => 
            array (
                'tag_id' => 689,
                'name' => 'Outdoor Picnics',
                'normalized' => 'outdoor picnics',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            188 => 
            array (
                'tag_id' => 690,
                'name' => 'Recipe Sharing',
                'normalized' => 'recipe sharing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            189 => 
            array (
                'tag_id' => 691,
                'name' => 'Local Food Tours',
                'normalized' => 'local food tours',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            190 => 
            array (
                'tag_id' => 692,
                'name' => 'Harvest Festivals',
                'normalized' => 'harvest festivals',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            191 => 
            array (
                'tag_id' => 693,
                'name' => 'Cooking Demonstrations',
                'normalized' => 'cooking demonstrations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            192 => 
            array (
                'tag_id' => 694,
                'name' => 'Community Garden Dinners',
                'normalized' => 'community garden dinners',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            193 => 
            array (
                'tag_id' => 695,
                'name' => 'International Potluck Night',
                'normalized' => 'international potluck night',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            194 => 
            array (
                'tag_id' => 696,
                'name' => 'Neighborhood Coffee Meetups',
                'normalized' => 'neighborhood coffee meetups',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            195 => 
            array (
                'tag_id' => 697,
                'name' => 'Cookbook Clubs',
                'normalized' => 'cookbook clubs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            196 => 
            array (
                'tag_id' => 698,
                'name' => 'Neighborhood Brunch',
                'normalized' => 'neighborhood brunch',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            197 => 
            array (
                'tag_id' => 699,
                'name' => 'Culinary Storytelling',
                'normalized' => 'culinary storytelling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            198 => 
            array (
                'tag_id' => 700,
                'name' => 'Potato Barbecue',
                'normalized' => 'potato barbecue',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            199 => 
            array (
                'tag_id' => 701,
                'name' => 'Neighborhood Soup Night',
                'normalized' => 'neighborhood soup night',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            200 => 
            array (
                'tag_id' => 702,
                'name' => 'Food Charity Drives',
                'normalized' => 'food charity drives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            201 => 
            array (
                'tag_id' => 703,
                'name' => 'Ice Cream Social',
                'normalized' => 'ice cream social',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            202 => 
            array (
                'tag_id' => 704,
                'name' => 'Community Food Workshops',
                'normalized' => 'community food workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            203 => 
            array (
                'tag_id' => 705,
                'name' => 'Neighborhood Breakfast Club',
                'normalized' => 'neighborhood breakfast club',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            204 => 
            array (
                'tag_id' => 706,
                'name' => 'Cooking Equipment Exchange',
                'normalized' => 'cooking equipment exchange',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            205 => 
            array (
                'tag_id' => 707,
                'name' => 'Local Ingredient Challenges',
                'normalized' => 'local ingredient challenges',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            206 => 
            array (
                'tag_id' => 708,
                'name' => 'Neighborhood Bake-Off',
                'normalized' => 'neighborhood bake-off',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            207 => 
            array (
                'tag_id' => 709,
                'name' => 'Cooking Swap Parties',
                'normalized' => 'cooking swap parties',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            208 => 
            array (
                'tag_id' => 710,
                'name' => 'Food and Music Fest',
                'normalized' => 'food and music fest',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            209 => 
            array (
                'tag_id' => 711,
                'name' => 'Neighborhood Picnic Potluck',
                'normalized' => 'neighborhood picnic potluck',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            210 => 
            array (
                'tag_id' => 712,
                'name' => 'DIY Pizza Night',
                'normalized' => 'diy pizza night',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            211 => 
            array (
                'tag_id' => 713,
                'name' => 'Cooking Club',
                'normalized' => 'cooking club',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            212 => 
            array (
                'tag_id' => 714,
                'name' => 'Neighborhood Wine and Cheese Night',
                'normalized' => 'neighborhood wine and cheese night',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            213 => 
            array (
                'tag_id' => 715,
                'name' => 'Community Supper',
                'normalized' => 'community supper',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            214 => 
            array (
                'tag_id' => 716,
                'name' => 'Cooking Garden Harvest',
                'normalized' => 'cooking garden harvest',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            215 => 
            array (
                'tag_id' => 717,
                'name' => 'Neighborhood Barbecue Potluck',
                'normalized' => 'neighborhood barbecue potluck',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            216 => 
            array (
                'tag_id' => 718,
                'name' => 'Cooking Swap Events',
                'normalized' => 'cooking swap events',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            217 => 
            array (
                'tag_id' => 719,
                'name' => 'Food Tasting Tours',
                'normalized' => 'food tasting tours',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            218 => 
            array (
                'tag_id' => 720,
                'name' => 'Neighborhood Food Bazaar',
                'normalized' => 'neighborhood food bazaar',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            219 => 
            array (
                'tag_id' => 721,
                'name' => 'Cooking Demos and Sampling',
                'normalized' => 'cooking demos and sampling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            220 => 
            array (
                'tag_id' => 722,
                'name' => 'Neighborhood Breakfast Potluck',
                'normalized' => 'neighborhood breakfast potluck',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            221 => 
            array (
                'tag_id' => 723,
                'name' => 'Food Preservation Workshops',
                'normalized' => 'food preservation workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            222 => 
            array (
                'tag_id' => 724,
                'name' => 'Neighborhood Tapas Night',
                'normalized' => 'neighborhood tapas night',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            223 => 
            array (
                'tag_id' => 725,
                'name' => 'Cooking Classes',
                'normalized' => 'cooking classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            224 => 
            array (
                'tag_id' => 726,
                'name' => 'Neighborhood Food Exchange',
                'normalized' => 'neighborhood food exchange',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            225 => 
            array (
                'tag_id' => 727,
                'name' => 'Cooking Theme Nights',
                'normalized' => 'cooking theme nights',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            226 => 
            array (
                'tag_id' => 728,
                'name' => 'Neighborhood Family Cooking',
                'normalized' => 'neighborhood family cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            227 => 
            array (
                'tag_id' => 729,
                'name' => 'Personal Training',
                'normalized' => 'personal training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            228 => 
            array (
                'tag_id' => 730,
                'name' => 'Writing',
                'normalized' => 'writing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            229 => 
            array (
                'tag_id' => 731,
                'name' => 'Graphic Design',
                'normalized' => 'graphic design',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            230 => 
            array (
                'tag_id' => 732,
                'name' => 'Photography',
                'normalized' => 'photography',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            231 => 
            array (
                'tag_id' => 733,
                'name' => 'Event Planning',
                'normalized' => 'event planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            232 => 
            array (
                'tag_id' => 734,
                'name' => 'Tutoring',
                'normalized' => 'tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            233 => 
            array (
                'tag_id' => 735,
                'name' => 'Life Coaching',
                'normalized' => 'life coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            234 => 
            array (
                'tag_id' => 736,
                'name' => 'Home Cleaning',
                'normalized' => 'home cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            235 => 
            array (
                'tag_id' => 737,
                'name' => 'Landscaping',
                'normalized' => 'landscaping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            236 => 
            array (
                'tag_id' => 738,
                'name' => 'Web Development',
                'normalized' => 'web development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            237 => 
            array (
                'tag_id' => 739,
                'name' => 'Personal Chef',
                'normalized' => 'personal chef',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            238 => 
            array (
                'tag_id' => 740,
                'name' => 'Social Media Management',
                'normalized' => 'social media management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            239 => 
            array (
                'tag_id' => 741,
                'name' => 'Pet Sitting',
                'normalized' => 'pet sitting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            240 => 
            array (
                'tag_id' => 742,
                'name' => 'House Painting',
                'normalized' => 'house painting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            241 => 
            array (
                'tag_id' => 743,
                'name' => 'Virtual Assistance',
                'normalized' => 'virtual assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            242 => 
            array (
                'tag_id' => 744,
                'name' => 'Language Translation',
                'normalized' => 'language translation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            243 => 
            array (
                'tag_id' => 745,
                'name' => 'Interior Design',
                'normalized' => 'interior design',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            244 => 
            array (
                'tag_id' => 746,
                'name' => 'Hair Styling',
                'normalized' => 'hair styling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            245 => 
            array (
                'tag_id' => 747,
                'name' => 'Fitness Instruction',
                'normalized' => 'fitness instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            246 => 
            array (
                'tag_id' => 748,
                'name' => 'Catering',
                'normalized' => 'catering',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            247 => 
            array (
                'tag_id' => 749,
                'name' => 'Music Lessons',
                'normalized' => 'music lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            248 => 
            array (
                'tag_id' => 750,
                'name' => 'Handyman Services',
                'normalized' => 'handyman services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            249 => 
            array (
                'tag_id' => 751,
                'name' => 'Nutrition Coaching',
                'normalized' => 'nutrition coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            250 => 
            array (
                'tag_id' => 752,
                'name' => 'Makeup Artistry',
                'normalized' => 'makeup artistry',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            251 => 
            array (
                'tag_id' => 753,
                'name' => 'Personal Shopping',
                'normalized' => 'personal shopping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            252 => 
            array (
                'tag_id' => 754,
                'name' => 'Yoga Instruction',
                'normalized' => 'yoga instruction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            253 => 
            array (
                'tag_id' => 755,
                'name' => 'Home Organizing',
                'normalized' => 'home organizing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            254 => 
            array (
                'tag_id' => 756,
                'name' => 'Life Drawing',
                'normalized' => 'life drawing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            255 => 
            array (
                'tag_id' => 757,
                'name' => 'Resume Writing',
                'normalized' => 'resume writing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            256 => 
            array (
                'tag_id' => 758,
                'name' => 'Massage Therapy',
                'normalized' => 'massage therapy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            257 => 
            array (
                'tag_id' => 759,
                'name' => 'Home Staging',
                'normalized' => 'home staging',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            258 => 
            array (
                'tag_id' => 760,
                'name' => 'Baking and Dessert Making',
                'normalized' => 'baking and dessert making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            259 => 
            array (
                'tag_id' => 761,
                'name' => 'Online Coaching',
                'normalized' => 'online coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            260 => 
            array (
                'tag_id' => 762,
                'name' => 'Art Lessons',
                'normalized' => 'art lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            261 => 
            array (
                'tag_id' => 763,
                'name' => 'Real Estate Consulting',
                'normalized' => 'real estate consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            262 => 
            array (
                'tag_id' => 764,
                'name' => 'Mobile Car Detailing',
                'normalized' => 'mobile car detailing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            263 => 
            array (
                'tag_id' => 765,
                'name' => 'Gardening Consultation',
                'normalized' => 'gardening consultation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            264 => 
            array (
                'tag_id' => 766,
                'name' => 'Fashion Styling',
                'normalized' => 'fashion styling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            265 => 
            array (
                'tag_id' => 767,
                'name' => 'Writing Workshops',
                'normalized' => 'writing workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            266 => 
            array (
                'tag_id' => 768,
                'name' => 'Dog Training',
                'normalized' => 'dog training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            267 => 
            array (
                'tag_id' => 769,
                'name' => 'Fitness Bootcamp',
                'normalized' => 'fitness bootcamp',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            268 => 
            array (
                'tag_id' => 770,
                'name' => 'Resume Editing',
                'normalized' => 'resume editing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            269 => 
            array (
                'tag_id' => 771,
                'name' => 'Home Renovation Consultation',
                'normalized' => 'home renovation consultation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            270 => 
            array (
                'tag_id' => 772,
                'name' => 'Life Skills Coaching',
                'normalized' => 'life skills coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            271 => 
            array (
                'tag_id' => 773,
                'name' => 'Health and Wellness Workshops',
                'normalized' => 'health and wellness workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            272 => 
            array (
                'tag_id' => 774,
                'name' => 'Photography Workshops',
                'normalized' => 'photography workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            273 => 
            array (
                'tag_id' => 775,
                'name' => 'Financial Consulting',
                'normalized' => 'financial consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            274 => 
            array (
                'tag_id' => 776,
                'name' => 'Home Cleaning Services',
                'normalized' => 'home cleaning services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            275 => 
            array (
                'tag_id' => 777,
                'name' => 'Home Office Organization',
                'normalized' => 'home office organization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            276 => 
            array (
                'tag_id' => 778,
                'name' => 'Cooking Classes',
                'normalized' => 'cooking classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            277 => 
            array (
                'tag_id' => 779,
                'name' => 'Public Speaking Coaching',
                'normalized' => 'public speaking coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            278 => 
            array (
                'tag_id' => 780,
                'name' => 'Language Lessons',
                'normalized' => 'language lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            279 => 
            array (
                'tag_id' => 781,
                'name' => 'Handcrafted Jewelry',
                'normalized' => 'handcrafted jewelry',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            280 => 
            array (
                'tag_id' => 782,
                'name' => 'Mobile Haircutting',
                'normalized' => 'mobile haircutting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            281 => 
            array (
                'tag_id' => 783,
                'name' => 'Home Energy Audits',
                'normalized' => 'home energy audits',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            282 => 
            array (
                'tag_id' => 784,
                'name' => 'Virtual Fitness Coaching',
                'normalized' => 'virtual fitness coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            283 => 
            array (
                'tag_id' => 785,
                'name' => 'Home Repair Services',
                'normalized' => 'home repair services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            284 => 
            array (
                'tag_id' => 786,
                'name' => 'Illustration',
                'normalized' => 'illustration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            285 => 
            array (
                'tag_id' => 787,
                'name' => 'Outdoor Adventure Guiding',
                'normalized' => 'outdoor adventure guiding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            286 => 
            array (
                'tag_id' => 788,
                'name' => 'Personal Concierge',
                'normalized' => 'personal concierge',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            287 => 
            array (
                'tag_id' => 789,
                'name' => 'Pet Grooming',
                'normalized' => 'pet grooming',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            288 => 
            array (
                'tag_id' => 790,
                'name' => 'Home Appliance Repair',
                'normalized' => 'home appliance repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            289 => 
            array (
                'tag_id' => 791,
                'name' => 'Professional Organizing',
                'normalized' => 'professional organizing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            290 => 
            array (
                'tag_id' => 792,
                'name' => 'Custom Clothing Design',
                'normalized' => 'custom clothing design',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            291 => 
            array (
                'tag_id' => 793,
                'name' => 'Private Language Tutoring',
                'normalized' => 'private language tutoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            292 => 
            array (
                'tag_id' => 794,
                'name' => 'Art Restoration',
                'normalized' => 'art restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            293 => 
            array (
                'tag_id' => 795,
                'name' => 'Personal Errand Running',
                'normalized' => 'personal errand running',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            294 => 
            array (
                'tag_id' => 796,
                'name' => 'Mobile Notary Services',
                'normalized' => 'mobile notary services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            295 => 
            array (
                'tag_id' => 797,
                'name' => 'Home Technology Installation',
                'normalized' => 'home technology installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            296 => 
            array (
                'tag_id' => 798,
                'name' => 'Local Tour Guiding',
                'normalized' => 'local tour guiding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            297 => 
            array (
                'tag_id' => 799,
                'name' => 'Custom Cake Baking',
                'normalized' => 'custom cake baking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            298 => 
            array (
                'tag_id' => 800,
                'name' => 'Personal Shopping Services',
                'normalized' => 'personal shopping services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            299 => 
            array (
                'tag_id' => 801,
                'name' => 'Voice Lessons',
                'normalized' => 'voice lessons',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            300 => 
            array (
                'tag_id' => 802,
                'name' => 'Home Renovation Services',
                'normalized' => 'home renovation services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            301 => 
            array (
                'tag_id' => 803,
                'name' => 'Local Consulting',
                'normalized' => 'local consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            302 => 
            array (
                'tag_id' => 804,
                'name' => 'Mobile Massage Therapy',
                'normalized' => 'mobile massage therapy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            303 => 
            array (
                'tag_id' => 805,
                'name' => 'Pet Photography',
                'normalized' => 'pet photography',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            304 => 
            array (
                'tag_id' => 806,
                'name' => 'Senior Care Services',
                'normalized' => 'senior care services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            305 => 
            array (
                'tag_id' => 807,
                'name' => 'Wedding Planning',
                'normalized' => 'wedding planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            306 => 
            array (
                'tag_id' => 808,
                'name' => 'Personalized Gift Creation',
                'normalized' => 'personalized gift creation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            307 => 
            array (
                'tag_id' => 809,
                'name' => 'Home Security Consulting',
                'normalized' => 'home security consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            308 => 
            array (
                'tag_id' => 810,
                'name' => 'Nutritional Counseling',
                'normalized' => 'nutritional counseling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            309 => 
            array (
                'tag_id' => 811,
                'name' => 'Local Marketing Services',
                'normalized' => 'local marketing services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            310 => 
            array (
                'tag_id' => 812,
                'name' => 'Home Cleaning and Organization',
                'normalized' => 'home cleaning and organization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            311 => 
            array (
                'tag_id' => 813,
                'name' => 'Mobile Pet Grooming',
                'normalized' => 'mobile pet grooming',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            312 => 
            array (
                'tag_id' => 814,
                'name' => 'Personal Finance Coaching',
                'normalized' => 'personal finance coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            313 => 
            array (
                'tag_id' => 815,
                'name' => 'Custom Art Commissions',
                'normalized' => 'custom art commissions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            314 => 
            array (
                'tag_id' => 816,
                'name' => 'Local Food Delivery',
                'normalized' => 'local food delivery',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            315 => 
            array (
                'tag_id' => 817,
                'name' => 'Senior Fitness Training',
                'normalized' => 'senior fitness training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            316 => 
            array (
                'tag_id' => 818,
                'name' => 'Clothing Alterations',
                'normalized' => 'clothing alterations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            317 => 
            array (
                'tag_id' => 819,
                'name' => 'Home Decorating Services',
                'normalized' => 'home decorating services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            318 => 
            array (
                'tag_id' => 820,
                'name' => 'Mobile Auto Detailing',
                'normalized' => 'mobile auto detailing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            319 => 
            array (
                'tag_id' => 821,
                'name' => 'Local Art Classes',
                'normalized' => 'local art classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            320 => 
            array (
                'tag_id' => 822,
                'name' => 'Environmental Consulting',
                'normalized' => 'environmental consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            321 => 
            array (
                'tag_id' => 823,
                'name' => 'Music Performances',
                'normalized' => 'music performances',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            322 => 
            array (
                'tag_id' => 824,
                'name' => 'Cleaning Services',
                'normalized' => 'cleaning services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            323 => 
            array (
                'tag_id' => 825,
                'name' => 'Home Energy Efficiency Consulting',
                'normalized' => 'home energy efficiency consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            324 => 
            array (
                'tag_id' => 826,
                'name' => 'Personal Styling',
                'normalized' => 'personal styling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            325 => 
            array (
                'tag_id' => 827,
                'name' => 'Local Photography Services',
                'normalized' => 'local photography services',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            326 => 
            array (
                'tag_id' => 828,
                'name' => 'Custom Furniture Design',
                'normalized' => 'custom furniture design',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            327 => 
            array (
                'tag_id' => 829,
                'name' => 'Local Fitness Classes',
                'normalized' => 'local fitness classes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            328 => 
            array (
                'tag_id' => 830,
                'name' => 'Public Accountant',
                'normalized' => 'public accountant',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            329 => 
            array (
                'tag_id' => 831,
                'name' => 'Massage Therapist',
                'normalized' => 'massage therapist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            330 => 
            array (
                'tag_id' => 832,
                'name' => 'Registered Dietitian',
                'normalized' => 'registered dietitian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            331 => 
            array (
                'tag_id' => 833,
                'name' => 'Financial Planner',
                'normalized' => 'financial planner',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            332 => 
            array (
                'tag_id' => 834,
                'name' => 'Photographer',
                'normalized' => 'photographer',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            333 => 
            array (
                'tag_id' => 835,
                'name' => 'Counselor',
                'normalized' => 'counselor',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            334 => 
            array (
                'tag_id' => 836,
                'name' => 'Real Estate Agent',
                'normalized' => 'real estate agent',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            335 => 
            array (
                'tag_id' => 837,
                'name' => 'Personal Trainer',
                'normalized' => 'personal trainer',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            336 => 
            array (
                'tag_id' => 838,
                'name' => 'Wedding Planner',
                'normalized' => 'wedding planner',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            337 => 
            array (
                'tag_id' => 839,
                'name' => 'Clinical Social Worker',
                'normalized' => 'clinical social worker',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            338 => 
            array (
                'tag_id' => 840,
                'name' => 'Life Coach',
                'normalized' => 'life coach',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            339 => 
            array (
                'tag_id' => 841,
                'name' => 'Occupational Therapist',
                'normalized' => 'occupational therapist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            340 => 
            array (
                'tag_id' => 842,
                'name' => 'Web Designer',
                'normalized' => 'web designer',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            341 => 
            array (
                'tag_id' => 843,
                'name' => 'Speech Therapist',
                'normalized' => 'speech therapist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            342 => 
            array (
                'tag_id' => 844,
                'name' => 'Fitness Instructor',
                'normalized' => 'fitness instructor',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            343 => 
            array (
                'tag_id' => 845,
                'name' => 'Marriage and Family Therapist',
                'normalized' => 'marriage and family therapist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            344 => 
            array (
                'tag_id' => 846,
                'name' => 'Event Planner',
                'normalized' => 'event planner',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            345 => 
            array (
                'tag_id' => 847,
                'name' => 'Chiropractor',
                'normalized' => 'chiropractor',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            346 => 
            array (
                'tag_id' => 848,
                'name' => 'Career Coach',
                'normalized' => 'career coach',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            347 => 
            array (
                'tag_id' => 849,
                'name' => 'Clinical Psychologist',
                'normalized' => 'clinical psychologist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            348 => 
            array (
                'tag_id' => 850,
                'name' => 'Copywriter',
                'normalized' => 'copywriter',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            349 => 
            array (
                'tag_id' => 851,
                'name' => 'Personal Chef',
                'normalized' => 'personal chef',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            350 => 
            array (
                'tag_id' => 852,
                'name' => 'Acupuncturist',
                'normalized' => 'acupuncturist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            351 => 
            array (
                'tag_id' => 853,
                'name' => 'Graphic Designer',
                'normalized' => 'graphic designer',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            352 => 
            array (
                'tag_id' => 854,
                'name' => 'Life Organizer',
                'normalized' => 'life organizer',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            353 => 
            array (
                'tag_id' => 855,
                'name' => 'Mental Health Counselor',
                'normalized' => 'mental health counselor',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            354 => 
            array (
                'tag_id' => 856,
                'name' => 'Makeup Artist',
                'normalized' => 'makeup artist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            355 => 
            array (
                'tag_id' => 857,
                'name' => 'Personal Stylist',
                'normalized' => 'personal stylist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            356 => 
            array (
                'tag_id' => 858,
                'name' => 'Clinical Nutritionist',
                'normalized' => 'clinical nutritionist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            357 => 
            array (
                'tag_id' => 859,
                'name' => 'Video Editor',
                'normalized' => 'video editor',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            358 => 
            array (
                'tag_id' => 860,
                'name' => 'Business Coach',
                'normalized' => 'business coach',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            359 => 
            array (
                'tag_id' => 861,
                'name' => 'Speech-Language Pathologist',
                'normalized' => 'speech-language pathologist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            360 => 
            array (
                'tag_id' => 862,
                'name' => 'Brand Consultant',
                'normalized' => 'brand consultant',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            361 => 
            array (
                'tag_id' => 863,
                'name' => 'Financial Analyst',
                'normalized' => 'financial analyst',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            362 => 
            array (
                'tag_id' => 864,
                'name' => 'Massage Therapist',
                'normalized' => 'massage therapist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            363 => 
            array (
                'tag_id' => 865,
                'name' => 'Interior Designer',
                'normalized' => 'interior designer',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            364 => 
            array (
                'tag_id' => 866,
                'name' => 'Clinical Social Worker',
                'normalized' => 'clinical social worker',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            365 => 
            array (
                'tag_id' => 867,
                'name' => 'Executive Coach',
                'normalized' => 'executive coach',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            366 => 
            array (
                'tag_id' => 868,
                'name' => 'Marriage and Family Therapist',
                'normalized' => 'marriage and family therapist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            367 => 
            array (
                'tag_id' => 869,
                'name' => 'Resume Writer',
                'normalized' => 'resume writer',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            368 => 
            array (
                'tag_id' => 870,
                'name' => 'Mental Health Counselor',
                'normalized' => 'mental health counselor',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            369 => 
            array (
                'tag_id' => 871,
                'name' => 'Leadership Trainer',
                'normalized' => 'leadership trainer',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            370 => 
            array (
                'tag_id' => 872,
                'name' => 'Social Media Manager',
                'normalized' => 'social media manager',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            371 => 
            array (
                'tag_id' => 873,
                'name' => 'Clinical Psychologist',
                'normalized' => 'clinical psychologist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            372 => 
            array (
                'tag_id' => 874,
                'name' => 'Health Coach',
                'normalized' => 'health coach',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            373 => 
            array (
                'tag_id' => 875,
                'name' => 'Marketing Consultant',
                'normalized' => 'marketing consultant',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            374 => 
            array (
                'tag_id' => 876,
                'name' => 'Counselor',
                'normalized' => 'counselor',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            375 => 
            array (
                'tag_id' => 877,
                'name' => 'Public Relations Specialist',
                'normalized' => 'public relations specialist',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            376 => 
            array (
                'tag_id' => 878,
                'name' => 'English',
                'normalized' => 'english',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            377 => 
            array (
                'tag_id' => 879,
                'name' => 'Spanish',
                'normalized' => 'spanish',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            378 => 
            array (
                'tag_id' => 880,
                'name' => 'French',
                'normalized' => 'french',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            379 => 
            array (
                'tag_id' => 881,
                'name' => 'German',
                'normalized' => 'german',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            380 => 
            array (
                'tag_id' => 882,
                'name' => 'Italian',
                'normalized' => 'italian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            381 => 
            array (
                'tag_id' => 883,
                'name' => 'Portuguese',
                'normalized' => 'portuguese',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            382 => 
            array (
                'tag_id' => 884,
                'name' => 'Dutch',
                'normalized' => 'dutch',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            383 => 
            array (
                'tag_id' => 885,
                'name' => 'Swedish',
                'normalized' => 'swedish',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            384 => 
            array (
                'tag_id' => 886,
                'name' => 'Danish',
                'normalized' => 'danish',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            385 => 
            array (
                'tag_id' => 887,
                'name' => 'Norwegian',
                'normalized' => 'norwegian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            386 => 
            array (
                'tag_id' => 888,
                'name' => 'Finnish',
                'normalized' => 'finnish',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            387 => 
            array (
                'tag_id' => 889,
                'name' => 'Russian',
                'normalized' => 'russian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            388 => 
            array (
                'tag_id' => 890,
                'name' => 'Polish',
                'normalized' => 'polish',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            389 => 
            array (
                'tag_id' => 891,
                'name' => 'Ukrainian',
                'normalized' => 'ukrainian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            390 => 
            array (
                'tag_id' => 892,
                'name' => 'Czech',
                'normalized' => 'czech',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            391 => 
            array (
                'tag_id' => 893,
                'name' => 'Hungarian',
                'normalized' => 'hungarian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            392 => 
            array (
                'tag_id' => 894,
                'name' => 'Romanian',
                'normalized' => 'romanian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            393 => 
            array (
                'tag_id' => 895,
                'name' => 'Greek',
                'normalized' => 'greek',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            394 => 
            array (
                'tag_id' => 896,
                'name' => 'Bulgarian',
                'normalized' => 'bulgarian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            395 => 
            array (
                'tag_id' => 897,
                'name' => 'Croatian',
                'normalized' => 'croatian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            396 => 
            array (
                'tag_id' => 898,
                'name' => 'Slovak',
                'normalized' => 'slovak',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            397 => 
            array (
                'tag_id' => 899,
                'name' => 'Slovenian',
                'normalized' => 'slovenian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            398 => 
            array (
                'tag_id' => 900,
                'name' => 'Serbian',
                'normalized' => 'serbian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            399 => 
            array (
                'tag_id' => 901,
                'name' => 'Bosnian',
                'normalized' => 'bosnian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            400 => 
            array (
                'tag_id' => 902,
                'name' => 'Albanian',
                'normalized' => 'albanian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            401 => 
            array (
                'tag_id' => 903,
                'name' => 'Macedonian',
                'normalized' => 'macedonian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            402 => 
            array (
                'tag_id' => 904,
                'name' => 'Estonian',
                'normalized' => 'estonian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            403 => 
            array (
                'tag_id' => 905,
                'name' => 'Latvian',
                'normalized' => 'latvian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            404 => 
            array (
                'tag_id' => 906,
                'name' => 'Lithuanian',
                'normalized' => 'lithuanian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            405 => 
            array (
                'tag_id' => 907,
                'name' => 'Maltese',
                'normalized' => 'maltese',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            406 => 
            array (
                'tag_id' => 908,
                'name' => 'Icelandic',
                'normalized' => 'icelandic',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            407 => 
            array (
                'tag_id' => 909,
                'name' => 'Irish',
                'normalized' => 'irish',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            408 => 
            array (
                'tag_id' => 910,
                'name' => 'Scottish Gaelic',
                'normalized' => 'scottish gaelic',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            409 => 
            array (
                'tag_id' => 911,
                'name' => 'Welsh',
                'normalized' => 'welsh',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            410 => 
            array (
                'tag_id' => 912,
                'name' => 'Basque',
                'normalized' => 'basque',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            411 => 
            array (
                'tag_id' => 913,
                'name' => 'Galician',
                'normalized' => 'galician',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            412 => 
            array (
                'tag_id' => 914,
                'name' => 'Catalan',
                'normalized' => 'catalan',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            413 => 
            array (
                'tag_id' => 915,
                'name' => 'Occitan',
                'normalized' => 'occitan',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            414 => 
            array (
                'tag_id' => 916,
                'name' => 'Corsican',
                'normalized' => 'corsican',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            415 => 
            array (
                'tag_id' => 917,
                'name' => 'Aromanian',
                'normalized' => 'aromanian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            416 => 
            array (
                'tag_id' => 918,
                'name' => 'Bavarian',
                'normalized' => 'bavarian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            417 => 
            array (
                'tag_id' => 919,
                'name' => 'Sicilian',
                'normalized' => 'sicilian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            418 => 
            array (
                'tag_id' => 920,
                'name' => 'Romani',
                'normalized' => 'romani',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            419 => 
            array (
                'tag_id' => 921,
                'name' => 'Luxembourgish',
                'normalized' => 'luxembourgish',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            420 => 
            array (
                'tag_id' => 922,
                'name' => 'Frisian',
                'normalized' => 'frisian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            421 => 
            array (
                'tag_id' => 923,
                'name' => 'Ladin',
                'normalized' => 'ladin',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            422 => 
            array (
                'tag_id' => 924,
                'name' => 'Walloon',
                'normalized' => 'walloon',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            423 => 
            array (
                'tag_id' => 925,
                'name' => 'Scots',
                'normalized' => 'scots',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            424 => 
            array (
                'tag_id' => 926,
                'name' => 'Limburgish',
                'normalized' => 'limburgish',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            425 => 
            array (
                'tag_id' => 927,
                'name' => 'Alemannic German',
                'normalized' => 'alemannic german',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            426 => 
            array (
                'tag_id' => 928,
                'name' => 'Friulian',
                'normalized' => 'friulian',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            427 => 
            array (
                'tag_id' => 929,
                'name' => 'Carpentry',
                'normalized' => 'carpentry',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            428 => 
            array (
                'tag_id' => 930,
                'name' => 'Masonry',
                'normalized' => 'masonry',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            429 => 
            array (
                'tag_id' => 931,
                'name' => 'Concrete Work',
                'normalized' => 'concrete work',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            430 => 
            array (
                'tag_id' => 932,
                'name' => 'Plumbing',
                'normalized' => 'plumbing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            431 => 
            array (
                'tag_id' => 933,
                'name' => 'Electrical Wiring',
                'normalized' => 'electrical wiring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            432 => 
            array (
                'tag_id' => 934,
                'name' => 'Roofing',
                'normalized' => 'roofing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            433 => 
            array (
                'tag_id' => 935,
                'name' => 'Painting and Decorating',
                'normalized' => 'painting and decorating',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            434 => 
            array (
                'tag_id' => 936,
                'name' => 'Tiling',
                'normalized' => 'tiling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            435 => 
            array (
                'tag_id' => 937,
                'name' => 'Drywall Installation',
                'normalized' => 'drywall installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            436 => 
            array (
                'tag_id' => 938,
                'name' => 'Cabinetmaking',
                'normalized' => 'cabinetmaking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            437 => 
            array (
                'tag_id' => 939,
                'name' => 'Flooring Installation',
                'normalized' => 'flooring installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            438 => 
            array (
                'tag_id' => 940,
                'name' => 'Concrete Finishing',
                'normalized' => 'concrete finishing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            439 => 
            array (
                'tag_id' => 941,
                'name' => 'Framing',
                'normalized' => 'framing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            440 => 
            array (
                'tag_id' => 942,
                'name' => 'Window and Door Installation',
                'normalized' => 'window and door installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            441 => 
            array (
                'tag_id' => 943,
                'name' => 'Demolition',
                'normalized' => 'demolition',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            442 => 
            array (
                'tag_id' => 944,
                'name' => 'Insulation Installation',
                'normalized' => 'insulation installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            443 => 
            array (
                'tag_id' => 945,
                'name' => 'Welding',
                'normalized' => 'welding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            444 => 
            array (
                'tag_id' => 946,
                'name' => 'Plastering',
                'normalized' => 'plastering',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            445 => 
            array (
                'tag_id' => 947,
                'name' => 'Scaffolding',
                'normalized' => 'scaffolding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            446 => 
            array (
                'tag_id' => 948,
                'name' => 'Stonework',
                'normalized' => 'stonework',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            447 => 
            array (
                'tag_id' => 949,
                'name' => 'Roof Truss Installation',
                'normalized' => 'roof truss installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            448 => 
            array (
                'tag_id' => 950,
                'name' => 'Caulking and Sealing',
                'normalized' => 'caulking and sealing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            449 => 
            array (
                'tag_id' => 951,
                'name' => 'Landscaping',
                'normalized' => 'landscaping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            450 => 
            array (
                'tag_id' => 952,
                'name' => 'Grading and Excavation',
                'normalized' => 'grading and excavation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            451 => 
            array (
                'tag_id' => 953,
                'name' => 'Concrete Formwork',
                'normalized' => 'concrete formwork',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            452 => 
            array (
                'tag_id' => 954,
                'name' => 'Rough Carpentry',
                'normalized' => 'rough carpentry',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            453 => 
            array (
                'tag_id' => 955,
                'name' => 'Fence Installation',
                'normalized' => 'fence installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            454 => 
            array (
                'tag_id' => 956,
                'name' => 'Bricklaying',
                'normalized' => 'bricklaying',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            455 => 
            array (
                'tag_id' => 957,
                'name' => 'Paving',
                'normalized' => 'paving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            456 => 
            array (
                'tag_id' => 958,
                'name' => 'Soldering',
                'normalized' => 'soldering',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            457 => 
            array (
                'tag_id' => 959,
                'name' => 'Sheet Metal Fabrication',
                'normalized' => 'sheet metal fabrication',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            458 => 
            array (
                'tag_id' => 960,
                'name' => 'Cabinet Installation',
                'normalized' => 'cabinet installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            459 => 
            array (
                'tag_id' => 961,
                'name' => 'Deck Building',
                'normalized' => 'deck building',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            460 => 
            array (
                'tag_id' => 962,
                'name' => 'Crown Molding Installation',
                'normalized' => 'crown molding installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            461 => 
            array (
                'tag_id' => 963,
                'name' => 'Epoxy Flooring Application',
                'normalized' => 'epoxy flooring application',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            462 => 
            array (
                'tag_id' => 964,
                'name' => 'Glass Installation',
                'normalized' => 'glass installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            463 => 
            array (
                'tag_id' => 965,
                'name' => 'Cabinet Refinishing',
                'normalized' => 'cabinet refinishing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            464 => 
            array (
                'tag_id' => 966,
                'name' => 'Masonry Restoration',
                'normalized' => 'masonry restoration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            465 => 
            array (
                'tag_id' => 967,
                'name' => 'Trenching',
                'normalized' => 'trenching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            466 => 
            array (
                'tag_id' => 968,
                'name' => 'Gutter Installation',
                'normalized' => 'gutter installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            467 => 
            array (
                'tag_id' => 969,
                'name' => 'Concrete Repair',
                'normalized' => 'concrete repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            468 => 
            array (
                'tag_id' => 970,
                'name' => 'Shingle Roofing Repair',
                'normalized' => 'shingle roofing repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            469 => 
            array (
                'tag_id' => 971,
                'name' => 'Window Repair',
                'normalized' => 'window repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            470 => 
            array (
                'tag_id' => 972,
                'name' => 'Drywall Repair',
                'normalized' => 'drywall repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            471 => 
            array (
                'tag_id' => 973,
                'name' => 'Plumbing Repair',
                'normalized' => 'plumbing repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            472 => 
            array (
                'tag_id' => 974,
                'name' => 'Electrical Repair',
                'normalized' => 'electrical repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            473 => 
            array (
                'tag_id' => 975,
                'name' => 'Tile Repair',
                'normalized' => 'tile repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            474 => 
            array (
                'tag_id' => 976,
                'name' => 'Carpentry Repair',
                'normalized' => 'carpentry repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            475 => 
            array (
                'tag_id' => 977,
                'name' => 'Siding Repair',
                'normalized' => 'siding repair',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            476 => 
            array (
                'tag_id' => 978,
                'name' => 'Typing',
                'normalized' => 'typing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            477 => 
            array (
                'tag_id' => 979,
                'name' => 'File Management',
                'normalized' => 'file management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            478 => 
            array (
                'tag_id' => 980,
                'name' => 'Word Processing',
                'normalized' => 'word processing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            479 => 
            array (
                'tag_id' => 981,
                'name' => 'Spreadsheets',
                'normalized' => 'spreadsheets',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            480 => 
            array (
                'tag_id' => 982,
                'name' => 'Presentation Software',
                'normalized' => 'presentation software',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            481 => 
            array (
                'tag_id' => 983,
                'name' => 'Web Browsing',
                'normalized' => 'web browsing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            482 => 
            array (
                'tag_id' => 984,
                'name' => 'Basic Computer Troubleshooting',
                'normalized' => 'basic computer troubleshooting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            483 => 
            array (
                'tag_id' => 985,
                'name' => 'Linux Operating Systems',
                'normalized' => 'linux operating systems',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            484 => 
            array (
                'tag_id' => 986,
                'name' => 'Windows Operating Systems',
                'normalized' => 'windows operating systems',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            485 => 
            array (
                'tag_id' => 987,
                'name' => 'MacOs Operating Systems',
                'normalized' => 'macos operating systems',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            486 => 
            array (
                'tag_id' => 988,
                'name' => 'Online Communication',
                'normalized' => 'online communication',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            487 => 
            array (
                'tag_id' => 989,
                'name' => 'Social Media',
                'normalized' => 'social media',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            488 => 
            array (
                'tag_id' => 990,
                'name' => 'Basic HTML Coding',
                'normalized' => 'basic html coding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            489 => 
            array (
                'tag_id' => 991,
                'name' => 'Data Entry',
                'normalized' => 'data entry',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            490 => 
            array (
                'tag_id' => 992,
                'name' => 'Remote Collaboration',
                'normalized' => 'remote collaboration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            491 => 
            array (
                'tag_id' => 993,
                'name' => 'Cybersecurity Awareness',
                'normalized' => 'cybersecurity awareness',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            492 => 
            array (
                'tag_id' => 994,
                'name' => 'Cloud Storage',
                'normalized' => 'cloud storage',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            493 => 
            array (
                'tag_id' => 995,
                'name' => 'Basic Graphic Design',
                'normalized' => 'basic graphic design',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            494 => 
            array (
                'tag_id' => 996,
                'name' => 'Video Conferencing',
                'normalized' => 'video conferencing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            495 => 
            array (
                'tag_id' => 997,
                'name' => 'Digital Note-Taking',
                'normalized' => 'digital note-taking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            496 => 
            array (
                'tag_id' => 998,
                'name' => 'Basic Database Usage',
                'normalized' => 'basic database usage',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            497 => 
            array (
                'tag_id' => 999,
                'name' => 'Online Research',
                'normalized' => 'online research',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            498 => 
            array (
                'tag_id' => 1000,
                'name' => 'Basic Spreadsheet Formulas',
                'normalized' => 'basic spreadsheet formulas',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            499 => 
            array (
                'tag_id' => 1001,
                'name' => 'Email Etiquette',
                'normalized' => 'email etiquette',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
        ));
        \DB::table('taggable_tags')->insert(array (
            0 => 
            array (
                'tag_id' => 1002,
                'name' => 'Text Editing',
                'normalized' => 'text editing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            1 => 
            array (
                'tag_id' => 1003,
                'name' => 'Backup and Recovery',
                'normalized' => 'backup and recovery',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            2 => 
            array (
                'tag_id' => 1004,
                'name' => 'Keyboard Shortcuts',
                'normalized' => 'keyboard shortcuts',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            3 => 
            array (
                'tag_id' => 1005,
                'name' => 'Basic Data Analysis',
                'normalized' => 'basic data analysis',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            4 => 
            array (
                'tag_id' => 1006,
                'name' => 'Task Management Software',
                'normalized' => 'task management software',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            5 => 
            array (
                'tag_id' => 1007,
                'name' => 'Online Shopping',
                'normalized' => 'online shopping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            6 => 
            array (
                'tag_id' => 1008,
                'name' => 'Webinars and Online Courses',
                'normalized' => 'webinars and online courses',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            7 => 
            array (
                'tag_id' => 1009,
                'name' => 'Basic Image Editing',
                'normalized' => 'basic image editing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            8 => 
            array (
                'tag_id' => 1010,
                'name' => 'Device Syncing',
                'normalized' => 'device syncing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            9 => 
            array (
                'tag_id' => 1011,
                'name' => 'Password Management',
                'normalized' => 'password management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            10 => 
            array (
                'tag_id' => 1012,
                'name' => 'Video Streaming',
                'normalized' => 'video streaming',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            11 => 
            array (
                'tag_id' => 1013,
                'name' => 'Basic Audio Editing',
                'normalized' => 'basic audio editing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            12 => 
            array (
                'tag_id' => 1014,
                'name' => 'Virtual Reality Navigation',
                'normalized' => 'virtual reality navigation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            13 => 
            array (
                'tag_id' => 1015,
                'name' => 'Remote Desktop Access',
                'normalized' => 'remote desktop access',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            14 => 
            array (
                'tag_id' => 1016,
                'name' => 'Online Gaming',
                'normalized' => 'online gaming',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            15 => 
            array (
                'tag_id' => 1017,
                'name' => 'Basic Video Editing',
                'normalized' => 'basic video editing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            16 => 
            array (
                'tag_id' => 1018,
                'name' => 'Creating Digital Presentations',
                'normalized' => 'creating digital presentations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            17 => 
            array (
                'tag_id' => 1019,
                'name' => 'Digital Calendars',
                'normalized' => 'digital calendars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            18 => 
            array (
                'tag_id' => 1020,
                'name' => 'Basic Animation',
                'normalized' => 'basic animation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            19 => 
            array (
                'tag_id' => 1021,
                'name' => 'Online Survey Tools',
                'normalized' => 'online survey tools',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            20 => 
            array (
                'tag_id' => 1022,
                'name' => 'PHP Web Development',
                'normalized' => 'php web development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            21 => 
            array (
                'tag_id' => 1023,
                'name' => 'Basic Project Management',
                'normalized' => 'basic project management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            22 => 
            array (
                'tag_id' => 1024,
                'name' => 'Virtual Meetings',
                'normalized' => 'virtual meetings',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            23 => 
            array (
                'tag_id' => 1025,
                'name' => 'Online Photo Sharing',
                'normalized' => 'online photo sharing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            24 => 
            array (
                'tag_id' => 1026,
                'name' => 'Adobe Photoshop',
                'normalized' => 'adobe photoshop',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            25 => 
            array (
                'tag_id' => 1027,
                'name' => 'Microsoft Excel Functions',
                'normalized' => 'microsoft excel functions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            26 => 
            array (
                'tag_id' => 1028,
                'name' => 'Google Analytics',
                'normalized' => 'google analytics',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            27 => 
            array (
                'tag_id' => 1029,
                'name' => 'AutoCAD',
                'normalized' => 'autocad',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            28 => 
            array (
                'tag_id' => 1030,
                'name' => 'Microsoft PowerPoint Animation',
                'normalized' => 'microsoft powerpoint animation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            29 => 
            array (
                'tag_id' => 1031,
                'name' => 'Google Docs Collaboration',
                'normalized' => 'google docs collaboration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            30 => 
            array (
                'tag_id' => 1032,
                'name' => 'Adobe Illustrator',
                'normalized' => 'adobe illustrator',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            31 => 
            array (
                'tag_id' => 1033,
                'name' => 'Microsoft Word Formatting',
                'normalized' => 'microsoft word formatting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            32 => 
            array (
                'tag_id' => 1034,
            'name' => 'Content Management Systems (CMS)',
            'normalized' => 'content management systems (cms)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            33 => 
            array (
                'tag_id' => 1035,
            'name' => 'Video Editing Software (e.g., Adobe Premiere)',
            'normalized' => 'video editing software (e.g., adobe premiere)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            34 => 
            array (
                'tag_id' => 1036,
                'name' => 'Microsoft Outlook Calendar',
                'normalized' => 'microsoft outlook calendar',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            35 => 
            array (
                'tag_id' => 1037,
            'name' => 'Graphic Design Software (e.g., CorelDRAW)',
            'normalized' => 'graphic design software (e.g., coreldraw)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            36 => 
            array (
                'tag_id' => 1038,
            'name' => 'Data Visualization Tools (e.g., Tableau)',
            'normalized' => 'data visualization tools (e.g., tableau)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            37 => 
            array (
                'tag_id' => 1039,
            'name' => 'Programming (e.g., Python)',
            'normalized' => 'programming (e.g., python)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            38 => 
            array (
                'tag_id' => 1040,
            'name' => 'Web Development Frameworks (e.g., Bootstrap)',
            'normalized' => 'web development frameworks (e.g., bootstrap)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            39 => 
            array (
                'tag_id' => 1041,
            'name' => 'Video Conferencing Tools (e.g., Zoom)',
            'normalized' => 'video conferencing tools (e.g., zoom)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            40 => 
            array (
                'tag_id' => 1042,
            'name' => 'Customer Relationship Management (CRM) Software (e.g., Salesforce)',
            'normalized' => 'customer relationship management (crm) software (e.g., salesforce)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            41 => 
            array (
                'tag_id' => 1043,
            'name' => 'Desktop Publishing Software (e.g., Adobe InDesign)',
            'normalized' => 'desktop publishing software (e.g., adobe indesign)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            42 => 
            array (
                'tag_id' => 1044,
            'name' => '3D Modeling Software (e.g., Blender)',
            'normalized' => '3d modeling software (e.g., blender)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            43 => 
            array (
                'tag_id' => 1045,
            'name' => 'Database Management Software (e.g., MySQL)',
            'normalized' => 'database management software (e.g., mysql)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            44 => 
            array (
                'tag_id' => 1046,
            'name' => 'Code Version Control (e.g., Git)',
            'normalized' => 'code version control (e.g., git)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            45 => 
            array (
                'tag_id' => 1047,
            'name' => 'Virtual Reality Software (e.g., Unity)',
            'normalized' => 'virtual reality software (e.g., unity)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            46 => 
            array (
                'tag_id' => 1048,
            'name' => 'Document Collaboration (e.g., Google Docs)',
            'normalized' => 'document collaboration (e.g., google docs)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            47 => 
            array (
                'tag_id' => 1049,
            'name' => 'E-commerce Platforms (e.g., Shopify)',
            'normalized' => 'e-commerce platforms (e.g., shopify)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            48 => 
            array (
                'tag_id' => 1050,
            'name' => 'Data Analysis Software (e.g., R)',
            'normalized' => 'data analysis software (e.g., r)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            49 => 
            array (
                'tag_id' => 1051,
            'name' => 'Presentation Design Software (e.g., Canva)',
            'normalized' => 'presentation design software (e.g., canva)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            50 => 
            array (
                'tag_id' => 1052,
            'name' => 'CAD Software (e.g., SolidWorks)',
            'normalized' => 'cad software (e.g., solidworks)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            51 => 
            array (
                'tag_id' => 1053,
            'name' => 'Video Streaming Platforms (e.g., Twitch)',
            'normalized' => 'video streaming platforms (e.g., twitch)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            52 => 
            array (
                'tag_id' => 1054,
            'name' => 'Project Management Tools (e.g., Asana)',
            'normalized' => 'project management tools (e.g., asana)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            53 => 
            array (
                'tag_id' => 1055,
            'name' => 'Text Editing Software (e.g., Sublime Text)',
            'normalized' => 'text editing software (e.g., sublime text)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            54 => 
            array (
                'tag_id' => 1056,
            'name' => 'Audio Editing Software (e.g., Audacity)',
            'normalized' => 'audio editing software (e.g., audacity)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            55 => 
            array (
                'tag_id' => 1057,
            'name' => 'Remote Desktop Software (e.g., TeamViewer)',
            'normalized' => 'remote desktop software (e.g., teamviewer)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            56 => 
            array (
                'tag_id' => 1058,
            'name' => 'Online Survey Platforms (e.g., SurveyMonkey)',
            'normalized' => 'online survey platforms (e.g., surveymonkey)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            57 => 
            array (
                'tag_id' => 1059,
            'name' => 'Web Design Software (e.g., Adobe Dreamweaver)',
            'normalized' => 'web design software (e.g., adobe dreamweaver)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            58 => 
            array (
                'tag_id' => 1060,
            'name' => 'Programming IDEs (e.g., Visual Studio Code)',
            'normalized' => 'programming ides (e.g., visual studio code)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            59 => 
            array (
                'tag_id' => 1061,
            'name' => 'Database Reporting Tools (e.g., Crystal Reports)',
            'normalized' => 'database reporting tools (e.g., crystal reports)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            60 => 
            array (
                'tag_id' => 1062,
            'name' => 'Video Recording Software (e.g., OBS Studio)',
            'normalized' => 'video recording software (e.g., obs studio)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            61 => 
            array (
                'tag_id' => 1063,
            'name' => 'Animation Software (e.g., Toon Boom Harmony)',
            'normalized' => 'animation software (e.g., toon boom harmony)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            62 => 
            array (
                'tag_id' => 1064,
            'name' => 'Collaborative Design Tools (e.g., Figma)',
            'normalized' => 'collaborative design tools (e.g., figma)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            63 => 
            array (
                'tag_id' => 1065,
            'name' => 'Customer Support Platforms (e.g., Zendesk)',
            'normalized' => 'customer support platforms (e.g., zendesk)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            64 => 
            array (
                'tag_id' => 1066,
            'name' => 'Code Editors (e.g., Atom)',
            'normalized' => 'code editors (e.g., atom)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            65 => 
            array (
                'tag_id' => 1067,
            'name' => 'Audio Recording Software (e.g., GarageBand)',
            'normalized' => 'audio recording software (e.g., garageband)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            66 => 
            array (
                'tag_id' => 1068,
            'name' => 'Virtual Machine Software (e.g., VMware)',
            'normalized' => 'virtual machine software (e.g., vmware)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            67 => 
            array (
                'tag_id' => 1069,
            'name' => 'Online Learning Platforms (e.g., Coursera)',
            'normalized' => 'online learning platforms (e.g., coursera)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            68 => 
            array (
                'tag_id' => 1070,
            'name' => 'Web Hosting Platforms (e.g., Bluehost)',
            'normalized' => 'web hosting platforms (e.g., bluehost)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            69 => 
            array (
                'tag_id' => 1071,
            'name' => 'CAD/CAM Software (e.g., Fusion 360)',
            'normalized' => 'cad/cam software (e.g., fusion 360)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            70 => 
            array (
                'tag_id' => 1072,
            'name' => 'Visual Effects Software (e.g., After Effects)',
            'normalized' => 'visual effects software (e.g., after effects)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            71 => 
            array (
                'tag_id' => 1073,
            'name' => 'Screen Capture Software (e.g., Snagit)',
            'normalized' => 'screen capture software (e.g., snagit)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            72 => 
            array (
                'tag_id' => 1074,
            'name' => 'Presentation Recording (e.g., Loom)',
            'normalized' => 'presentation recording (e.g., loom)',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            73 => 
            array (
                'tag_id' => 1075,
                'name' => 'Effective Communication',
                'normalized' => 'effective communication',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            74 => 
            array (
                'tag_id' => 1076,
                'name' => 'Active Listening',
                'normalized' => 'active listening',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            75 => 
            array (
                'tag_id' => 1077,
                'name' => 'Conflict Resolution',
                'normalized' => 'conflict resolution',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            76 => 
            array (
                'tag_id' => 1078,
                'name' => 'Teamwork',
                'normalized' => 'teamwork',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            77 => 
            array (
                'tag_id' => 1079,
                'name' => 'Problem Solving',
                'normalized' => 'problem solving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            78 => 
            array (
                'tag_id' => 1080,
                'name' => 'Empathy',
                'normalized' => 'empathy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            79 => 
            array (
                'tag_id' => 1081,
                'name' => 'Negotiation',
                'normalized' => 'negotiation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            80 => 
            array (
                'tag_id' => 1082,
                'name' => 'Delegation',
                'normalized' => 'delegation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            81 => 
            array (
                'tag_id' => 1083,
                'name' => 'Time Management',
                'normalized' => 'time management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            82 => 
            array (
                'tag_id' => 1084,
                'name' => 'Adaptability',
                'normalized' => 'adaptability',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            83 => 
            array (
                'tag_id' => 1085,
                'name' => 'Open-Mindedness',
                'normalized' => 'open-mindedness',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            84 => 
            array (
                'tag_id' => 1086,
                'name' => 'Feedback Giving',
                'normalized' => 'feedback giving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            85 => 
            array (
                'tag_id' => 1087,
                'name' => 'Feedback Receiving',
                'normalized' => 'feedback receiving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            86 => 
            array (
                'tag_id' => 1088,
                'name' => 'Collaborative Decision-Making',
                'normalized' => 'collaborative decision-making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            87 => 
            array (
                'tag_id' => 1089,
                'name' => 'Conflict Management',
                'normalized' => 'conflict management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            88 => 
            array (
                'tag_id' => 1090,
                'name' => 'Cultural Sensitivity',
                'normalized' => 'cultural sensitivity',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            89 => 
            array (
                'tag_id' => 1091,
                'name' => 'Facilitation',
                'normalized' => 'facilitation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            90 => 
            array (
                'tag_id' => 1092,
                'name' => 'Trust Building',
                'normalized' => 'trust building',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            91 => 
            array (
                'tag_id' => 1093,
                'name' => 'Consensus Building',
                'normalized' => 'consensus building',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            92 => 
            array (
                'tag_id' => 1094,
                'name' => 'Cross-Functional Collaboration',
                'normalized' => 'cross-functional collaboration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            93 => 
            array (
                'tag_id' => 1095,
                'name' => 'Remote Collaboration',
                'normalized' => 'remote collaboration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            94 => 
            array (
                'tag_id' => 1096,
                'name' => 'Conflict Avoidance',
                'normalized' => 'conflict avoidance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            95 => 
            array (
                'tag_id' => 1097,
                'name' => 'Decision Consistency',
                'normalized' => 'decision consistency',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            96 => 
            array (
                'tag_id' => 1098,
                'name' => 'Problem Framing',
                'normalized' => 'problem framing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            97 => 
            array (
                'tag_id' => 1099,
                'name' => 'Collaborative Innovation',
                'normalized' => 'collaborative innovation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            98 => 
            array (
                'tag_id' => 1100,
                'name' => 'Resource Sharing',
                'normalized' => 'resource sharing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            99 => 
            array (
                'tag_id' => 1101,
                'name' => 'Remote Meeting Facilitation',
                'normalized' => 'remote meeting facilitation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            100 => 
            array (
                'tag_id' => 1102,
                'name' => 'Communication Planning',
                'normalized' => 'communication planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            101 => 
            array (
                'tag_id' => 1103,
                'name' => 'Active Participation',
                'normalized' => 'active participation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            102 => 
            array (
                'tag_id' => 1104,
                'name' => 'Task Allocation',
                'normalized' => 'task allocation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            103 => 
            array (
                'tag_id' => 1105,
                'name' => 'Collaborative Problem Diagnosis',
                'normalized' => 'collaborative problem diagnosis',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            104 => 
            array (
                'tag_id' => 1106,
                'name' => 'Collaborative Learning',
                'normalized' => 'collaborative learning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            105 => 
            array (
                'tag_id' => 1107,
                'name' => 'Conflict Transformation',
                'normalized' => 'conflict transformation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            106 => 
            array (
                'tag_id' => 1108,
                'name' => 'Collaborative Decision Prioritization',
                'normalized' => 'collaborative decision prioritization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            107 => 
            array (
                'tag_id' => 1109,
                'name' => 'Interpersonal Flexibility',
                'normalized' => 'interpersonal flexibility',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            108 => 
            array (
                'tag_id' => 1110,
                'name' => 'Shared Vision',
                'normalized' => 'shared vision',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            109 => 
            array (
                'tag_id' => 1111,
                'name' => 'Mutual Accountability',
                'normalized' => 'mutual accountability',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            110 => 
            array (
                'tag_id' => 1112,
                'name' => 'Virtual Team Building',
                'normalized' => 'virtual team building',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            111 => 
            array (
                'tag_id' => 1113,
                'name' => 'Collaborative Reflection',
                'normalized' => 'collaborative reflection',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            112 => 
            array (
                'tag_id' => 1114,
                'name' => 'Inclusive Collaboration',
                'normalized' => 'inclusive collaboration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            113 => 
            array (
                'tag_id' => 1115,
                'name' => 'Conflict Transformation',
                'normalized' => 'conflict transformation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            114 => 
            array (
                'tag_id' => 1116,
                'name' => 'Solution-Oriented Collaboration',
                'normalized' => 'solution-oriented collaboration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            115 => 
            array (
                'tag_id' => 1117,
                'name' => 'Collaborative Brainstorming',
                'normalized' => 'collaborative brainstorming',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            116 => 
            array (
                'tag_id' => 1118,
                'name' => 'Collaborative Evaluation',
                'normalized' => 'collaborative evaluation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            117 => 
            array (
                'tag_id' => 1119,
                'name' => 'Interdisciplinary Collaboration',
                'normalized' => 'interdisciplinary collaboration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            118 => 
            array (
                'tag_id' => 1120,
                'name' => 'Conflict Transformation',
                'normalized' => 'conflict transformation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            119 => 
            array (
                'tag_id' => 1121,
                'name' => 'Collective Ownership',
                'normalized' => 'collective ownership',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            120 => 
            array (
                'tag_id' => 1122,
                'name' => 'Empathy',
                'normalized' => 'empathy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            121 => 
            array (
                'tag_id' => 1123,
                'name' => 'Patience',
                'normalized' => 'patience',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            122 => 
            array (
                'tag_id' => 1124,
                'name' => 'Compassion',
                'normalized' => 'compassion',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            123 => 
            array (
                'tag_id' => 1125,
                'name' => 'Active Listening',
                'normalized' => 'active listening',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            124 => 
            array (
                'tag_id' => 1126,
                'name' => 'Medical Communication',
                'normalized' => 'medical communication',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            125 => 
            array (
                'tag_id' => 1127,
                'name' => 'Medication Administration',
                'normalized' => 'medication administration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            126 => 
            array (
                'tag_id' => 1128,
                'name' => 'Personal Care Assistance',
                'normalized' => 'personal care assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            127 => 
            array (
                'tag_id' => 1129,
                'name' => 'Meal Preparation',
                'normalized' => 'meal preparation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            128 => 
            array (
                'tag_id' => 1130,
                'name' => 'Hygiene Support',
                'normalized' => 'hygiene support',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            129 => 
            array (
                'tag_id' => 1131,
                'name' => 'Crisis Management',
                'normalized' => 'crisis management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            130 => 
            array (
                'tag_id' => 1132,
                'name' => 'First Aid',
                'normalized' => 'first aid',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            131 => 
            array (
                'tag_id' => 1133,
                'name' => 'Emotional Support',
                'normalized' => 'emotional support',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            132 => 
            array (
                'tag_id' => 1134,
                'name' => 'Childcare',
                'normalized' => 'childcare',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            133 => 
            array (
                'tag_id' => 1135,
                'name' => 'Elderly Companionship',
                'normalized' => 'elderly companionship',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            134 => 
            array (
                'tag_id' => 1136,
                'name' => 'Medical Monitoring',
                'normalized' => 'medical monitoring',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            135 => 
            array (
                'tag_id' => 1137,
                'name' => 'Physical Therapy Assistance',
                'normalized' => 'physical therapy assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            136 => 
            array (
                'tag_id' => 1138,
                'name' => 'Respite Care',
                'normalized' => 'respite care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            137 => 
            array (
                'tag_id' => 1139,
                'name' => 'Autism Support',
                'normalized' => 'autism support',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            138 => 
            array (
                'tag_id' => 1140,
                'name' => 'Dementia Care',
                'normalized' => 'dementia care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            139 => 
            array (
                'tag_id' => 1141,
                'name' => 'Palliative Care',
                'normalized' => 'palliative care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            140 => 
            array (
                'tag_id' => 1142,
                'name' => 'Patient Advocacy',
                'normalized' => 'patient advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            141 => 
            array (
                'tag_id' => 1143,
                'name' => 'Infant Care',
                'normalized' => 'infant care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            142 => 
            array (
                'tag_id' => 1144,
                'name' => 'Bedside Care',
                'normalized' => 'bedside care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            143 => 
            array (
                'tag_id' => 1145,
                'name' => 'Hospice Support',
                'normalized' => 'hospice support',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            144 => 
            array (
                'tag_id' => 1146,
                'name' => 'Home Health Aid',
                'normalized' => 'home health aid',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            145 => 
            array (
                'tag_id' => 1147,
                'name' => 'Special Needs Care',
                'normalized' => 'special needs care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            146 => 
            array (
                'tag_id' => 1148,
                'name' => 'Grief Counseling',
                'normalized' => 'grief counseling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            147 => 
            array (
                'tag_id' => 1149,
                'name' => 'Alzheimer\'s Care',
                'normalized' => 'alzheimer\'s care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            148 => 
            array (
                'tag_id' => 1150,
                'name' => 'Child Safety',
                'normalized' => 'child safety',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            149 => 
            array (
                'tag_id' => 1151,
                'name' => 'Bathing Assistance',
                'normalized' => 'bathing assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            150 => 
            array (
                'tag_id' => 1152,
                'name' => 'Medical Documentation',
                'normalized' => 'medical documentation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            151 => 
            array (
                'tag_id' => 1153,
                'name' => 'Tube Feeding',
                'normalized' => 'tube feeding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            152 => 
            array (
                'tag_id' => 1154,
                'name' => 'Infection Control',
                'normalized' => 'infection control',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            153 => 
            array (
                'tag_id' => 1155,
                'name' => 'Cognitive Stimulation',
                'normalized' => 'cognitive stimulation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            154 => 
            array (
                'tag_id' => 1156,
                'name' => 'Adaptive Equipment',
                'normalized' => 'adaptive equipment',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            155 => 
            array (
                'tag_id' => 1157,
                'name' => 'Bedridden Care',
                'normalized' => 'bedridden care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            156 => 
            array (
                'tag_id' => 1158,
                'name' => 'Feeding Assistance',
                'normalized' => 'feeding assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            157 => 
            array (
                'tag_id' => 1159,
                'name' => 'Wheelchair Mobility',
                'normalized' => 'wheelchair mobility',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            158 => 
            array (
                'tag_id' => 1160,
                'name' => 'Compassionate Communication',
                'normalized' => 'compassionate communication',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            159 => 
            array (
                'tag_id' => 1161,
                'name' => 'Social Interaction',
                'normalized' => 'social interaction',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            160 => 
            array (
                'tag_id' => 1162,
                'name' => 'Pain Management',
                'normalized' => 'pain management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            161 => 
            array (
                'tag_id' => 1163,
                'name' => 'Feeding Tube Care',
                'normalized' => 'feeding tube care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            162 => 
            array (
                'tag_id' => 1164,
                'name' => 'Cultural Sensitivity',
                'normalized' => 'cultural sensitivity',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            163 => 
            array (
                'tag_id' => 1165,
                'name' => 'Comfort Care',
                'normalized' => 'comfort care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            164 => 
            array (
                'tag_id' => 1166,
                'name' => 'Incontinence Care',
                'normalized' => 'incontinence care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            165 => 
            array (
                'tag_id' => 1167,
                'name' => 'Assistive Communication',
                'normalized' => 'assistive communication',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            166 => 
            array (
                'tag_id' => 1168,
                'name' => 'Awareness Campaigning',
                'normalized' => 'awareness campaigning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            167 => 
            array (
                'tag_id' => 1169,
                'name' => 'Community Organizing',
                'normalized' => 'community organizing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            168 => 
            array (
                'tag_id' => 1170,
                'name' => 'Advocacy',
                'normalized' => 'advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            169 => 
            array (
                'tag_id' => 1171,
                'name' => 'Protest Planning',
                'normalized' => 'protest planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            170 => 
            array (
                'tag_id' => 1172,
                'name' => 'Petition Creation',
                'normalized' => 'petition creation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            171 => 
            array (
                'tag_id' => 1173,
                'name' => 'Public Speaking',
                'normalized' => 'public speaking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            172 => 
            array (
                'tag_id' => 1174,
                'name' => 'Media Outreach',
                'normalized' => 'media outreach',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            173 => 
            array (
                'tag_id' => 1175,
                'name' => 'Coalition Building',
                'normalized' => 'coalition building',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            174 => 
            array (
                'tag_id' => 1176,
                'name' => 'Lobbying',
                'normalized' => 'lobbying',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            175 => 
            array (
                'tag_id' => 1177,
                'name' => 'Digital Activism',
                'normalized' => 'digital activism',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            176 => 
            array (
                'tag_id' => 1178,
                'name' => 'Event Planning',
                'normalized' => 'event planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            177 => 
            array (
                'tag_id' => 1179,
                'name' => 'Storytelling',
                'normalized' => 'storytelling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            178 => 
            array (
                'tag_id' => 1180,
                'name' => 'Grassroots Campaigning',
                'normalized' => 'grassroots campaigning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            179 => 
            array (
                'tag_id' => 1181,
                'name' => 'Policy Analysis',
                'normalized' => 'policy analysis',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            180 => 
            array (
                'tag_id' => 1182,
                'name' => 'Social Media Management',
                'normalized' => 'social media management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            181 => 
            array (
                'tag_id' => 1183,
                'name' => 'Fundraising',
                'normalized' => 'fundraising',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            182 => 
            array (
                'tag_id' => 1184,
                'name' => 'Artistic Activism',
                'normalized' => 'artistic activism',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            183 => 
            array (
                'tag_id' => 1185,
                'name' => 'Nonviolent Resistance Training',
                'normalized' => 'nonviolent resistance training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            184 => 
            array (
                'tag_id' => 1186,
                'name' => 'Public Education',
                'normalized' => 'public education',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            185 => 
            array (
                'tag_id' => 1187,
                'name' => 'Crisis Response',
                'normalized' => 'crisis response',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            186 => 
            array (
                'tag_id' => 1188,
                'name' => 'Digital Storytelling',
                'normalized' => 'digital storytelling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            187 => 
            array (
                'tag_id' => 1189,
                'name' => 'Community Engagement',
                'normalized' => 'community engagement',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            188 => 
            array (
                'tag_id' => 1190,
                'name' => 'Policy Advocacy',
                'normalized' => 'policy advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            189 => 
            array (
                'tag_id' => 1191,
                'name' => 'Intersectional Activism',
                'normalized' => 'intersectional activism',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            190 => 
            array (
                'tag_id' => 1192,
                'name' => 'Campaign Strategy',
                'normalized' => 'campaign strategy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            191 => 
            array (
                'tag_id' => 1193,
                'name' => 'Volunteer Coordination',
                'normalized' => 'volunteer coordination',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            192 => 
            array (
                'tag_id' => 1194,
                'name' => 'Corporate Activism',
                'normalized' => 'corporate activism',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            193 => 
            array (
                'tag_id' => 1195,
                'name' => 'Letter Writing',
                'normalized' => 'letter writing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            194 => 
            array (
                'tag_id' => 1196,
                'name' => 'Awareness Art',
                'normalized' => 'awareness art',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            195 => 
            array (
                'tag_id' => 1197,
                'name' => 'Solidarity Building',
                'normalized' => 'solidarity building',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            196 => 
            array (
                'tag_id' => 1198,
                'name' => 'Campaign Evaluation',
                'normalized' => 'campaign evaluation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            197 => 
            array (
                'tag_id' => 1199,
                'name' => 'Online Activism',
                'normalized' => 'online activism',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            198 => 
            array (
                'tag_id' => 1200,
                'name' => 'Public Policy Research',
                'normalized' => 'public policy research',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            199 => 
            array (
                'tag_id' => 1201,
                'name' => 'Economic Activism',
                'normalized' => 'economic activism',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            200 => 
            array (
                'tag_id' => 1202,
                'name' => 'Resource Mobilization',
                'normalized' => 'resource mobilization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            201 => 
            array (
                'tag_id' => 1203,
                'name' => 'Strategic Communications',
                'normalized' => 'strategic communications',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            202 => 
            array (
                'tag_id' => 1204,
                'name' => 'Allyship',
                'normalized' => 'allyship',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            203 => 
            array (
                'tag_id' => 1205,
                'name' => 'International Advocacy',
                'normalized' => 'international advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            204 => 
            array (
                'tag_id' => 1206,
                'name' => 'Online Petitioning',
                'normalized' => 'online petitioning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            205 => 
            array (
                'tag_id' => 1207,
                'name' => 'Public Demonstration',
                'normalized' => 'public demonstration',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            206 => 
            array (
                'tag_id' => 1208,
                'name' => 'Legislative Advocacy',
                'normalized' => 'legislative advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            207 => 
            array (
                'tag_id' => 1209,
                'name' => 'Social Justice Training',
                'normalized' => 'social justice training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            208 => 
            array (
                'tag_id' => 1210,
                'name' => 'Issue Campaigning',
                'normalized' => 'issue campaigning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            209 => 
            array (
                'tag_id' => 1211,
                'name' => 'Public Awareness Workshops',
                'normalized' => 'public awareness workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            210 => 
            array (
                'tag_id' => 1212,
                'name' => 'Voter Education',
                'normalized' => 'voter education',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            211 => 
            array (
                'tag_id' => 1213,
                'name' => 'Environmental Activism',
                'normalized' => 'environmental activism',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            212 => 
            array (
                'tag_id' => 1214,
                'name' => 'Community Empowerment',
                'normalized' => 'community empowerment',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            213 => 
            array (
                'tag_id' => 1215,
                'name' => 'Knife Skills',
                'normalized' => 'knife skills',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            214 => 
            array (
                'tag_id' => 1216,
                'name' => 'Cooking Techniques',
                'normalized' => 'cooking techniques',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            215 => 
            array (
                'tag_id' => 1217,
                'name' => 'Flavor Pairing',
                'normalized' => 'flavor pairing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            216 => 
            array (
                'tag_id' => 1218,
                'name' => 'Seasoning',
                'normalized' => 'seasoning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            217 => 
            array (
                'tag_id' => 1219,
                'name' => 'Meal Planning',
                'normalized' => 'meal planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            218 => 
            array (
                'tag_id' => 1220,
                'name' => 'Food Safety',
                'normalized' => 'food safety',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            219 => 
            array (
                'tag_id' => 1221,
                'name' => 'Baking',
                'normalized' => 'baking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            220 => 
            array (
                'tag_id' => 1222,
                'name' => 'Grilling',
                'normalized' => 'grilling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            221 => 
            array (
                'tag_id' => 1223,
                'name' => 'Sous Vide Cooking',
                'normalized' => 'sous vide cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            222 => 
            array (
                'tag_id' => 1224,
                'name' => 'Pasta Making',
                'normalized' => 'pasta making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            223 => 
            array (
                'tag_id' => 1225,
                'name' => 'Sauce Making',
                'normalized' => 'sauce making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            224 => 
            array (
                'tag_id' => 1226,
                'name' => 'Fermentation',
                'normalized' => 'fermentation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            225 => 
            array (
                'tag_id' => 1227,
                'name' => 'Plating Presentation',
                'normalized' => 'plating presentation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            226 => 
            array (
                'tag_id' => 1228,
                'name' => 'Salad Creation',
                'normalized' => 'salad creation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            227 => 
            array (
                'tag_id' => 1229,
                'name' => 'Dough Kneading',
                'normalized' => 'dough kneading',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            228 => 
            array (
                'tag_id' => 1230,
                'name' => 'Garnishing',
                'normalized' => 'garnishing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            229 => 
            array (
                'tag_id' => 1231,
                'name' => 'Food Pairing',
                'normalized' => 'food pairing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            230 => 
            array (
                'tag_id' => 1232,
                'name' => 'Marination',
                'normalized' => 'marination',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            231 => 
            array (
                'tag_id' => 1233,
                'name' => 'Culinary Creativity',
                'normalized' => 'culinary creativity',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            232 => 
            array (
                'tag_id' => 1234,
                'name' => 'Dessert Making',
                'normalized' => 'dessert making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            233 => 
            array (
                'tag_id' => 1235,
                'name' => 'Canning and Preserving',
                'normalized' => 'canning and preserving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            234 => 
            array (
                'tag_id' => 1236,
                'name' => 'One-Pot Cooking',
                'normalized' => 'one-pot cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            235 => 
            array (
                'tag_id' => 1237,
                'name' => 'Rice Cooking',
                'normalized' => 'rice cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            236 => 
            array (
                'tag_id' => 1238,
                'name' => 'Broiling',
                'normalized' => 'broiling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            237 => 
            array (
                'tag_id' => 1239,
                'name' => 'Slicing Techniques',
                'normalized' => 'slicing techniques',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            238 => 
            array (
                'tag_id' => 1240,
                'name' => 'Mise en Place',
                'normalized' => 'mise en place',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            239 => 
            array (
                'tag_id' => 1241,
                'name' => 'Stock and Broth Making',
                'normalized' => 'stock and broth making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            240 => 
            array (
                'tag_id' => 1242,
                'name' => 'Stir-Frying',
                'normalized' => 'stir-frying',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            241 => 
            array (
                'tag_id' => 1243,
                'name' => 'Pastry Making',
                'normalized' => 'pastry making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            242 => 
            array (
                'tag_id' => 1244,
                'name' => 'Meat Grading',
                'normalized' => 'meat grading',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            243 => 
            array (
                'tag_id' => 1245,
                'name' => 'Dough Rolling',
                'normalized' => 'dough rolling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            244 => 
            array (
                'tag_id' => 1246,
                'name' => 'Food Presentation',
                'normalized' => 'food presentation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            245 => 
            array (
                'tag_id' => 1247,
                'name' => 'Caramelization',
                'normalized' => 'caramelization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            246 => 
            array (
                'tag_id' => 1248,
                'name' => 'Braising',
                'normalized' => 'braising',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            247 => 
            array (
                'tag_id' => 1249,
                'name' => 'Spice Blending',
                'normalized' => 'spice blending',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            248 => 
            array (
                'tag_id' => 1250,
                'name' => 'Piping Techniques',
                'normalized' => 'piping techniques',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            249 => 
            array (
                'tag_id' => 1251,
                'name' => 'Food Garnishing',
                'normalized' => 'food garnishing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            250 => 
            array (
                'tag_id' => 1252,
                'name' => 'Cocktail Mixing',
                'normalized' => 'cocktail mixing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            251 => 
            array (
                'tag_id' => 1253,
                'name' => 'Curing',
                'normalized' => 'curing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            252 => 
            array (
                'tag_id' => 1254,
                'name' => 'Roasting',
                'normalized' => 'roasting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            253 => 
            array (
                'tag_id' => 1255,
                'name' => 'Egg Cooking Techniques',
                'normalized' => 'egg cooking techniques',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            254 => 
            array (
                'tag_id' => 1256,
                'name' => 'Infusion',
                'normalized' => 'infusion',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            255 => 
            array (
                'tag_id' => 1257,
                'name' => 'Artisan Bread Baking',
                'normalized' => 'artisan bread baking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            256 => 
            array (
                'tag_id' => 1258,
                'name' => 'Sautéing',
                'normalized' => 'sautéing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            257 => 
            array (
                'tag_id' => 1259,
                'name' => 'Frying',
                'normalized' => 'frying',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            258 => 
            array (
                'tag_id' => 1260,
                'name' => 'Sourdough Starter',
                'normalized' => 'sourdough starter',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            259 => 
            array (
                'tag_id' => 1261,
                'name' => 'Simmering',
                'normalized' => 'simmering',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            260 => 
            array (
                'tag_id' => 1262,
                'name' => 'Food Plating',
                'normalized' => 'food plating',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            261 => 
            array (
                'tag_id' => 1263,
                'name' => 'Homemade Pasta',
                'normalized' => 'homemade pasta',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            262 => 
            array (
                'tag_id' => 1264,
                'name' => 'Dressing and Marinade Making',
                'normalized' => 'dressing and marinade making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            263 => 
            array (
                'tag_id' => 1265,
                'name' => 'Ingredient Substitution',
                'normalized' => 'ingredient substitution',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            264 => 
            array (
                'tag_id' => 1266,
                'name' => 'Cake Decorating',
                'normalized' => 'cake decorating',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            265 => 
            array (
                'tag_id' => 1267,
                'name' => 'Gelatin Techniques',
                'normalized' => 'gelatin techniques',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            266 => 
            array (
                'tag_id' => 1268,
                'name' => 'Homemade Condiments',
                'normalized' => 'homemade condiments',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            267 => 
            array (
                'tag_id' => 1269,
                'name' => 'Pickling',
                'normalized' => 'pickling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            268 => 
            array (
                'tag_id' => 1270,
                'name' => 'Food Styling',
                'normalized' => 'food styling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            269 => 
            array (
                'tag_id' => 1271,
                'name' => 'Blanching and Shocking',
                'normalized' => 'blanching and shocking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            270 => 
            array (
                'tag_id' => 1272,
                'name' => 'Cooking with Fresh Herbs',
                'normalized' => 'cooking with fresh herbs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            271 => 
            array (
                'tag_id' => 1273,
                'name' => 'Bread Proofing',
                'normalized' => 'bread proofing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            272 => 
            array (
                'tag_id' => 1274,
                'name' => 'Candy Making',
                'normalized' => 'candy making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            273 => 
            array (
                'tag_id' => 1275,
                'name' => 'Fondant Work',
                'normalized' => 'fondant work',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            274 => 
            array (
                'tag_id' => 1276,
                'name' => 'Fish Filleting',
                'normalized' => 'fish filleting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            275 => 
            array (
                'tag_id' => 1277,
                'name' => 'Nut Butter Making',
                'normalized' => 'nut butter making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            276 => 
            array (
                'tag_id' => 1278,
                'name' => 'Pâté and Terrine Preparation',
                'normalized' => 'pâté and terrine preparation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            277 => 
            array (
                'tag_id' => 1279,
                'name' => 'Pie Crust Making',
                'normalized' => 'pie crust making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            278 => 
            array (
                'tag_id' => 1280,
                'name' => 'Food Preservation',
                'normalized' => 'food preservation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            279 => 
            array (
                'tag_id' => 1281,
                'name' => 'Culinary Etiquette',
                'normalized' => 'culinary etiquette',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            280 => 
            array (
                'tag_id' => 1282,
                'name' => 'Sugar Work',
                'normalized' => 'sugar work',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            281 => 
            array (
                'tag_id' => 1283,
                'name' => 'Chocolate Tempering',
                'normalized' => 'chocolate tempering',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            282 => 
            array (
                'tag_id' => 1284,
                'name' => 'Pickle Fermentation',
                'normalized' => 'pickle fermentation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            283 => 
            array (
                'tag_id' => 1285,
                'name' => 'Vegan Cooking',
                'normalized' => 'vegan cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            284 => 
            array (
                'tag_id' => 1286,
                'name' => 'Dumpling Folding',
                'normalized' => 'dumpling folding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            285 => 
            array (
                'tag_id' => 1287,
                'name' => 'Crepes Making',
                'normalized' => 'crepes making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            286 => 
            array (
                'tag_id' => 1288,
                'name' => 'Smoking Techniques',
                'normalized' => 'smoking techniques',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            287 => 
            array (
                'tag_id' => 1289,
                'name' => 'Sushi Rolling',
                'normalized' => 'sushi rolling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            288 => 
            array (
                'tag_id' => 1290,
                'name' => 'Food Pairing',
                'normalized' => 'food pairing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            289 => 
            array (
                'tag_id' => 1291,
                'name' => 'Food Photography',
                'normalized' => 'food photography',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            290 => 
            array (
                'tag_id' => 1292,
                'name' => 'Gluten-Free Baking',
                'normalized' => 'gluten-free baking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            291 => 
            array (
                'tag_id' => 1293,
                'name' => 'Pasta Sauces',
                'normalized' => 'pasta sauces',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            292 => 
            array (
                'tag_id' => 1294,
                'name' => 'Dressing Emulsification',
                'normalized' => 'dressing emulsification',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            293 => 
            array (
                'tag_id' => 1295,
                'name' => 'Flambéing',
                'normalized' => 'flambéing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            294 => 
            array (
                'tag_id' => 1296,
                'name' => 'Cheese Pairing',
                'normalized' => 'cheese pairing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            295 => 
            array (
                'tag_id' => 1297,
                'name' => 'Risotto Making',
                'normalized' => 'risotto making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            296 => 
            array (
                'tag_id' => 1298,
                'name' => 'Stew Creation',
                'normalized' => 'stew creation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            297 => 
            array (
                'tag_id' => 1299,
                'name' => 'Whipped Cream Making',
                'normalized' => 'whipped cream making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            298 => 
            array (
                'tag_id' => 1300,
                'name' => 'Homemade Ice Cream',
                'normalized' => 'homemade ice cream',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            299 => 
            array (
                'tag_id' => 1301,
                'name' => 'Gravy Preparation',
                'normalized' => 'gravy preparation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            300 => 
            array (
                'tag_id' => 1302,
                'name' => 'Dim Sum Folding',
                'normalized' => 'dim sum folding',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            301 => 
            array (
                'tag_id' => 1303,
                'name' => 'Pizza Tossing',
                'normalized' => 'pizza tossing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            302 => 
            array (
                'tag_id' => 1304,
                'name' => 'Chutney Making',
                'normalized' => 'chutney making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            303 => 
            array (
                'tag_id' => 1305,
                'name' => 'Crepe Flipping',
                'normalized' => 'crepe flipping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            304 => 
            array (
                'tag_id' => 1306,
                'name' => 'Casserole Assembly',
                'normalized' => 'casserole assembly',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            305 => 
            array (
                'tag_id' => 1307,
                'name' => 'Artisanal Cheese Making',
                'normalized' => 'artisanal cheese making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            306 => 
            array (
                'tag_id' => 1308,
                'name' => 'Pancake Flipping',
                'normalized' => 'pancake flipping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            307 => 
            array (
                'tag_id' => 1309,
                'name' => 'Chopping Techniques',
                'normalized' => 'chopping techniques',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            308 => 
            array (
                'tag_id' => 1310,
                'name' => 'Poaching',
                'normalized' => 'poaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            309 => 
            array (
                'tag_id' => 1311,
                'name' => 'Gelato Making',
                'normalized' => 'gelato making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            310 => 
            array (
                'tag_id' => 1312,
                'name' => 'Sautéing Seafood',
                'normalized' => 'sautéing seafood',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            311 => 
            array (
                'tag_id' => 1313,
                'name' => 'Vacuuming',
                'normalized' => 'vacuuming',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            312 => 
            array (
                'tag_id' => 1314,
                'name' => 'Dusting',
                'normalized' => 'dusting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            313 => 
            array (
                'tag_id' => 1315,
                'name' => 'Bathroom Cleaning',
                'normalized' => 'bathroom cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            314 => 
            array (
                'tag_id' => 1316,
                'name' => 'Mopping',
                'normalized' => 'mopping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            315 => 
            array (
                'tag_id' => 1317,
                'name' => 'Window Cleaning',
                'normalized' => 'window cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            316 => 
            array (
                'tag_id' => 1318,
                'name' => 'Kitchen Cleaning',
                'normalized' => 'kitchen cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            317 => 
            array (
                'tag_id' => 1319,
                'name' => 'Laundry Cleaning',
                'normalized' => 'laundry cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            318 => 
            array (
                'tag_id' => 1320,
                'name' => 'Oven Cleaning',
                'normalized' => 'oven cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            319 => 
            array (
                'tag_id' => 1321,
                'name' => 'Refrigerator Cleaning',
                'normalized' => 'refrigerator cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            320 => 
            array (
                'tag_id' => 1322,
                'name' => 'Dishwashing',
                'normalized' => 'dishwashing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            321 => 
            array (
                'tag_id' => 1323,
                'name' => 'Upholstery Cleaning',
                'normalized' => 'upholstery cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            322 => 
            array (
                'tag_id' => 1324,
                'name' => 'Floor Polishing',
                'normalized' => 'floor polishing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            323 => 
            array (
                'tag_id' => 1325,
                'name' => 'Garbage Disposal',
                'normalized' => 'garbage disposal',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            324 => 
            array (
                'tag_id' => 1326,
                'name' => 'Curtain and Blind Cleaning',
                'normalized' => 'curtain and blind cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            325 => 
            array (
                'tag_id' => 1327,
                'name' => 'Baseboard Cleaning',
                'normalized' => 'baseboard cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            326 => 
            array (
                'tag_id' => 1328,
                'name' => 'Carpet Cleaning',
                'normalized' => 'carpet cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            327 => 
            array (
                'tag_id' => 1329,
                'name' => 'Deep Cleaning',
                'normalized' => 'deep cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            328 => 
            array (
                'tag_id' => 1330,
                'name' => 'Stain Removal',
                'normalized' => 'stain removal',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            329 => 
            array (
                'tag_id' => 1331,
                'name' => 'Gutter Cleaning',
                'normalized' => 'gutter cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            330 => 
            array (
                'tag_id' => 1332,
                'name' => 'Grout Cleaning',
                'normalized' => 'grout cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            331 => 
            array (
                'tag_id' => 1333,
                'name' => 'Mattress Cleaning',
                'normalized' => 'mattress cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            332 => 
            array (
                'tag_id' => 1334,
                'name' => 'Wall Washing',
                'normalized' => 'wall washing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            333 => 
            array (
                'tag_id' => 1335,
                'name' => 'Pet Hair Removal',
                'normalized' => 'pet hair removal',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            334 => 
            array (
                'tag_id' => 1336,
                'name' => 'Ceiling Cleaning',
                'normalized' => 'ceiling cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            335 => 
            array (
                'tag_id' => 1337,
                'name' => 'Electronic Device Cleaning',
                'normalized' => 'electronic device cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            336 => 
            array (
                'tag_id' => 1338,
                'name' => 'Shoe Cleaning',
                'normalized' => 'shoe cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            337 => 
            array (
                'tag_id' => 1339,
                'name' => 'Stainless Steel Cleaning',
                'normalized' => 'stainless steel cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            338 => 
            array (
                'tag_id' => 1340,
                'name' => 'Outdoor Cleaning',
                'normalized' => 'outdoor cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            339 => 
            array (
                'tag_id' => 1341,
                'name' => 'Mold and Mildew Removal',
                'normalized' => 'mold and mildew removal',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            340 => 
            array (
                'tag_id' => 1342,
                'name' => 'Furniture Cleaning',
                'normalized' => 'furniture cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            341 => 
            array (
                'tag_id' => 1343,
                'name' => 'Rug Cleaning',
                'normalized' => 'rug cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            342 => 
            array (
                'tag_id' => 1344,
                'name' => 'Toy Cleaning',
                'normalized' => 'toy cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            343 => 
            array (
                'tag_id' => 1345,
                'name' => 'Junk Removal',
                'normalized' => 'junk removal',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            344 => 
            array (
                'tag_id' => 1346,
                'name' => 'Wall Stain Removal',
                'normalized' => 'wall stain removal',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            345 => 
            array (
                'tag_id' => 1347,
                'name' => 'Bathroom Cleaning',
                'normalized' => 'bathroom cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            346 => 
            array (
                'tag_id' => 1348,
                'name' => 'Pantry Organization',
                'normalized' => 'pantry organization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            347 => 
            array (
                'tag_id' => 1349,
                'name' => 'Drapery Cleaning',
                'normalized' => 'drapery cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            348 => 
            array (
                'tag_id' => 1350,
                'name' => 'Blind Dusting',
                'normalized' => 'blind dusting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            349 => 
            array (
                'tag_id' => 1351,
                'name' => 'Shoe Rack Organization',
                'normalized' => 'shoe rack organization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            350 => 
            array (
                'tag_id' => 1352,
                'name' => 'Air Vent Cleaning',
                'normalized' => 'air vent cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            351 => 
            array (
                'tag_id' => 1353,
                'name' => 'Car Interior Cleaning',
                'normalized' => 'car interior cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            352 => 
            array (
                'tag_id' => 1354,
                'name' => 'Cabinet Cleaning',
                'normalized' => 'cabinet cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            353 => 
            array (
                'tag_id' => 1355,
                'name' => 'Patio Furniture Cleaning',
                'normalized' => 'patio furniture cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            354 => 
            array (
                'tag_id' => 1356,
                'name' => 'Computer Keyboard Cleaning',
                'normalized' => 'computer keyboard cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            355 => 
            array (
                'tag_id' => 1357,
                'name' => 'Plant Care',
                'normalized' => 'plant care',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            356 => 
            array (
                'tag_id' => 1358,
                'name' => 'Diaper Changing',
                'normalized' => 'diaper changing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            357 => 
            array (
                'tag_id' => 1359,
                'name' => 'Playtime Supervision',
                'normalized' => 'playtime supervision',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            358 => 
            array (
                'tag_id' => 1360,
                'name' => 'Bedtime Routine',
                'normalized' => 'bedtime routine',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            359 => 
            array (
                'tag_id' => 1361,
                'name' => 'Meal Planning for Kids',
                'normalized' => 'meal planning for kids',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            360 => 
            array (
                'tag_id' => 1362,
                'name' => 'Communication with Children',
                'normalized' => 'communication with children',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            361 => 
            array (
                'tag_id' => 1363,
                'name' => 'Hygiene Teaching',
                'normalized' => 'hygiene teaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            362 => 
            array (
                'tag_id' => 1364,
                'name' => 'Potty Training',
                'normalized' => 'potty training',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            363 => 
            array (
                'tag_id' => 1365,
                'name' => 'Conflict Resolution for Children',
                'normalized' => 'conflict resolution for children',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            364 => 
            array (
                'tag_id' => 1366,
                'name' => 'Homework Assistance',
                'normalized' => 'homework assistance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            365 => 
            array (
                'tag_id' => 1367,
                'name' => 'Creative Activities',
                'normalized' => 'creative activities',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            366 => 
            array (
                'tag_id' => 1368,
                'name' => 'Outdoor Supervision',
                'normalized' => 'outdoor supervision',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            367 => 
            array (
                'tag_id' => 1369,
                'name' => 'Positive Discipline',
                'normalized' => 'positive discipline',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            368 => 
            array (
                'tag_id' => 1370,
                'name' => 'Scheduling and Routine',
                'normalized' => 'scheduling and routine',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            369 => 
            array (
                'tag_id' => 1371,
                'name' => 'Educational Engagement',
                'normalized' => 'educational engagement',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            370 => 
            array (
                'tag_id' => 1372,
                'name' => 'Caring for Sick Children',
                'normalized' => 'caring for sick children',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            371 => 
            array (
                'tag_id' => 1373,
                'name' => 'Social Skills',
                'normalized' => 'social skills',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            372 => 
            array (
                'tag_id' => 1374,
                'name' => 'Cultural Sensitivity',
                'normalized' => 'cultural sensitivity',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            373 => 
            array (
                'tag_id' => 1375,
                'name' => 'Impersonations',
                'normalized' => 'impersonations',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            374 => 
            array (
                'tag_id' => 1376,
                'name' => 'Stand-Up Comedy',
                'normalized' => 'stand-up comedy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            375 => 
            array (
                'tag_id' => 1377,
                'name' => 'Funny Dance Moves',
                'normalized' => 'funny dance moves',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            376 => 
            array (
                'tag_id' => 1378,
                'name' => 'Prank Planning',
                'normalized' => 'prank planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            377 => 
            array (
                'tag_id' => 1379,
                'name' => 'Juggling',
                'normalized' => 'juggling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            378 => 
            array (
                'tag_id' => 1380,
                'name' => 'Physical Comedy',
                'normalized' => 'physical comedy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            379 => 
            array (
                'tag_id' => 1381,
                'name' => 'Funny Storytelling',
                'normalized' => 'funny storytelling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            380 => 
            array (
                'tag_id' => 1382,
                'name' => 'Whimsical Art',
                'normalized' => 'whimsical art',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            381 => 
            array (
                'tag_id' => 1383,
                'name' => 'Silly Costumes',
                'normalized' => 'silly costumes',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            382 => 
            array (
                'tag_id' => 1384,
                'name' => 'Mimicry',
                'normalized' => 'mimicry',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            383 => 
            array (
                'tag_id' => 1385,
                'name' => 'Comedic Improvisation',
                'normalized' => 'comedic improvisation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            384 => 
            array (
                'tag_id' => 1386,
                'name' => 'Funny Facial Expressions',
                'normalized' => 'funny facial expressions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            385 => 
            array (
                'tag_id' => 1387,
                'name' => 'Parody Song Writing',
                'normalized' => 'parody song writing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            386 => 
            array (
                'tag_id' => 1388,
                'name' => 'Comedic Mime',
                'normalized' => 'comedic mime',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            387 => 
            array (
                'tag_id' => 1389,
                'name' => 'Sarcastic Wit',
                'normalized' => 'sarcastic wit',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            388 => 
            array (
                'tag_id' => 1390,
                'name' => 'Whacky Inventions',
                'normalized' => 'whacky inventions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            389 => 
            array (
                'tag_id' => 1391,
                'name' => 'Funny Voiceovers',
                'normalized' => 'funny voiceovers',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            390 => 
            array (
                'tag_id' => 1392,
                'name' => 'Spoof Cooking',
                'normalized' => 'spoof cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            391 => 
            array (
                'tag_id' => 1393,
                'name' => 'Character Role-Play',
                'normalized' => 'character role-play',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            392 => 
            array (
                'tag_id' => 1394,
                'name' => 'Exaggerated Reactions',
                'normalized' => 'exaggerated reactions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            393 => 
            array (
                'tag_id' => 1395,
                'name' => 'Comedic Magic Tricks',
                'normalized' => 'comedic magic tricks',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            394 => 
            array (
                'tag_id' => 1396,
                'name' => 'Tongue Twisters',
                'normalized' => 'tongue twisters',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            395 => 
            array (
                'tag_id' => 1397,
                'name' => 'Fake News Reporting',
                'normalized' => 'fake news reporting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            396 => 
            array (
                'tag_id' => 1398,
                'name' => 'Absurd Challenges',
                'normalized' => 'absurd challenges',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            397 => 
            array (
                'tag_id' => 1399,
                'name' => 'Speed Reading',
                'normalized' => 'speed reading',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            398 => 
            array (
                'tag_id' => 1400,
                'name' => 'Quick Sketching',
                'normalized' => 'quick sketching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            399 => 
            array (
                'tag_id' => 1401,
                'name' => 'Flash Writing',
                'normalized' => 'flash writing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            400 => 
            array (
                'tag_id' => 1402,
                'name' => 'Express Workout',
                'normalized' => 'express workout',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            401 => 
            array (
                'tag_id' => 1403,
                'name' => 'Instant Pot Cooking',
                'normalized' => 'instant pot cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            402 => 
            array (
                'tag_id' => 1404,
                'name' => 'Speed Typing',
                'normalized' => 'speed typing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            403 => 
            array (
                'tag_id' => 1405,
                'name' => 'Micro Meditation',
                'normalized' => 'micro meditation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            404 => 
            array (
                'tag_id' => 1406,
                'name' => 'Rapid Puzzle Solving',
                'normalized' => 'rapid puzzle solving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            405 => 
            array (
                'tag_id' => 1407,
                'name' => 'Lightning Decision-Making',
                'normalized' => 'lightning decision-making',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            406 => 
            array (
                'tag_id' => 1408,
                'name' => 'Swift Sudoku Completion',
                'normalized' => 'swift sudoku completion',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            407 => 
            array (
                'tag_id' => 1409,
                'name' => 'Snapshot Photography',
                'normalized' => 'snapshot photography',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            408 => 
            array (
                'tag_id' => 1410,
                'name' => 'Immediate Problem Solving',
                'normalized' => 'immediate problem solving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            409 => 
            array (
                'tag_id' => 1411,
                'name' => 'Expressive Drawing',
                'normalized' => 'expressive drawing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            410 => 
            array (
                'tag_id' => 1412,
                'name' => 'Speed Memorization',
                'normalized' => 'speed memorization',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            411 => 
            array (
                'tag_id' => 1413,
                'name' => 'Rapid Brushing',
                'normalized' => 'rapid brushing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            412 => 
            array (
                'tag_id' => 1414,
                'name' => 'Efficient Packing',
                'normalized' => 'efficient packing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            413 => 
            array (
                'tag_id' => 1415,
                'name' => 'Instant Messaging',
                'normalized' => 'instant messaging',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            414 => 
            array (
                'tag_id' => 1416,
                'name' => 'Quick Stretches',
                'normalized' => 'quick stretches',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            415 => 
            array (
                'tag_id' => 1417,
                'name' => 'Expressive Dance',
                'normalized' => 'expressive dance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            416 => 
            array (
                'tag_id' => 1418,
                'name' => 'Rapid Skincare Routine',
                'normalized' => 'rapid skincare routine',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            417 => 
            array (
                'tag_id' => 1419,
                'name' => 'Speed Drawing Challenge',
                'normalized' => 'speed drawing challenge',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            418 => 
            array (
                'tag_id' => 1420,
                'name' => 'Instant Messaging Art',
                'normalized' => 'instant messaging art',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            419 => 
            array (
                'tag_id' => 1421,
                'name' => 'Quick DIY Project',
                'normalized' => 'quick diy project',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            420 => 
            array (
                'tag_id' => 1422,
                'name' => 'Speed Cleaning',
                'normalized' => 'speed cleaning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            421 => 
            array (
                'tag_id' => 1423,
                'name' => 'Immediate Goal Setting',
                'normalized' => 'immediate goal setting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            422 => 
            array (
                'tag_id' => 1424,
                'name' => 'Expressive Writing',
                'normalized' => 'expressive writing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            423 => 
            array (
                'tag_id' => 1425,
                'name' => 'Rapid Reading Aloud',
                'normalized' => 'rapid reading aloud',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            424 => 
            array (
                'tag_id' => 1426,
                'name' => 'Speed Drawing Portraits',
                'normalized' => 'speed drawing portraits',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            425 => 
            array (
                'tag_id' => 1427,
                'name' => 'Instant Handcraft',
                'normalized' => 'instant handcraft',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            426 => 
            array (
                'tag_id' => 1428,
                'name' => 'Quick Juggling',
                'normalized' => 'quick juggling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            427 => 
            array (
                'tag_id' => 1429,
                'name' => 'Swift Document Review',
                'normalized' => 'swift document review',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            428 => 
            array (
                'tag_id' => 1430,
                'name' => 'Immediate Recipe Execution',
                'normalized' => 'immediate recipe execution',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            429 => 
            array (
                'tag_id' => 1431,
                'name' => 'Expressive Music',
                'normalized' => 'expressive music',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            430 => 
            array (
                'tag_id' => 1432,
                'name' => 'Rapid Problem Assessment',
                'normalized' => 'rapid problem assessment',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            431 => 
            array (
                'tag_id' => 1433,
                'name' => 'Speed Puzzle Assembly',
                'normalized' => 'speed puzzle assembly',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            432 => 
            array (
                'tag_id' => 1434,
                'name' => 'Instant Hairstyling',
                'normalized' => 'instant hairstyling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            433 => 
            array (
                'tag_id' => 1435,
                'name' => 'Quick Gardening',
                'normalized' => 'quick gardening',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            434 => 
            array (
                'tag_id' => 1436,
                'name' => 'Expressive Acting',
                'normalized' => 'expressive acting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            435 => 
            array (
                'tag_id' => 1437,
                'name' => 'Immediate Decluttering',
                'normalized' => 'immediate decluttering',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            436 => 
            array (
                'tag_id' => 1438,
                'name' => 'Speed Drawing Animals',
                'normalized' => 'speed drawing animals',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            437 => 
            array (
                'tag_id' => 1439,
                'name' => 'Instant Puzzle Solving',
                'normalized' => 'instant puzzle solving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            438 => 
            array (
                'tag_id' => 1440,
                'name' => 'Quick Origami',
                'normalized' => 'quick origami',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            439 => 
            array (
                'tag_id' => 1441,
                'name' => 'Expressive Improv',
                'normalized' => 'expressive improv',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            440 => 
            array (
                'tag_id' => 1442,
                'name' => 'Rapid Cooking Technique',
                'normalized' => 'rapid cooking technique',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            441 => 
            array (
                'tag_id' => 1443,
                'name' => 'Immediate Song Creation',
                'normalized' => 'immediate song creation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            442 => 
            array (
                'tag_id' => 1444,
                'name' => 'Speed Doodling',
                'normalized' => 'speed doodling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            443 => 
            array (
                'tag_id' => 1445,
                'name' => 'Instant Storytelling',
                'normalized' => 'instant storytelling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            444 => 
            array (
                'tag_id' => 1446,
                'name' => 'Quick Card Trick',
                'normalized' => 'quick card trick',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            445 => 
            array (
                'tag_id' => 1447,
                'name' => 'Expressive Poetry',
                'normalized' => 'expressive poetry',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            446 => 
            array (
                'tag_id' => 1448,
                'name' => 'Rapid Fitness Challenge',
                'normalized' => 'rapid fitness challenge',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            447 => 
            array (
                'tag_id' => 1449,
                'name' => 'Sprinting',
                'normalized' => 'sprinting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            448 => 
            array (
                'tag_id' => 1450,
                'name' => 'Snail Racing',
                'normalized' => 'snail racing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            449 => 
            array (
                'tag_id' => 1451,
                'name' => 'Slow Boat Ride',
                'normalized' => 'slow boat ride',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            450 => 
            array (
                'tag_id' => 1452,
                'name' => 'Slow Ballet Performance',
                'normalized' => 'slow ballet performance',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            451 => 
            array (
                'tag_id' => 1453,
                'name' => 'Slow Food Tasting',
                'normalized' => 'slow food tasting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            452 => 
            array (
                'tag_id' => 1454,
                'name' => 'Slow Portrait Drawing',
                'normalized' => 'slow portrait drawing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            453 => 
            array (
                'tag_id' => 1455,
                'name' => 'Speedy Puzzle Solving',
                'normalized' => 'speedy puzzle solving',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            454 => 
            array (
                'tag_id' => 1456,
                'name' => 'Relaxed Puzzle Assembly',
                'normalized' => 'relaxed puzzle assembly',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            455 => 
            array (
                'tag_id' => 1457,
                'name' => 'Fast Yoga Flow',
                'normalized' => 'fast yoga flow',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            456 => 
            array (
                'tag_id' => 1458,
                'name' => 'Slow Yoga Practice',
                'normalized' => 'slow yoga practice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            457 => 
            array (
                'tag_id' => 1459,
                'name' => 'Rapid Conversation',
                'normalized' => 'rapid conversation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            458 => 
            array (
                'tag_id' => 1460,
                'name' => 'Slow Philosophical Discussion',
                'normalized' => 'slow philosophical discussion',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            459 => 
            array (
                'tag_id' => 1461,
                'name' => 'Quick Meditation',
                'normalized' => 'quick meditation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            460 => 
            array (
                'tag_id' => 1462,
                'name' => 'Slow Mindfulness Practice',
                'normalized' => 'slow mindfulness practice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            461 => 
            array (
                'tag_id' => 1463,
                'name' => 'Slow Stretching Session',
                'normalized' => 'slow stretching session',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            462 => 
            array (
                'tag_id' => 1464,
                'name' => 'Speedy Cooking',
                'normalized' => 'speedy cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            463 => 
            array (
                'tag_id' => 1465,
                'name' => 'Slow Cooking',
                'normalized' => 'slow cooking',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            464 => 
            array (
                'tag_id' => 1466,
                'name' => 'Budget Planning',
                'normalized' => 'budget planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            465 => 
            array (
                'tag_id' => 1467,
                'name' => 'Debt Management',
                'normalized' => 'debt management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            466 => 
            array (
                'tag_id' => 1468,
                'name' => 'Savings Strategies',
                'normalized' => 'savings strategies',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            467 => 
            array (
                'tag_id' => 1469,
                'name' => 'Financial Education Workshops',
                'normalized' => 'financial education workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            468 => 
            array (
                'tag_id' => 1470,
                'name' => 'Pension Advice',
                'normalized' => 'pension advice',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            469 => 
            array (
                'tag_id' => 1471,
                'name' => 'Charitable Giving Strategy',
                'normalized' => 'charitable giving strategy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            470 => 
            array (
                'tag_id' => 1472,
                'name' => 'Business Financial Consulting',
                'normalized' => 'business financial consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            471 => 
            array (
                'tag_id' => 1473,
                'name' => 'Socially Responsible Investing',
                'normalized' => 'socially responsible investing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            472 => 
            array (
                'tag_id' => 1474,
                'name' => 'Financial Literacy Seminars',
                'normalized' => 'financial literacy seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            473 => 
            array (
                'tag_id' => 1475,
                'name' => 'Charitable Trusts',
                'normalized' => 'charitable trusts',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            474 => 
            array (
                'tag_id' => 1476,
                'name' => 'Divorce Financial Planning',
                'normalized' => 'divorce financial planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            475 => 
            array (
                'tag_id' => 1477,
                'name' => 'Sustainable Financial Planning',
                'normalized' => 'sustainable financial planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            476 => 
            array (
                'tag_id' => 1478,
                'name' => 'Energy Audit',
                'normalized' => 'energy audit',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            477 => 
            array (
                'tag_id' => 1479,
                'name' => 'Composting',
                'normalized' => 'composting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            478 => 
            array (
                'tag_id' => 1480,
                'name' => 'Waste Reduction Workshops',
                'normalized' => 'waste reduction workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            479 => 
            array (
                'tag_id' => 1481,
                'name' => 'Community Cleanups',
                'normalized' => 'community cleanups',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            480 => 
            array (
                'tag_id' => 1482,
                'name' => 'Urban Farming',
                'normalized' => 'urban farming',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            481 => 
            array (
                'tag_id' => 1483,
                'name' => 'Solar Panel Installation',
                'normalized' => 'solar panel installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            482 => 
            array (
                'tag_id' => 1484,
                'name' => 'Public Transportation Advocacy',
                'normalized' => 'public transportation advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            483 => 
            array (
                'tag_id' => 1485,
                'name' => 'Zero Waste Lifestyle Coaching',
                'normalized' => 'zero waste lifestyle coaching',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            484 => 
            array (
                'tag_id' => 1486,
                'name' => 'Car Sharing Programs',
                'normalized' => 'car sharing programs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            485 => 
            array (
                'tag_id' => 1487,
                'name' => 'Plastic-Free Initiatives',
                'normalized' => 'plastic-free initiatives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            486 => 
            array (
                'tag_id' => 1488,
                'name' => 'Eco-Friendly Product Development',
                'normalized' => 'eco-friendly product development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            487 => 
            array (
                'tag_id' => 1489,
                'name' => 'Sustainable Packaging Design',
                'normalized' => 'sustainable packaging design',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            488 => 
            array (
                'tag_id' => 1490,
                'name' => 'Renewable Energy Advocacy',
                'normalized' => 'renewable energy advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            489 => 
            array (
                'tag_id' => 1491,
                'name' => 'E-Waste Recycling',
                'normalized' => 'e-waste recycling',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            490 => 
            array (
                'tag_id' => 1492,
                'name' => 'Nature Restoration Projects',
                'normalized' => 'nature restoration projects',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            491 => 
            array (
                'tag_id' => 1493,
                'name' => 'Sustainable Fashion Advocacy',
                'normalized' => 'sustainable fashion advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            492 => 
            array (
                'tag_id' => 1494,
                'name' => 'Community Gardens',
                'normalized' => 'community gardens',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            493 => 
            array (
                'tag_id' => 1495,
                'name' => 'Renewable Energy Workshops',
                'normalized' => 'renewable energy workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            494 => 
            array (
                'tag_id' => 1496,
                'name' => 'Ocean Cleanup Projects',
                'normalized' => 'ocean cleanup projects',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            495 => 
            array (
                'tag_id' => 1497,
                'name' => 'Green Technology Innovation',
                'normalized' => 'green technology innovation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            496 => 
            array (
                'tag_id' => 1498,
                'name' => 'Food Rescue Programs',
                'normalized' => 'food rescue programs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            497 => 
            array (
                'tag_id' => 1499,
                'name' => 'Sustainable Landscaping',
                'normalized' => 'sustainable landscaping',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            498 => 
            array (
                'tag_id' => 1500,
                'name' => 'Renewable Energy Investments',
                'normalized' => 'renewable energy investments',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            499 => 
            array (
                'tag_id' => 1501,
                'name' => 'Environmental Advocacy',
                'normalized' => 'environmental advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
        ));
        \DB::table('taggable_tags')->insert(array (
            0 => 
            array (
                'tag_id' => 1502,
                'name' => 'Green Workshops for Kids',
                'normalized' => 'green workshops for kids',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            1 => 
            array (
                'tag_id' => 1503,
                'name' => 'Carbon Footprint Calculators',
                'normalized' => 'carbon footprint calculators',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            2 => 
            array (
                'tag_id' => 1504,
                'name' => 'Rainwater Harvesting',
                'normalized' => 'rainwater harvesting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            3 => 
            array (
                'tag_id' => 1505,
                'name' => 'Sustainable Tourism Promotion',
                'normalized' => 'sustainable tourism promotion',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            4 => 
            array (
                'tag_id' => 1506,
                'name' => 'Renewable Energy Policy Advocacy',
                'normalized' => 'renewable energy policy advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            5 => 
            array (
                'tag_id' => 1507,
                'name' => 'Green Roof Installation',
                'normalized' => 'green roof installation',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            6 => 
            array (
                'tag_id' => 1508,
                'name' => 'Climate Change Art Projects',
                'normalized' => 'climate change art projects',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            7 => 
            array (
                'tag_id' => 1509,
                'name' => 'Sustainable Catering',
                'normalized' => 'sustainable catering',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            8 => 
            array (
                'tag_id' => 1510,
                'name' => 'Green Transportation Initiatives',
                'normalized' => 'green transportation initiatives',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            9 => 
            array (
                'tag_id' => 1511,
                'name' => 'Eco-Friendly Event Planning',
                'normalized' => 'eco-friendly event planning',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            10 => 
            array (
                'tag_id' => 1512,
                'name' => 'Renewable Energy Education',
                'normalized' => 'renewable energy education',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            11 => 
            array (
                'tag_id' => 1513,
                'name' => 'Sustainable Water Management',
                'normalized' => 'sustainable water management',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            12 => 
            array (
                'tag_id' => 1514,
                'name' => 'Green Business Consulting',
                'normalized' => 'green business consulting',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            13 => 
            array (
                'tag_id' => 1515,
                'name' => 'Community Renewable Energy Projects',
                'normalized' => 'community renewable energy projects',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            14 => 
            array (
                'tag_id' => 1516,
                'name' => 'Upcycling Workshops',
                'normalized' => 'upcycling workshops',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            15 => 
            array (
                'tag_id' => 1517,
                'name' => 'Sustainable Building Materials',
                'normalized' => 'sustainable building materials',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            16 => 
            array (
                'tag_id' => 1518,
                'name' => 'Green Education Programs',
                'normalized' => 'green education programs',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            17 => 
            array (
                'tag_id' => 1519,
                'name' => 'Ethical Investing',
                'normalized' => 'ethical investing',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            18 => 
            array (
                'tag_id' => 1520,
                'name' => 'Sustainable Product Reviews',
                'normalized' => 'sustainable product reviews',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            19 => 
            array (
                'tag_id' => 1521,
                'name' => 'Renewable Energy Workforce Development',
                'normalized' => 'renewable energy workforce development',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            20 => 
            array (
                'tag_id' => 1522,
                'name' => 'Sustainable Transportation Campaigns',
                'normalized' => 'sustainable transportation campaigns',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            21 => 
            array (
                'tag_id' => 1523,
                'name' => 'Green Technology Seminars',
                'normalized' => 'green technology seminars',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            22 => 
            array (
                'tag_id' => 1524,
                'name' => 'Zero Waste Packaging Solutions',
                'normalized' => 'zero waste packaging solutions',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
            23 => 
            array (
                'tag_id' => 1525,
                'name' => 'Sustainable Consumer Advocacy',
                'normalized' => 'sustainable consumer advocacy',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
        ));
        
        
    }
}