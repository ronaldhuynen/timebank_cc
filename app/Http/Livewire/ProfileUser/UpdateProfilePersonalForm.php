<?php

namespace App\Http\Livewire\ProfileUser;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Jetstream\HasProfilePhoto;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfilePersonalForm extends Component
{
    use WithFileUploads;
    use HasProfilePhoto;


    public $state = [];
    public $photo;

    protected $listeners = ['countryToParent', 'cityToParent', 'districtToParent'];

    protected $rules = [
        'photo' => 'nullable|mimes:jpg,jpeg,png|max:1024',
        'state.about' => 'nullable|string|max:400',
        'state.motivation' => 'nullable|string|max:200',
        'state.date_of_birth' => 'nullable|date',
        // 'state.website' => 'nullable|string|url',
    ];

    protected $messages = [
        'state.motivation' => 'Error',
        'state.date_of_birth' => 'Your Birthday is not a valid date'
    ];

    // public function countryToParent($value)
    // {
    //     $this->country = $value;
    // }

    // public function cityToParent($value)
    // {
    //     $this->city = $value;
    // }

    // public function districtToParent($value)
    // {
    //     $this->district = $value;
    // }

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    public function updated($field)
    {
        $this->validateOnly($field);    // 1st velidation, in real-time
    }

    /**
    * Update the user's profile contact information.
    *
    * @return void
    */
    public function updateProfilePersonalForm()
    {
        $this->validate();  // 2nd validation, just before save method
        $this->resetErrorBag();

        $user = Auth::user();

        if (isset($this->photo)) {
            $user->updateProfilePhoto($this->photo);
        } else {
            $user->forcefill(['profile_photo_path' => 'app-images/new-profile.svg'])->save();
        }
        $user->about = $this->state['about'];
        $user->motivation = $this->state['motivation'];
        $user->date_of_birth = $this->state['date_of_birth'];
        // $user->website = $this->state['website'];
        $user->save();
        $this->emit('saved');
        $this->emit('refresh-navigation-menu');


        // Update session with new profile_photo_path
        Session([
            'activeProfilePhoto'=> Auth::user()->profile_photo_path
        ]);

    }


    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        Auth::user()->profile_photo_path = 'app-images/new-profile.svg';
        // $this->photo = null;
        Session([
            'activeProfilePhoto'=> Auth::user()->profile_photo_path
        ]);
        $this->emit('refresh-navigation-menu');
    }



    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }


    public function render()
    {
        return view('livewire.profile-user.update-profile-personal-form');
    }
}
