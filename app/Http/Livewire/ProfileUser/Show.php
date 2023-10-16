<?php

namespace App\Http\Livewire\ProfileUser;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public $user;
    public $link;
    public $location;
    public $lastLoginAt;
    public $registeredSince;
    
    public function mount()
    {

        // // Define the location name   
        // $location = '';    
        // $firstLocation = $this->user->locations->first();

        // if ($firstLocation) {
        //     if ($firstLocation->district) {
        //         $location .= $firstLocation->district->locale->name . ', ';
        //     }
        //     if ($firstLocation->city) {
        //         $location .= $firstLocation->city->locale->name . ', ';
        //     }
        //     if ($firstLocation->division) {
        //         $location .= $firstLocation->division->locale->name . ', ';
        //     }
        //     if ($firstLocation->country) {
        //         $location .= $firstLocation->country->code;
        //     }
        // }
        // // Remove trailing comma and space
        // $this->location = rtrim($location, ', ');


        // // Construct the URL for Nominatim search
        // $searchUrl = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($this->location);

        // // Send the HTTP request to the Nominatim API
        // $response = Http::get($searchUrl);

        // // Parse the JSON response
        // $data = $response->json();

        // // Extract the first result's coordinates (if available)
        // if (!empty($data[0])) {
        //     $latitude = $data[0]['lat'];
        //     $longitude = $data[0]['lon'];

        //     // Create the OpenStreetMap URL with the coordinates
        //     $osmUrl = "https://www.openstreetmap.org/?mlat={$latitude}&mlon={$longitude}#map=12/{$latitude}/{$longitude}";

        //     // Generate the link in HTML
        //     $this->link = $osmUrl;
        // } else {
        //     $this->link = "#";
        // }



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
    
    public function render()
    {
        return view('livewire.profile-user.show');
    } 
}
