<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TransactionController;
use Livewire\Component;

class FromAccount extends Component
{
    public $profileAccounts = [];
    public $fromAccountId;
    public $selectedAccount = null;
    public $label;

    public function mount()
    {
        $this->profileAccounts = $this->getProfileAccounts();
        $this->preSelected();
    }

    public function getProfileAccounts()
    {
        $transactionController = new TransactionController();
        return $transactionController->getAccountsInfo();
    }

    public function resetForm()
    {
        $this->profileAccounts = $this->getProfileAccounts();
        $this->preSelected();
    }

    public function preSelected()
    {
        if (count($this->profileAccounts) > 0) {
            $this->fromAccountId = $this->profileAccounts->first()['id'];
            $firstAccount = $this->profileAccounts->first();

            // Translate the 'name' field
            $firstAccount['name'] = __(ucfirst(strtolower($firstAccount['name'])));

            $this->selectedAccount = $firstAccount;
            $this->dispatch('fromAccountId', $this->selectedAccount);
        }
    }

    public function fromAccountSelected($fromAccountId)
    {
        $this->fromAccountId = $fromAccountId;

        $selectedAccount = collect($this->profileAccounts)->firstWhere('id', $fromAccountId);

        // Translate the 'name' field
        $selectedAccount['name'] = __(ucfirst(strtolower($selectedAccount['name'])));

        $this->selectedAccount = $selectedAccount;
        $this->dispatch('fromAccountId', $this->selectedAccount);
    }

    public function render()
    {
        return view('livewire.from-account');
    }
}
