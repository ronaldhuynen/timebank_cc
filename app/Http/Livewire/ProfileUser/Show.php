<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\Friend;
use App\Models\PendingFriend;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use RTippin\Messenger\Messenger;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public $user;
    public $location = [];
    public $friend;
    public $pendingFriend;
    public $phone;
    public $languagesWithCompetences = [];
    public $lastLoginAt;
    public $registeredSince;
    public $isOnline;
    public $isAway;

    /**
     * The mount method is called when the component is mounted.
     *
     */
    public function mount()
    {
        // initialize the user's location
        $location = '';
        $firstLocation = $this->user->locations->first();

        if ($firstLocation) {
            if ($firstLocation->district) {
                $location .= $firstLocation->district->locale->name . ', ';
            }
            if ($firstLocation->city) {
                $location .= $firstLocation->city->locale->name . ', ';
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

        // retrieve the friend record for the current user and the displayed user profile
        $this->friend = Friend::where('owner_id', session('activeProfileId'))
            ->where('owner_type', session('activeProfileType'))
            ->where('party_id', $this->user->id)
            ->where('party_type', User::class)
            ->get();

        // retrieve the pending friend request for the current user and the displayed user profile
        $this->pendingFriend = PendingFriend::where('sender_id', session('activeProfileId'))
            ->where('sender_type', session('activeProfileType'))
            ->where('recipient_id', $this->user->id)
            ->where('recipient_type', User::class)
            ->select('id')
            ->get();

        if ($this->user->phone_public_for_friends === 1) {
            $this->phone = User::find($this->user->id)->phone;
        }

        // Calculate last login
        $activityLog =
                Activity::where('subject_id', auth()->user()->id)
                ->where('subject_type', 'App\Models\User')
                ->whereNotNull('properties->old->last_login_at')
                ->get('properties')->last();
        if(isset($activityLog)) {
            $lastLoginAt = json_decode($activityLog, true)['properties']['old']['last_login_at'];
            $this->lastLoginAt = Carbon::createFromTimeStamp(strtotime($lastLoginAt))->diffForHumans();
        }

        // Calculate Registered since
        $createdAt = Carbon::parse($this->user->created_at);
        $this->registeredSince = $createdAt->diffForHumans();

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

        // Create a language collection that combines user languages and their competence names
        $this->user->languages = $this->user->languages->map(function ($language) {
            $language->competence_name = DB::table('language_competences')->find($language->pivot->competence)->name;
            return $language;
        });

        ds($this->user)->label('user in show');

        $this->user->lang_preference = DB::table('languages')->where('lang_code', $this->user->lang_preference)->first()->name;
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
     *  Start a conversation with the user.
     */
    public function startMessenger()
    {
        return redirect('/messenger/recipient/user/' . $this->user->id);
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
