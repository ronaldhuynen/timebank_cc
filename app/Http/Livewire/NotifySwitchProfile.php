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
            $title = __('Profile switch'),
            $description = __('Your profile has been switched successfully')
        );
    }


    public function render()
    {
        return view('livewire.notify-switch-profile');
    }
}
