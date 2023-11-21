<?php

namespace App\Traits;

use App\Models\Transaction;

trait AccountInfoTrait
{

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
    

    /**
     * Retrieves the account totals of a profile.
     *
     * @param string|null $profileType The profile type. If null, the active profile type from the session will be used.
     * @param int|null $profileId The profile ID. If null, the active profile ID from the session will be used.
     * @param int|null $sinceDaysAgo The number of days to filter transactions. If null, all transactions will be included.
     * @return array Sum of all balances, count of transfers, count of transfers received, count of transfers sent.
     */
    public function getAccountsTotals($profileType = null, $profileId = null, $sinceDaysAgo = null)
    {
        if ($profileType === null) {
            $profileType = session('activeProfileType');
        }
        if ($profileId === null) {
            $profileId = session('activeProfileId');
        }

        $accounts = $profileType::find($profileId)->accounts;
        
        $sumBalances = 0; 
        $countTransfers = 0; 
        $countTransfersReceived = 0; 
        $countTransfersSent = 0;

        $accountIds = $accounts->pluck('id')->toArray(); // Get all account ids of profile

        foreach ($accounts as $account) {
            $sumBalances  += $this->getBalance($account->id);
            $transfersQuery = Transaction::where('from_account_id', $account->id)->orWhere('to_account_id', $account->id);
            
            // If $sinceDaysAgo is not null, filter transactions created within the specified number of days
            if ($sinceDaysAgo !== null) {
                $transfersQuery->whereDate('created_at', '>=', now()->subDays($sinceDaysAgo));
            }

            $transfers = $transfersQuery->get();

            foreach ($transfers as $transfer) {
                // Exclude transactions between accounts owned by the same profile
                // Check if both from_account_id and to_account_id are in $accountIds
                if (!in_array($transfer->from_account_id, $accountIds) || !in_array($transfer->to_account_id, $accountIds)) {
                    $countTransfers++;
                    if ($transfer->to_account_id == $account->id) {
                        $countTransfersReceived++;
                    }
                    if ($transfer->from_account_id == $account->id) {
                        $countTransfersSent++;
                    }
                }
            }
        }
        
        $totals = [
            'sumBalances' => $sumBalances,
            'countTransfersSince' => now()->subDays($sinceDaysAgo),
            'transfers' => $countTransfers,
            'transfersReceived' => $countTransfersReceived,
            'transfersSent' => $countTransfersSent,
        ];

        return $totals;   
    }
}