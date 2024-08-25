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
    public $searchAccount;
    public $fromDate;
    public $toDate;
    public $perPage = 50;
    public $sortField;
    public $sortAsc = true;
    public $fromAccountId;
    public $stateSource = [];
    public $transactions = [];

    protected $listeners = ['fromAccountId', 'searchTransactions', 'accountSelected', 'accountDeselected'];

    protected $rules = [
        'searchAmount' => 'nullable|regex:/^\d*:[0-5]\d$/',
        'search' => 'nullable|string|min:3|max:100',
        'searchAmount' => 'nullable|integer',
        'fromDate' => 'nullable|date',
        'toDate' => 'nullable|after_or_equal:fromDate',
    ];

    protected $messages = [
        'searchAmount.regex' => 'The amount should be positive and in hh:mm format. For example 90 minutes is 1:30.',
        'fromDate.date' => 'The from date must be a valid date.',
        'toDate.date' => 'The to date must be a valid date.',
    ];

    // TODO NEXT: search by amount. Refactor 1st the amount component with two HH and MM inputs


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


    public function accountSelected($accountId)
    {
        $this->searchAccount = $accountId;
    }


    public function accountDeselected()
    {
        $this->searchAccount = null;
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
        if (!empty($this->search) || !empty($this->searchAmount || !empty($this->fromDate) || !empty($this->toDate || !empty($this->searchAccount)))) {
            $this->searchState = true;
        } else {
            $this->searchState = false;
        }

        if (!empty($this->search) || !empty($this->searchAmount)) {
            $this->hideBalance = true;
        } else {
            $this->hideBalance = false;
        }

        $search = $this->search;
        $searchAccount = $this->searchAccount;
        $searchAmount = $this->searchAmount !== null ? dbFormat($this->searchAmount) : null;

        $this->resetPage();
        $this->validate();

        // Convert $search to lowercase
        $search = strtolower($search);
        // Remove trailing whitespaces
        $search = trim($search);
        // Reset state to the original data source
        $state = $this->stateSource;
        // Prepare date filter
        $fromDate = $this->fromDate ? strtotime($this->fromDate) : null;
        $toDate = $this->toDate ? strtotime($this->toDate) : null;


        // Filter the transactions based on the search criteria
        $stateFiltered = array_filter($state, function ($transaction) use ($search, $searchAccount, $fromDate, $toDate) {
            // Check if the transaction date is within the specified date range
            $transactionDate = strtotime($transaction['datetime']);
            $dateInRange = (!$fromDate || $transactionDate >= $fromDate) && (!$toDate || $transactionDate <= $toDate);
            // If the date is not in range, skip this transaction
            if (!$dateInRange) {
                return false;
            }
            // If both $search and $searchAccount are empty, only apply the dateInRange filter
            if (empty($search) && empty($searchAccount)) {
                return true;
            }
            // Initialize search-related flags
            $descriptionContainsSearch = false;
            $relationContainsSearch = false;
            // Check if a search term is provided
            if (!empty($search)) {
                // Convert transaction description and relation to lowercase and check if they contain the search keyword
                $descriptionContainsSearch = isset($transaction['description']) && $transaction['description'] !== null && strpos(strtolower($transaction['description']), $search) !== false;
                $relationContainsSearch = isset($transaction['relation']) && $transaction['relation'] !== null && strpos(strtolower($transaction['relation']), $search) !== false;
            }
            // Check if the transaction matches the searchAccount
            $accountMatches = false;
            if (isset($transaction['account_from']) && in_array($searchAccount, (array)$transaction['account_from'], true)) {
                $accountMatches = true;
            }
            if (isset($transaction['account_to']) && in_array($searchAccount, (array)$transaction['account_to'], true)) {
                $accountMatches = true;
            }
            // Combine all conditions
            if (!empty($search) && !empty($searchAccount)) {
                $result = $accountMatches && ($descriptionContainsSearch || $relationContainsSearch);
            } else {
                $result = $descriptionContainsSearch || $relationContainsSearch || $accountMatches;
            }

            return $result;
        });

         // Paginate the $stateFiltered array
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $this->perPage; // Number of items per page
        $currentItems = array_slice($stateFiltered, ($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator($currentItems, count($stateFiltered), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        // Assign the paginated items to $this->transactions
        $this->transactions = $paginatedItems->toArray();

        // Return the paginated items
        return $paginatedItems;


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
