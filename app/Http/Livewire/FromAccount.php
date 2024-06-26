<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TransactionController;

use Livewire\Component;

class FromAccount extends Component
{
    public $profileAccounts = [];
    public $fromAccountId;

    protected $listeners = [
        'resetForm'];

    public function boot()
    {
        $this->profileAccounts = $this->getProfileAccounts();
    }


    public function getProfileAccounts()
    {
        $transactions = new TransactionController();
        return  $transactions->getAccountsInfo();
    }


    public function resetForm()
    {
        $this->profileAccounts = $this->getProfileAccounts();
        $this->emitSelf('preSelected)');
    }



    public function preSelected()
    {
        $this->fromAccountId = $this->profileAccounts[0]['id'];  // by default 1st account is selected
        $this->emit('fromAccountId', $this->fromAccountId);
    }


    public function fromAccountSelected($fromAccountId)
    {
        $this->emit('fromAccountId', $fromAccountId);
    }


    public function render()
    {
        return view('livewire.from-account');
    }
}
