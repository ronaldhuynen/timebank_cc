<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\Features;
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
            'state.about' => 'nullable|string|max:900',   //TODO: check max with legacy cyclos data
            'state.about_short' => 'required|string|max:150',   //TODO: check max with legacy cyclos data
            'state.motivation' => 'required|string|max:300',  //TODO: check max with legacy cyclos data
            'languages' => 'required',
            'languages.id' => 'integer',
            'state.date_of_birth' => 'nullable|date',
            'website' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/i',
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
        $languages = $this->user->languages;
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
        $this->user->about_short = $this->state['about_short'];
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
        $this->dispatch('saved');
        Session(['activeProfilePhoto' => $this->user->profile_photo_path ]);
        redirect()->route('user.edit');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        if (! Features::managesProfilePhotos()) {
            return;
        }

        if (is_null($this->user->profile_photo_path)) {
            return;
        }


        // Only delete a profile-photo, and not a default-photo in 'app-images/'
        if (str_starts_with($this->user->profile_photo_path, 'profile-photos/')) {
            Storage::disk(isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public'))->delete($this->user->profile_photo_path);

            $this->user->forceFill([
                'profile_photo_path' =>  config('timebank-cc.files.profile_user.photo_default'),
            ])->save();

            Session(['activeProfilePhoto' => $this->user->profile_photo_path ]);
        }

        $this->dispatch('saved');
        return redirect()->route('user.edit');
    }



    public function addUrlScheme($url, $scheme = 'https://')
    {
        return parse_url($url, PHP_URL_SCHEME) === null ?
        $scheme . $url : $url;
    }


    public function render()
    {
        return view('livewire.profile-user.update-profile-personal-form');
    }
}
