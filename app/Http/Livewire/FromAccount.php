<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TransactionController;
use Livewire\Component;

class FromAccount extends Component
{
    public $profileAccounts = [];
    public $fromAccountId;
    public $selectedAccount;
    public $label;

    protected $listeners = [
        'resetForm'
    ];

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
        if (!empty($this->profileAccounts)) {
            $this->fromAccountId = $this->profileAccounts[0]['id'];
            $this->selectedAccount = [
                'id' => $this->profileAccounts[0]['id'],
                'name' => ucfirst(strtolower($this->profileAccounts[0]['name'])),
                'balance' => tbFormat($this->profileAccounts[0]['balance']),
            ];
            
            $this->dispatch('fromAccountId', $this->fromAccountId);

        }
    }

    public function fromAccountSelected($fromAccountId)
    {
        $this->fromAccountId = $fromAccountId;
        $selected = collect($this->profileAccounts)->firstWhere('id', $fromAccountId);
        $this->selectedAccount = [
            'id' => $selected['id'],
            'name' => ucfirst(strtolower($selected['name'])),
            'balance' => tbFormat($selected['balance']),
        ];
        
        $this->dispatch('fromAccountId', $this->fromAccountId);

    }

    public function render()
    {
        return view('livewire.from-account');
    }
}
