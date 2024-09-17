<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AmountNew extends Component
{
    public $amount;
    public $hours;
    public $minutes;
    public $label;
    public $maxLengthHoursInput = 3;

    protected $listeners = ['resetForm'];

    // protected $rules = ['amount' => 'required|regex:/^\d*:[0-5]\d$/'];

    // protected $messages = [
    //     'amount.regex' => 'The amount should be positive and in hh:mm format. For example 90 minutes is 1:30.',
    // ];

    public function resetForm()
    {
        $this->reset();
    }


    public function updatedHours()
    {
        $this->calculateAmount();
    }

    public function updatedMinutes()
    {
        $this->calculateAmount();
    }

    protected function calculateAmount()
    {
        $hours = is_numeric($this->hours) ? (int)$this->hours : 0;
        $minutes = is_numeric($this->minutes) ? (int)$this->minutes : 0;
        $this->amount = ($hours * 60) + $minutes;
        $this->dispatch('amountDispatched', $this->amount);
    }

    public function render()
    {
        return view('livewire.amount-new');
    }
}
