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
        if (count($this->profileAccounts) > 0) {
            $this->fromAccountId = $this->profileAccounts->first()['id'];
            $this->selectedAccount = [
                'id' => $this->profileAccounts->first()['id'],
                'name' => ucfirst(strtolower($this->profileAccounts->first()['name'])),
                'balanceH' => tbFormat($this->profileAccounts->first()['balance']),
                'balance' => $this->profileAccounts->first()['balance'],
                'limitMin' => $this->profileAccounts->first()['limitMin'],
                'limitMax' => $this->profileAccounts->first()['limitMax'],
                'maxBalanceAvailableByProfile' => $this->profileAccounts->first()['maxBalanceAvailableByProfile'],
            ];
            $this->dispatch('fromAccountId', $this->selectedAccount);
        }
    }

    public function fromAccountSelected($fromAccountId)
    {
        $this->fromAccountId = $fromAccountId;
        $selected = collect($this->profileAccounts)->firstWhere('id', $fromAccountId);
        $this->selectedAccount = [
            'id' => $selected['id'],
            'name' => ucfirst(strtolower($selected['name'])),
            'balanceH' => tbFormat($selected['balance']),
            'balance' => $selected['balance'],
            'limitMin' => $selected['limitMin'],
            'limitMax' => $selected['limitMax'],
            'maxBalanceAvailableByProfile' => $selected['maxBalanceAvailableByProfile'],
        ];
        
        $this->dispatch('fromAccountId', $this->selectedAccount);
    }

    public function render()
    {
        return view('livewire.from-account');
    }
}
