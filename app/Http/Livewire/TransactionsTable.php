<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsTable extends Component
{
    use WithPagination;

    public $searchState = false;
    public $search = '';
    public $fromDate;
    public $toDate;
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


    public function updatingSearch()
    {
        $this->searchState = true;
        $this->resetPage();
    }


    public function updatingFromDate()
    {
        $this->searchState = true;
        $this->resetPage();
    }


    public function updatingToDate()
    {
        $this->searchState = true;
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
        $search = $this->search;
        $transactions = [];
        $balance = 0;
        $accountId = $this->fromAccountId;

        //TODO: Zoeken op amount mogelijk maken!

        if ($this->searchState === false) {
            $results = Transaction::with('accountTo.accountable', 'accountFrom.accountable')
                ->where('to_account_id', $accountId)
                ->orWhere('from_account_id', $accountId)
                ->get();

            foreach ($results as $t) {
                if ($t->to_account_id === $accountId) {
                    // Credit transfer
                    $ct = $t;
                    $transactions[] = [
                        'trans_id' =>  $ct->id,
                        'datetime' => $ct->created_at,
                        'amount' => $ct->amount,
                        'type' => 'Credit',
                        'account_from' => $ct->from_account_id,
                        'relation' => 'From ' . ($ct->accountFrom->accountable->name != null ? $ct->accountFrom->accountable->name : ''),
                        'profile_photo' => ($ct->accountFrom->accountable->profile_photo_path != null ? $ct->accountFrom->accountable->profile_photo_path : ''),
                        'description' => $ct->description,
                    ];
                }
                if ($t->from_account_id === $accountId) {
                    // Debit transfer
                    $dt = $t;
                    $transactions[] = [
                        'trans_id' =>  $dt->id,
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
        } else {
            // $searchState is true
            $searchResults = Transaction::with('accountTo.accountable', 'accountFrom.accountable')
            ->where([['to_account_id', $accountId],['description', 'like', '%' . $search . '%']])
            ->orWhere([['from_account_id', $accountId],['description', 'like', '%' . $search . '%']])
            ->orWhereHas('accountTo.accountable', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orWhereHas('accountFrom.accountable', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->get();


            if ($this->fromDate == null) {
                // $this->fromDate = Carbon::now()->subDays(365)->toDateString();
                $this->fromDate = '';
            }
            if ($this->toDate == null) {
                $this->toDate = Carbon::now()->toDateString();
            }

            $results = $searchResults->whereBetween('created_at', [$this->fromDate, $this->toDate]);

            foreach ($results as $t) {
                if ($t->to_account_id === $accountId) {
                    // Credit transfer
                    $ct = $t;
                    $transactions[] = [
                        'trans_id' => $ct->id,
                        'datetime' => $ct->created_at,
                        'amount' => $ct->amount,
                        'type' => 'Credit',
                        'account_from' => $ct->from_account_id,
                        'relation' => 'From ' . ($ct->accountFrom->accountable->name != null ? $ct->accountFrom->accountable->name : ''),
                        'profile_photo' => ($ct->accountFrom->accountable->profile_photo_path != null ? $ct->accountFrom->accountable->profile_photo_path : ''),
                        'description' => $ct->description,
                    ];
                }

                if ($t->from_account_id === $accountId) {
                    // Debit transfer
                    $dt = $t;
                    $transactions[] = [
                        'trans_id' =>  $dt->id,
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
        }

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
