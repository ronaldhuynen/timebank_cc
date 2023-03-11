<?php

namespace App\Http\Livewire;

use App\Models\Medium;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MediaForm extends Component
{
    public $mediaOptions;
    public $mediaOptionSelected;
    public $media;
    public $userOnMedium;
    public $serverOfMedium;
    public $mediables_id;
    public $updateMode = false;
    public $selectedPlaceholder;


    private function resetInputFields()
    {
        $this->reset(['updateMode', 'mediaOptionSelected', 'userOnMedium', 'serverOfMedium']);
    }

    public function mount()
    {
        $this->mediaOptions = Medium::select("*")->orderBy("name")->get();
        // $this->mediaOptions = Medium::all();
    }


    public function store()
    {
        $validatedMedium = $this->validate([
            'mediaOptionSelected' => 'required',
            'userOnMedium' => 'required|string',
        ]);

        DB::table('mediables')->insert([
            'medium_id' => $this->mediaOptionSelected,
            'mediable_type' => session('activeProfileType'),
            'mediable_id' => session('activeProfileId'),
            'user_on_medium' => str_replace('@', '', $this->userOnMedium),
            'server_of_medium' => str_replace('@', '', $this->serverOfMedium),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
           ]);
        session()->flash('message', __('Added successfully'));
        $this->resetInputFields();
    }


    public function edit($id)
    {
        //TODO: make also suitable for organisations with session('activeProfileType') instead of auth()->user()->id

        $this->mediables_id = $id;
        $this->mediaOptionSelected = User::find(session('activeProfileId'))->media->where('pivot.id', $id)->first()->pivot->medium_id;
        $this->userOnMedium = User::find(session('activeProfileId'))->media->where('pivot.id', $id)->first()->pivot->user_on_medium;
        $this->serverOfMedium = User::find(session('activeProfileId'))->media->where('pivot.id', $id)->first()->pivot->server_of_medium;
        $this->selectedPlaceholder = Medium::find($this->mediaOptionSelected);
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
            'mediaOptionSelected' => 'required',
            'userOnMedium' => 'required|string',
        ]);


        if ($this->mediables_id) {
            DB::table('mediables')->where('id', $this->mediables_id)->update([
                'medium_id' => $this->mediaOptionSelected,
                'user_on_medium' => str_replace('@', '', $this->userOnMedium),
                'server_of_medium' => str_replace('@', '', $this->serverOfMedium),
                'updated_at' => Carbon::now(),
            ]);
            // $this->updateMode = false;
            session()->flash('message', __('Updated'));
            $this->resetInputFields();
        }
    }


    public function delete($id)
    {
        if ($id) {
            DB::table('mediables')->where('id', $id)->delete();
            session()->flash('message', __('Deleted'));
        }
    }


    public function render()
    {
        //TODO: make also suitable for organisations with session('activeProfileType') instead of auth()->user()->id
    //    Medium::select("*")->orderBy("name")->get();
        $this->media = User::find(session('activeProfileId'))->media()->orderBy('mediables.updated_at','desc')->get();

        return view('livewire.media-form');
    }
}
