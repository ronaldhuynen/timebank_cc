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


    public function transfer()
    {
        return view(
            'transfer.show',
        );
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
        return ($results != null ? view('transactions.statement', compact(['transactionId'])) : abort(403));
    }
}
