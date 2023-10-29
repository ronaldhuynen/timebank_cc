<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\Friend;
use App\Models\PendingFriend;
use App\Models\User;
use function PHPUnit\Framework\isFalse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public $user;
    public $location = [];
    public $friend;
    public $pendingFriend;
    public $phone;
    public $lastLoginAt;
    public $registeredSince;
    public $response;

    public function mount()
    {
        // Define the location name
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

        $this->friend = Friend::where('owner_id', session('activeProfileId'))
            ->where('owner_type', session('activeProfileType'))
            ->where('party_id', $this->user->id)
            ->where('party_type', User::class)
            ->get();

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
    }

    public function friendRequest()
    {
        $this->pendingFriend = 
            PendingFriend::where('sender_id', session('activeProfileId'))
            ->where('sender_type', session('activeProfileType'))
            ->where('recipient_id', $this->user->id)
            ->where('recipient_type', User::class)
            ->select('id')
            ->get();

        // $this->pendingFriend = true;
    }

    public function cancelFriendRequest()
    {
        $this->pendingFriend = 
            PendingFriend::where('sender_id', session('activeProfileId'))
            ->where('sender_type', session('activeProfileType'))
            ->where('recipient_id', $this->user->id)
            ->where('recipient_type', User::class)
            ->select('id')
            ->get();

        // $this->friend = false;
    }


    public function render()
    {
        return view('livewire.profile-user.show');
    }
}
