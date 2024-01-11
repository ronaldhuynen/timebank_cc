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
        'default' => [
            'mappings' => [
                'properties' => [
                    'id' => [
                        'type' => 'keyword',
                    ],
                ],
            ],
            'settings' => [
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
                    ],
                ],
            ],
        ],
        'posts_index' => [
            'mappings' => [
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
                            // Add more fields for other locales
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
                            // Add more fields for other locales
                        ],
                    ],
                ],
            ],
        ],
        'users_index' => [
            'mappings' => [
                'properties' => [
                    'tags' => [
                        'properties' => [
                            'contexts' => [
                                'properties' => [
                                    'categories' => [
                                        'properties' => [
                                            'name_de' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_de',
                                                ],
                                            'name_en' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_en',
                                                ],
                                            'name_es' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_es',
                                            ],
                                            // Add other languages here...
                                        ],
                                    ],
                                    'tags' => [
                                        'properties' => [
                                            'name_de' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_de',
                                            ],
                                            'name_en' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_en',
                                            ],
                                            'name_es' => [
                                                'type' => 'text',
                                                'analyzer' => 'analyzer_es',
                                            ],
                                            // Add other languages here...
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
];
