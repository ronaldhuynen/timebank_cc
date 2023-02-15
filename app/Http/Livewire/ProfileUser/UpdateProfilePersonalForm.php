<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\Language;
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
    public $user;
    public $photo;
    public $languages;

    protected $listeners = ['languagesToParent', 'countryToParent', 'cityToParent', 'districtToParent'];


    public function rules()
    {
        return [
            'photo' => config('timebank-cc.rules.profile_user.profile_photo'),
            'state.about' => config('timebank-cc.rules.profile_user.about'),
            'state.motivation' => config('timebank-cc.rules.profile_user.motivation'),
            'state.date_of_birth' => config('timebank-cc.rules.profile_user.date_of_birth'),
            // 'state.website' => config('timebank-cc.rules.profile_user.website'),
        ];
    }


    public function messages()
    {
        return [
            'state.motivation' => config('timebank-cc.messages.profile_user.motivation'),
            // 'state.date_of_birth' => config('timebank-cc.messages.profile_user.date_of_birth'),
        ];
    }

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

    public function languagesToParent($value)
    {
        $this->languages = $value;
    }

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        $this->user = Auth::user();
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
        if (isset($this->photo)) {
            $this->user->updateProfilePhoto($this->photo);
        }

        $this->validate();  // 2nd validation, just before save method

        $this->user->about = $this->state['about'];
        $this->user->motivation = $this->state['motivation'];
        $this->user->date_of_birth = $this->state['date_of_birth'];
        // $this->user->website = $this->state['website'];

        foreach ($this->languages as $lang) {
            // zoiets van
            // koppelen aan $user
            $user = $this->user;
            // $userLang = new Language();
            $userLang['user_id'] = $user->id;
            $userLang['name'] = $lang;
            $userLang['lang_code'] = config('timebank-cc.languages')[$lang]['lang_code'];
            $userLang['flag'] = config('timebank-cc.languages')[$lang]['flag'];

            // dump(($userLang));
            $user = $user->languages()->firstOrCreate($userLang);
        }


        $this->user->save();
        $this->emit('saved');
        Session(['activeProfilePhoto'=> $this->user->profile_photo_path ]);
        // $this->emit('refresh-navigation-menu');
        redirect()->route('profile-user.show');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto(UpdatesUserProfileInformation $updater)
    {
        Auth::user()->deleteProfilePhoto();

        $this->emit('saved');

        return redirect()->route('profile-user.show');
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
