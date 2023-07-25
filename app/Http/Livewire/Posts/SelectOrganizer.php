<?php

namespace App\Http\Livewire\Posts;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SelectOrganizer extends Component
{
    public $search;
    public $searchResults = [];
    public $showDropdown = false;
    public $selectedId;
    public $selected = [];
    // public $description;
    // public $name;

    protected $listeners = [
        'resetForm',
        'meetingExists'
    ];


    public function checkValidation()
    {
        $this->emit('toAccountValidation');
    }

    public function resetForm()
    {
        $this->reset();
    }
    
    /**
     * Populate dropdown when already meeting data exists
     *
     * @param  mixed $value
     * @return void
     */
    public function meetingExists($value)
    {
        $this->selectedId = $value['meetingable_id'];
        $this->selected['id'] = $value['meetingable_id']; 
        $this->selected['type'] = $value['meetingable_type'];
        if ($value['meetingable_type'] == User::class) {
            $organizer = User::where('id', $value['meetingable_id'])->select('name', 'profile_photo_path')->firstOrFail();
            $description = '';
        } else {
            $organizer = Organisation::where('id', $value['meetingable_id'])->select('name', 'profile_photo_path')->firstOrFail();
            $description = __('Organization');
        }
        $this->selected['name'] = $organizer->name;
        $this->selected['profile_photo_path'] = url(Storage::url($organizer->profile_photo_path));
        $this->selected['description'] = $description;
    }


    public function orgSelected($value)
    {
        $this->selectedId = $value;
        $this->selected = collect($this->searchResults)->where('id', '=', $value)->first();
        $this->showDropdown = false;
        $this->search = '';
        $this->emit('orgSelected', $this->selected);
    }


    /**
     * updatedSearch: Search query To Accounts
     *
     * @param  mixed $newValue
     * @return void
     */
    public function updatedSearch($newValue)
    {
        $this->showDropdown = true;
        $search = $this->search;        
        $users = User::where('name', 'like', '%' . $search . '%')
            ->where('id', '!=', '1')        // Exclude Super-Admin user  //TODO: exclude all admin users by role 
            ->select('id', 'name', 'profile_photo_path')
            ->get();
        $users = $users->map(function ($item) {
            return
            [
                'id' => $item['id'],
                'type' => User::class,
                'name' => $item['name'],
                'description' => '',
                'profile_photo_path' => url('/storage/' . $item['profile_photo_path'])
            ];
        });
        $organizations = Organisation::where('name', 'like', '%' . $search . '%')->select('id', 'name', 'profile_photo_path')->get();
        $organizations = $organizations->map(function ($item) {
            return
            [
                'id' => $item['id'],
                'type' => Organisation::class,
                'name' => $item['name'],
                'description' => __('Organization'),
                'profile_photo_path' => url(Storage::url($item['profile_photo_path']))
            ];
        });
        if ($users->isNotEmpty()) {
            $merged = collect($users->merge($organizations));
        } else {
            $merged = collect($organizations);
        }
        $response = $merged->take(6);
        $this->searchResults = $response;
    }


    public function render()
    {
        return view('livewire.posts.select-organizer');
    }
}
