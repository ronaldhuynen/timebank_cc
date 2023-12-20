<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Organization;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Matchish\ScoutElasticSearch\MixedSearch;

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

    public function updatedSearch()
    {
        if (($this->search) == '') {
            $this->searchState = false;    
        } else {
        $this->searchState = true;
        }
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

        
        // Check if $search contains a time format
        if (preg_match('/(\d{1,4}:\d{2})/', $search, $matches)) {
            // Convert $search using tbFormat() helper function
            $searchAmount = dbFormat($matches[0]);            
            // Remove the time-format part from $search
            $search = str_replace($matches[0], '', $search);
        }

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
                        'account_from_name' => $ct->accountFrom->name,
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
                        'account_to_name' => $dt->accountTo->name,
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
        } elseif ($search || isset($searchAmount)) {
            // $searchState is true

            // Remove special characters that conflict with Elesticsearch query from $search

            $search = preg_replace('/[^a-zA-Z0-9\s]/', '', $search);

            if (isset($searchAmount)) {
                // $search contains a time format
               
                if (strlen($search) > 0) {
                $searchQuery = $search . '~ AND ' . $searchAmount;
                } else{
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
                        'account_from_name' => $ct->accountFrom->name,
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
                        'account_to_name' => $dt->accountTo->name,
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
