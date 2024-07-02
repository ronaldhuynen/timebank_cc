<?php

namespace App\Http\Livewire\ProfileOrg;

use App\Models\Account;
use App\Models\Friend;
use App\Models\Organization;
use App\Models\PendingFriend;
use App\Models\Tag;
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
    public $org;
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
        // $this->getLastLogin();
        // $this->getLastExchangeAt();
        $this->getRegisteredSince();
        $this->getLanguages();
        $this->getSkills();
        $this->getAccountsTotals();
        $this->getSocials();
    }


    /***
     * Retrieve the online status of the organization and sets the properties isOnline and isAway accordingly.
     *
     * @return void
     */
    public function getOnlineStatus()
    {
        // Check online status of the organization
        $messenger = app(Messenger::class);
        $status = $messenger->getProviderOnlineStatus($this->org);

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
     * Retrieve the friend record for the current organization and the displayed organization profile.
     *
     * @return void
     */
    public function getFriend()
    {
        $this->friend = Friend::where('owner_id', session('activeProfileId'))
            ->where('owner_type', session('activeProfileType'))
            ->where('party_id', $this->org->id)
            ->where('party_type', Organization::class)
            ->get();
    }


    /**
     * Retrieve the pending friend request for the current organization and the displayed organization profile.
     *
     * @return void
     */
    public function getPendingFriend()
    {
        $this->pendingFriend = PendingFriend::where('sender_id', session('activeProfileId'))
            ->where('sender_type', session('activeProfileType'))
            ->where('recipient_id', $this->org->id)
            ->where('recipient_type', Organization::class)
            ->select('id')
            ->get();
    }


    /**
     * Retrieve the pending friend request for the current organization and the displayed organization profile.
     *
     * @return void
     */
    public function friendRequest()
    {
        $this->pendingFriend =
            PendingFriend::where('sender_id', session('activeProfileId'))
            ->where('sender_type', session('activeProfileType'))
            ->where('recipient_id', $this->org->id)
            ->where('recipient_type', Organization::class)
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
            ->where('recipient_id', $this->org->id)
            ->where('recipient_type', Organization::class)
            ->select('id')
            ->get();
    }


    /**
     * Get the organization's location and generate a link to OpenStreetMap.
     *
     * @return void
     */
    public function getLocation()
    {
        $location = '';
        $country = '';
        $division = '';
        $city = '';
        $district = '';

        $firstLocation = $this->org->locations->first();


        if ($firstLocation) {
            if (isset($firstLocation->city)) {
                $city = $firstLocation->city->translations->first()->name;
                $location = $city;
                $locationShort = $city;
            }
            if (isset($firstLocation->district)) {
                $district = $firstLocation->district->translations->first()->name;
                $city ? $location = $city . ' ' . $district : $location = $district;
            }
            if (isset($firstLocation->division)) {
                $division = $firstLocation->division->translations->first()->name;
                $city || $district ? $location = $location . ', ' . $division : $location = $division;
            }
            if (isset($firstLocation->country)) {
                $country = $firstLocation->country->code;
                $city || $district || $division ? $location = $location . ', ' . $country : $location = $country;
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
     * Retrieve the phone number of the organization.
     *
     * @return void
     */
    public function getPhone()
    {
        if ($this->org->phone_public_for_friends === 1) {
            $this->phone = Organization::find($this->org->id)->phone;
        }
        $this->phone = $this->org->phone;
    }


    public function toggleAboutText()
    {
        $this->showAboutFullText = !$this->showAboutFullText;
    }


    /**
     * Retrieve the organization's languages and their language competence.
     *
     * @return void
     */
    public function getLanguages()
    {
        // Create a language collection that combines organization languages and their competence names
        $this->org->languages = $this->org->languages->map(function ($language) {
            $language->competence_name = DB::table('language_competences')->find($language->pivot->competence)->name;
            return $language;
        });

        // Get the organization's language preference (if it exists)
        $lang_preference = DB::table('languages')->where('lang_code', $this->org->lang_preference)->first();
        if ($lang_preference) {
            $this->org->lang_preference = $lang_preference->name;
        }
    }


    /**
     * Retrieves the skills of this organization.
     *
     * @return \Illuminate\Support\Collection
     */
    //TODO! This will set the skill Cache, and not get the skills from cache! FIX THIS!
    public function getSkills()
    {
        $skillsCache = Cache::remember('skills-org-' . $this->org->id . '-lang-' . app()->getLocale(), now()->addDays(7), function () { // remember cache
            $tagIds = $this->org->tags->pluck('tag_id');
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
     * Get the last login time for organization.
     *
     * @return void
     */
    // public function getLastLogin()
    // {
    //     $activityLog =
    //             Activity::where('subject_id', auth()->org()->id)
    //             ->where('subject_type', 'App\Models\Organization')
    //             ->whereNotNull('properties->old->last_login_at')
    //             ->get('properties')->last();
    //     if(isset($activityLog)) {
    //         $lastLoginAt = json_decode($activityLog, true)['properties']['old']['last_login_at'];
    //         $this->lastLoginAt = Carbon::createFromTimeStamp(strtotime($lastLoginAt))->diffForHumans();
    //     }
    // }


    /**
     * Get the last exchange date for the organization's profile.
     *
     * @return void
     */
    // public function getLastExchangeAt()
    // {
    //     if ($this->accountsTotals) {
    //         if ($this->accountsTotals['lastTransferDate']) {
    //             $this->lastExchangeAt = Carbon::parse($this->accountsTotals['lastTransferDate'][0])->diffForHumans();
    //         } else {
    //             $this->lastExchangeAt = null;   // no transfers
    //         }
    //     } else {
    //         // Get the accounts totals if it is not present
    //         $this->getAccountsTotals();
    //         if ($this->accountsTotals['lastTransferDate']) {
    //             $this->lastExchangeAt = Carbon::parse($this->accountsTotals['lastTransferDate'][0])->diffForHumans();
    //         } else {
    //             $this->lastExchangeAt = null;   // no transfers
    //         }
    //     }
    // }


    /**
     * Calculates and sets the registered since date for the organization.
     *
     * @return void
     */
    public function getRegisteredSince()
    {
        $createdAt = Carbon::parse($this->org->created_at);
        $this->registeredSince = $createdAt->diffForHumans();
    }


    /**
     * Retrieves the totals of the organization's accounts.
     * This method calls the `getAccountsTotals` method of the `Account` model to calculate the totals of the organization's accounts.
     *
     */
    public function getAccountsTotals()
    {
        $this->accountsTotals = (new Account())->getAccountsTotals(Organization::class, $this->org->id, config('timebank-cc.account_info.account_totals.countTransfersSince'));
    }


    /**
     * Retrieves the social media accounts associated with this organization.
     *
     * @return void
     */
    public function getSocials()
    {
        $this->socials = $this->org->socials()->orderBy('sociables.updated_at', 'desc')->get();
    }


    /**
     * Redirects to the payment page to this organization.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payButton()
    {
        return redirect()->route('pay.to.name', ['name' => $this->org->name]);
    }


    /**
     *  Start a conversation with the organization.
     */
    public function startMessenger()
    {
        redirect('/messenger/recipient/organization/' . $this->org->id);
    }


    /**
     * Render the view for the ProfileUser Show component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.profile-org.show');
    }
}
