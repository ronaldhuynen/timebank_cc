<?php

namespace App\Http\Livewire;

use Elastic\Elasticsearch\Client;
use Livewire\Component;
use Matchish\ScoutElasticSearch\MixedSearch;
use ONGR\ElasticsearchDSL\Highlight\Highlight;
use ONGR\ElasticsearchDSL\Query\Compound\FunctionScoreQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MultiMatchQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\TermQuery;
use ONGR\ElasticsearchDSL\Search;
use ONGR\ElasticsearchDSL\Sort\FieldSort;

class MainSearchBar extends Component
{
    public $search;
    public $results = [];


    public function render()
    {
        return view('livewire.main-search-bar');
    }

    public function updatedSearch()
    {
        $search = $this->search;

        $rawOutput = MixedSearch::search($search, function (Client $client, Search $body) use ($search) {
            $highlight = new Highlight();
            $highlight->addField('translations.title');
            $body->addHighlight($highlight);

            $body->setSource(['id', '__class_name', '_score']);

            $multiMatchQuery = new MultiMatchQuery([
                'translations.title',
                'translations.excerpt',
                'translations.content',
                'category.names',
                'about',
                'motivation',

            ], $search, ['fuzziness' => 2]);
            $functionScoreQuery = new FunctionScoreQuery($multiMatchQuery);
            $functionScoreQuery->addWeightFunction(100, new TermQuery('__class_name', 'App\Models\Post'));
            $body->addQuery($functionScoreQuery);
            $body->setSize(100);   
            $body->addSort(new FieldSort('_score', 'DESC')); 

            return $client->search(['index' => [
                'posts_index',
                'users_index', 
                'organizations_index', 
                ], 'body' => $body->toArray()])->asArray();
        })->raw();

        $results = $rawOutput['hits']['hits'];

        $extractedData = array_map(function ($result) {
            return [
                'id' => $result['_source']['id'],
                'model' => $result['_source']['__class_name'],
                'score' => $result['_score'],
            ];
        }, $results);

        $this->emit('resultsUpdated', $extractedData);

        $this->results = $extractedData;
    }
}