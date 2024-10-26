<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SingleTransactionTable extends Component
{
    // public $singleTransaction = [];
    public $balance = 0;
    public $transaction;
    public $qrModalVisible = false;
    public $transactionId;

    public function mount($transactionId)
    {
        $this->transactionId = $transactionId;
        $this->getTransaction($transactionId);
    }

    public function getTransaction()
    {
        $results = Transaction::with('accountTo.accountable', 'accountFrom.accountable', 'transactionType')->findOrFail($this->transactionId);
        
        $fromType = get_class($results->accountFrom->accountable);
        $toType = get_class($results->accountTo->accountable);
        $fromId = $results->accountFrom->accountable->id;
        $toId = $results->accountTo->accountable->id;

        

// Check if the user is authorized to view the transaction
if (
    !in_array(Session::get('activeProfileType'), [$fromType, $toType]) ||
    !in_array(Session::get('activeProfileId'), [$fromId, $toId])
) {
    abort(403, 'Unauthorized action.');
}



                $transaction[] = [
                    'trans_id' => $results->id,
                    'amount' => $results->amount,
                    'from_account' => $results->accountFrom->name,
                    'from_relation' => $results->accountFrom->accountable->name,
                    'from_profile_photo' => $results->accountFrom->accountable->profile_photo_path,
                    'to_account' => $results->accountTo->name,
                    'to_relation' => $results->accountTo->accountable->name,
                    'to_profile_photo' => $results->accountTo->accountable->profile_photo_path,
                    'description' => $results->description,
                    'type' => $results->transactionType->name ?? 'work',
                    'datetime' => $results->created_at,
                ];

        return Arr::collapse($transaction);
    }


    public function qrModal()
    {
        $this->qrModalVisible = true;
    }

    public function render()
    {
        $this->transaction = $this->getTransaction();
        return view('livewire.single-transaction-table');
    }
}

