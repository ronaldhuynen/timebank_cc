<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Amount extends Component
{
    public $amount;
    public $hours;
    public $minutes;
    public $label;
    public $maxLengthHoursInput = 3;

    protected $listeners = ['resetForm'];
    

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
        $this->dispatch('amount', $this->amount);
    }


    public function render()
    {
        return view('livewire.amount');
    }
}
