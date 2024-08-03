<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\WireUiActions;


class NotifySwitchProfile extends Component
{
    use WireUiActions;


    public function mount()
    {
        $this->notify();
    }

    public function notify()
    {
        // WireUI notification

        $this->notification()->success(
            $title = 'Profile saved',
            $description = 'Your profile was successfull saved'
        );
    }


    public function render()
    {
        return view('livewire.notify-switch-profile');
    }
}
