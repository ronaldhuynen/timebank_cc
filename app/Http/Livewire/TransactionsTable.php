<?php

namespace App\Http\Livewire;

use App\Exports\TransactionsExport;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsTable extends Component
{
    use WithPagination;

    public $searchState = false;
    public $hideBalance = false;
    public $showSearchSection = false;
    public $search;
    public $searchAmount;
    public $searchAccount;
    public $fromDate;
    public $toDate;
    public $perPage = 25;
    public $sortField;
    public $sortAsc = true;
    public $fromAccountId;
    public $stateSource = [];
    // public $transactions = [];
    protected $transactionsForExport;

    protected $listeners = [
        'fromAccountId',
        'searchTransactions',
        'toAccountDetails' => 'searchAccountDispatched',
        'amount' => 'amountDispatched'
    ];

    protected $rules = [
        'search' => 'nullable|string|min:3|max:100',
        'searchAmount' => 'nullable|integer',
        'fromDate' => 'nullable|date',
        'toDate' => 'nullable|after_or_equal:fromDate',
    ];

    protected $messages = [
        'fromDate.date' => 'The from date must be a valid date.',
        'toDate.date' => 'The to date must be a valid date.',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function amountDispatched($amount)
    {
        $this->searchAmount = $amount;
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function fromAccountId($selectedAccount)
    {
        $this->fromAccountId = $selectedAccount['id'];
    }

    public function searchAccountDispatched($accountDetails)
    {
        $this->searchAccount = $accountDetails['accountId'];
    }

public function getTransactions()
{
    $accountId = $this->fromAccountId;

    // Fetch the account with its accountable relationship
    $account = Account::with(['accountable:id,name,full_name'])->find($accountId);

    // Use window function to calculate running balance
    $transactions = Transaction::selectRaw("
        transactions.*,
        SUM(
            CASE
                WHEN to_account_id = ? THEN amount
                WHEN from_account_id = ? THEN -amount
                ELSE 0
            END
        ) OVER (ORDER BY created_at ASC) AS balance
    ", [$accountId, $accountId])
    ->with(['accountTo.accountable:id,name,full_name,profile_photo_path', 'accountFrom.accountable:id,name,full_name,profile_photo_path'])
    ->where(function ($query) use ($accountId) {
        $query->where('to_account_id', $accountId)
              ->orWhere('from_account_id', $accountId);
    })
    ->orderBy('created_at', 'desc') // Order descending for newest transactions first
    ->paginate($this->perPage);

    // Transform the transactions to include necessary data
    $transactions->getCollection()->transform(function ($t) use ($accountId, $account) {
        $transaction = [
            'trans_id' => $t->id,
            'datetime' => $t->created_at,
            'amount' => $t->amount,
            'type' => $t->to_account_id === $accountId ? 'Credit' : 'Debit',
            'account_id' => $account->id,
            'account_name' => $account->name,
            'account_holder_name' => $account->accountable->name,
            'account_holder_full_name' => $account->accountable->full_name,
            'description' => $t->description,
            'balance' => $t->balance, // Running balance from window function
        ];

        if ($t->to_account_id === $accountId) {
            // Credit transaction
            $transaction += [
                'account_from' => $t->from_account_id,
                'account_counter_id' => $t->from_account_id,
                'account_from_name' => $t->accountFrom->name ?? '',
                'account_counter_name' => $t->accountFrom->name ?? '',
                'relation' => $t->accountFrom->accountable->name ?? '',
                'relation_full_name' => $t->accountFrom->accountable->full_name ?? '',
                'profile_photo' => $t->accountFrom->accountable->profile_photo_path ?? '',
            ];
        } else {
            // Debit transaction
            $transaction += [
                'account_to' => $t->to_account_id,
                'account_counter_id' => $t->to_account_id,
                'account_to_name' => $t->accountTo->name ?? '',
                'account_counter_name' => $t->accountTo->name ?? '',
                'relation' => $t->accountTo->accountable->name ?? '',
                'relation_full_name' => $t->accountTo->accountable->full_name ?? '',
                'profile_photo' => $t->accountTo->accountable->profile_photo_path ?? '',
            ];
        }

        return $transaction;
    });

    // Remove the sorting at the end as it's no longer needed
    // $transactions->setCollection(
    //     $transactions->getCollection()->sortByDesc('datetime')->values()
    // );

    // Return the paginated items
    return $transactions;
}


    public function searchTransactions()
    {
        if (!empty($this->search) || !empty($this->searchAmount) || !empty($this->fromDate) || !empty($this->toDate) || !empty($this->searchAccount)) {
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
        $searchAmount = $this->searchAmount !== null ? $this->searchAmount : null;
        $fromDate = $this->fromDate;
        $toDate = $this->toDate;
        $this->resetPage();
        $this->validate();

        // Convert $search to lowercase
        $search = strtolower($search);
        // Remove trailing whitespaces
        $search = trim($search);

        // Perform the search directly in the database query
        $accountId = $this->fromAccountId;
        $query = Transaction::with('accountTo.accountable', 'accountFrom.accountable')
            ->where(function ($query) use ($accountId) {
                $query->where('to_account_id', $accountId)
                    ->orWhere('from_account_id', $accountId);
            });

        // Apply search filters
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('accountFrom.accountable', function ($query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                    })
                    ->orWhereHas('accountTo.accountable', function ($query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                    });
            });
        }

        if (!empty($searchAccount)) {
            $query->where(function ($query) use ($searchAccount) {
                $query->where('from_account_id', $searchAccount)
                    ->orWhere('to_account_id', $searchAccount);
            });
        }

        if (!empty($searchAmount)) {
            $query->where('amount', $searchAmount);
        }

        if (!empty($fromDate)) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if (!empty($toDate)) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        // Paginate the search results
        $results = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

        $transactions = [];
        $balance = 0;

        foreach ($results as $t) {
            if ($t->to_account_id === $accountId) {
                // Credit transfer
                $ct = $t;
                $transactions[] = [
                    'trans_id' => $ct->id,
                    'datetime' => $ct->created_at,
                    'amount' => $ct->amount,
                    'type' => 'Credit', // A transaction received FROM another account holder
                    'account_id' => $accountId,
                    'account_name' => $ct->accountTo->name,
                    'account_holder_name' => $ct->accountTo->accountable->name,
                    'account_holder_full_name' => $ct->accountTo->accountable->full_name,
                    'account_from' => $ct->from_account_id,
                    'account_counter_id' => $ct->from_account_id,
                    'account_from_name' => $ct->accountFrom->name != null ? $ct->accountFrom->name : '',
                    'account_counter_name' => $ct->accountFrom->name != null ? $ct->accountFrom->name : '',
                    'relation' => $ct->accountFrom->accountable->name != null ? $ct->accountFrom->accountable->name : '',
                    'relation_full_name' => $ct->accountFrom->accountable->name != null ? $ct->accountFrom->accountable->full_name : '',
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
                    'type' => 'Debit', // A transaction paid TO another account holder
                    'account_id' => $accountId,
                    'account_name' => $dt->accountFrom->name,
                    'account_holder_name' => $dt->accountFrom->accountable->name,
                    'account_holder_full_name' => $dt->accountFrom->accountable->full_name,
                    'account_to' => $dt->to_account_id,
                    'account_counter_id' => $dt->to_account_id,
                    'account_to_name' => $dt->accountTo->name != null ? $dt->accountTo->name : '',
                    'account_counter_name' => $dt->accountTo->name != null ? $dt->accountTo->name : '',
                    'relation' => $dt->accountTo->accountable->name != null ? $dt->accountTo->accountable->name : '',
                    'relation_full_name' => $dt->accountTo->accountable->name != null ? $dt->accountTo->accountable->full_name : '',
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

        $this->transactionsForExport = $state;
        // Assign the paginated items to $this->transactions
        // $this->transactions = $paginatedItems->toArray();

        // Return the paginated items
        return $paginatedItems;
    }

    public function exportTransactions($type)
    {
        $data = collect($this->transactionsForExport);

        // Remove multiple keys from each item in the collection
        $data = $data->map(function ($item) {
            $item = collect($item);
            $item->forget([
                'account_from',
                'account_to',
                'account_to_name',
                'account_from_name',
                'profile_photo'
            ]);
            return $item->toArray();
        });

        // Pass the data directly to the export route
        return (new TransactionsExport($data))->download('transactions.' . $type);
    }

    public function render()
    {
        if ($this->searchState === false) {
            $transactions = $this->getTransactions();
        } else {
            $transactions = $this->searchTransactions();
        }

        return view('livewire.transactions-table', [
            'transactions' => $transactions,
        ]);
    }
}
