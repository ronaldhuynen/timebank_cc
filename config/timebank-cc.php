<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Account Properties
    |--------------------------------------------------------------------------
    |
    | The default account properties that will be set into the database when new accounts are created.
    | The balance limits are in minutes.
    */

    'accounts' => [
        'personal' => [
            'name' =>  'Personal Account',
            'limit_min' => 0,
            'limit_max' => 6000,
        ],
        'organisation' => [
            'name' => 'Organisation Account',
            'limit_min' => 0,
            'limit_max' => 6000,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Verification rules and file size limits
    |--------------------------------------------------------------------------
    | Here you can set the verification rules that will be used to verify data
    | that will be submitted in forms.
    |
    | Also you can set here the uploaded file properties and limits as well as
    | the defaut files that will be used when no file is uploaded by the user.
    */

    'rules' => [
        'profile_user' => [
            'name' =>  'required|string|unique:users,name|min:3|max:40',
            'email' => 'required|email|unique:users,email|max:40',
            'password' => 'required|min:6|same:passwordConfirmation',
            'profile_photo' => 'nullable|mimes:jpg,jpeg,png,svg|max:1024',
            'about' => 'nullable|string|max:400',   //TODO: check max with legacy cyclos data
            'motivation' => 'nullable|string|max:200',  //TODO: check max with legacy cyclos data
            'date_of_birth' => 'nullable|date',
            'website' => 'nullable|url',
        ],
    ],

    'files' => [
        'profile_user' => [
            'photo_new' => 'app-images/profile-user-new.svg',
            'photo_default' => 'app-images/profile-user-default.svg',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Verification messages
    |--------------------------------------------------------------------------
    | Here you can set the verification error messages that will be used to
    | verify data that will be submitted in forms.
    */
    'messages' => [
        'profile_user' => [
            // 'name' =>  '',
            // 'email' => '',
            // 'about' => '',
            // 'motivation' => 'error!',
            // 'date_of_birth' => '',
        ],
        'file' => [
            // 'profile_photo' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            // 'profile_photo_default' => 'app-images/new-profile.svg',
        ],
    ],

        /*
    |--------------------------------------------------------------------------
    | Available languages
    |--------------------------------------------------------------------------
    | List all the languages that will be available to users to select from.
    | This array should be alphabetically sorted.
    */
    'languages' => [
        'Arabic' => [
            'lang_code' => 'ar',
            'flag' => '',
        ],
        'Dutch' => [
            'lang_code' => 'nl',
            'flag' => '🇳🇱',
        ],
        'English' => [
            'lang_code' => 'en',
            'flag' => '🇬🇧',
        ],
        'French' => [
            'lang_code' => 'fr',
            'flag' => '🇫🇷',
        ],
        'German'=> [
            'lang_code' => 'de',
            'flag' => '🇩🇪',
        ],
        'Italian' => [
            'lang_code' => 'it',
            'flag' => '🇮🇹',
        ],
        'Polish' => [
            'lang_code' => 'pl',
            'flag' => '🇵🇱',
        ],
        'Russian' => [
            'lang_code' => 'ru',
            'flag' => '🇷🇺',
        ],
        'Spanish' => [
            'lang_code' => 'es',
            'flag' => '🇪🇸',
        ],
        'Ukrainian' => [
            'lang_code' => 'uk',
            'flag' => '🇺🇦',
        ],

    ]

]




















































































































































































































































































































































































