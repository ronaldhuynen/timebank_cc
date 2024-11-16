<?php

namespace App\Http\Livewire;

use App\Exports\TransactionsExport;
use App\Http\Controllers\TransactionController;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
// use Livewire\Attributes\On;
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
    public $amountType = 'credit/debit';
    public $fromDate;
    public $toDate;
    public $typeOptions = [];
    public $searchTypes = [];
    public $perPage = 15;
    public $sortField;
    public $sortAsc = true;
    public $fromAccountId;

    protected $account;
    protected $transactionsForExport;

    protected $listeners = [
        'fromAccountId',
        'searchTransactions',
        'toAccountDetails' => 'searchAccountDispatched',
        'amount' => 'amountDispatched',
    ];


    protected $rules = [
        'search' => 'nullable|string|min:3|max:100',
        'searchAmount' => 'nullable|integer',
        'fromDate' => 'nullable|date',
        'toDate' => 'nullable|after_or_equal:fromDate',
        'searchTypes' => 'nullable|array',
        'searchTypes.*' => 'integer',
    ];


    protected $messages = [
        'fromDate.date' => 'The from date must be a valid date.',
        'toDate.date' => 'The to date must be a valid date.',
    ];


    public function mount($toAccountType = null)
    {
        // $toAccountType is optional for transactiontables that should show transactions to a certain account during first page load
        $activeProfileType = strtolower(class_basename(session('activeProfileType')));
        $canPay = config('timebank-cc.permissions.' . $activeProfileType . '.payment_types', []);

        if ($toAccountType != null) {
            $canReceive = config('timebank-cc.accounts.' . $toAccountType . '.receiving_types', []);
            // Merge the two transaction type groups to find all available options, use only unique values
            $typeIds = array_unique(array_merge($canPay, $canReceive));
        } else {
            $typeIds = $canPay;
        }

        $this->typeOptions = TransactionType::whereIn('id', $typeIds)->get()->map(function ($type) {
            $type->name = __(ucfirst(strtolower($type->name)));
            return $type;
        });
    }


    public function amountDispatched($amount)
    {
        $this->searchAmount = $amount;
    }


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
    public function getTransactions()
    {
        // Hide the balance column if transactions are skipped because of a search filter
        if (!empty($this->search) ||
            !empty($this->searchAmount) ||
            !empty($this->amountType) ||
            !empty($this->searchAccount ||
            !empty($this->fromDate) ||
            !empty($this->searchTypes))) {
            $this->hideBalance = true;
        } else {
            $this->hideBalance = false;
        }

        $accountId = $this->fromAccountId;
        if (!isset($accountId)) {
            return ;    // return empty if accountId is not set yet
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
        $searchTypes = $this->searchTypes;
        $this->validate();

        // Fetch the account with its accountable relationship
        $account = Account::with(['accountable:id,name,full_name'])->find($accountId);

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

        if ($this->amountType == 'credit' || $this->amountType == 'debit') {
            if ($this->amountType == 'credit') {
                $query->where('to_account_id', $accountId);
            } else {
                $query->where('from_account_id', $accountId);
            }
        }

        if (!empty($fromDate)) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if (!empty($toDate)) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        if (!empty($searchTypes)) {
            $query->whereIn('transaction_type_id', $searchTypes);
        }


        // Paginate the search results
        $transactions = $query
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        // Transform the transactions to include necessary data
        $transactions->getCollection()->transform(function ($t) use ($accountId, $account) {
            $transaction = [
                'trans_id' => $t->id,
                'datetime' => $t->created_at,
                'amount' => $t->amount,
                'c/d' => $t->to_account_id === $accountId ? 'Credit' : 'Debit',
                'account_id' => $account->id,
                'account_name' => $account->name,
                'account_holder_name' => $account->accountable->name,
                'account_holder_full_name' => $account->accountable->full_name,
                'description' => $t->description,
                'type' => $t->transactionType->name ?? '',
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

        // Return the paginated items
        return $transactions;
    }


    public function exportTransactions($type)
    {

        // Hide the balance column if transactions are skipped because of a search filter
        if (!empty($this->search) ||
                    !empty($this->searchAmount) ||
                    !empty($this->searchAccount ||
                    !empty($this->amountType) ||
                    !empty($this->fromDate) ||
                    !empty($this->searchTypes))) {
            $this->hideBalance = true;
        } else {
            $this->hideBalance = false;
        }

        $accountId = $this->fromAccountId;
        if (!isset($accountId)) {
            return ;    // return empty if accountId is not set yet
        }

        $accountId = $this->fromAccountId;

        // Check if accountId is owned by active profile
        $check = $this->checkAccountHolder($accountId);
        if (!$check) {
            return ;
        }

        $this->validate();

        // Fetch the account with its accountable relationship
        $account = Account::with(['accountable:id,name,full_name'])->find($accountId);

        // Build the query
        $query = Transaction::with([
            'accountTo.accountable:id,name,full_name,profile_photo_path',
            'accountFrom.accountable:id,name,full_name,profile_photo_path',
            'transactionType:id,name'
        ])->where(function ($query) use ($accountId) {
            $query->where('to_account_id', $accountId)
                ->orWhere('from_account_id', $accountId);
        });

        // Apply search filters if any
        if (!empty($this->search)) {
            $search = strtolower(trim($this->search));
            $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('accountFrom.accountable', function ($query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(full_name) LIKE ?', ["%{$search}%"]);
                    })
                    ->orWhereHas('accountTo.accountable', function ($query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(full_name) LIKE ?', ["%{$search}%"]);
                    });
            });
        }

        if (!empty($this->searchAccount)) {
            $query->where(function ($query) {
                $query->where('from_account_id', $this->searchAccount)
                    ->orWhere('to_account_id', $this->searchAccount);
            });
        }

        if (!empty($this->searchAmount)) {
            $query->where('amount', $this->searchAmount);
        }

        if ($this->amountType == 'credit' || $this->amountType == 'debit') {
            if ($this->amountType == 'credit') {
                $query->where('to_account_id', $accountId);
            } else {
                $query->where('from_account_id', $accountId);
            }
        }

        if (!empty($this->fromDate)) {
            $query->whereDate('created_at', '>=', $this->fromDate);
        }

        if (!empty($this->toDate)) {
            $query->whereDate('created_at', '<=', $this->toDate);
        }

        if (!empty($this->searchTypes)) {
            $query->whereIn('transaction_type_id', $this->searchTypes);
        }

        // Get all transactions without pagination and balance as this is for export
        // Running balance is not calculated as for accounts with many transactions this would take too long
        // to query and php's time limit would throw an error.
        $transactions = $query->orderBy('created_at', 'desc')->get();

        // Transform the transactions as needed
        $data = $transactions->map(function ($t) use ($account, $accountId) {
            $transaction = [
                'trans_id' => $t->id,
                'datetime' => $t->created_at,
                'amount' => $t->amount,
                'c/d' => $t->to_account_id === $accountId ? 'Credit' : 'Debit',
                'account_id' => $account->id,
                'account_name' => $account->name,
                'account_holder_name' => $account->accountable->name,
                'account_holder_full_name' => $account->accountable->full_name,
                'description' => $t->description,
                'type' => $t->transactionType ? $t->transactionType->name : '',
            ];

            if ($t->to_account_id === $accountId) {
                // Credit transaction details
                $transaction += [
                    'account_from' => $t->from_account_id,
                    'account_counter_id' => $t->from_account_id,
                    'account_from_name' => $t->accountFrom->name ?? '',
                    'account_counter_name' => $t->accountFrom->name ?? '',
                    'relation' => $t->accountFrom->accountable->name ?? '',
                    'relation_full_name' => $t->accountFrom->accountable->full_name ?? '',
                ];
            } else {
                // Debit transaction details
                $transaction += [
                    'account_to' => $t->to_account_id,
                    'account_counter_id' => $t->to_account_id,
                    'account_to_name' => $t->accountTo->name ?? '',
                    'account_counter_name' => $t->accountTo->name ?? '',
                    'relation' => $t->accountTo->accountable->name ?? '',
                    'relation_full_name' => $t->accountTo->accountable->full_name ?? '',
                ];
            }

            return $transaction;
        });

        // Remove unnecessary keys
        $data = $data->map(function ($item) {
            return collect($item)->except([
                'account_from',
                'account_to',
                'account_from_name',
                'account_to_name',
            ])->toArray();
        });

        // Use the TransactionsExport to export data
        return (new TransactionsExport($data))->download('transactions.' . $type);
    }


    private function checkAccountHolder($accountId)
    {
        //TODO: remove test comment for production
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

            return false; // check failed
        }
        return true; // check passed
    }


    /**
     * Logs a warning message and reports it via email to the system administrator.
     *
     * This method logs a warning message with detailed information about the event,
     * including account details, user details, IP address, and location. It also
     * sends an email to the system administrator with the same information.
     */
    private function logAndReport($warningMessage, $accountId, $error = '')
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


    // public function updated()
    // {
    //     $this->resetPage();
    // }


    public function render()
    {
        return view('livewire.transactions-table', [
            'transactions' => $this->getTransactions(),
        ]);
    }
}
