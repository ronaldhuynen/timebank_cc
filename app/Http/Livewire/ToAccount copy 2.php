<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;

class ToAccount extends Component
{
    public $search;
    public $searchResults = [];
    public $showDropdown = false;
    public $myAccountId;
    public $toAccountId;
    public $toAccountName;
    public $toHolderName;
    public $userAccounts;


    protected $listeners = [
        'fromAccountId',
        'resetForm'
    ];

    public function checkRequired()
    {
    if ($this->toAccountId === null || '') {
        // $this->requiredError = true;
        $this->emit('requiredError');
        }
    }

    public function resetForm()
    {
        $this->search = null;
        $this->searchResults = [];
        $this->showDropdown = false;
        $this->fromAccountId = null;
        $this->toAccountId = null;
        $this->toAccountName = null;
        $this->toHolderName = null;
        $this->userAccounts = null;
    }


    public function updatedSelected()
    {
        $this->emitSelf('toAccountSelected', $this->selected);
    }


    public function fromAccountId($fromAccount)
    {
        $this->fromAccountId = $fromAccount;
    }


    public function toAccountSelected($toAccount)
    {
        $this->toAccountId = $toAccount;
        $toAccountDetails = collect($this->searchResults)->where('accountId', '=', $toAccount)->first();
        $this->emit('toAccountDetails', $toAccountDetails);
        $this->toAccountName = $toAccountDetails['accountName'];
        $this->toHolderName = $toAccountDetails['holderName'];
        $this->showDropdown = false;
        $this->search = '';
        $this->emit('toAccountSelected', $toAccount);
    }


    public function updatedSearch($newValue)
    {
        $this->showDropdown = true;
        $excludeAccount = $this->fromAccountId;
        $search = $this->search;
        $accounts = Account::with('accountable')
            ->whereHas('accountable', function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orWhere('name', 'like', '%' . $search . '%')
            ->get();

        $mappedAccounts = $accounts->map(function ($account, $key) {
            return [
                'accountId' => $account->id,
                'accountName' => $account->name,
                'holderId' => $account->accountable->id,
                'holderName' => $account->accountable->name
            ];
        })->whereNotIn('accountId', $excludeAccount);

        $response = $mappedAccounts->take(6);

        $this->searchResults = $response;
    }


    public function render()
    {
        return view('livewire.to-account');
    }
}
