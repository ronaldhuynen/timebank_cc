<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TransactionController;
use App\Mail\TransferReceived;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Stevebauman\Location\Facades\Location as IpLocation;

use WireUi\Traits\WireUiActions;
use function Laravel\Prompts\error;

class Pay extends Component
{
    use WireUiActions;

    public $hours;
    public $minutes;
    public $amount;
    public $fromAccountId;
    public $fromAccountName;
    public $fromAccountBalance;
    public $toAccountId;
    public $toAccountName;
    public $toHolderId;
    public $toHolderName;
    public $toHolderPhoto;
    public $type;
    public $typeOptions = [];
    public $description;
    public $transTypeRadio;
    public $limitError;
    public $requiredError = false;
    public $submitEnabled = false;
    public $modalVisible = false;
    public $modalErrorVisible = false;

    protected $listeners = [
        'amount' => 'amountValidation',
        'fromAccountId',
        'toAccountId',
        'toAccountDetails',
        'description',
        'transTypeRadio',
        'resetForm',
        'removeSelectedAccount',
    ];

    protected $rules = [
        'amount' => 'required|integer|min:1',
        'fromAccountId' => 'required|integer|exists:accounts,id',
        'toAccountId' => 'required|integer',
        'description' => 'required|string|min:3|max:1500',
        'transTypeRadio' => 'required|string|exists:transaction_types,name',
    ];

    public function mount($amount = null, $hours = null, $minutes = null)
    {
        $this->modalVisible = false;

        if ($amount !== null && is_numeric($amount) && $amount > 0) {
            $this->amount = $amount;
        } else {
            $hours = is_numeric($this->hours) ? (int) $this->hours : 0;
            $minutes = is_numeric($this->minutes) ? (int) $this->minutes : 0;
            $this->amount = $hours * 60 + $minutes;
        }
    }

    /**
     * Extra validation when amount looses focus
     *
     * @param  mixed $toAccountId
     * @return void
     */
    public function amountValidation($amount = null)
    {
        $this->amount = $amount ?? $this->amount;
        $this->validateOnly('amount');
    }

    /**
     * Sets fromAccountId after From Account drop down is selected
     *
     * @param  mixed $toAccount
     * @return void
     */
    public function fromAccountId($selectedAccount)
    {
        $this->modalVisible = false;
        $this->fromAccountId = $selectedAccount['id'];
        $this->fromAccountName = $selectedAccount['name'];
        $this->fromAccountBalance = $selectedAccount['balance'];
        $this->validateOnly('fromAccountId');
    }

    /**
     * Sets fromAccountId after To Account drop down is selected
     *
     * @param  mixed $toAccount
     * @return void
     */
    public function toAccountId($toAccountId)
    {
        $this->modalVisible = false;
        $this->toAccountId = $toAccountId;
        $this->validateOnly('toAccountId');
    }

    /**
     * Sets To account details after it is selected
     *
     * @param  mixed $details
     * @return void
     */
    public function toAccountDetails($details)
    {
        if ($details) {
            // Check if we have a to account
            $this->requiredError = false;
            $this->toAccountId = $details['accountId'];
            $this->toAccountName = $details['accountName'];
            $this->toHolderId = $details['holderId'];
            $this->toHolderName = $details['holderName'];
            $this->toHolderPhoto = url($details['holderPhoto']);

            if ($details['holderType'] == 'App\Models\User') {
                $this->typeOptions = ['work', 'gift'];
            } elseif ($details['holderType'] == 'App\Models\Organization') {
                $this->typeOptions = ['work', 'donation'];
            } elseif ($details['holderType'] == 'App\Models\Bank') {
                $this->typeOptions = ['work', 'currency removal'];
            }
            // TODO: Add Currency creation transaction types for banks

            $this->validateOnly('toAccountId');

            $this->dispatch('setTransactionTypeOptions', $this->typeOptions);
        } else {
            // if no to account is present, set id to null and validate so the user received an error
            $this->toAccountId = null;
            $this->validateOnly('toAccountId');
        }
    }

    /**
     * Sets description after it is updated
     *
     * @param  mixed $content
     * @return void
     */
    public function description($description)
    {
        $this->description = $description;
        $this->validateOnly('description');
    }

    /**
     * Sets transTypeRadio after it is updated
     *
     * @param  mixed $content
     * @return void
     */
    public function transTypeRadio($transTypeRadio)
    {
        $this->transTypeRadio = $transTypeRadio;
        $this->validateOnly('transTypeRadio');
    }

