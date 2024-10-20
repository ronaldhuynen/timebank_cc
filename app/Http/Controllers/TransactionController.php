<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Traits\AccountInfoTrait;

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
