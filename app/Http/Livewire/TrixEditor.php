<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TrixEditor extends Component
{
    public $value;
    public $trixId;

    protected $listeners = ['showModal', 'resetModal'];


    public function mount()
    {
        $this->trixId = 'trix-' . uniqid();
        $this->value = "";
    }


    public function showModal($value = '')
    {
        $this->value = $value;
    }


    public function resetModal()
    {
        $this->reset();
    }

    public function updatingValue($value)
    {
        $this->emit('trixEditor', $value);
    }


    public function render()
    {
        return view('livewire.trix-editor');
    }
}
