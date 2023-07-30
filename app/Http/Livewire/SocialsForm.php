<?php

namespace App\Http\Livewire;

use App\Models\Social;
use App\Models\User;
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
        // $this->socialOptions = Social::all();
    }


    public function store()
    {
        $validatedSocial = $this->validate([
            'socialsOptionSelected' => 'required',
            'userOnSocial' => 'required|string',
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
        session()->flash('message', __('Added successfully'));
        $this->resetInputFields();
    }


    public function edit($id)
    {
        //TODO: make also suitable for organizations with session('activeProfileType') instead of auth()->user()->id

        $this->sociables_id = $id;
        $this->socialsOptionSelected = User::find(session('activeProfileId'))->social->where('pivot.id', $id)->first()->pivot->social_id;
        $this->userOnSocial = User::find(session('activeProfileId'))->social->where('pivot.id', $id)->first()->pivot->user_on_social;
        $this->serverOfSocial = User::find(session('activeProfileId'))->social->where('pivot.id', $id)->first()->pivot->server_of_social;
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
            'socialsOptionSelected' => 'required',
            'userOnSocial' => 'required|string',
        ]);


        if ($this->sociables_id) {
            DB::table('sociables')->where('id', $this->sociables_id)->update([
                'social_id' => $this->socialsOptionSelected,
                'user_on_social' => str_replace('@', '', $this->userOnSocial),
                'server_of_social' => str_replace('@', '', $this->serverOfSocial),
                'updated_at' => Carbon::now(),
            ]);
            session()->flash('message', __('Updated'));
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
        //TODO: make also suitable for organizations with session('activeProfileType') instead of auth()->user()->id
    //    Social::select("*")->orderBy("name")->get();
        $this->socials = User::find(session('activeProfileId'))->social()->orderBy('sociables.updated_at','desc')->get();

        return view('livewire.socials-form');
    }
}
