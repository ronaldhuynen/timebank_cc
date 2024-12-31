<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\WireUiActions;


class NotifyEmailVerified extends Component
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
            $title = __('Email verified'),
            $description = __('Your email has been verified successfully')
        );
    }

    public function dehydrate()
    {
        // Clear the session key after the component is rendered
        session()->forget('email-verified');
        session()->forget('email-profile');
    }

    public function render()
    {
        return view('livewire.notify-email-verified');
    }
}
