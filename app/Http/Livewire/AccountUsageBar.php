<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AccountUsageBar extends Component
{
    public $selectedAccount;
    public $balancePct = 1;

    protected $listeners = [
        'fromAccountId',
    ];

    public function mount()
    {
        $this->selectedAccount = [
            'id' => null,
            'name' => '',
            'balance' => 0,
            'limitMin' => 0,
            'limitMax' => 0,
            'available' => 0,
            'maxBalanceAvailableByProfile' => 0,
        ];
    }

    public function fromAccountId($selectedAccount)
    {
        $this->selectedAccount = $selectedAccount;
        $this->balancePct = ($selectedAccount['balance'] / $selectedAccount['limitMax']) * 100;
        $this->selectedAccount['available'] = $selectedAccount['limitMax'] - $selectedAccount['balance'];
    }

    public function render()
    {
        return view('livewire.account-usage-bar');
    }
}
