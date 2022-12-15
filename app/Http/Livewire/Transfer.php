<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TransactionController;
use App\Mail\TransferReceived;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use WireUi\Traits\Actions;


class Transfer extends Component
{
    use Actions;

    public $amount;
    public $fromAccountId;
    public $toAccountId;
    public $toAccountName;
    public $toHolderId;
    public $toHolderName;
    public $description;
    public $requiredError = false;
    public $submitEnabled = false;
    public $modalVisible = false;

    protected $listeners = [
        'amount',
        'fromAccountId',
        'toAccountDetails',
        'description',
        'resetForm',
        'toAccountValidation'
    ];

    protected $rules = [
        'amount' => 'required|regex:/^\d*:[0-5]\d$/',
        'toAccountId' => 'required',
        'description' => 'required|string|min:3|max:1500'
    ];


    protected $messages = [
        'amount.regex' => 'The amount should be positive and in hh:mm format. For example 90 minutes is 1:30.',
    ];


    /**
      * Sets amount after it is selected in livewire amount component
      *
      * @param  mixed $amount
      * @return void
      */
    public function amount($amount)
    {
        $this->amount = $amount;
        $this->validateOnly('amount');
    }


    /**
     * Sets fromAccountId after From Account drop down is selected
     *
     * @param  mixed $fromAccount
     * @return void
     */
    public function fromAccountId($fromAccount)
    {
        $this->fromAccountId = $fromAccount;
    }


    /**
     * Sets toAccountSelected after From Account drop down is selected
     *
     * @param  mixed $toAccount
     * @return void
     */
    public function toAccountSelected($toAccount)
    {
        $this->validateOnly('toAccountId');
        $this->toAccountSelected = $toAccount;
    }


     /**
     * Sets To account details after it is selected
     *
     * @param  mixed $details
     * @return void
     */
    public function toAccountDetails($details)
    {
        $this->requiredError = false;
        $this->toAccountId = $details['accountId'];
        $this->toAccountName = $details['accountName'];
        $this->toHolderId = $details['holderId'];
        $this->toHolderName = $details['holderName'];
    }


    /**
     * Extra validation when search field lost focus
     *
     * @param  mixed $toAccountId
     * @return void
     */
    public function toAccountValidation($toAccountId = null)
    {
        if ($toAccountId === null) {
            $this->requiredError = true;
        } else {
            $this->requiredError = false;
        }
        // TODO create also a validation error when from and to account is equal!!
    }

       /**
     * Sets description after it is updated
     *
     * @param  mixed $content
     * @return void
     */
    public function description($content)
    {
        $this->description = $content;
        $this->validateOnly('description');
    }


    /**
    * Shows the transfer confirmation modal after a 2nd and complete validation
    *
    * @return void
    */
    public function confirmModal()
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $errors) {
            // dump($errors);
            $this->validate();
            // Execution stops here if validation fails.
        }
        $this->modalVisible = true;
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
        $amount = dbFormat($this->amount);
        $description = $this->description;

        $transactions = new TransactionController();
        $balanceFrom = $transactions->getBalance($fromAccountId);
        $balanceTo = $transactions->getBalance($toAccountId);

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

            // TODO ONDERSTAANDE VALIDATIES WERKEN NOG NIET!
            // transactie wordt niet uitgevoerd, maar foutmelding is niet getoond.


            if ($amount > $transferBudgetFrom && $amount > $transferBudgetTo && $transferBudgetFrom <= $transferBudgetTo) {
                info('Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Maximum transfer amount possible: ' . tbFormat($transferBudgetFrom));
                return redirect()->back()->with('error', 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Maximum transfer amount possible: ' . tbFormat($transferBudgetFrom));
            }
            if ($amount > $transferBudgetFrom && $amount > $transferBudgetTo && $transferBudgetFrom > $transferBudgetTo) {
                info('Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Moreover, it would also exceed the maximum balance of the receiving account. Maximum transfer amount possible: ' . tbFormat($transferBudgetTo));
                return redirect()->back()->with('error', 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Moreover, it would also exceed the maximum balance of the receiving account. Maximum transfer amount possible: ' . tbFormat($transferBudgetTo));
            }
            if ($amount > $transferBudgetFrom) {
                info('Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Maximum transfer amount possible: ' . tbFormat($transferBudgetFrom));
                return redirect()->back()->with('error', 'Sorry, your balance (' . tbFormat($balanceFrom) . ') is too low for this transfer. Your balance can not go below ' . tbFormat($limitMinFrom) . '. Maximum transfer amount possible: ' . tbFormat($transferBudgetFrom));
            }
            if ($amount > $transferBudgetTo) {
                info('Sorry, this transfer would exceed the maximum balance of the receiving account. Maximum transfer amount possible: ' . tbFormat($transferBudgetTo));
                return redirect()->back()->with('error', 'Sorry, this transfer would exceed the maximum balance of the receiving account. Maximum transfer amount possible: ' . tbFormat($transferBudgetTo));
            }


            $transfer = new Transaction();
            $transfer->from_account_id = $fromAccountId;
            $transfer->to_account_id = $transferToAccount;
            $transfer->amount = $amount;
            $transfer->description = $description;
            $transfer->creator_user_id = Auth::user()->id;
            $save = $transfer->save();
            if ($save) {

                // WireUI notification
                $this->notification()->success(
                    $title = __('Transfer complete!'),
                    $description = tbFormat($amount) . __('was paid to the ') . $this->toAccountName . __(' of ') . $this->toHolderName . '.' . '<br /><br />'. '<a href="' . route('transaction.show', ['transactionId' => $transfer->id]) . '">' . __('Show Transaction # ') . $transfer->id . '</a>'
                );

                $this->emit('resetForm');

                //Send TransferReceived mail
                $now = now();
                Mail::to($transfer->accountTo->accountable)->later(
                    $now->addSeconds(1),
                    new TransferReceived($transfer)
                );
            } else {

                // WireUI notification
                $this->notification()->error(
                    $title = __('Transfer failed!'),
                    $description = __('Oops, we have an error: the transfer was not saved!')
                );

                return back();
            }
        }
    }


    public function resetForm()
    {
        $this->amount = null;
        $this->toAccountId = null;
        $this->toAccountName = null;
        $this->description = null;
        $this->modalVisible = false;
    }



    /**
       * Render the livewire component
       *
       * @return void
       */
    public function render()
    {
        return view('livewire.transfer');
    }
}
