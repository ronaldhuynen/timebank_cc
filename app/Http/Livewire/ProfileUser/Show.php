<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\Account;
use App\Models\Friend;
use App\Models\PendingFriend;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use RTippin\Messenger\Messenger;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public $user;
    public $showAboutFullText = false;
    public $location = [];
    public $friend;
    public $pendingFriend;
    public $phone;
    public $languagesWithCompetences = [];
    public $skills;
    public $lastLoginAt;
    public $lastExchangeAt;
    public $registeredSince;
    public $isOnline;
    public $isAway;
    public $accountsTotals;
    public $socials;

    /**
     * The mount method is called when the component is mounted.
     *
     */
    public function mount()
    {
        $this->getOnlineStatus();
        $this->getLocation();
        $this->getFriend();
        $this->getPendingFriend();
        $this->getPhone();
        $this->getLastLogin();
        $this->getLastExchangeAt();
        $this->getRegisteredSince();
        $this->getLanguages();
        $this->getSkills();
        $this->getAccountsTotals();
        $this->getSocials();

        // ds($this->user)->label('user in show');
        // ds($this->skills)->label('skills in show');

    }


    /***
     * Retrieve the online status of the user and sets the properties isOnline and isAway accordingly.
     *
     * @return void
     */
    public function getOnlineStatus()
    {
        // Check online status of the user
        $messenger = app(Messenger::class);
        $status = $messenger->getProviderOnlineStatus($this->user);

        if ($status === 1) {
            $this->isOnline = true;
            $this->isAway = false;
        } elseif ($status === 2) {
            $this->isOnline = false;
            $this->isAway = true;
        } else {
            $this->isOnline = false;
            $this->isAway = false;
        }
    }


    /**
     * Retrieve the friend record for the current user and the displayed user profile.
     *
     * @return void
     */
    public function getFriend()
    {
        $this->friend = Friend::where('owner_id', session('activeProfileId'))
            ->where('owner_type', session('activeProfileType'))
            ->where('party_id', $this->user->id)
            ->where('party_type', User::class)
            ->get();
    }


    /**
     * Retrieve the pending friend request for the current user and the displayed user profile.
     *
     * @return void
     */
    public function getPendingFriend()
    {
        $this->pendingFriend = PendingFriend::where('sender_id', session('activeProfileId'))
            ->where('sender_type', session('activeProfileType'))
            ->where('recipient_id', $this->user->id)
            ->where('recipient_type', User::class)
            ->select('id')
            ->get();
    }


    /**
     * Retrieve the pending friend request for the current user and the displayed user profile.
     *
     * @return void
     */
    public function friendRequest()
    {
        $this->pendingFriend =
            PendingFriend::where('sender_id', session('activeProfileId'))
            ->where('sender_type', session('activeProfileType'))
            ->where('recipient_id', $this->user->id)
            ->where('recipient_type', User::class)
            ->select('id')
            ->get();
    }


    /**
     * Cancel a friend request by selecting the pending friend record with the sender ID, sender type, recipient ID, and recipient type.
     *
     * @return void
     */
    public function cancelFriendRequest()
    {
        $this->pendingFriend =
            PendingFriend::where('sender_id', session('activeProfileId'))
            ->where('sender_type', session('activeProfileType'))
            ->where('recipient_id', $this->user->id)
            ->where('recipient_type', User::class)
            ->select('id')
            ->get();
    }


    /**
     * Get the user's location and generate a link to OpenStreetMap.
     *
     * @return void
     */
    public function getLocation()
    {
        $location = '';
        $firstLocation = $this->user->locations->first();

        if ($firstLocation) {
            if ($firstLocation->city) {
                $location .= $firstLocation->city->locale->name . ', ';
            }
            if ($firstLocation->district) {
                $location .= $firstLocation->district->locale->name . ', ';
            }
            if ($firstLocation->division) {
                $location .= $firstLocation->division->locale->name . ', ';
            }
            if ($firstLocation->country) {
                $location .= $firstLocation->country->code;
            }
        }

        // Remove trailing comma and space
        $this->location = ['name' => rtrim($location, ', ')];


        // Construct the URL for Nominatim search
        $searchUrl = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($this->location['name']);

        // Send the HTTP request to the Nominatim API
        $response = Http::get($searchUrl);

        // Parse the JSON response
        $data = $response->json();

        // Extract the first result's coordinates (if available)
        if (!empty($data[0])) {
            $latitude = $data[0]['lat'];
            $longitude = $data[0]['lon'];

            // Create the OpenStreetMap URL with the coordinates
            $osmUrl = "https://www.openstreetmap.org/?mlat={$latitude}&mlon={$longitude}#map=12/{$latitude}/{$longitude}";

            // Generate the link in HTML
            $this->location['link'] =  $osmUrl;
        } else {
            $this->location['link'] = "#";
        }

    }


    /**
     * Retrieve the phone number of the user.
     *
     * @return void
     */
    public function getPhone()
    {
        if ($this->user->phone_public_for_friends === 1) {
            $this->phone = User::find($this->user->id)->phone;
        }
        $this->phone = $this->user->phone;
    }


    public function toggleAboutText()
    {
        $this->showAboutFullText = !$this->showAboutFullText;
    }


    /**
     * Retrieve the user's languages and their language competence.
     *
     * @return void
     */
    public function getLanguages()
    {
        // Create a language collection that combines user languages and their competence names
        $this->user->languages = $this->user->languages->map(function ($language) {
            $language->competence_name = DB::table('language_competences')->find($language->pivot->competence)->name;
            return $language;
        });

        // Get the user's language preference (if it exists)
        $lang_preference = DB::table('languages')->where('lang_code', $this->user->lang_preference)->first();
        if ($lang_preference) {
            $this->user->lang_preference = $lang_preference->name;
        }
    }


    /**
     * Retrieves the skills of this user.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSkills()
    {
        $skillsCache = Cache::remember('skills-user-' . $this->user->id . '-lang-' . app()->getLocale(), now()->addDays(7), function () { // remember cache
            $tagIds = $this->user->tags->pluck('tag_id');
            $translatedTags = collect((new Tag())->translateTagIdsWithContexts($tagIds, App::getLocale(), App::getFallbackLocale()));     // Translate to app locale, if not available to fallback locale, if not available do not translate
            $skills = $translatedTags->map(function ($item, $key) {
                return [
                    'tag_id' => $item['tag_id'],
                    'name' => $item['tag'],
                    'foreign' => ($item['locale']['locale'] ==  App::getLocale()) ? false : true,    // Mark all tags in a foreign language read-only, as users need to switch locale to edit/update/etc foreign tags
                    'readonly' => $item['locale']['locale'],
                    'example' =>  $item['locale']['example'],
                    'category' => $item['category'],
                    'category_path' =>  $item['category_path'],
                    'category_color' =>  $item['category_color'],
                    'title' =>  $item['category_path']      // 'title' is used by Tagify script for text that shows on hover

                ];
            });
            $skills = collect($skills);

            return $skills;

        });

        $this->skills = $skillsCache;
    }


    /**
     * Get the last login time for user.
     *
     * @return void
     */
    public function getLastLogin()
    {
        $activityLog =
                Activity::where('subject_id', auth()->user()->id)
                ->where('subject_type', 'App\Models\User')
                ->whereNotNull('properties->old->last_login_at')
                ->get('properties')->last();
        if(isset($activityLog)) {
            $lastLoginAt = json_decode($activityLog, true)['properties']['old']['last_login_at'];
            $this->lastLoginAt = Carbon::createFromTimeStamp(strtotime($lastLoginAt))->diffForHumans();
        }
    }


    /**
     * Get the last exchange date for the user's profile.
     *
     * @return void
     */
    public function getLastExchangeAt()
    {
        if ($this->accountsTotals) {            
            if ($this->accountsTotals['lastTransferDate']) {
                $this->lastExchangeAt = Carbon::parse($this->accountsTotals['lastTransferDate'][0])->diffForHumans();
            } else {
                $this->lastExchangeAt = null;   // no transfers
            }
        } else { 
            // Get the accounts totals if it is not present
            $this->getAccountsTotals();
            if ($this->accountsTotals['lastTransferDate']) {
                $this->lastExchangeAt = Carbon::parse($this->accountsTotals['lastTransferDate'][0])->diffForHumans();
            } else {
                $this->lastExchangeAt = null;   // no transfers
            }
        }
    }


    /**
     * Calculates and sets the registered since date for the user.
     *
     * @return void
     */
    public function getRegisteredSince()
    {
        $createdAt = Carbon::parse($this->user->created_at);
        $this->registeredSince = $createdAt->diffForHumans();
    }


    /**
     * Retrieves the totals of the user's accounts.
     * This method calls the `getAccountsTotals` method of the `Account` model to calculate the totals of the user's accounts.
     *
     */
    public function getAccountsTotals()
    {
        $this->accountsTotals = (new Account)->getAccountsTotals(User::class, $this->user->id, config('timebank-cc.account_info.account_totals.countTransfersSince'));
    }


    /**
     * Retrieves the social media accounts associated with this user.
     *
     * @return void
     */
    public function getSocials()
    {
        $this->socials = $this->user->socials()->orderBy('sociables.updated_at', 'desc')->get();
    }


    /**
     * Redirects to the payment page to this user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payButton()
    {
        return redirect()->route('pay.to.name', ['name' => $this->user->name]);
    }
 

    /**
     *  Start a conversation with the user.
     */
    public function startMessenger()
    {
        redirect('/messenger/recipient/user/' . $this->user->id);
    }


    /**
     * Render the view for the ProfileUser Show component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.profile-user.show');
    }
}
