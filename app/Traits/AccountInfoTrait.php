<?php

namespace App\Traits;

use App\Models\Transaction;

trait AccountInfoTrait
{
    /**
     * Get the balance of an account.
     *
     * @param int $accountId The ID of the account.
     * @return float The balance of the account in minutes.
     */
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
     * If no profileType and profileId is specified, the active profile is used.
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

        // Get the profile and its accounts in a single query
        $profile = $profileType::with(['accounts' => function ($query) {
            $query->where(function ($query) {
                $query->whereNull('inactive_at')
                      ->orWhere('inactive_at', '>', now());
            });
        }])->find($profileId);

        // Calculate the total balance of all accounts of the profile
        $sumAccounts = $profile->accounts->sum(function ($account) {
            return $this->getBalance($account->id);
        });

        $maxBalanceAvailableByProfile = $profile->limit_max - $sumAccounts - $profile->limit_min;

        // Map the collection to include the total balance
        $accounts = $profile->accounts->map(function ($account) use ($maxBalanceAvailableByProfile) {
            return [
                'id' => $account->id,
                'name' => $account->name,
                'balance' => $this->getBalance($account->id),
                'limitMin' => $account->limit_min,
                'limitMax' => $account->limit_max,
                'maxBalanceAvailableByProfile' => $maxBalanceAvailableByProfile
            ];
        });

        return $accounts;
    }


    /**
     * Retrieves the account totals of a profile.
     * If no profileType and profileId is specified, the active profile is used.
     *
     * @param string|null $profileType The profile type. If null, the active profile type from the session will be used.
     * @param int|null $profileId The profile ID. If null, the active profile ID from the session will be used.
     * @param int|null $sinceDaysAgo The number of days to filter the counted transfers. If null, all transfers will be counted.
     * @return array Sum of all balances (in minutes), count of transfers, count of transfers received, count of transfers sent.
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
        $countTransfersGiven = 0;

        $accountIds = $accounts->pluck('id')->toArray(); // Get all account ids of profile

        foreach ($accounts as $account) {
            $sumBalances  += $this->getBalance($account->id);
            $transfersQuery = Transaction::where(function ($query) use ($account) {
                $query->where('from_account_id', $account->id)
                    ->orWhere('to_account_id', $account->id);
            });

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
                        $countTransfersGiven++;
                    }
                }
            }
        }

        $totals = [
            'sumBalances' => $sumBalances,
            'countTransfersSince' => $sinceDaysAgo !== null ? now()->subDays($sinceDaysAgo) : null,
            'transfers' => $countTransfers,
            'transfersReceived' => $countTransfersReceived,
            'transfersGiven' => $countTransfersGiven,
            'lastTransferDate' => $transfersQuery->count() > 0 ? $transfersQuery->orderBy('created_at', 'desc')->take(1)->pluck('created_at') : null
        ];

        return $totals;
    }
}
