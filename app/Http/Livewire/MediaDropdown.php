<?php

namespace App\Http\Livewire;

use App\Models\Medium;
use Livewire\Component;

class MediaDropdown extends Component
{
    public $media;
    public $medium;
    public $username;
    public $medium_id;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields()
    {
        $this->medium = '';
        $this->username = '';
    }

    public function store()
    {
        $validatedDate = $this->validate(
            [
                'medium.0' => 'required',
                'username.0' => 'required',
                'medium.*' => 'required',
                'username.*' => 'required',
            ],
            [
                'medium.0.required' => 'medium field is required',
                'username.0.required' => 'Username field is required',
                'medium.*.required' => 'medium field is required',
                'username.*.required' => 'Username field is required',
            ]
        );

        foreach ($this->medium as $key => $value) {
            Medium::create(['medium' => $this->medium[$key], 'username' => $this->username[$key]]);
        }

        $this->inputs = [];

        $this->resetInputFields();

        session()->flash('message', 'medium Added Successfully.');
    }


    public function render()
    {
        $data = Medium::all();
        return view('livewire.media-dropdown', ['data' => $data]);
    }
}
