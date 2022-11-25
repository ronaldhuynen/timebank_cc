<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Description extends Component
{
    public $description;
    public $requiredError = false;

    protected $listeners = ['resetForm'];


    /**
     * Extra check if field is empty on blur textarea
     *
     * @return void
     */
    public function checkRequired()
    {

        $this->emit('description', $this->description);

        if ($this->description === null || '')
        {
            $this->requiredError = true;
        }
    }


    public function resetForm()
    {
        $this->description = null;
    }

    public function updated()
    {
        // try {
        //     $this->validateOnly('description');
        // } catch (\Illuminate\Validation\ValidationException $errors) {
        //     $this->requiredError = true;
        //     $this->validateOnly('description');
        // }
        // // Execution stops here if validation fails.
        // $this->requiredError = false;
        $this->emit('description', $this->description);

    }


    public function render()
    {
        return view('livewire.description');
    }
}
