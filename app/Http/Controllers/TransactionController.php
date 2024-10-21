<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\Organization;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\AccountInfoTrait;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use AccountInfoTrait;


    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function pay()
    {
        $toName = null;
        return view('pay.show', compact(['toName']));
    }


    public function payToName($name = null)
    {
        return view('pay.show', compact(['name']));
    }

    public function payAmountToName($hours = null, $minutes = null, $name = null)
    {
        return view('pay.show', compact(['hours', 'minutes', 'name']));
    }

    public function payAmountToNameWithDescr($hours = null, $minutes = null, $name = null, $description = null)
    {
        return view('pay.show', compact(['hours', 'minutes', 'name', 'description']));
    }


    public function doCyclosPayment(Request $request, $minutes = null, $toAccoundId = null, $name =null, $description = null)
    {
        $cyclos_id = $request->query('to');
        // Retrieve the amount from the query and replace comma with dot
        $amountString = $request->query('amount');
        $amountNumeric = (float) str_replace(',', '.', $amountString);
        // Convert the amount to minutes
        $minutes = $amountNumeric * 60;
        $toAccountId = Account::accountsCyclosMember($request->query('to'));
        if (count($toAccountId) > 1 ) {
            // More than 1 account is found with this cyclos_id, do not use accountId but search by name
            // so user can select the proper account from the toAccount component
            $name = $this->getNameByCyclosId($cyclos_id);
        } else {
            $toAccountId = $toAccountId->keys()->first();
        }        
        $description = $request->query('description');

        return view('pay.show', compact(['minutes', 'toAccountId', 'name', 'description']));
    }

    public static function getNameByCyclosId($cyclos_id)
    {
        $user = User::where('cyclos_id', $cyclos_id)->first();
        if ($user) {
            return $user->name;
        }

        $organization = Organization::where('cyclos_id', $cyclos_id)->first();
        if ($organization) {
            return $organization->name;
        }

        $bank = Bank::where('cyclos_id', $cyclos_id)->first();
        if ($bank) {
            return $bank->name;
        }

        return null;
    }

    public function transactions()
    {
        $profileAccounts = $this->getAccountsInfo();

        return view('transactions.show', compact('profileAccounts'));
    }


    public function statement($transactionId)
    {
        $results = Transaction::with('accountTo.accountable', 'accountFrom.accountable')
            ->where('id', $transactionId)
            ->whereHas('accountTo', function ($query) {
                $query->where('accountable_type', Session('activeProfileType'))
                ->where('accountable_id', Session('activeProfileId'));
            })
            ->orWhereHas('accountFrom.accountable', function ($query) {
                $query->where('accountable_type', Session('activeProfileType'))
                ->where('accountable_id', Session('activeProfileId'));
            })
            ->find($transactionId);

        //TODO: add permission check
        //TODO: if 403, but has permission, redirect with message to switch profile
        //TODO: replace 403 with custom redirect page incl explanation

        // Check if the transaction exists
        if ($transactionId) {
            // Pass the transactionId and transaction details to the view
            return view('transactions.statement', compact('transactionId'));
        } else {
            // Abort with a 403 status code if the transaction does not exist
            return abort(403);
        }

    }
}
