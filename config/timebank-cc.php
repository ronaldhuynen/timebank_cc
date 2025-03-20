<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Mail addresses
    |--------------------------------------------------------------------------
    |
    */
    'mail' => [
        'system_admin' => 'admin@timebank.cc',
        'user_admin' => 'admin@timebank.cc',
        'content_admin' => 'admin@timebank.cc',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Profile Properties
    |--------------------------------------------------------------------------
    |
    */
    'profiles' => [
        'user' => [
            'limit_min' => 0,
            'limit_max' => 6000, // 100 H
            'profile_photo_path_new' => 'app-images/profile-user-new.svg',
            'profile_photo_path_default' => 'app-images/profile-user-default.svg',

        ],
        'organization' => [
            'limit_min' => 0,
            'limit_max' => 6000, // 100 H
            'profile_photo_path_new' => 'app-images/profile-user-new.svg',
            'profile_photo_path_default' => 'app-images/profile-user-default.svg',
        ],
        'bank' => [
            'limit_min' => 0,
            'limit_max' => null, // unlimited H
            'profile_photo_path_new' => 'app-images/profile-user-new.svg',
            'profile_photo_path_default' => 'app-images/profile-user-default.svg',
        ],
        'admin' => [
            'limit_min' => 0,
            'limit_max' => 0,
            'profile_photo_path_new' => 'app-images/profile-user-new.svg',
            'profile_photo_path_default' => 'app-images/profile-user-default.svg',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Default Account Properties
    |--------------------------------------------------------------------------
    |
    | The default account properties that will be set into the database when new accounts are created.
    | The balance limits are in minutes. A negative balance limit should be set as 'limit_min' = -300
    |
    | Receiving types - defines which transaction types the account can receive:
    | 1 => worked time
    | 2 => gift
    | 3 => donation
    | 4 => currency creation
    | 5 => currency removal
    |
    */
    // TODO JOERI: Check transaction types
    'accounts' => [
        'user' => [
            'name' =>  'personal account',
            'limit_min' => 0,
            'limit_max' => 6000, // 100 H
            'receiving_types' => [1,2],
        ],
        'user_project' => [
            'name' =>  'personal project account',
            'limit_min' => 0,
            'receiving_types' => [1,3],
        ],
        'organization' => [
            'name' => 'organization account',
            'limit_min' => 0,
            'limit_max' => 6000, // 100 H, default value,  manually set organizations with a big turn-over to a higher limit
            'receiving_types' => [1,3],
        ],
        'bank' => [
            'name' => 'banking system account',
            'limit_min' => 0,    // The 'source' bank and the debit account should have limit_min = NULL, other banks can use this config
            'limit_max' => 600000, //  10,000 H
            'receiving_types' => [1,4],
        ],
        'community' => [
            'name' => 'community account',
            'limit_min' => 0,    // The 'source' bank and the debit account should have limit_min = NULL, other banks can use this config
            'limit_max' => null,
            'receiving_types' => [3,4],
        ],
        'debit' => [
            'name' => 'debit',
            'limit_min' => null,    // The 'source' bank and the debit account should have limit_min = NULL, other banks can use this config
            'limit_max' => 0,
            'receiving_types' => [5],
        ],
    ],
    'maxLengthHoursInput' => [  // Sets the default max length the amount component can have for the hours input box
        'user' => 3,
        'organization' => 3,
        'bank' => 5,
        'admin' => 10,
        'transaction_types' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | User type permission settings
    |--------------------------------------------------------------------------
    |
    | Payment types - defines which transaction types the user type can pay:
    | 1 => worked time
    | 2 => gift
    | 3 => donation
    | 4 => currency creation
    | 5 => currency removal
    |
    */
    // TODO JOERI: Check transaction types
    'permissions' => [
        'user' => [
            'payment_types' => [1,2,3],
        ],
        'user_project' => [
            'payment_types' => [1,2,3],
        ],
        'organization' => [
            'payment_types' => [1,2,3],
        ],
        'bank' => [
            'payment_types' => [1,2,3,5],
        ],
        'admin' => [
            'payment_types' => [],
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Public / Private settings
    |--------------------------------------------------------------------------
    |
    */

    'account_info' => [
        'user' => [
            'balance_public' =>  true,
        ],
        'organization' => [
            'balance_public' =>  false,
        ],
        'bank' => [
            'balance_public' =>  false,
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
                        'webmaster',
                        'web-master',
                        'tijd-bank',
                        'tijdbank',
                        'bank',
                        'timebank',
                        'time-bank',
                        'moderator',
                        'regulator',
                        'belasting',
                        'tax',
                        'test',
                    ];

                    // Disallowed names as they might conflict with (future) url paths
                    $completelyDisallowedNames = [
                        'test',
                        'debug',
                        'user',
                        'users',
                        'member',
                        'members',
                        'profile',
                        'organization',
                        'organizations',
                        'organisation',
                        'organisations',
                        'bank',
                        'banks',
                        'admin',
                        'transaction',
                        'transactions',
                        'transfer',
                        'transfers',
                        'statement',
                        'statements',
                        'payment',
                        'payments',
                        'pay',
                        'paid',
                        'invoice',
                        'request',
                        'requests',
                        'edit',
                        'show',
                        'update',
                        'message',
                        'messages',
                        'messenger',
                        'messengers',
                        'berichten',
                        'chat',
                        'talk',
                        'meet',
                        'drive',
                        'cloud',
                        'config',
                        'settings',
                        'agenda',
                        'calendar',
                        'news',
                        'nieuws',
                        'vote',
                        'poll',
                        'auth',
                        'authenticate',
                        'verify',
                        'verification',
                        'date',
                        'datum',
                        'confirm',
                        'mail',
                        'post',
                        'posts',
                        'blog',
                    ];

                    // Check for disallowed substrings
                    foreach ($disallowedWords as $word) {
                        if (str_contains(strtolower($value), $word)) {
                            $fail(trans('validation.custom.profile_user.name.disallowed', ['word' => $word]));
                        }
                    }

                    // Check for completely disallowed names
                    if (in_array(strtolower($value), array_map('strtolower', $completelyDisallowedNames))) {
                        $fail(trans('validation.custom.profile_user.name.completely_disallowed', ['name' => $value]));
                    }
                },
                'regex:/^[a-zA-Z0-9-_ ]+$/', // only letters, numbers, spaces, dashes and underscores
            ],

            'email' => 'required|email|unique:users,email|max:40',
            'password' => 'required|min:6|same:passwordConfirmation',
            'profile_photo' => 'nullable|mimes:gif,jpg,jpeg,png,svg|max:1536', // max 1,5 MB
            'about' => 'nullable|string|max:400',   //TODO: check max with legacy cyclos data
            'about_short' => 'nullable|string|max:150',   
            'motivation' => 'nullable|string|max:200',  //TODO: check max with legacy cyclos data
            'date_of_birth' => 'nullable|date',
            'languages' => 'required',
            'website' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ],
        'profile_organization' => [
            'email' => 'required|email|unique:organizations,email|max:40',
            'password' => 'required|min:6|same:passwordConfirmation',
            'profile_photo' => 'nullable|mimes:gif,jpg,jpeg,png,svg|max:1536', // max 1,5 MB
            'about' => 'nullable|string|max:400',   //TODO: check max with legacy cyclos data
            'about_short' => 'nullable|string|max:150',   
            'motivation' => 'nullable|string|max:200',  //TODO: check max with legacy cyclos data
            'languages' => 'required',
            'website' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ],
        'profile_bank' => [
            'email' => 'required|email|unique:bank,email|max:40',
            'password' => 'required|min:6|same:passwordConfirmation',
            'profile_photo' => 'nullable|mimes:gif,jpg,jpeg,png,svg|max:1536', // max 1,5 MB
            'about' => 'nullable|string|max:400',   //TODO: check max with legacy cyclos data
            'about_short' => 'nullable|string|max:150',   
            'motivation' => 'nullable|string|max:200',  //TODO: check max with legacy cyclos data
            'languages' => 'required',
            'website' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ],
        'profile_admin' => [
            'email' => 'required|email|unique:admin,email|max:40',
            'password' => 'required|min:6|same:passwordConfirmation',
            'profile_photo' => 'nullable|mimes:gif,jpg,jpeg,png,svg|max:1536', // max 1,5 MB
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Base Language
    |--------------------------------------------------------------------------
    | Translations are linked by their context to one base language.
    |
    | IMPORTANT: This language is also used as fallback locale, therefore all names, titles, terms, etc. must be at least in this language!
    | IMPORTANT: The base language can not be changed in an existing project, unless the new base language pre-exists for all translations!
    */
    'base_language' => 'en',    // Do not change in existing project, see note above
    'base_language_name' => 'English', // Do not change in existing project, see note above

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



/*
|--------------------------------------------------------------------------
| Post settings
|--------------------------------------------------------------------------
|
*/
    'posts' => [
        'postable_is_auth_user' => true,    // Post editor profile that is stored. Set to true: Users, set to false: active profile models stored in session (users, organizations, banks, admins)
        'site-content-writer' => 'Timebank.cc', // Writer name for general site content such as static pages. This name can be a non-exsisting user / organization
        'title_rule' => 'required|string|min:3|max:150',
        'excerpt_rule' => 'nullable|string|string|max:500',
        'content_rule' => 'nullable|string|max:1048576', // max 1 MB in bytes
        'image_rule' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:6144', // max 6 MB
        'media_owner_rule' => 'nullable|string|max:150',
        'media_caption_rule' => 'nullable|string|max:300',
        'meeting_address_rule' => 'nullable|string|max:100',
    ],


/*
|--------------------------------------------------------------------------
| Tags settings
|--------------------------------------------------------------------------
|
*/
    'tags' => [
        'name_rule' => '',
    ],


/*
|--------------------------------------------------------------------------
| Custom Messenger settings
|--------------------------------------------------------------------------
|
*/
        'messenger' => [
            'default_unread_mail_delay' => 8, // In hours. After this default delay an email will be send to notify an unread chat message. Users / profiles can change this in their settings
        ]

];

