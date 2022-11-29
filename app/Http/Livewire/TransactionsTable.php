<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $sortField;
    public $sortAsc = true;
    public $fromAccountId;

    protected $listeners = [
        'fromAccountId',
    ];


    public function clear()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }


    public function fromAccountId($fromAccount)
    {
        $this->resetPage();
        $this->fromAccountId = $fromAccount;
    }


    public function getTransactions()
    {

        // $this->search = '';
        $search = $this->search;
        $transactions = [];
        $balance = 0;
        $accountId = $this->fromAccountId;

            $allTransfers = Transaction::
            with('accountTo.accountable', 'accountFrom.accountable')
            ->where([['to_account_id', $accountId],['description', 'like', '%' . $search . '%']])
            ->orWhere([['from_account_id', $accountId],['description', 'like', '%' . $search . '%']])
            ->get();

        info(array($allTransfers));


        foreach ($allTransfers as $t) {
            if ($t->to_account_id === $accountId) {
                // Credit transfer
                $ct = $t;
                $transactions[] = [
                    'datetime' => $ct->created_at,
                    'amount' => $ct->amount,
                    'type' => 'Credit',
                    'account_from' => $ct->from_account_id,
                    'relation' => 'From ' . ($ct->accountFrom->accountable->name != null ? $ct->accountFrom->accountable->name : ''),
                    'profile_photo' => ($ct->accountFrom->accountable->profile_photo_path != null ? $ct->accountFrom->accountable->profile_photo_path : ''),
                    'description' => $ct->description,
                ];
            } else {
                // Debit transfer
                $dt = $t;
                $transactions[] = [
                    'datetime' => $dt->created_at,
                    'amount' => $dt->amount,
                    'type' => 'Debit',
                    'account_to' => $dt->to_account_id,
                    'relation' => 'To ' . ($dt->accountTo->accountable->name != null ? $dt->accountTo->accountable->name : ''),
                    'profile_photo' => ($dt->accountFrom->accountable->profile_photo_path != null ? $dt->accountFrom->accountable->profile_photo_path : ''),
                    'description' => $dt->description,
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

        $contents = collect($transactions)->where('relation', $this->search);

        return $transactions;
    }

    public function render()
    {
        return view('livewire.transactions-table', [
            'transactions' => collect($this->getTransactions())
            ->sortByDesc('datetime')
            ->paginate($this->perPage)
        ]);
    }
}
