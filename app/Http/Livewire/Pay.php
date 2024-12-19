<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TransactionController;
use App\Mail\TransferReceived;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
    public $toHolderType;
    public $toHolderName;
    public $toHolderPhoto;
    public $type;
    public $typeOptions = [];
    public $description;
    public $transactionTypeSelected;
    public $limitError;
    public $requiredError = false;
    public $submitEnabled = false;
    public $modalVisible = false;
    public $modalErrorVisible = false;

    public $typeOptionsProtected;

    protected $listeners = [
        'amount' => 'amountValidation',
        'fromAccountId',
        'toAccountId',
        'toAccountDetails' => 'toAccountDispatched',
        'description',
        'transactionTypeSelected',
        'resetForm',
        'removeSelectedAccount',
    ];

    protected $rules = [
        'amount' => 'required|integer|min:1',
        'fromAccountId' => 'required|integer|exists:accounts,id',
        'toAccountId' => 'required|integer',
        'description' => 'required|string|min:3|max:1500',
        'transactionTypeSelected.name' => 'required|string|exists:transaction_types,name',
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
    public function toAccountDispatched($details)
    {
        if ($details) {
            // Check if we have a to account
            $this->requiredError = false;
            $this->toAccountId = $details['accountId'];
            $this->toAccountName = __(ucfirst(strtolower($details['accountName'])));
            $this->toHolderId = $details['holderId'];
            $this->toHolderType = $details['holderType'];
            $this->toHolderName = $details['holderName'];
            $this->toHolderPhoto = url($details['holderPhoto']);

            // Look up in config what transaction types are possible / allowed and dispatch
            $canReceive = config('timebank-cc.accounts.' . strtolower(class_basename($details['holderType'])) . '.receiving_types');
            $canPay = config('timebank-cc.permissions.' . strtolower(class_basename(session('activeProfileType'))) . '.payment_types');
            $this->typeOptionsProtected = array_intersect($canPay, $canReceive);
            $this->typeOptions = $this->typeOptionsProtected;
            $this->dispatch('transactionTypeOptions', $this->typeOptions);
        } else {
            // if no to account is present, set id to null and validate so the user received an error
            $this->typeOptions = null;
            $this->dispatch('transactionTypeOptions', $this->typeOptions);
            $this->toAccountId = null;
        }
        $this->validateOnly('toAccountId');
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
     * Sets transactionTypeSelected after it is updated
     *
     * @param  mixed $content
     * @return void
     */
    public function transactionTypeSelected($selected)
    {
        $this->transactionTypeSelected = $selected;
        $this->validateOnly('transactionTypeSelected');
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
            $t = Account::where('id', $transferToAccount)->select('limit_max', 'limit_min')->first();
            $limitMaxTo = $t->limit_max - $t->limit_min;

            $transferBudgetFrom = $balanceFrom - $limitMinFrom;
            if (config('timebank-cc.account_info.' . strtolower(class_basename($this->toHolderType)) . '.balance_public')) {
                $transferBudgetTo = $limitMaxTo - $balanceTo;
                $balanceToPublic = true;
            } else {
                $transferBudgetTo = $limitMaxTo - $balanceTo;
                $balanceToPublic = false;
            }

            $this->checkBalanceLimits($amount, $transferBudgetTo, $transferBudgetFrom, $limitMinFrom, $balanceToPublic);

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
        $transactionTypeId = $this->transactionTypeSelected['id'];

        // NOTICE: Livewire public properties can be changed / hacked on the client side!
        // Check therefore check again ownership of the fromAccountId.
        // The getAccountsInfo() from the AccountInfoTrait checks the active profile sessions.
        $transactionController = new TransactionController();
        $accountsInfo = collect($transactionController->getAccountsInfo());
        // Check if the session's active profile owns the submitted fromAccountId
        if (!$accountsInfo->contains('id', $fromAccountId)) {
            $warningMessage = 'Unauthorized payment attempt: illegal access of From account';
            return $this->logAndReport($warningMessage, $fromAccountId, $toAccountId);
        }

        // Check if From and To Account is different
        if ($toAccountId === $fromAccountId) {
            $warningMessage = 'Impossible payment attempt: To and From account are the same';
            return $this->logAndReport($warningMessage, $fromAccountId, $toAccountId);
        }

        // Check if the To Account exists
        $account_exists = Account::where('id', $toAccountId)->first();
        if (!$account_exists) {
            $warningMessage = 'Impossible payment attempt: To account not found';
            return $this->logAndReport($warningMessage, $fromAccountId, $toAccountId);
        }

        $transferToAccount = $account_exists->id;


        // Check if the To transactionTypeSelected is allowed
        if (!in_array($transactionTypeId, $this->typeOptionsProtected)) {
            $transactionType = TransactionType::find($transactionTypeId)->name ?? 'id: '. $transactionTypeId;
            $warningMessage = 'Impossible payment attempt: transaction type not allowed';
            return $this->logAndReport($warningMessage, $fromAccountId, $toAccountId, $transactionType);
        }


        $f = Account::where('id', $fromAccountId)->select('limit_min')->first();
        $limitMinFrom = $f->limit_min;
        $t = Account::where('id', $transferToAccount)->select('limit_max', 'limit_min')->first();
        $limitMaxTo = $t->limit_max - $t->limit_min;

        $balanceFrom = $transactionController->getBalance($fromAccountId);
        $balanceTo = $transactionController->getBalance($toAccountId);

        $transferBudgetFrom = $balanceFrom - $limitMinFrom;
        if (config('timebank-cc.account_info.' . strtolower(class_basename($this->toHolderType)) . '.balance_public')) {
            $transferBudgetTo = $limitMaxTo - $balanceTo;
            $balanceToPublic = true;
        } else {
            $transferBudgetTo = $limitMaxTo - $balanceTo;
            $balanceToPublic = false;
        }

        // Check balance limits
        $this->checkBalanceLimits($amount, $transferBudgetTo, $transferBudgetFrom, $limitMinFrom, $balanceToPublic);

        // Use a database transaction for saving the payment
        DB::beginTransaction();
        try {

            $transfer = new Transaction();
            $transfer->from_account_id = $fromAccountId;
            $transfer->to_account_id = $transferToAccount;
            $transfer->amount = $amount;
            $transfer->description = $description;
            $transfer->transaction_type_id = $transactionTypeId;
            $transfer->creator_user_id = Auth::user()->id;
            $save = $transfer->save();

            // TODO: remove testing comment for production
            // Uncomment to test a failed transaction
            //$save = false;

            if ($save) {
                // Commit the database transaction
                DB::commit();
                // WireUI notification
                $this->notification()->success($title = __('Transaction done!'), $description = tbFormat($amount) . __('was paid to the ') . $this->toAccountName . __(' of ') . $this->toHolderName . '.' . '<br /><br />' . '<a href="' . route('transaction.show', ['transactionId' => $transfer->id]) . '">' . __('Show Transaction # ') . $transfer->id . '</a>');
                $this->dispatch('resetForm');

                           

                // Send TransferReceived mail if conditions are met
                $recipient = $transfer->accountTo->accountable;

                // Check if the recipient has message settings and an email address
                if (method_exists($recipient, 'message_settings')) {
                    $messageSettings = $recipient->message_settings()->first();

                    if ($messageSettings && $messageSettings->payment_received) {
                        // Ensure the recipient has an email attribute
                        if (isset($recipient->email)) {
                            $now = now();
                            Mail::to($recipient->email)->later($now->addSeconds(2), new TransferReceived($transfer));
                        }
                    }
                }

            } else {
                throw new \Exception('Transaction could not be saved');

            }
        } catch (\Exception $e) {
            DB::rollBack();

            // WireUI notification
            $this->notification()->send([
                'title' => __('Transaction failed') . '!',
                'description' => __('Sorry we have an error: this transaction could not be saved!') . '<br /><br />' . __('Our team has been notified. Please try again later.') . '<br /><br />' . __('Error') . ': ' . $e->getMessage(),
                'icon' => 'error',
                'timeout' => 50000
            ]);

            $warningMessage = 'Transaction failed';
            $this->logAndReport($warningMessage, $fromAccountId, $toAccountId, $e);

            $this->resetForm();

            return back();
        }
    }


    /**
     * Check balance limits for a transfer operation.
     *
     * This method checks if the transfer amount exceeds the allowed budget limits
     * for both the source and destination accounts. It sets an appropriate error
     * message and makes the error modal visible if any limit is exceeded.
     */
    private function checkBalanceLimits($amount, $transferBudgetTo, $transferBudgetFrom, $limitMinFrom, $balanceToPublic)
    {
        if ($amount > $transferBudgetFrom && $amount > $transferBudgetTo && $transferBudgetFrom <= $transferBudgetTo) {
            $this->limitError = __('messages.pay_limit_error_budget_from', [
                        'limitMinFrom' => tbFormat($limitMinFrom),
                        'transferBudgetFrom' => tbFormat($transferBudgetFrom),
                    ]);
            return $this->modalErrorVisible = true;
        }
        if ($amount > $transferBudgetFrom && $amount > $transferBudgetTo && $transferBudgetFrom > $transferBudgetTo) {
            if ($balanceToPublic) {
                $this->limitError = __('messages.pay_limit_error_budget_from_and_to', [
                        'limitMinFrom' => tbFormat($limitMinFrom),
                        'transferBudgetTo' => tbFormat($transferBudgetTo),
                    ]);
            } else {
                $this->limitError = __('messages.pay_limit_error_budget_from_and_to_without_budget_to', [
                                'limitMinFrom' => tbFormat($limitMinFrom),
                            ]);
            }
            return $this->modalErrorVisible = true;
        }
        if ($amount > $transferBudgetFrom) {
            $this->limitError = __('messages.pay_limit_error_budget_from', [
                        'limitMinFrom' => tbFormat($limitMinFrom),
                        'transferBudgetFrom' => tbFormat($transferBudgetFrom),
                    ]);
            return $this->modalErrorVisible = true;
        }
        if ($amount > $transferBudgetTo) {
            if ($balanceToPublic) {
                $this->limitError = __('messages.pay_limit_error_budget_to', [
                    'transferBudgetTo' => tbFormat($transferBudgetTo),
                ]);
            } else {
                $this->limitError = __('messages.pay_limit_error_budget_to_without_budget_to', [
                    'transferBudgetTo' => tbFormat($transferBudgetTo),
                    'toHolderName' => $this->toHolderName,
                ]);
            }
            return $this->modalErrorVisible = true;
        }
        $this->limitError = null;
    }


    /**
     * Logs a warning message and reports it via email to the system administrator.
     *
     * This method logs a warning message with detailed information about the event,
     * including account details, user details, IP address, and location. It also
     * sends an email to the system administrator with the same information.
     */
    private function logAndReport($warningMessage, $fromAccountId, $toAccountId, $transactionType = '', $error = '')
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
            'transactionType' => ucfirst($transactionType),
            'IP address' => $ip,
            'IP location' => $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName,
            'Event Time' => $eventTime,
            'Message' => $error,
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
            'Transaction Type: ' . ucfirst($transactionType) . "\n" .
            'IP address: ' . $ip . "\n" .
            'IP location: ' . $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName . "\n" .
            'Event Time: ' . $eventTime . "\n\n" .
            $error,
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
