<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Amount extends Component
{
    public $amount;
    public $label;
    public $maxLengthHoursInput = 3;

    protected $listeners = ['resetForm'];

    // protected $rules = ['amount' => 'required|regex:/^\d*:[0-5]\d$/'];

    // protected $messages = [
    //     'amount.regex' => 'The amount should be positive and in hh:mm format. For example 90 minutes is 1:30.',
    // ];

    public function resetForm()
    {
        $this->amount = null;
    }


    public function updated()
    {
        $this->dispatch('amount', $this->amount);
    }

    public function render()
    {
        return view('livewire.amount');
    }
}
