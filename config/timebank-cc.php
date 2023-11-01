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
        'organization' => [
            'name' => 'Organization Account',
            'limit_min' => 0,
            'limit_max' => 18000,
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
            'name' =>  ['required','string','unique:users,name','unique:organizations,name','min:3','max:40', 
                function ($attribute, $value, $fail) {    
                // Disallow the following words to be used inside the name:
                    $disallowedWords = [
                        'admin',  
                        'superuser',
                        'super-user',
                        'supervisor',
                        'bank',
                        'timebank',
                        'time-bank',
                        'moderator',
                        'regulator',
                    ];
                    foreach ($disallowedWords as $word) {
                        if (str_contains(strtolower($value), $word)) {
                            $fail(trans('validation.custom.profile_user.name.disallowed', ['word' => $word]));
                        }
                    }   
                },
            ],
            'email' => 'required|email|unique:users,email|max:40',
            'password' => 'required|min:6|same:passwordConfirmation',
            'profile_photo' => 'nullable|mimes:gif,jpg,jpeg,png,svg|max:1024',
            'about' => 'nullable|string|max:400',   //TODO: check max with legacy cyclos data
            'motivation' => 'nullable|string|max:200',  //TODO: check max with legacy cyclos data
            'date_of_birth' => 'nullable|date',
            'website' => 'nullable|string|max:150',
        ],
        // TODO: move validation rules in Livewire Posts to this config
        // 'posts' => [
        //     'title' =>  'required|string|unique:users,name|min:3|max:40',
        //     'intro' => 'required|string|max:300',
        //     'content' => 'required|string',
        //     'locale' => 'string|unique:post_translations,locale'
        // ],
    ],

    'files' => [
        'profile_user' => [
            'photo_new' => 'app-images/profile-user-new.svg',
            'photo_default' => 'app-images/profile-user-default.svg',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Base Language
    |--------------------------------------------------------------------------
    | Translations are linked by their context to one base language. 
    | 
    */
    'base_language' => 'en',
    'base_language_name' => 'English'

];
