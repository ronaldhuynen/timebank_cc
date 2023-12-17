<?php

namespace App\Http\Livewire;

use App\Models\Social;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SocialsForm extends Component
{
    public $socialsOptions;
    public $socialsOptionSelected;
    public $socials;
    public $userOnSocial;
    public $serverOfSocial;
    public $sociables_id;
    public $updateMode = false;
    public $selectedPlaceholder;


    private function resetInputFields()
    {
        $this->reset(['updateMode', 'socialsOptionSelected', 'userOnSocial', 'serverOfSocial']);
    }

    public function mount()
    {
        $this->socialsOptions = Social::select("*")->orderBy("name")->get();
        $this->getSocials();
    }

    public function getSocials()
    {
        $this->socials = session('activeProfileType')::find(session('activeProfileId'))->socials;
    }

    public function store()
    {
        $validatedSocial = $this->validate([
            'socialsOptionSelected' => 'required|integer',
            'userOnSocial' => 'required|string|max:150',
        ]);

        DB::table('sociables')->insert([
            'social_id' => $this->socialsOptionSelected,
            'sociable_type' => session('activeProfileType'),
            'sociable_id' => session('activeProfileId'),
            'user_on_social' => str_replace('@', '', $this->userOnSocial),
            'server_of_social' => str_replace('@', '', $this->serverOfSocial),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
           ]);
        session()->flash('message', __('Saved'));
        $this->resetInputFields();
        $this->getSocials();
    }


    public function edit($id)
    {
        $this->sociables_id = $id;
        $this->socialsOptionSelected = session('activeProfileType')::find(session('activeProfileId'))->socials->where('pivot.id', $id)->first()->pivot->social_id;
        $this->userOnSocial = session('activeProfileType')::find(session('activeProfileId'))->socials->where('pivot.id', $id)->first()->pivot->user_on_social;
        $this->serverOfSocial = session('activeProfileType')::find(session('activeProfileId'))->socials->where('pivot.id', $id)->first()->pivot->server_of_social;
        $this->selectedPlaceholder = Social::find($this->socialsOptionSelected);
        $this->updateMode = true;

        $this->dispatchBrowserEvent('contentChanged');
    }


    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }


    public function update()
    {
        $validatedDate = $this->validate([
            'socialsOptionSelected' => 'required|integer',
            'userOnSocial' => 'required|string|max:150',
        ]);


        if ($this->sociables_id) {
            DB::table('sociables')->where('id', $this->sociables_id)->update([
                'social_id' => $this->socialsOptionSelected,
                'user_on_social' => str_replace('@', '', $this->userOnSocial),
                'server_of_social' => str_replace('@', '', $this->serverOfSocial),
                'updated_at' => Carbon::now(),
            ]);
            
            $this->emitUp('emitSaved');
            $this->resetInputFields();
        }
    }


    public function delete($id)
    {
        if ($id) {
            DB::table('sociables')->where('id', $id)->delete();
            session()->flash('message', __('Deleted'));
        }
    }


    public function render()
    {
        $this->getSocials();
        return view('livewire.socials-form');
    }
}
