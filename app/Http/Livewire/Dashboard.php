<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Dashboard extends Component
{
    public $lastLoginAt;
    public $user;

    public function mount()
    {
        $this->user = [
            'name' => auth()->user()->name,
            'firstName' => Str::words(auth()->user()->name, 1,''),
            'birthday' => auth()->user()->date_of_birth,
        ];

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


    public function render()
    {
        return view('livewire.dashboard');
    }
}
