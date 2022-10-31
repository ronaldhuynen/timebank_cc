<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Amount extends Component
{
    public $amount;

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
        $this->emit('amount', $this->amount);
        // try {

        //     $this->validateOnly('amount');
        // } catch (\Illuminate\Validation\ValidationException $errors) {
        //     $this->validateOnly('amount');
        // }
        // Execution stops here if validation fails.
    }

    public function render()
    {
        return view('livewire.amount');
    }
}
