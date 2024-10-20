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

    public function mount()
    {
        // Ensure hours is a positive integer or set to null
        if (!is_null($this->hours) && (!is_numeric($this->hours) || $this->hours <= 0 || intval($this->hours) != $this->hours)) {
            $this->hours = null;
        }

        // Ensure minutes is a positive integer or set to null
        if (!is_null($this->minutes) && (!is_numeric($this->minutes) || $this->minutes < 0 || intval($this->minutes) != $this->minutes)) {
            $this->minutes = null;
            $this->calculateAmount();

        } elseif ($this->minutes > 59) {
            // If minutes is more than 59, adjust hours and minutes
            $additionalHours = intdiv($this->minutes, 60);
            $remainingMinutes = $this->minutes % 60;

            $this->hours = is_null($this->hours) ? 0 : $this->hours;
            $this->hours += $additionalHours;
            $this->minutes = $remainingMinutes;
            $this->calculateAmount();
        }

        // Add leading zero to minutes if less than 10
        if (!is_null($this->minutes) && $this->minutes < 10) {
            $this->minutes = str_pad($this->minutes, 2, '0', STR_PAD_LEFT);
            $this->calculateAmount();
        }

        $this->amount = 0;
    }

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
        $hours = is_numeric($this->hours) ? (int) $this->hours : 0;
        $minutes = is_numeric($this->minutes) ? (int) $this->minutes : 0;
        $this->amount = $hours * 60 + $minutes;
        $this->dispatch('amount', $this->amount);
        // Format the inputs for empty values
        if ($this->amount === 0) {
            $this->reset(['hours', 'minutes']);
        } else {
            if ($this->amount < 60) {
                $this->hours = 0;
            }
            if ($this->amount % 60 === 0) {
                $this->minutes = '00';
            }
        }
    }

    public function render()
    {
        return view('livewire.amount');
    }
}
