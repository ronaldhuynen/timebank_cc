<?php

namespace App\Http\Controllers;

use App\Http\Livewire\TransactionsTable;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Request;

class TransactionController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function transfer()
    {
        // $userAccounts = $this->userAccounts();

        return view('transfer.show',
            // compact('userAccounts')
        );
    }

    public function transactions()
    {
        $userAccounts = $this->userAccounts();

        return view('transactions.show', compact('userAccounts'));
    }


    public function statement($transactionId, $accountId)
    {
        // dd('test');
        info($transactionId);
        info($accountId);

        return view('transactions.statement', compact(['transactionId', 'accountId']));
    }


    public function userAccounts()
    {
        $class = new (Session('activeProfileType'));
        $activeProfile = $class->find(Session('activeProfileId'));
        $accounts = $class->with('accounts')->find($activeProfile->id)->accounts;

        $userAccounts = $accounts->map(function ($account, $key) {
            return [
                'id' => $account->id,
                'name' => $account->name,
                'balance' => $this->getBalance($account->id)
            ];
        });
        return $userAccounts;
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
}
