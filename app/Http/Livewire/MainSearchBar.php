<?php

namespace App\Http\Livewire;

use Elastic\Elasticsearch\Client;
use Livewire\Component;
use Matchish\ScoutElasticSearch\MixedSearch;
use ONGR\ElasticsearchDSL\Highlight\Highlight;
use ONGR\ElasticsearchDSL\Query\FullText\MultiMatchQuery;
use ONGR\ElasticsearchDSL\Search;

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
                'name',
                'about',
                'locations.district',
                'locations.city',
                'locations.division',
                'locations.country',
                'tags.contexts.tags.name',
                'tags.contexts.categories.translations.name',

            ], $search, ['fuzziness' => 2]);
            $body->addQuery($multiMatchQuery);
            $body->setSize(100);

            return $client->search(['index' => [
                'posts_index',
                'users_index',
                'organizations_index',
                ], 'body' => $body->toArray()])->asArray();
        })->raw();

        $results = $rawOutput['hits']['hits'];

        $extractedData = array_map(function ($result) {
            $score = $result['_score'];
            if ($result['_source']['__class_name'] === 'App\Models\Post') {
                $score *= 1.5; // Apply multiplier to the score if the model is a Post
            }
            return [
                'id' => $result['_source']['id'],
                'model' => $result['_source']['__class_name'],
                'score' => $score,
            ];
        }, $results);

        // Sort the extracted data by score in descending order
        $extractedData = collect($extractedData)->sortByDesc('score')->all();

        //$this->emit('resultsUpdated', $extractedData);

        $this->results = $extractedData;
    }
}
