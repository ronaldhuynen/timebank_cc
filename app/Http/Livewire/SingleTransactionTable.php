<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Arr;
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
        $this->getTransaction();
    }

    public function getTransaction()
    {
        $balance = $this->balance;
        $results = Transaction::with('accountTo.accountable', 'accountFrom.accountable')->findOrFail($this->transactionId);
        // dd($results->accountFrom->accountable->name);
        info($results);
        info($this->accountId);
        // dd($results->to_account_id);

            if ($results->to_account_id === (int) $this->accountId) {
                // Credit transfer
                $ct = $results;
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
            if ($results->from_account_id === (int) $this->accountId) {
                // Debit transfer
                $dt = $results;
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
        $transaction = $state;
        // dd($transaction);

        return Arr::collapse($transaction);
    }

    public function render()
    {
        $this->transaction = $this->getTransaction();
        return view('livewire.single-transaction-table');
    }
}

