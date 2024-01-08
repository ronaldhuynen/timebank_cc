<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Artisan;

class SearchIndexController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }


    public function indexStopwords($indexName)
    {
        $stopwords = config('timebank-cc.elasticsearch.stopwords');

        $settings = [
            'analysis' => [
                'analyzer' => [
                    'my_custom_analyzer' => [
                        'type' => 'standard',
                        'stopwords' => $stopwords
                    ]
                ]
            ]
        ];

        // Create the index
        $params = [
            'index' => $indexName,
            'body' => [
                'settings' => $settings,
                // other index settings...
            ]
        ];

        $response = $this->client->indices()->create($params);

        return $response;

    }

    public function deleteIndex($indexName)
    {
        $client = ClientBuilder::create()->build();
        $params = ['index' => $indexName,
                    'alias' => $indexName];
        $response = $client->indices()->delete($params);

        return $response;

    }
}
