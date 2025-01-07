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
            'photo' => config('timebank-cc.rules.profile_bank.profile_photo'),
            'state.about' => config('timebank-cc.rules.profile_bank.about'),
            'state.about_short' => config('timebank-cc.rules.profile_bank.about_short'),
            'state.motivation' => config('timebank-cc.rules.profile_bank.motivation'),
            'languages' => config('timebank-cc.rules.profile_bank.languages'),
            'website' => config('timebank-cc.rules.profile_bank.website'),
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

        // $this->validate();  // 2nd validation, just before save method

        
try {
    $this->validate();  // 2nd validation, just before save method
} catch (\Illuminate\Validation\ValidationException $e) {
    // Log validation errors
    \Log::error('Validation errors:', $e->errors());
    // Optionally, you can display the errors to the user
    $this->addError('validation', 'Validation failed. Please check your input.');
    return;
}


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

            $bank->languages()->detach(); // Remove all languages of this bank before inserting the new ones
            DB::table('languagables')->insert($languages);
        }

        $bank->save();
        $this->dispatch('saved');
        session(['activeProfilePhoto' => $bank->profile_photo_path ]);
        redirect()->route('bank.edit');
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
                'profile_photo_path' =>  config('timebank-cc.profiles.bank.profile_photo_path_default'),
            ])->save();

            Session(['activeProfilePhoto'=> $bank->profile_photo_path ]);
        }

        $this->dispatch('saved');
        return redirect()->route('bank.edit');
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
