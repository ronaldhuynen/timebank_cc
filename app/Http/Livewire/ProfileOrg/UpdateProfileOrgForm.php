<?php

namespace App\Http\Livewire\ProfileOrg;

use App\Models\Organization;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\HasProfilePhoto;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileOrgForm extends Component
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
            'state.about' => 'required|string|max:900',   //TODO: check max with legacy cyclos data
            'state.about_short' => 'required|string|max:150',   //TODO: check max with legacy cyclos data
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
        
        $this->getLanguages();
    }


    public function getLanguages()
    {        
        // Create a language options collection that combines all language and competence options
        $langOptions = DB::table('languages')->get(['id','name']);
        $compOptions = DB::table('language_competences')->get(['id','name']);
        $langOptions = collect(Arr::crossJoin($langOptions, $compOptions));
        $langOptions = $langOptions->Map(function ($language, $key) {
            return [
                'id' => $key,   // index key is needed to select values in dropdown (option-value)
                'langId' => $language[0]->id,
                'compId' => $language[1]->id,
                'name' => trans($language[0]->name) . ' - ' . trans($language[1]->name),
            ];
        });

        // Create an array of the pre-selected language options
        $languages = $this->organization->languages;
        $languages = $languages->map(function ($language, $key) use ($langOptions) {
            $competence = DB::table('language_competences')->find($language->pivot->competence);
            $langSelected = collect($langOptions)->where('name', trans($language->name) . ' - ' . trans($competence->name));
            return [
                $langSelected->keys()
            ];
        });
        $languages = $languages->flatten();

        // Create a selected language collection that holds the selected languages with their selected competences
        $this->languages = collect($langOptions)->whereIn('id', $languages);
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
        // $this->website = $this->addUrlScheme($this->website);
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
        $this->organization->about_short = $this->state['about_short'];
        $this->organization->motivation = $this->state['motivation'];
        $this->organization->website =  str_replace(['http://', 'https://', ], '', $this->website);

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
        Session(['activeProfilePhoto' => $this->organization->profile_photo_path ]);
        redirect()->route('org.edit');
    }

    /**
     * Delete organization's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {       
        if (! Features::managesProfilePhotos()) {
            return;
        }

        if (is_null($this->organization->profile_photo_path)) {
            return;
        }


        // Only delete a profile-photo, and not a default-photo in 'app-images/'
        if (str_starts_with($this->organization->profile_photo_path, 'profile-photos/')) {
            Storage::disk(isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public'))->delete($this->organization->profile_photo_path);

            $this->organization->forceFill([
                'profile_photo_path' =>  config('timebank-cc.files.profile_user.photo_default'),
            ])->save();

            Session(['activeProfilePhoto'=> $this->organization->profile_photo_path ]);
        }

        $this->emit('saved');
        return redirect()->route('org.edit');
    }


    public function render()
    {
        return view('livewire.profile-org.update-profile-org-form');
    }
}
