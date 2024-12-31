<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\WireUiActions;


class NotifyUnauthorizedAction extends Component
{
    use WireUiActions;


    public function mount()
    {
        $this->notify();
    }

    public function notify()
    {
        // WireUI notification

        $this->notification()->warning(
            $title = __('Unauthorized action'),
            $description = session('unauthorizedAction'),
        );
    }

    public function dehydrate()
    {
        // Clear the session key after the component is rendered
        session()->forget('unauthorizedAction');
    }

    public function render()
    {
        return view('livewire.notify-unauthorized-action');
    }
}
