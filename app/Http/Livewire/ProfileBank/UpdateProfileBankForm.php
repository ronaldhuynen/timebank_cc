<?php

namespace App\Http\Livewire\ProfileBank;

use App\Models\Bank;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\HasProfilePhoto;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileBankForm extends Component
{
    use WithFileUploads;
    use HasProfilePhoto;

    public $state = [];
    public $bank;
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
        // Check if the active profile is 'Bank'
        if (getActiveProfileType() !== 'Bank' || !userOwnsProfile(getActiveProfile()) ) {
            abort(403, 'Unauthorized action.');
            // TODO: Add log and report
        }

        $this->state = Bank::find(session('activeProfileId'))->toArray();
        $this->website = $this->state['website'];
        $this->bank = Bank::find(session('activeProfileId'));
        $this->bank['profile_photo_url'] = url(Storage::url($this->bank->profile_photo_path));
        
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
        $languages = $this->bank->languages;
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
        if ($field == 'website') {
            // If website is not empty, add URL scheme
            if (!empty($this->website)) {
                $this->website = $this->addUrlScheme($this->website);
            } else {
                // If website is empty, remove 'https://' prefix
                $this->website = str_replace('https://', '', $this->website);
            }
        }

        $this->validateOnly($field);
    }

    
    /**
    * Update the bank's profile contact information.
    *
    * @return void
    */
    public function updateProfilePersonalForm()
    {
        $bank = getActiveProfile();
        if ( !userOwnsProfile($bank) ) {
            abort(403, 'Unauthorized action.');
            // TODO: Add log and report
        }

        if (isset($this->photo)) {
            $bank->updateProfilePhoto($this->photo);  // Trait (use HasProfilePhoto) needs to attached to Bank model for this to work
        }

        $this->validate();  // 2nd validation, just before save method

        $bank->about = $this->state['about'];
        $bank->about_short = $this->state['about_short'];
        $bank->motivation = $this->state['motivation'];
        $bank->website =  str_replace(['http://', 'https://', ], '', $this->website);

        if (isset($this->languages)) {

            $languages = collect($this->languages)->Map(function ($lang, $key) use ($bank) {
                return [
                    'language_id' => $lang['langId'],
                    'competence' => $lang['compId'],
                    'languagable_type' => Bank::class,
                    'languagable_id' => $bank->id,
                ];
            })->toArray();

            $bank->languages()->detach(); // Remove all languages of this organization before inserting the new ones
            DB::table('languagables')->insert($languages);
        }

        $bank->save();
        $this->dispatch('saved');
        session(['activeProfilePhoto' => $bank->profile_photo_path ]);
        redirect()->route('org.edit');
    }

    /**
     * Delete the bank's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {       
        $bank = getActiveProfile();
        if (!userOwnsProfile($bank)) {
            abort(403, 'Unauthorized action.');
            // TODO: Add log and report
        }

        if (! Features::managesProfilePhotos()) {
            return;
        }

        if (is_null($bank->profile_photo_path)) {
            return;
        }

        // Only delete a profile-photo, and not a default-photo in 'app-images/'
        if (str_starts_with($bank->profile_photo_path, 'profile-photos/')) {
            Storage::disk(isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public'))->delete($bank->profile_photo_path);

            $bank->forceFill([
                'profile_photo_path' =>  config('timebank-cc.profiles.organization.profile_photo_path_default'),
            ])->save();

            Session(['activeProfilePhoto'=> $bank->profile_photo_path ]);
        }

        $this->dispatch('saved');
        return redirect()->route('org.edit');
    }


    public function addUrlScheme($url, $scheme = 'https://')
    {
        return parse_url($url, PHP_URL_SCHEME) === null ?
        $scheme . $url : $url;
    }

    
    public function render()
    {
        return view('livewire.profile-bank.update-profile-bank-form');
    }
}
