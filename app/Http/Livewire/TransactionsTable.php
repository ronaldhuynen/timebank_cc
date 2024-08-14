<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsTable extends Component
{
    use WithPagination;

    public $searchState = false;
    public $search = '';
    public $searchAmount;
    public $fromDate;
    public $toDate;
    public $perPage = 20;
    public $sortField;
    public $sortAsc = true;
    public $fromAccountId;
    public $transactions;

    protected $listeners = [
        'fromAccountId', 'searchTransactions',
    ];


    protected $rules = [
        'searchAmount' => 'nullable|regex:/^\d*:[0-5]\d$/',
        'search' => 'nullable|string|min:3|max:1500'
    ];


    protected $messages = [
        'searchAmount.regex' => 'The amount should be positive and in hh:mm format. For example 90 minutes is 1:30.',
    ];


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
        $transactions = [];
        $balance = 0;
        $accountId = $this->fromAccountId;

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
                    'account_from_name' => ($ct->accountFrom->name != null ? $ct->accountFrom->name : ''),
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
                    'account_to_name' => ($dt->accountTo->name != null ? $dt->accountTo->name : ''),
                    'relation' => 'To ' . ($dt->accountTo->accountable->name != null ? $dt->accountTo->accountable->name : ''),
                    'profile_photo' => ($dt->accountTo->accountable->profile_photo_path != null ? $dt->accountTo->accountable->profile_photo_path : ''),
                    'description' => $dt->description,
                ];
            }

        }

        $transactions = collect($transactions) ->sortByDesc('datetime');
        $transactions = collect($transactions) ->sortByDesc('datetime');

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



        // Paginate the $state array
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $this->perPage; // Number of items per page
        $currentItems = array_slice($state, ($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator($currentItems, count($state), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);


        // Convert to array for Livewire
        $this->transactions = $paginatedItems->toArray();

    }


    public function searchTransactions()
    {
        $this->searchState = true;
        $search = $this->search;
        $searchAmount = $this->searchAmount !== null ? dbFormat($this->searchAmount) : null;
        $transactions = [];
        $balance = 0;
        $accountId = $this->fromAccountId;

        // Validate inputs
        $this->validate();


        // Remove special characters that conflict with Elesticsearch query from $search
        $search = preg_replace('/[^a-zA-Z0-9\s]/', '', $search);

        if (isset($searchAmount)) {
            // $search contains a time format

            if (strlen($search) > 0) {
                $searchQuery = $search . '~ AND ' . $searchAmount;
            } else {
                $searchQuery = 'amount:' . $searchAmount;	//
            }

        } else {
            // $search does not contain a time format
            $searchQuery = $search . '~';
        }

        if (strlen($searchQuery) > 1) {     // Because we use the fuzzy search character '~', we need to check if $searchQuery is > 1
            $searchResults = Transaction::search($searchQuery)
            ->query(function ($query) use ($accountId) {
                $query->where('to_account_id', $accountId)
                ->orWhere('from_account_id', $accountId);
            })
            ->get(); // Scout search
        } else {
            $searchResults = Transaction::search('*')
            ->query(function ($query) use ($accountId) {
                $query->where('to_account_id', $accountId)
                ->orWhere('from_account_id', $accountId);
            })
            ->get(); // Scout search
        }


        if ($this->fromDate == null) {
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
                    'account_from_name' => ($ct->accountFrom->name != null ? $ct->accountFrom->name : ''),
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
                    'account_to_name' => ($dt->accountTo->name != null ? $dt->accountTo->name : ''),
                    'relation' => 'To ' . ($dt->accountTo->accountable->name != null ? $dt->accountTo->accountable->name : ''),
                    'profile_photo' => ($dt->accountTo->accountable->profile_photo_path != null ? $dt->accountTo->accountable->profile_photo_path : ''),
                    'description' => $dt->description,
                ];
            }
        }


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


        // Paginate the $state array
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $this->perPage; // Number of items per page
        $currentItems = array_slice($state, ($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator($currentItems, count($state), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);


        // Convert to array for Livewire
        $this->transactions = $paginatedItems->toArray();

    }


    public function render()
    {
        if ($this->searchState === false) {
        $transactions = $this->getTransactions();
        } else { $transactions = $this->transactions; }

        return view('livewire.transactions-table', [
            'transactions' => collect($transactions)
                ->sortByDesc('datetime')
                ->paginate($this->perPage)
            ]);
    }
}
