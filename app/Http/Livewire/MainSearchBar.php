<?php

namespace App\Http\Livewire;

use App\Overrides\Matchish\ScoutElasticSearch\ElasticSearch\EloquentHitsIteratorAggregate;
use Elastic\Elasticsearch\Client;
use Livewire\Component;
use Matchish\ScoutElasticSearch\MixedSearch;
use ONGR\ElasticsearchDSL\Highlight\Highlight;
use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MatchPhrasePrefixQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MatchQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MultiMatchQuery;
use ONGR\ElasticsearchDSL\Search;

class MainSearchBar extends Component
{
    public $search;
    public $suggestions = [];
    public $fetchedResults = [];
    public $results = [];
    public $showResults = false;


    public function render()
    {
        return view('livewire.main-search-bar');
    }

    public function updatedSearch()
    {
        $search = $this->search;

        if (strlen($search) > 1) {     // Because we use the fuzzy search character '~', we need to check if $searchQuery is > 1
            // Remove special characters that conflict with Elesticsearch query from $search
            $search = preg_replace('/[^a-zA-Z0-9\s]/', '', $search);

            // Remove trailing whitespaces
            $search = rtrim($search);

            // Add fuzzy search character '~' to $search
            $search = $search . '* ';
        }

        $rawOutput = MixedSearch::search($search, function (Client $client, Search $body) use ($search) {
            $body->setSource(['id', '__class_name', '_score']);

            $fields = [
                //TODO: make a user setting to enable multi-language search or check languages table of user?
                'post_translations.title_'. app()->getLocale(),
                'post_translations.excerpt_'. app()->getLocale(),
                'post_translations.content_'. app()->getLocale(),
                'post_category.name_'. app()->getLocale(),
                'name',
                'about_'. app()->getLocale(),
                'motivation_'. app()->getLocale(),
                'locations.district',
                'locations.city',
                'locations.division',
                'locations.country',
                'tags.contexts.tags.name_'. app()->getLocale(),
                'tags.contexts.categories.name_'. app()->getLocale(),
            ];

            $boostedFields = [
                'name' => config('timebank-cc.main_search_bar.boosted_fields.name'),
                'tags.contexts.tags.name' => config('timebank-cc.main_search_bar.boosted_fields.tags'),
                'tags.contexts.categories.name' => config('timebank-cc.main_search_bar.boosted_fields.categories'),
            ];

            $boolQuery = new BoolQuery();

            // Add match query for each field
            foreach ($fields as $field) {
                $matchQuery = new MatchQuery($field, $search, [
                    'operator' => 'and',
                ]);
                $boolQuery->add($matchQuery, BoolQuery::SHOULD);
            }

            // Construct fields parameter with boosts
            $fieldsWithBoosts = [];
            foreach ($fields as $field) {
                $fieldsWithBoosts[] = isset($boostedFields[$field]) ? $field . '^' . $boostedFields[$field] : $field;
            }
            $multiMatchQuery = new MultiMatchQuery($fieldsWithBoosts, $search, [
                'type' => config('timebank-cc.main_search_bar.search.type'),
                'fuzziness' => config('timebank-cc.main_search_bar.search.fuzziness'),
                'prefix_length' => config('timebank-cc.main_search_bar.search.prefix_length'),
            ]);
            $boolQuery->add($multiMatchQuery, BoolQuery::SHOULD);
            $body->addQuery($boolQuery);

            
            // Add match_phrase_prefix query for each field for partial matching
            foreach ($fields as $field) {
                $matchPhrasePrefixQuery = new MatchPhrasePrefixQuery($field, $search);
                $boolQuery->add($matchPhrasePrefixQuery, BoolQuery::SHOULD);
            }


            $highlight = new Highlight();
            foreach ($fields as $field) {
                $highlight->addField($field, [
                    'fragment_size' => config('timebank-cc.main_search_bar.search.fragment_size'),
                    'fragmenter' => config('timebank-cc.main_search_bar.search.fragmenter'),
                    'number_of_fragments' => config('timebank-cc.main_search_bar.search.number_of_fragments'),
                    'pre_tags' => [config('timebank-cc.main_search_bar.search.pre-tags')],
                    'post_tags' => [config('timebank-cc.main_search_bar.search.post-tags')],
                    'order' => config('timebank-cc.main_search_bar.search.order'),
                ]);
            }
            $body->addHighlight($highlight);

            //TODO: define max results in config file
            $body->setSize(100);    // get max results

            return $client->search(['index' => config('timebank-cc.main_search_bar.model_indices'), 'body' => $body->toArray()])->asArray();
        })
        ->raw();

        info($rawOutput);


        // $callback = function ($query) {
        //     $query->with('tags.contexts.tags.locale')->get();
        // };
        // $iterator = new EloquentHitsIteratorAggregate($rawOutput, $callback);
        // info(collect($iterator));
        // $hitsIterator = new EloquentHitsIteratorAggregate($rawOutput);
        // foreach ($hitsIterator as $model) {
        //     info($model);
        // }


        $results = $rawOutput['hits']['hits'];
        $extractedData = array_map(function ($result) use ($search) {

            $highlight = $result['highlight'][array_key_first($result['highlight'])] ?? null;


            // Clean the highlight from the pre- and post-tags for sorting the results
            if ($highlight !== null) {
                $highlightClean = collect($highlight)
                    ->mapWithKeys(function ($fragment, $key) {
                        return [$key => strip_tags($fragment)];
                    })
                    ->all();
            }

            // Sort the highlight in the order of the keys of the sorted highlightClean array
            $sortedKeys = array_keys($highlightClean);
            $sortedHighlight = array_map(function ($key) use ($highlight) {
                return $highlight[$key];
            }, $sortedKeys);

            $suggest = (array_values(array_unique($highlightClean)));

            return [
                'id' => $result['_source']['id'],
                'model' => $result['_source']['__class_name'],
                'score' => $result['_score'],
                'highlight' =>  $sortedHighlight,
                'suggest' => $suggest
            ];

        }, $results);

        // Sort the extracted data by score in descending order
        $extractedData = collect($extractedData)->sortByDesc('score')->all();
        

        $suggestions = collect($extractedData)->pluck('suggest')->flatten()->unique();
        $this->suggestions = $suggestions->take(config('timebank-cc.main_search_bar.suggestions'));
        $this->fetchedResults = $extractedData;
    }

    public function showSearchResults($value)
    {
        $this->search = $value;
        $this->results = $this->fetchedResults;
        $this->showResults = true;
    }
}
