<?php

namespace App\Http\Livewire;

use App\Models\Locations\City;
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
use RTippin\Messenger\Messenger;

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
                'post_translations.title_' . app()->getLocale(),
                'post_translations.excerpt_' . app()->getLocale(),
                'post_translations.content_' . app()->getLocale(),
                'post_category.name_' . app()->getLocale(),
                'postable.name',
                'name',
                'about_short' . app()->getLocale(),
                'motivation_' . app()->getLocale(),
                'locations.district',
                'locations.city',
                'locations.division',
                'locations.country',
                'tags.contexts.tags.name_' . app()->getLocale(),
                'tags.contexts.categories.name_' . app()->getLocale(),
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
            $body->setSize(50);    // get max results

            return $client->search(['index' => config('timebank-cc.main_search_bar.model_indices'), 'body' => $body->toArray()])->asArray();
        })
            ->raw();

        $callback = function ($query) {
            $query;
        };

        $cardData = [];
        $hitsIterator = new EloquentHitsIteratorAggregate($rawOutput, $callback);
        foreach ($hitsIterator as $model) {
            $type = get_class($model);

            if ($type === 'App\Models\User' || $type === 'App\Models\Organization') {
                $model->load([
                    'locations.district.translations',
                    'locations.city.translations',
                    'locations.division.translations',
                    'locations.country.translations',
                ])
                ->select('id', 'name', 'profile_photo_path');

                $firstLocation = $model->locations->first();  // TODO: Update this method when we have multiple locations for users and organizations
                 
                // Construct location strings 
                if ($firstLocation) {

                    $city = null;
                    $district = null;
                    $division = null;
                    $country = null;
                    $locationShort = null;
                    $location = '';

                    if ($firstLocation->city) {
                        $city = $firstLocation->city->translations->first()->name;
                    }
                    if ($firstLocation->district) {
                        $district = $firstLocation->district->translations->first()->name;
                    }
                    if ($firstLocation->division) {
                        $division = $firstLocation->division->translations->first()->name;
                    }
                    if (!$firstLocation->division && $city != null) {
                        $cityId = $firstLocation->city->id;
                        $division = City::find($cityId)->division->translations->first()->name;
                    }
                    if ($firstLocation->country) {
                        $country = $firstLocation->country->code;
                    }

                    if ($city) {
                        $locationShort = $city . ', ' . $division;
                        if ($district) {
                            $location = $city . ' ' . $district . ', ' . $division . ', ' . $country;
                        } else {
                            $location = $city . ', ' . $division . ', ' . $country;
                        }
                    } else {
                        if ($country && !$city) {
                            $division ? $locationShort = $division . ', ' . $country : $locationShort = $country;
                            $division ? $location = $division . ', ' . $country : $location = $country;
                        }
                    }
                }

                // Check online status of the user
                $messenger = app(Messenger::class);
                $messengerStatus = $messenger->getProviderOnlineStatus($model);

                if ($messengerStatus === 1) {
                    $status = 'online';
                } elseif ($messengerStatus === 2) {
                    $status = 'away';
                } else {
                    $status = 'offline';
                }


                $cardData [] = [
                    'title' => $model->name,
                    'subtitle' => $model->about_short,
                    'photo' => $model->profile_photo_path,
                    'location_short' => $locationShort,
                    'location' => $location,
                    'status' => $status,
                ];
            }

            if ($type === 'App\Models\Post') {
                $model->load([
                        'postable',
                        'category.translations' => function ($query) {
                            $query->where('locale', app()->getLocale());
                        },
                        'translations' => function ($query) {
                            $query->where('locale', app()->getLocale());
                        },
                    ])->first();



                $cardData [] = [
                    'title' => $model->title,
                    'subtitle' => $model->excerpt,
                    'photo' => '',
                    'location_short' => '',
                    'location' => '',
                    'status' => '',
                ];

            }


            info('model: ' . json_encode($model, JSON_PRETTY_PRINT));


        }


        info('cardData: ' . json_encode($cardData, JSON_PRETTY_PRINT));
        info('rawOutput: ' . json_encode($rawOutput, JSON_PRETTY_PRINT));

        $rawData = $rawOutput['hits']['hits'];


        $results = array_map(function ($rawItem, $cardItem) {
            return array_merge($rawItem, $cardItem);
        }, $rawData, $cardData);


        info('results: ' . json_encode($results, JSON_PRETTY_PRINT));


        $extractedData = array_map(function ($result) use ($cardData) {

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
                'suggest' => $suggest,
                'title' => $result['title'],
                'subtitle' => $result['subtitle'],
                'photo' => $result['photo'],
                'location_short' => $result['location_short'],
                'location' => $result['location'],
                'status' => $result['status'],
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
        // $this->showResults = true;


        // Flash the results to the session, so it can be retrieved in the SearchController
        session()->flash('results', $this->results);

        return redirect()->route('search.show');
    }
}
