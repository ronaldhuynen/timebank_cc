<?php

namespace App\Http\Livewire;

use App\Models\TransactionType;
use Livewire\Component;

class TransactionTypeRadio extends Component
{
    public $type;
    public $typeOptions;
    public $transactionTypeSelected;

    protected $listeners = ['transactionTypeOptions' => 'transactionTypeOptionsDispatched'];


    public function mount($type = null)
    {
        if ($type) {
            $typeSelected = ($type == 'worked time' || $type == 1) ? 'worked time' : $this->transactionTypeSelected; 
            $typeSelected = ($type == 'gift' || $type == 2) ? 'gift' : $this->transactionTypeSelected;
            $typeSelected = ($type == 'donation' || $type == 3) ? 'donation' : $this->transactionTypeSelected;            

            if ($typeSelected) {
                $this->transactionTypeSelected = $typeSelected;
            }
        }
        $this->updated();
    }


    public function updated()
    {
        $selected = TransactionType::where('name', $this->transactionTypeSelected)->first();
        $this->dispatch('transactionTypeSelected', $selected);
    }


    public function transactionTypeOptionsDispatched($typeOptions)
    {
        if ($typeOptions == null) {
            $this->reset('typeOptions');
            $this->reset('transactionTypeSelected');
        } else {
            $this->typeOptions = TransactionType::find($typeOptions);
            
            // Check if 'worked time' exists in the options and pres-select this option
            $workedTimeOption = $this->typeOptions->firstWhere('name', 'worked time');
         if ($workedTimeOption) {
                $this->transactionTypeSelected = 'worked time';
            } else {
                // Optionally set to the first available option
                $this->transactionTypeSelected = $this->typeOptions->first()->name ?? null;
            }

        }
        $this->updated();
    }



    public function render()
    {
        return view('livewire.transaction-type-radio');
    }
}
