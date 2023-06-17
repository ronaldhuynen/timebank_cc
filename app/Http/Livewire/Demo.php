<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Demo extends Component
{
     public $demo;


    public function render() {
        return view(view: 'livewire.demo');
    //         ->layout('layouts.demo-app');   // use special layout for this demo
    }


    // Like constructior
    public function mount(\App\Models\Demo $demo) {
        $this->demo = $demo;
    }


    public function submit() {
        $this->validate();
        $this->demo->save();
    }

    protected function rules(): array {
        return [
            'demo.description' => [
                'required',
                'string',
            ],
        ];
    }
}
