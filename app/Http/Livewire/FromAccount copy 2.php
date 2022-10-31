<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;

class FromAccount extends Component
{
    public $userAccounts = [];
    public $fromAccountId;

    protected $listeners = [
        'resetForm',
        'refreshComponent' => '$refresh'];


    public function boot()
    {
        // $transactions = new TransactionController();
        // $this->userAccounts = $transactions->userAccounts();

        $accounts = User::with('accounts')->find(Auth::user()->id)->accounts;
        $this->userAccounts = $accounts->map(function ($account, $key) {
            return [
                'id' => $account->id,
                'name' => $account->name,
                'balance' => $this->getBalance($account->id)
            ];
        });
        // return $userAccounts;
    }


    public function getBalance($accountId)
    {
        $balance = 0;
        $transactions = Transaction::where('from_account_id', $accountId)->orWhere('to_account_id', $accountId)->select('from_account_id', 'to_account_id', 'amount')->get();
        foreach ($transactions as $t) {
            if ($t->to_account_id === $accountId) {
                $balance += $t->amount;
            } else {
                $balance -= $t->amount;
            }
        }
        //TODO store  current balance in cache until it it is updated?
        return $balance;
    }


    public function resetForm()
    {
        // $this->dispatchBrowserEvent('refresh-page');
        $this->emitSelf('preSelected)');
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
