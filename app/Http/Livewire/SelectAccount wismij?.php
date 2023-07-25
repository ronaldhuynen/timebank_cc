<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class SelectAccount extends Component

{
    public $results;
    public $search;
    public $selected;
    public $toAccountSelected;
    public $myAccountSelected;
    public $showDropdown;

    abstract public function query();


    protected $listeners = ['myAccountSelected'];


    public function myAccountSelected($myAccount)
    {
        $this->myAccountSelected = $myAccount;
    }

    public function mount()
    {
        $this->showDropdown = false;
        $this->results = collect();
    }


    public function updatedSelected()
    {
        $this->emitSelf('toAccountSelected', $this->selected);
    }


    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = collect();
            $this->showDropdown = false;
            return;
        }

        if ($this->query()) {
            $this->results = $this->query();
        } else {
            $this->results = collect();
        }

        $this->showDropdown = true;
    }

    public function render()
    {
        return view('livewire.select-account');
    }
}
