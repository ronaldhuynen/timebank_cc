<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FromAccount extends Component
{
    public $userAccounts;
    public $fromAccountId;


    public function preSelected($userAccounts)
    {
        $defaultSelected = $userAccounts[0]['id'];
        $this->fromAccountId = $defaultSelected;
        $this->emit('fromAccountSelected', $this->fromAccountId);
    }


    public function fromAccountId ($fromAccountId)
    {
        $this->emit('fromAccountSelected', $fromAccountId);
    }


    public function render()
    {
        return view('livewire.from-account');
    }
}
