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
use ONGR\ElasticsearchDSL\Query\TermLevel\FuzzyQuery;
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
                'tags.contexts.categories.translations.name',
                'tags.locale.locale'
            ];

            $boostedFields = [
                'name' => 1.3,
                'tags.contexts.categories.translations.name' => 1.1,
                'tags.contexts.tags.name' => 2.5,
                // Add more fields here...
            ];

            $boolQuery = new BoolQuery();

            // Construct fields parameter with boosts
            $fieldsWithBoosts = [];
            foreach ($fields as $field) {
                $fieldsWithBoosts[] = isset($boostedFields[$field]) ? $field . '^' . $boostedFields[$field] : $field;
            }

            $multiMatchQuery = new MultiMatchQuery($fieldsWithBoosts, $search, [
                'type' => 'best_fields',
                'fuzziness' => 'AUTO', //config('timebank-cc.main_search_bar.fuzziness'),
                // 'prefix_length' => 1, //characters at the beginning of the word that must match
                'max_expansions' => 50, //maximum number of terms to which the query will expand
                'minimum_should_match' => 2
            ]);

            $boolQuery->add($multiMatchQuery, BoolQuery::SHOULD);
            $body->addQuery($boolQuery);

            $highlight = new Highlight();
            foreach ($fields as $field) {
                $highlight->addField($field, [
                    'fragment_size' => 10,
                    'fragmenter' => 'simple',
                    'number_of_fragments' => 5,
                    'pre_tags' => [$pre_tags],
                    'post_tags' => [$post_tags],
                ]);
            }
            $body->addHighlight($highlight);


            $body->setSize(100);    // get max results

            return $client->search(['index' => [
                'posts_index',
                'users_index',
                'organizations_index',
                ], 'body' => $body->toArray()])->asArray();
        })->raw();

        $results = $rawOutput['hits']['hits'];
        info($results);

        $extractedData = array_map(function ($result) use ($search, $pre_tags, $post_tags) {


            $score = $result['_score'];
            if ($result['_source']['__class_name'] === 'App\Models\Post') {
                $score *= 1.3; // Apply multiplier to the score if the model is a Post
            }

            $highlight = $result['highlight'][array_key_first($result['highlight'])] ?? null;
            info($highlight);

            // Sort the highlight fragments by relevance
            if ($highlight !== null) {
                $searchWithTags = $pre_tags . $search . $post_tags;
                $comparison = new Compare();
                usort($highlight, function ($a, $b) use ($search, $searchWithTags, $comparison) {
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
                    $distanceA = $comparison->jaroWinkler($searchWithTags, $a);
                    $distanceB = $comparison->jaroWinkler($searchWithTags, $b);

                    // Sort in ascending order of distance
                    return $distanceA <=> $distanceB;
                });
            }


            return [
                'id' => $result['_source']['id'],
                'model' => $result['_source']['__class_name'],
                'score' => $score,
                'highlight' => $highlight,
            ];
        }, $results);

        // Sort the extracted data by score in descending order
        $extractedData = collect($extractedData)->sortByDesc('score')->all();
        //$this->emit('resultsUpdated', $extractedData);


        $this->results = $extractedData;
    }
}
