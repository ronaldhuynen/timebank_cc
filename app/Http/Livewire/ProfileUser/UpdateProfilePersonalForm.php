<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    protected $listeners = ['languagesToParent'];


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


    public function languagesToParent($values)
    {
        $this->languages = $values;
        // dump($this->languages);
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

    /**
     * Validate a single field when updated.
     * This is the 1st validation method on this form.
     *
     * @param  mixed $field
     * @return void
     */
    public function updated($field)
    {
        $this->validateOnly($field);
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
        $this->user->website =  str_replace(['http://', 'https://', ], '', $this->state['website']);


        if (isset($this->languages)) {

            $languages = collect($this->languages)->Map(function ($lang, $key) {
                return [
                    'language_id' => $lang['langId'],
                    'competence' => $lang['compId'],
                    'languagable_type' => User::class,
                    'languagable_id' => $this->user->id,
                ];
            })->toArray();

            $this->user->languages()->detach(); // Remove all languages of this user before inserting the new ones
            DB::table('languagables')->insert($languages);
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
