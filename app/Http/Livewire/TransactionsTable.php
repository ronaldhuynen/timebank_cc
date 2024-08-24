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
    public $hideBalance = false;
    public $search;
    public $searchAmount;
    public $fromDate;
    public $toDate;
    public $perPage = 50;
    public $sortField;
    public $sortAsc = true;
    public $fromAccountId;
    public $stateSource = [];
    public $transactions = [];

    protected $listeners = ['fromAccountId', 'searchTransactions'];

    protected $rules = [
        'searchAmount' => 'nullable|regex:/^\d*:[0-5]\d$/',
        'search' => 'nullable|string|min:3|max:1500',
        'fromDate' => 'nullable|date',
        'toDate' => 'nullable|after_or_equal:fromDate',
    ];

    protected $messages = [
        'searchAmount.regex' => 'The amount should be positive and in hh:mm format. For example 90 minutes is 1:30.',
        'fromDate.date' => 'The from date must be a valid date.',
        'toDate.date' => 'The to date must be a valid date.',
    ];


    public function mount()
    {
        $this->resetPage();
        $this->getTransactions();

        // $this->fromDate = Carbon::now()->subYears(2)->toDateString(); // Set default fromDate to 2 years ago to limit long queries
        // $this->toDate = Carbon::now()->toDateString();
    }


    public function updatingPerPage()
    {
        $this->resetPage();
    }

    
    public function fromAccountId($fromAccount)
    {
        $this->fromAccountId = $fromAccount;
    }

    public function getTransactions()
    {
        $transactions = [];
        $balance = 0;
        $accountId = $this->fromAccountId;

        $results = Transaction::with('accountTo.accountable', 'accountFrom.accountable')->where('to_account_id', $accountId)->orWhere('from_account_id', $accountId)->get();

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
                    'account_from_name' => $ct->accountFrom->name != null ? $ct->accountFrom->name : '',
                    'relation' => 'From ' . ($ct->accountFrom->accountable->name != null ? $ct->accountFrom->accountable->name : ''),
                    'profile_photo' => $ct->accountFrom->accountable->profile_photo_path != null ? $ct->accountFrom->accountable->profile_photo_path : '',
                    'description' => $ct->description,
                ];
            }
            if ($t->from_account_id === $accountId) {
                // Debit transfer
                $dt = $t;
                $transactions[] = [
                    'trans_id' => $dt->id,
                    'datetime' => $dt->created_at,
                    'amount' => $dt->amount,
                    'type' => 'Debit',
                    'account_to' => $dt->to_account_id,
                    'account_to_name' => $dt->accountTo->name != null ? $dt->accountTo->name : '',
                    'relation' => 'To ' . ($dt->accountTo->accountable->name != null ? $dt->accountTo->accountable->name : ''),
                    'profile_photo' => $dt->accountTo->accountable->profile_photo_path != null ? $dt->accountTo->accountable->profile_photo_path : '',
                    'description' => $dt->description,
                ];
            }
        }

        $transactions = collect($transactions);

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

        // Sort the $state array by 'datetime' in descending order
        $state = collect($state)->sortByDesc('datetime')->values()->all();
        $this->stateSource = $state;

        // Paginate the sorted $state array
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $this->perPage; // Number of items per page
        $currentItems = array_slice($state, ($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator($currentItems, count($state), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        // Convert to array for Livewire
        return $this->transactions = $paginatedItems->toArray();
    }


    public function searchTransactions()
    {
        if (!empty($this->search) || !empty($this->searchAmount || !empty($this->fromDate) || !empty($this->toDate) )) {
            $this->searchState = true;
        } else {
            $this->searchState = false;
        }
        
        if (!empty($this->search) || !empty($this->searchAmount )) {
            $this->hideBalance = true;
        } else {
            $this->hideBalance = false;
        }

        $search = $this->search;
        $searchAmount = $this->searchAmount !== null ? dbFormat($this->searchAmount) : null;
        
        $this->resetPage();
        $this->validate();

        // Convert $search to lowercase
        $search = strtolower($search);
        // Remove trailing whitespaces
        $search = trim($search);
        // Reset state to the original data source
        $state = $this->stateSource;

        // Filter the $this->state array based on the search keyword and date range
        $stateFiltered = array_filter($state, function ($transaction) use ($search) {
            // Convert transaction description and relation to lowercase and check if they contain the search keyword
            $descriptionContainsSearch = strpos(strtolower($transaction['description']), $search) !== false;
            $relationContainsSearch = strpos(strtolower($transaction['relation']), $search) !== false;
            // Check if the transaction date is within the specified date range
            $transactionDate = strtotime($transaction['datetime']);
            $fromDate = $this->fromDate ? strtotime($this->fromDate) : null;
            $toDate = $this->toDate ? strtotime($this->toDate) : null;
            $dateInRange = (!$fromDate || $transactionDate >= $fromDate) && (!$toDate || $transactionDate <= $toDate);
            // Return true if either the search matches or the date is in range
            return ($search === '' || $descriptionContainsSearch || $relationContainsSearch) && $dateInRange;
        });

        // Paginate the $state array
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $this->perPage; // Number of items per page
        $currentItems = array_slice($stateFiltered, ($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator($currentItems, count($stateFiltered), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        // Convert to array for Livewire
        return $this->transactions = $paginatedItems->toArray();
    }

    public function render()
    {
        if ($this->searchState === false) {
            $transactions = $this->getTransactions();
        } else {
            $transactions = $this->transactions;
        }

        return view('livewire.transactions-table', [
            'transactions' => collect($transactions),
        ]);
    }
}
