<?php

namespace App\Traits;

use App\Models\Transaction;

trait AccountInfoTrait
{
    /**
     * AccountInfoTrait constructor.
     * This constructor initializes the middleware for authentication.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getBalance($accountId)
    {
        $balance = 0;
        $transactions = Transaction::where('from_account_id', $accountId)->orWhere('to_account_id', $accountId)->select('from_account_id', 'to_account_id', 'amount')->get();
        foreach ($transactions as $transaction) {
            if ($transaction->to_account_id === $accountId) {
                $balance += $transaction->amount;
            } else {
                $balance -= $transaction->amount;
            }
        }
        //TODO store current balance in cache until it it is updated?
        return $balance;
    }


    /**
     * Get accounts associated with a profile. 
     * If no profile is specified, the active profile is used.
     * Returns an array with account id, name, and balance (in minutes).
     * 
     * @return void
     */
    public function getAccountsInfo($profileType = null, $profileId = null)
    {
        if ($profileType === null) {
            $profileType = session('activeProfileType');
        }
        if ($profileId === null) {
            $profileId = session('activeProfileId');
        }

        $accounts = $profileType::find($profileId)->accounts;
        $accounts = $accounts->map(function ($account) {
            return [
                'id' => $account->id,
                'name' => $account->name,
                'balance' => $this->getBalance($account->id)
            ];
        });
        return $accounts;
    }
}
