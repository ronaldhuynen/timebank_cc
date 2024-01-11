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
                        'analyzer_nl' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'dutch_stop',
                            ],
                        ],
                        'analyzer_en' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'english_stop',
                            ],
                        ],
                        'analyzer_fr' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'french_stop',
                            ],
                        ],
                        'analyzer_de' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'german_stop',
                            ],
                        ],
                        'analyzer_es' => [
                            'tokenizer' => 'standard',
                            'filter' => [
                                'lowercase',
                                'spanish_stop',
                            ],
                        ],
                    ],
                ],
            ],

        ]

    ],

];
