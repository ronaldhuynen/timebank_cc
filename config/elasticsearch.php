<?php

return [
    'host' => env('ELASTICSEARCH_HOST'),
    'user' => env('ELASTICSEARCH_USER'),
    'password' => env('ELASTICSEARCH_PASSWORD'),
    'cloud_id' => env('ELASTICSEARCH_CLOUD_ID'),
    'api_key' => env('ELASTICSEARCH_API_KEY'),
    'queue' => [
        'timeout' => env('SCOUT_QUEUE_TIMEOUT'),
    ],
    'indices' => [
        'mappings' => [
            'default' => [
                'properties' => [
                    'id' => [
                        'type' => 'keyword',
                    ],
                ],
            ],


            'posts_index' => [
                'properties' => [
                    'id' => [
                        'type' => 'keyword',
                    ],
                    'post_translations' => [
                        'properties' => [
                            'title_nl' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_nl',
                            ],
                            'title_en' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_en',
                            ],
                            'title_fr' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_fr',
                            ],
                            'title_de' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_de',
                            ],
                            'title_es' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_es',
                            ],
                            'excerpt_nl' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_nl',
                            ],
                            'excerpt_en' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_en',
                            ],
                            'excerpt_fr' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_fr',
                            ],
                            'excerpt_de' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_de',
                            ],
                            'excerpt_es' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_es',
                            ],
                            'content_nl' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_nl',
                            ],
                            'content_en' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_en',
                            ],
                            'content_fr' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_fr',
                            ],
                            'content_de' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_de',
                            ],
                            'content_es' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_es',
                            ],
                        ],
                    ],
                    'post_category' => [
                        'properties' => [
                            'name_nl' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_nl',
                            ],
                            'name_en' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_en',
                            ],
                            'name_fr' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_fr',
                            ],
                            'name_de' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_de',
                            ],
                            'name_es' => [
                                'type' => 'text',
                                'analyzer' => 'analyzer_es',
                            ],
                        ],
                    ],
                ],
            ],

            'users_index' => [
                'properties' => [
                    'about_nl' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_nl',
                    ],
                    'about_en' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_en',
                    ],
                    'about_fr' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_fr',
                    ],
                    'about_de' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_de',
                    ],
                    'about_es' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_es',
                    ],
                    'motivation_nl' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_nl',
                    ],
                    'motivation_en' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_en',
                    ],
                    'motivation_fr' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_fr',
                    ],
                    'motivation_de' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_de',
                    ],
                    'motivation_es' => [
                        'type' => 'text',
                        'analyzer' => 'analyzer_es',
                    ],

                    'locations' => [
                        'properties' => [
                            'district' => [
                                'type' => 'text',
                                'analyzer' => 'locations_analyzer',
                            ],
                            'city' => [
                                'type' => 'text',
                                'analyzer' => 'locations_analyzer',
                            ],
                            'division' => [
                                'type' => 'text',
                                'analyzer' => 'locations_analyzer',
                            ],
                            'country' => [
                                'type' => 'text',
                                'analyzer' => 'locations_analyzer',
                            ],
                        ],
                    ],

                    'tags' => [
                        'properties' => [
                            'contexts' => [
                                'properties' => [
                                    'categories' => [
                                        'properties' => [
                                            'name_nl' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_nl',
                                            ],
                                            'name_en' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_en',
                                            ],
                                            'name_fr' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_fr',
                                            ],
                                            'name_de' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_de',
                                            ],
                                            'name_es' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_es',
                                            ],
                                        ],
                                    ],
                                    'tags' => [
                                        'properties' => [
                                            'name_nl' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_nl',
                                            ],
                                            'name_en' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_en',
                                            ],
                                            'name_fr' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_fr',
                                            ],
                                            'name_de' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_de',
                                            ],
                                            'name_es' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_es',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],

            ],
        ],


        'settings' => [
            'default' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0,
                'analysis' => [
                    'filter' => [
                        'custom_keyword_marker' => [ // Exclude these keywords from stemming and stopwords
                            'type' => 'keyword_marker',
                            'keywords' => ["Den Haag", "The Hague", "La Haye", "Den Haag", "La Haya"], 
                        ],
                        'locations_stop' => [
                            'type' => 'stop',
                            'stopwords' => [
                                // Dutch stopwords
                                "den", "de", "het", "een", "en", "van", "op", "aan", "in", "voor", "met",
                                "door", "onder", "boven", "te", "uit", "bij", "naar", "om", "tot",
                                "over", "tussen", "achter", "voor", "tegen", "door", "naast", "langs",
                                "binnen", "buiten", "rond", "sinds", "onder", "boven", "langs", "af",
                                "uit", "op", "tussen", "tot", "bij", "vanaf", "door", "om", "heen",
                                // English stopwords
                                "the", "and", "of", "a", "an", "in", "on", "at", "by", "for",
                                "with", "from", "to", "into", "through", "over", "under", "behind",
                                "beside", "between", "around", "near", "throughout", "since", "above",
                                "below", "up", "down", "before", "after", "during", "while", "among",
                                "about", "against", "off", "along", "across", "toward", "inside",
                                "outside", "against", "within", "without", "onto", "upon",
                                // French stopwords
                                 "le", "la", "les", "l'", "de", "du", "des", "un", "une", "d'",
                                "et", "en", "au", "aux", "à", "avec", "par", "pour", "sur", "sous",
                                "entre", "vers", "pendant", "depuis", "devant", "derrière", "chez",
                                "près", "loin", "dans", "hors", "au-dessus", "au-dessous", "au milieu",
                                "tout près", "tout loin", "tout autour", "autour", "avant", "après",
                                "pendant", "alors que", "entre", "contre", "à travers", "jusqu'à",
                                "jusque", "parmi", "au sujet de", "contre", "avec", "sans", "à","sur",
                                // German stopwords
                                "der", "die", "das", "des", "dem", "den", "ein", "eine", "einem",
                                "einen", "und", "in", "auf", "an", "mit", "bei", "nach", "vor",
                                "über", "unter", "zwischen", "neben", "hinter", "vorbei", "durch",
                                "um", "bis", "für", "gegen", "entlang", "seit", "oberhalb", "unterhalb",
                                "umher", "innerhalb", "außerhalb", "rund um", "seit", "über",
                                "vor", "nach", "während", "währenddessen", "unter", "über", "gegenüber",
                                "mitte", "nah", "fern", "innerhalb", "außerhalb", "zwischen", "vor",
                                "hinter", "vorbei",
                                // Spanish stopwords
                                "el", "la", "los", "las", "un", "una", "unos", "unas", "de", "del",
                                "al", "a", "con", "en", "por", "para", "sobre", "bajo", "ante",
                                "desde", "hacia", "entre", "tras", "durante", "según", "sin", "hasta",
                                "so", "sobre", "bajo", "frente", "detrás", "cerca", "lejos", "dentro",
                                "fuera", "alrededor", "junto", "contra", "a través", "hasta", "aunque",
                                "mientras", "entre", "contra", "sin", "hacia", "dentro", "fuera", "sobre",
                            ],
                        ],
                        'dutch_stop' => [
                            'type' => 'stop',
                            'stopwords' => '_dutch_',
                        ],
                        'english_stop' => [
                            'type' => 'stop',
                            'stopwords' => '_english_',
                        ],
                        'french_stop' => [
                            'type' => 'stop',
                            'stopwords' => '_french_',
                        ],
                        'german_stop' => [
                            'type' => 'stop',
                            'stopwords' => '_german_',
                        ],
                        'spanish_stop' => [
                            'type' => 'stop',
                            'stopwords' => '_spanish_',
                        ],
                    ],

                    'analyzer' => [
                         'locations_analyzer' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'custom_keyword_marker',
                                'locations_stop',
                            ],
                        ],
                        'analyzer_nl' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'custom_keyword_marker',
                                'dutch_stop',
                            ],
                        ],
                        'analyzer_en' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'custom_keyword_marker',
                                'english_stop',
                            ],
                        ],
                        'analyzer_fr' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'custom_keyword_marker',
                                'french_stop',
                            ],
                        ],
                        'analyzer_de' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'custom_keyword_marker',
                                'german_stop',
                            ],
                        ],
                        'analyzer_es' => [
                            'tokenizer' => 'standard',
                            'custom_keyword_marker',
                            'filter' => [
                                'lowercase',
                                'spanish_stop',
                            ],
                        ],
                    ],
                ],
            ],

        ],

    ],

];
