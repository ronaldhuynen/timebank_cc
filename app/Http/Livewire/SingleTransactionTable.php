<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class SingleTransactionTable extends Component
{
    // public $singleTransaction = [];
    public $balance = 0;
    public $accountId;
    public $transaction;

    public function mount($transactionId, $accountId)
    {
        $this->transactionId = $transactionId;
        $this->accountId = $accountId;


    }

    public function getTransaction()
    {
        $balance = $this->balance;
        $results= Transaction::with('accountTo.accountable', 'accountFrom.accountable')->findOrFail($this->transactionId);

        info($results);

        foreach ($results as $t) {
            if ($t->to_account_id === $this->accountId) {
                // Credit transfer
                $ct = $t;
                $transaction[] = [
                    'datetime' => $ct->created_at,
                    'amount' => $ct->amount,
                    'type' => 'Credit',
                    'account_from' => $ct->from_account_id,
                    'relation' => 'From ' . ($ct->accountFrom->accountable->name != null ? $ct->accountFrom->accountable->name : ''),
                    'profile_photo' => ($ct->accountFrom->accountable->profile_photo_path != null ? $ct->accountFrom->accountable->profile_photo_path : ''),
                    'description' => $ct->description,
                ];
            }
            if ($t->from_account_id === $this->accountId) {
                // Debit transfer
                $dt = $t;
                $transaction[] = [
                    'datetime' => $dt->created_at,
                    'amount' => $dt->amount,
                    'type' => 'Debit',
                    'account_to' => $dt->to_account_id,
                    'relation' => 'To ' . ($dt->accountTo->accountable->name != null ? $dt->accountTo->accountable->name : ''),
                    'profile_photo' => ($dt->accountTo->accountable->profile_photo_path != null ? $dt->accountTo->accountable->profile_photo_path : ''),
                    'description' => $dt->description,
                ];
            }
        }

        $transaction = collect($transaction)->sortBy('datetime');

        $state = [];
        foreach ($transaction as $s) {
            if ($s['type'] == 'Debit') {
                $balance -= $s['amount'];
            } else {
                $balance += $s['amount'];
            }
            $s['balance'] = $balance;

            $state[] = $s;
        }
        $transactions = $state;

        $contents = collect($transaction)->where('relation', $this->search);

        return $transaction;
    }

    public function render()
    {
        return view('livewire.single-transaction-table', [
            'transaction' => collect($this->getTransaction())
            ->sortByDesc('datetime')
        ]);
    }
}

