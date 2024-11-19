<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
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
            // TODO: redirect to public custom page with more info
            abort(403, 'Unauthorized action.');
        }

                $transaction[] = [
                    'trans_id' => $results->id,
                    'amount' => $results->amount,
                    'from_account' => $results->accountFrom->name,
                    'from_relation_path' => URL::to('/') . '/' . strtolower(class_basename($fromType)) .  '/' . $results->accountFrom->accountable->id,
                    'from_relation_name' => $results->accountFrom->accountable->name,
                    'from_relation_full_name' => $results->accountFrom->accountable->full_name,
                    'from_relation_location' => $results->accountFrom->accountable->getLocationFirst()['name_short'],
                    'from_profile_photo' => $results->accountFrom->accountable->profile_photo_path,
                    'to_account' => $results->accountTo->name,
                    'to_relation_path' => URL::to('/') . '/' . strtolower(class_basename($toType)) .  '/' . $results->accountTo->accountable->id,
                    'to_relation_name' => $results->accountTo->accountable->name,
                    'to_relation_full_name' => $results->accountTo->accountable->full_name,
                    'to_relation_location' => $results->accountTo->accountable->getLocationFirst()['name_short'],
                    'to_profile_photo' => $results->accountTo->accountable->profile_photo_path,
                    'description' => $results->description,
                    'type_label' => $results->transactionType->label ?? '',
                    'type_icon' => $results->transactionType->icon ?? '',
                    'creator_user' => $results->creator_user_id ? $this->getCreatorUser($results->creator_user_id) : '',
                    'datetime' => $results->created_at,
                ];

        return Arr::collapse($transaction);
    }


    public function getCreatorUser($id)
    {
        if($id) {
        $model = User::find($id);
        $creator = [
            'name' => $model->name,
            'full_name' => $model->full_name,
            'path' => URL::to('/') . '/' . 'user' .  '/' . $id,
        ];
        } 
        
        return $creator;
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

