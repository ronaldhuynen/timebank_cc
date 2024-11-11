<?php

namespace App\Http\Livewire;

use App\Exports\TransactionsExport;
use App\Http\Controllers\TransactionController;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Stevebauman\Location\Facades\Location as IpLocation;

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

    protected $account;
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


    // public function mount()
    // {
    //     $this->resetPage();
    // }


    public function amountDispatched($amount)
    {
        $this->searchAmount = $amount;
    }


    // public function updatingPerPage()
    // {
    //     $this->resetPage();
    // }


    public function fromAccountId($selectedAccount)
    {
        $this->fromAccountId = $selectedAccount['id'];
    }


    public function searchAccountDispatched($accountDetails)
    {
        $this->searchAccount = $accountDetails['accountId'];
    }


    /**
     * Get all transactions with running balance.
     * Returns a paginator object that only loads the transactions for the selected page.
     *
     * IMPORTANT: This method requires MySQL 8.0+ or MariaDB 10.2+ for window function support.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getTransaction2s()
    {
        $accountId = $this->fromAccountId;
        if(!isset($accountId)) {
            return ;    // return empty if accountId is not set yet
        }   

        // Check if accountId is owned by active profile
        $check = $this->checkAccountHolder($accountId);
        if (!$check) {
            return ;
        }

        // Fetch the account with its accountable relationship
        $this->account = Account::with(['accountable:id,name,full_name'])->find($accountId);

        // Use window function to calculate running balance for each transaction
        // This function requires MySQL 8.0+ or MariaDB 10.2+ for window function support.
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
        $transactions->getCollection()->transform(function ($t) use ($accountId, $this->account) {
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

        $accountId = $this->fromAccountId;

        // Check if accountId is owned by active profile
        $check = $this->checkAccountHolder($accountId);
        if (!$check) {
            return ;
        }
        $search = $this->search;
        $searchAccount = $this->searchAccount;
        $searchAmount = $this->searchAmount !== null ? $this->searchAmount : null;
        $fromDate = $this->fromDate;
        $toDate = $this->toDate;
        $this->validate();

         // Fetch the account with its accountable relationship
        $this->account = Account::with(['accountable:id,name,full_name'])->find($accountId);

        // Use window function to calculate running balance for each transaction
        // This function requires MySQL 8.0+ or MariaDB 10.2+ for window function support.
        $query = Transaction::selectRaw("
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

      
        // Perform the search directly in the database query
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
        $transactions = $query
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
       
        // Transform the transactions to include necessary data
        $transactions->getCollection()->transform(function ($t) use ($accountId, $this->account) {
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


    private function checkAccountHolder($accountId)
    {        
        //TODO: remove test for production
        //Uncomment below  to test Log and Report
        // $accountId = 999999;

        // NOTICE: Livewire public properties can be changed / hacked on the client side!
        // Check therefore check again ownership of the fromAccountId.
        // The getAccountsInfo() from the AccountInfoTrait checks the active profile sessions.
        $transactionController = new TransactionController();
        $accountsInfo = collect($transactionController->getAccountsInfo());

        // Check if the session's active profile owns the submitted fromAccountId
        if (!$accountsInfo->contains('id', $accountId)) {
            $warningMessage = 'Unauthorized transactions table access attempt';
            $this->logAndReport($warningMessage, $accountId);

            return false;
        }
    }


    /**
     * Logs a warning message and reports it via email to the system administrator.
     *
     * This method logs a warning message with detailed information about the event,
     * including account details, user details, IP address, and location. It also
     * sends an email to the system administrator with the same information.
     */
    private function logAndReport($warningMessage, $accountId, $error = '' )
    {
        $account = Account::find($accountId);
        $accountHolder = $account ? $account->accountable()->value('name') : '';

        $ip = request()->ip();    
        $ipLocationInfo = IpLocation::get($ip);        
        
        // Escape ipLocation errors when not in production
        if (!$ipLocationInfo || App::environment(['local', 'development', 'staging'])) {
            $ipLocationInfo = (object) [
                'cityName' => 'local City',
                'regionName' => 'local Region',
                'countryName' => 'local Country',
            ];
        }
        $eventTime = now()->toDateTimeString();
        
        // Log this event and mail to admin
        Log::warning($warningMessage, [
            'accountId_notOwnedByActiveProfile' => $accountId,
            'accountHolder' => $accountHolder,
            'userId' => Auth::id(),
            'userName' => Auth::user()->name,
            'activeProfileId' => session('activeProfileId'),
            'activeProfileType' => session('activeProfileType'),
            'activeProfileName' => session('activeProfileName'),
            'IP address' => $ip,
            'IP location' => $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName,
            'Event Time' => $eventTime,
            'Message' => $error,
        ]);
        Mail::raw(
            $warningMessage . '.' . "\n\n" . 
            'Account ID (not owned by active profile): ' . $accountId . "\n" . 
            'Account Holder: ' . $accountHolder . "\n" . 
            'User ID: ' . Auth::id() . "\n" . 'User Name: ' . Auth::user()->name . "\n" . 
            'Active Profile ID: ' . session('activeProfileId') . "\n" . 
            'Active Profile Type: ' . session('activeProfileType') . "\n" . 
            'Active Profile Name: ' . session('activeProfileName') . "\n" .
            'IP address: ' . $ip . "\n" .
            'IP location: ' . $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName . "\n" . 
            'Event Time: ' . $eventTime . "\n\n" .
            $error,
            function ($message) use ($warningMessage) {
                $message->to(config('timebank-cc.mail.system_admin'))->subject($warningMessage);
            },
        );

        session()->flash('error', __($warningMessage) . '. ' . __('This event has been logged and reported to our system administrator') . '.');
    }
    

    public function updated()
    {
        $this->resetPage();
    }


    public function render()
    {
        // if ($this->searchState === false) {
        //     $transactions = $this->getTransactions();
        // } else {
        //     $transactions = $this->searchTransactions();
        // }
        $transactions = $this->searchTransactions();
        // $transactions = $this->getTransactions();


        return view('livewire.transactions-table', [
            'transactions' => $transactions,
        ]);
    }
}
