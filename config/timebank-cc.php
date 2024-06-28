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
        'user' => [
            'name' =>  'Personal Account',
            'limit_min' => 0,
            'limit_max' => 6000, // 100 H
        ],
        'organization' => [
            'name' => 'Organization Account',
            'limit_min' => 0,
            'limit_max' => 6000, // 100 H, default value,  manually set organizations with a big turn-over to a higher limit
        ],
        'bank' => [
            'name' => 'Organization Account',
            'limit_min' => 0,    // The 'source' bank and the debit account should have limit_min = NULL, other banks can use this config
            'limit_max' => 600000, //  10,000 H
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Public / Private settings
    |--------------------------------------------------------------------------
    |
    | The default account properties that will be set into the database when new accounts are created.
    | The balance limits are in minutes.
    */

    'account_info' => [
        'personal' => [
            'balance_public' =>  true,
        ],
        'organization' => [
            'balance_public' =>  true,
        ],
        'account_totals' => [
            'sumBalances_public' => false,
            'countTransfersSince' => 365,   // days ago
            'countTransfersSince_humanReadable' => 'past year',   // Short description of countTransfersSince in base language: must have translation key!
            'countTransfers_public' => true,
            'countTransfersReceived_public' => true,
            'countTransfersGiven_public' => true,
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
            'name' =>  ['required', 'string', 'unique:users,name', 'unique:organizations,name', 'min:3', 'max:40',
                function ($attribute, $value, $fail) {
                    // Disallow the following words to be used inside the name:
                    $disallowedWords = [
                        'admin',
                        'administrator',
                        'superuser',
                        'super-user',
                        'supervisor',
                        'bank',
                        'timebank',
                        'time-bank',
                        'moderator',
                        'regulator',
                        'belastingdienst',
                        'tax-office',
                    ];
                    foreach ($disallowedWords as $word) {
                        if (str_contains(strtolower($value), $word)) {
                            $fail(trans('validation.custom.profile_user.name.disallowed', ['word' => $word]));
                        }
                    }
                },
                'regex:/^[a-zA-Z0-9-_ ]+$/', // only letters, numbers, spaces, dashes and underscores
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
    | IMPORTANT: This language is also used as fallback locale, therefore all names, titles, terms, etc. must be at least in this language.
    |
    */
    'base_language' => 'en',
    'base_language_name' => 'English',


    /*
    |--------------------------------------------------------------------------
    | Search settings
    |--------------------------------------------------------------------------
    | Configuration of Elasticsearch matching and highlighting.
    | More info: https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-multi-match-query.html
    |
    */
    'main_search_bar' => [
        'boosted_fields' => [   // fields with a boost factor, 1,0 neutral, 1,5 boosted, 0,5 penalized
            'name' =>  1.3,
            'tags' => 1,
            'categories' => 1,
        ],
        'search' => [
            'type' => 'best_fields', // 'best_fields', 'most_fields', 'cross_fields', 'phrase', 'phrase_prefix'
            'fuzziness' => 'AUTO', // 'AUTO' or a number between 0 and 2
            'prefix_length' => 0, //characters at the beginning of the word that must match
            'fragment_size' => 50, //The size of the highlighted fragment in characters.
            'fragmenter' => 'simple', // 'simple' or 'span'
            'number_of_fragments' => 5, // The maximum number of fragments to return. If the number of fragments is set to 0, no fragments are returned. Instead, the entire field contents are highlighted and returned.
            'pre-tags'  => '<span class="font-black italic">', // HTML tags to wrap around highlighted text
            'post-tags' => '</span>', // HTML tags to wrap around highlighted text
            'order' => 'score', // 'score' or 'none', the order of the fragments
        ],
        'model_indices' => [   // Elasticsearch indices that will be searched (defined in Models and imported by Scout)
            'posts_index',
            'users_index',
            'organizations_index',
        ],
        'suggestions' => 5, // max number of suggestions to show in search bar
    ],

];
