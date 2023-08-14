<?php

namespace App\Http\Livewire\ProfileUser;

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
    public $website;

    protected $listeners = ['languagesToParent'];


    public function rules()
    {
        return [
            'photo' => 'nullable|mimes:gif,jpg,jpeg,png,svg|max:1024',
            'state.about' => 'required|string|max:400',   //TODO: check max with legacy cyclos data
            'state.motivation' => 'required|string|max:200',  //TODO: check max with legacy cyclos data
            'languages' => 'required',
            'languages.id' => 'integer',
            'state.date_of_birth' => 'nullable|date',
            'website' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
    }

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        $this->website = $this->state['website'];
        $this->user = Auth::user();
    }

    
    public function languagesToParent($values)
    {
        $this->languages = $values;
        $this->validateOnly('languages');
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
        if ($field = 'website') {    
        $this->website = $this->addUrlScheme($this->website);
        }
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
        $this->user->website =  $this->website;


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

    
        
    function addUrlScheme($url, $scheme = 'https://')
    {
        return parse_url($url, PHP_URL_SCHEME) === null ?
        $scheme . $url : $url;
    }


    public function render()
    {
        return view('livewire.profile-user.update-profile-personal-form');
    }
}
