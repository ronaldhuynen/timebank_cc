<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TransactionTypeRadio extends Component
{
    public $type;
    public $typeOptions;
    public $transTypeRadio = 'work';

    protected $listeners = ['setTransactionTypeOptions'];


    public function mount($type = null)
    {
        if ($type) {
            $transType = ($type == 'w' || $type == 1) ? 'work' : $this->transTypeRadio; // default value ('work')
            $transType = ($type == 'g' || $type == 2) ? 'gift' : $this->transTypeRadio;
            $transType = ($type == 'd' || $type == 3) ? 'donation' : $this->transTypeRadio;            
  
            if ($transType) {
                $this->transTypeRadio = $transType;
            }
        }
        $this->updated();
    }


    public function updated()
    {
        $this->dispatch('transTypeRadio', $this->transTypeRadio);
    }


    public function setTransactionTypeOptions($typeOptions)
    {
        $this->typeOptions = $typeOptions;
    }


    public function render()
    {
        return view('livewire.transaction-type-radio');
    }
}
