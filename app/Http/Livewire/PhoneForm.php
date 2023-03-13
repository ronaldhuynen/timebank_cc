<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PhoneForm extends Component
{
    public $phoneCodeOptions;
    public $phonecode;
    public $phone;

    /**
     * When component is updated, emit values $phonecode and $phone to parent component
     *
     * @return void
     */
    public function updated()
    {
        $this->emit('phoneToParent', $this->phonecode, $this->phone);
    }

    public function mount()
    {
        $phoneCodeOptions = DB::table('location_countries')->get();
        $this->phoneCodeOptions = $phoneCodeOptions->Map(function ($options, $key) {
                    return [
                        'id' => $options->id,
                        'code' => $options->country_code,
                        'label' => $options->flag . ' +' . $options->phone_code,
                    ];
                });
        $this->phoneCodeOptions->toArray();

        $this->phonecode = $this->phoneCodeOptions[0]['code'];
    }


    public function render()
    {
        return view('livewire.phone-form');
    }
}
