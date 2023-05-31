<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Livewire\Component;

class Dashboard extends Component
{

    public function mount()
    {
        $activityLog =
        Activity::where('subject_id', auth()->user()->id)
        ->where('subject_type','App\Models\User')
        ->whereNotNull('properties->attributes->last_login_at')
        ->get('properties')->last();
        $lastLoginAt = json_decode($activityLog, true)['properties']['old']['last_login_at'];
        $this->lastLoginAt = Carbon::createFromTimeStamp(strtotime($lastLoginAt))->diffForHumans();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
