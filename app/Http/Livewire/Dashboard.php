<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Dashboard extends Component
{

    public $login;

    public function mount()
    {
        $this->login = Carbon::createFromTimeStamp(strtotime(User::find(auth()->id())->last_login_at))->diffForHumans();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
