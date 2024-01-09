<?php

namespace App\Http\Livewire;

use Atomescrochus\StringSimilarities\Compare;
use Elastic\Elasticsearch\Client;
use Illuminate\Support\Str;
use Livewire\Component;
use Matchish\ScoutElasticSearch\MixedSearch;
use ONGR\ElasticsearchDSL\Highlight\Highlight;
use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MatchQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MultiMatchQuery;
use ONGR\ElasticsearchDSL\Query\Joining\NestedQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\FuzzyQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\TermQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\WildcardQuery;
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

        if (strlen($search) > 1) {     // Because we use the fuzzy search character '~', we need to check if $searchQuery is > 1
            // Remove special characters that conflict with Elesticsearch query from $search
            $search = preg_replace('/[^a-zA-Z0-9\s]/', '', $search);

            // Remove trailing whitespaces
            $search = rtrim($search);

            // Add fuzzy search character '~' to $search
            $search = $search . '*';
        }

        // Define pre and post tags for highlighting
        $pre_tags = '<span class="font-extrabold italic">';
        $post_tags = '</span>';

        $rawOutput = MixedSearch::search($search, function (Client $client, Search $body) use ($search, $pre_tags, $post_tags) {
            $body->setSource(['id', '__class_name', '_score']);

            $fields = [
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
                'tags.contexts.tags.locale',
                'tags.contexts.categories.translations.name',
            ];

            $boostedFields = [
                'name' => 1.3,
                'tags.contexts.categories.translations.name' => 0.5,
                'tags.contexts.tags.name' => 1.5,
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
                'type' => 'best_fields',
                'fuzziness' => '1', //config('timebank-cc.main_search_bar.fuzziness'),
                // 'prefix_length' => 1, //characters at the beginning of the word that must match
                'max_expansions' => 10, //maximum number of terms to which the query will expand
            ]);
            $boolQuery->add($multiMatchQuery, BoolQuery::SHOULD);
            $body->addQuery($boolQuery);
            
            


// $nestedQuery = new NestedQuery(
//     'tags.contexts.tags',
//     new MatchQuery('locale', 'nl')
// );
// $boolQuery->add($nestedQuery, BoolQuery::FILTER);
// $body->addQuery($boolQuery);



            $highlight = new Highlight();
            foreach ($fields as $field) {
                $highlight->addField($field, [
                    'fragment_size' => 30, //max character length of the fragment
                    'fragmenter' => 'simple',
                    'number_of_fragments' => 5, //max number of fragments to return
                    'pre_tags' => [$pre_tags],
                    'post_tags' => [$post_tags],
                ]);
            }
            $body->addHighlight($highlight);


            $body->setSize(100);    // get max results

            //TODO: define model index names in config file
            return $client->search(['index' => [
                'posts_index',
                'users_index',
                'organizations_index',
                ], 'body' => $body->toArray()])->asArray();
        })->raw();

        $results = $rawOutput['hits']['hits'];
        $extractedData = array_map(function ($result) use ($search, $pre_tags, $post_tags) {

            $highlight = $result['highlight'][array_key_first($result['highlight'])] ?? null;

            // Sort the highlight fragments by relevance
            if ($highlight !== null) {

                $highlightClean = collect($highlight)
                    ->mapWithKeys(function ($fragment, $key) use ($pre_tags, $post_tags) {
                        return [$key => Str::replaceFirst($pre_tags, '', Str::replaceLast($post_tags, '', $fragment))];
                    })
                    ->all();

                $comparison = new Compare();
                uasort($highlightClean, function ($a, $b) use ($search, $comparison) {
                    // Check for a partial match with the search string
                    $partialMatchA = strpos($a, $search) !== false;
                    $partialMatchB = strpos($b, $search) !== false;

                    if ($partialMatchA && !$partialMatchB) {
                        return -1;
                    }
                    if (!$partialMatchA && $partialMatchB) {
                        return 1;
                    }

                    // Calculate the Jaro-Winkler distance of each fragment to the search string
                    $distanceA = $comparison->jaroWinkler($search, $a);
                    $distanceB = $comparison->jaroWinkler($search, $b);

                    // Sort in ascending order of distance
                    return $distanceB <=> $distanceA;
                });
            }

            // Sort the highlight in the order of the keys of the sorted highlightClean array
            $sortedKeys = array_keys($highlightClean);
            $sortedHighlight = array_map(function ($key) use ($highlight) {
                return $highlight[$key];
            }, $sortedKeys);

            return [
                'id' => $result['_source']['id'],
                'model' => $result['_source']['__class_name'],
                'score' => $result['_score'],
                'highlight' =>  $sortedHighlight,
            ];

        }, $results);

        // Sort the extracted data by score in descending order
        $extractedData = collect($extractedData)->sortByDesc('score')->all();

        $this->results = $extractedData;
    }
}
