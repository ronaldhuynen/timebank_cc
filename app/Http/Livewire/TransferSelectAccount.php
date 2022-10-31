<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;

class TransferSelectAccount extends SelectAccount

{
    public $myAccountSelected;
    public $toAccountSelected;

    protected $listeners = ['myAccountSelected', 'toAccountSelected'];


    public function myAccountSelected($myAccount)
    {
        $this->emitSelf('myAccountSelected', $myAccount);
        dump('stap 1');
    }


    public function toAccountSelected($toAccount)
    {
        $this->toAccountSelected = $toAccount;
    }


    public function query()
    {
        // dump($this->myAccountSelected);
        $excludeAccount = $this->myAccountSelected;
        dump('stap 3', $excludeAccount);
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
        })
         ->whereNotIn('accountId', $excludeAccount);
        $mappedAccounts->all();

        return $mappedAccounts;
    }
}
