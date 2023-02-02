<?php

namespace App\Http\Controllers;

use App\Http\Livewire\TransactionsTable;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
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
        return view('transfer.show',
        );
    }

    public function transactions()
    {
        $userAccounts = $this->userAccounts();

        return view('transactions.show', compact('userAccounts'));
    }


    public function statement($transactionId)
    {
        info($transactionId);

        $results = Transaction::with('accountTo.accountable', 'accountFrom.accountable')
            ->where('id', $transactionId)
            ->whereHas('accountTo', function ($query) {
                $query->where('accountable_type', Session('activeProfileType'))
                ->where('accountable_id',  Session('activeProfileId'));
            })
            ->orWhereHas('accountFrom.accountable', function ($query) {
                 $query->where('accountable_type', Session('activeProfileType'))
                ->where('accountable_id', Session('activeProfileId'));
            })
            ->find($transactionId);

            //TODO: add permission check
            //TODO: if 403, but has permission, redirect with message to switch profile
            //TODO: replace 403 with custom redirect page incl explanation
        return ($results != null ? view('transactions.statement', compact(['transactionId'])) : abort(403));
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
