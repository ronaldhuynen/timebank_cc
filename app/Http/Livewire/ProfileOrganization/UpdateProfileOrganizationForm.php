<?php

namespace App\Http\Livewire\ProfileOrganization;

use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Jetstream\HasProfilePhoto;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileOrganizationForm extends Component
{
    use WithFileUploads;
    use HasProfilePhoto;


    public $state = [];
    public $organization;
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
        $this->state = Organization::find(session('activeProfileId'))->toArray();
        $this->website = $this->state['website'];
        $this->organization = Organization::find(session('activeProfileId'));
        $this->organization['profile_photo_url'] = url(Storage::url($this->organization->profile_photo_path));
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
    * Update the organization's profile contact information.
    *
    * @return void
    */
    public function updateProfilePersonalForm()
    {
        if (isset($this->photo)) {
            $this->organization->updateProfilePhoto($this->photo);  // Trait (use HasProfilePhoto) needs to attached to Organization model for this to work
        }

        $this->validate();  // 2nd validation, just before save method

        $this->organization->about = $this->state['about'];
        $this->organization->motivation = $this->state['motivation'];
        $this->organization->website =  str_replace(['http://', 'https://', ], '', $this->state['website']);


        if (isset($this->languages)) {

            $languages = collect($this->languages)->Map(function ($lang, $key) {
                return [
                    'language_id' => $lang['langId'],
                    'competence' => $lang['compId'],
                    'languagable_type' => Organization::class,
                    'languagable_id' => $this->organization->id,
                ];
            })->toArray();

            $this->organization->languages()->detach(); // Remove all languages of this organization before inserting the new ones
            DB::table('languagables')->insert($languages);
        }

        $this->organization->save();
        $this->emit('saved');
        Session(['activeProfilePhoto'=> $this->organization->profile_photo_path ]);
        redirect()->route('profile-organization.show');
    }

    /**
     * Delete organization's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto(UpdatesUserProfileInformation $updater)
    {
        Auth::organization()->deleteProfilePhoto();

        $this->emit('saved');

        return redirect()->route('profile-organization.show');
    }


    function addUrlScheme($url, $scheme = 'https://')
    {
        return parse_url($url, PHP_URL_SCHEME) === null ?
        $scheme . $url : $url;
    }


    public function render()
    {
        return view('livewire.profile-organization.update-profile-organization-form');
    }
}
