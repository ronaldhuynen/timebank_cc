<?php

namespace App\Http\Controllers;

use App\Http\Livewire\TransactionsTable;
use App\Models\Transaction;
use App\Models\User;
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
        $transactions = $this->getTransactions();
        $transactionsCollection = collect($this->getTransactions());
        $transactions = $transactionsCollection->reverse()->paginate(15);
        return view('transactions.show', compact('userAccounts', 'transactions'));
    }

    // TODO: Remove as this function is used in Livewire componenent transactions-table ???
    public function getTransactions()
    {
        $transactions = [];
        $balance = 0;
        $accountId = Session('accountId');
        $allTransfers = Transaction::with('accountTo.accountable', 'accountFrom.accountable')
            ->where('to_account_id', $accountId)->orWhere('from_account_id', $accountId)
            ->get();
        foreach ($allTransfers as $t) {
            if ($t->to_account_id === $accountId) {
                // Credit transfer
                $ct = $t;
                $transactions[] = [
                    'datetime' => $ct->created_at,
                    'amount' => $ct->amount,
                    'type' => 'Credit',
                    'account_from' => $ct->from_account_id,
                    'relation' => 'From ' . $ct->accountFrom->accountable->name,
                    'profile_photo' => $ct->accountFrom->accountable->profile_photo_path,
                    'description' => (strlen($ct->description) > 58) ? substr_replace($ct->description, '...', 55) : $ct->description,
                ];
            } else {
                // Debit transfer
                $dt = $t;
                $transactions[] = [
                    'datetime' => $dt->created_at,
                    'amount' => $dt->amount,
                    'type' => 'Debit',
                    'account_to' => $dt->to_account_id,
                    'relation' => 'To ' . $dt->accountTo->accountable->name,
                    'profile_photo' => $dt->accountFrom->accountable->profile_photo_path,
                    'description' => (strlen($dt->description) > 58) ? substr_replace($dt->description, '...', 55) : $dt->description,
                ];
            }
        }

        $transactions = collect($transactions)->sortBy('datetime');
        $state = [];
        foreach ($transactions as $s) {
            if ($s['type'] == 'Debit') {
                $balance -= $s['amount'];
            } else {
                $balance += $s['amount'];
            }
            $s['balance'] = $balance;
            $state[] = $s;
        }
        $transactions = $state;

        return $transactions;
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
