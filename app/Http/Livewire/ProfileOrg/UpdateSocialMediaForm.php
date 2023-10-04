<?php

namespace App\Http\Livewire\ProfileOrg;

use Livewire\Component;
use WireUi\Traits\Actions;

class UpdateSocialMediaForm extends Component
{
    use Actions;

    public $profile;
    public $website;


    protected $listeners = ['emitSaved'];

    public function rules()
    {
        return [
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

        $this->profile = session('activeProfileType')::find(session('activeProfileId'));
        $this->website = $this->profile['website'];
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

    public function emitSaved()
    {
        $this->emit('saved');
    }

    /**
    * Update the organization's profile contact information.
    *
    * @return void
    */
    public function update()
    {
        $this->validate();  // 2nd validation, just before save method

        $this->profile->website =  str_replace(['http://', 'https://', ], '', $this->website);

        $this->profile->save();
        $this->emit('saved');
    }



    public function addUrlScheme($url, $scheme = 'https://')
    {
        return parse_url($url, PHP_URL_SCHEME) === null ?
        $scheme . $url : $url;
    }


    public function render()
    {
        return view('livewire.profile-org.update-social-media-form');
    }
}
