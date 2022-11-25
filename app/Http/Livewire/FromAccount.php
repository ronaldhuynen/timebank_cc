<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Controllers\TransactionController;

class FromAccount extends Component
{
    public $userAccounts = [];
    public $fromAccountId;

    protected $listeners = [
        'resetForm'];

    public function boot()
    {
        $this->userAccounts = $this->getUserAccounts();
    }

    public function getUserAccounts()
    {
        $transactions = new TransactionController();
        return  $transactions->userAccounts();
    }

    public function resetForm()
    {
        $this->userAccounts = $this->getUserAccounts();
        $this->emitSelf('preSelected)');
        info('reset form on FromAccount');
    }



    public function preSelected()
    {
        $this->fromAccountId = $this->userAccounts[0]['id'];  // by default 1st account is selected
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