    public function showModal()
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $errors) {
            // dump($errors);  //TODO! Replace dump and render error message nicely for user
            $this->validate();
            // Execution stops here if validation fails.
        }

        $fromAccountId = $this->fromAccountId;
        $toAccountId = $this->toAccountId;
        $amount = $this->amount;
        $transactionController = new TransactionController();
        $balanceFrom = $transactionController->getBalance($fromAccountId);
        $balanceTo = $transactionController->getBalance($toAccountId);

        if ($toAccountId === $fromAccountId) {
            return redirect()->back()->with('error', 'You cannot transfer Hours from and to the same account');
        } else {
            $account_exists = Account::where('id', $toAccountId)->first();
            if (!$account_exists) {
                return redirect()->back()->with('error', 'Account not found.');
            } else {
                $transferToAccount = $account_exists->id;
            }

            $f = Account::where('id', $fromAccountId)->select('limit_min')->first();
            $limitMinFrom = $f->limit_min;
            $t = Account::where('id', $transferToAccount)->select('limit_max')->first();
            $limitMaxTo = $t->limit_max;

            $transferBudgetFrom = $balanceFrom - $limitMinFrom;
            $transferBudgetTo = $limitMaxTo - $balanceTo;

            if ($amount > $transferBudgetFrom && $amount > $transferBudgetTo && $transferBudgetFrom <= $transferBudgetTo) {
                $this->limitError = 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Maximum transfer amount possible: ' . tbFormat($transferBudgetFrom);
                return $this->modalErrorVisible = true;
            }
            if ($amount > $transferBudgetFrom && $amount > $transferBudgetTo && $transferBudgetFrom > $transferBudgetTo) {
                $this->limitError = 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Moreover, it would also exceed the maximum balance of the receiving account. Maximum transfer amount possible: ' . tbFormat($transferBudgetTo);
                return $this->modalErrorVisible = true;
            }
            if ($amount > $transferBudgetFrom) {
                $this->limitError = 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Maximum transfer amount possible: ' . tbFormat($transferBudgetFrom);
                return $this->modalErrorVisible = true;
            }
            if ($amount > $transferBudgetTo) {
                $this->limitError = 'Sorry, this transfer would exceed the maximum balance of the receiving account. Maximum transfer amount possible: ' . tbFormat($transferBudgetTo);
                return $this->modalErrorVisible = true;
            }

            $this->modalVisible = true;
        }
    }

    /**
     * Create transfer, output success / error message and reset from.
     *
     * @return void
     */
    public function doTransfer()
    {
        $fromAccountId = $this->fromAccountId;
        $toAccountId = $this->toAccountId;
        $amount = $this->amount;
        $description = $this->description;
        $transType = $this->transTypeRadio;

        // NOTICE: Livewire public properties can be changed / hacked on the client side!
        // Check therefore check again ownership of the fromAccountId.
        // The getAccountsInfo() from the AccountInfoTrait checks the active profile sessions.
        $transactionController = new TransactionController();
        $accountsInfo = collect($transactionController->getAccountsInfo());
        // Check if the session's active profile owns the submitted fromAccountId
        if (!$accountsInfo->contains('id', $fromAccountId)) {
            $warningMessage = 'Unauthorized account payment attempt:  illegal access of From account';
            return $this->logAndReport($warningMessage, $fromAccountId, $toAccountId);
        }

        // Check if From and To Account is different 
        if ($toAccountId === $fromAccountId) {            
            $warningMessage = 'Impossible account payment attempt: To and From account are the same';
            return $this->logAndReport($warningMessage, $fromAccountId, $toAccountId);
        }

        // Check if the To Account exists
        $account_exists = Account::where('id', $toAccountId)->first();
        if (!$account_exists) {
            $warningMessage = 'Impossible account payment attempt: To account not found';
            return $this->logAndReport($warningMessage, $fromAccountId, $toAccountId);
        }

        $transferToAccount = $account_exists->id;

        $f = Account::where('id', $fromAccountId)->select('limit_min')->first();
        $limitMinFrom = $f->limit_min;
        $t = Account::where('id', $transferToAccount)->select('limit_max')->first();
        $limitMaxTo = $t->limit_max;
        
        $balanceFrom = $transactionController->getBalance($fromAccountId);
        $balanceTo = $transactionController->getBalance($toAccountId);

        $transferBudgetFrom = $balanceFrom - $limitMinFrom;
        $transferBudgetTo = $limitMaxTo - $balanceTo;

        // TODO: Line breaks in error message of modal
        // TODO: Translation keys
        if ($amount > $transferBudgetFrom && $amount > $transferBudgetTo && $transferBudgetFrom <= $transferBudgetTo) {
            $this->limitError = 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Maximum transfer amount possible: ' . tbFormat($transferBudgetFrom);
            return $this->modalErrorVisible = true;
        }
        if ($amount > $transferBudgetFrom && $amount > $transferBudgetTo && $transferBudgetFrom > $transferBudgetTo) {
            $this->limitError = 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Moreover, it would also exceed the maximum balance of the receiving account. Maximum transfer amount possible: ' . tbFormat($transferBudgetTo);
            return $this->modalErrorVisible = true;
        }
        if ($amount > $transferBudgetFrom) {
            $this->limitError = 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Maximum transfer amount possible: ' . tbFormat($transferBudgetFrom);
            return $this->modalErrorVisible = true;
        }
        if ($amount > $transferBudgetTo) {
            $this->limitError = 'Sorry, this transfer would exceed the maximum balance of the receiving account. Maximum transfer amount possible: ' . tbFormat($transferBudgetTo);
            return $this->modalErrorVisible = true;
        }

        $transactionType = TransactionType::where('name', $transType)->first();
        $transactionTypeId = $transactionType ? $transactionType->id : 1;

        $transfer = new Transaction();
        $transfer->from_account_id = $fromAccountId;
        $transfer->to_account_id = $transferToAccount;
        $transfer->amount = $amount;
        $transfer->description = $description;
        $transfer->transaction_type_id = $transactionTypeId;
        $transfer->creator_user_id = Auth::user()->id;
        $save = $transfer->save();
        if ($save) {
            // WireUI notification
            $this->notification()->success($title = __('Transfer complete!'), $description = tbFormat($amount) . __('was paid to the ') . $this->toAccountName . __(' of ') . $this->toHolderName . '.' . '<br /><br />' . '<a href="' . route('transaction.show', ['transactionId' => $transfer->id]) . '">' . __('Show Transaction # ') . $transfer->id . '</a>');

            $this->dispatch('resetForm');

            //Send TransferReceived mail
            $now = now();
            Mail::to($transfer->accountTo->accountable)->later($now->addSeconds(1), new TransferReceived($transfer));
        } else {
            // WireUI notification
            $this->notification()->error($title = __('Transfer failed!'), $description = __('Sorry, we have an error: the transfer was not saved!'));
            // TODO: send email with error info to admin and also log this event

            return back();
        }
    }

    private function logAndReport($warningMessage, $fromAccountId, $toAccountId, )
    {
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
            'fromAccountId' => $fromAccountId,
            'fromAccountHolder' => Account::find($fromAccountId)->accountable()->value('name'),
            'toAccountId' => $toAccountId,
            'toAccountHolder' => Account::find($toAccountId)->accountable()->value('name'),
            'userId' => Auth::id(),
            'userName' => Auth::user()->name,
            'activeProfileId' => session('activeProfileId'),
            'activeProfileType' => session('activeProfileType'),
            'activeProfileName' => session('activeProfileName'),
            'IP address' => $ip,
            'IP location' => $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName,
            'Event Time' => $eventTime,
        ]);
        Mail::raw(
            $warningMessage . '.' . "\n\n" . 
            'From Account ID: ' . $fromAccountId . "\n" . 
            'From Account Holder: ' . Account::find($fromAccountId)->accountable()->value('name') . "\n" . 
            'To Account ID: ' . $toAccountId . "\n" . 
            'To Account Holder: ' . Account::find($toAccountId)->accountable()->value('name') . "\n" . 
            'User ID: ' . Auth::id() . "\n" . 'User Name: ' . Auth::user()->name . "\n" . 
            'Active Profile ID: ' . session('activeProfileId') . "\n" . 
            'Active Profile Type: ' . session('activeProfileType') . "\n" . 
            'Active Profile Name: ' . session('activeProfileName') . "\n" .
            'IP address: ' . $ip . "\n" .
            'IP location: ' . $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName . "\n" . 
            'Event Time: ' . $eventTime,
            function ($message) use ($warningMessage) {
                $message->to(config('timebank-cc.mail.system_admin'))->subject($warningMessage);
            },
        );

        return redirect()
            ->back()
            ->with('error', __($warningMessage) . '. ' . __('This event has been logged and reported to our system administrator') . '.');
    }


    public function resetForm()
    {
        $this->amount = null;
        $this->toAccountId = null;
        $this->toAccountName = null;
        $this->description = null;
        $this->modalVisible = false;
    }

    public function removeSelectedAccount()
    {
        $this->toAccountId = null;
        $this->toAccountName = null;
        $this->toHolderId = null;
        $this->toHolderName = null;
    }

    /**
     * Render the livewire component
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pay');
    }
}
