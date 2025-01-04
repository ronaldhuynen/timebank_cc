<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Propaganistas\LaravelPhone\PhoneNumber;

class UpdateProfilePhoneForm extends Component
{
    public $phoneCodeOptions;
    public $phonecode;
    public $state = [];


    protected $rules = [
        'state.phone' => [ 'phone:phonecode,mobile,strict', 'regex:/^[\d+()\s-]+$/', ],
        'phonecode'  => 'required_with:state.phone,mobile',
        'state.phone_public_for_friends' =>'boolean|nullable',
        'state.phone_public' =>'boolean|nullable',
    ];


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount(Request $request, Repository $config)
    {

        $activeProfile = getActiveProfile();

        // Check for the existence of both columns and use the one that exists
        $phonePublicForFriends = isset($activeProfile->phone_public_for_friends);
        $phonePublic = isset($activeProfile->phone_public);


        $this->state = array_merge([
            'phone' => $activeProfile->phone,
            'phone_public_for_friends' => $phonePublicForFriends == true ? $activeProfile->phone_public_for_friends : null,
            'phone_public' => $phonePublic == true ? $activeProfile->phone_public : null,
        ], $activeProfile->withoutRelations()->toArray());        

        $phoneCodeOptions = DB::table('countries')->get()->sortBy('code');
        $this->phoneCodeOptions = $phoneCodeOptions->Map(function ($options, $key) {
            return [
                'id' => $options->id,
                'code' => $options->code,
                'label' => $options->flag . ' +' . $options->phonecode,
            ];
        });
    }

    public function phonecodeInit()
    {
        $activeProfile = getActiveProfile();

        // Fill country code dropdown
        $this->phoneCodeOptions->toArray();
    
        // Ensure the profile is authenticated and retrieve the phone field
        $profilePhone = $activeProfile->phone ?? '';

        if ($profilePhone != '') {
            $country = new PhoneNumber($profilePhone);
            $this->phonecode = $country->getCountry();
            $phone = new PhoneNumber($profilePhone, $this->phonecode);
            $this->state['phone'] = $phone->formatNational();
        } else {
            $country = get_class($activeProfile)::find($this->state['id'])->locations()
                ->with('city:id,country_id') // Eager load just the 'country_id' from 'city'
                ->get() // Get the locations
                ->pluck('city.country_id') // Extract the country_id values
                ->toArray();
            $countries = ($this->phoneCodeOptions)->pluck('id')->toArray();

            if (in_array($country, $countries)) {
                $this->phonecode = DB::table('countries')->select('code')->where('id', $country)->pluck('code')->first();
            } else {
                $this->phonecode =  $this->phoneCodeOptions[0]['code'];
            }
        }

    }


    /**
     * Validate phone field when updated.
     * This is the 1st validation method on this form.
     *
     * @param  mixed $field
     * @return void
     */
    public function updatedPhone()
    {
        $this->validateOnly($this->state['phone']);

        if (isset($this->state['phone']) && $this->state['phone'] != '') {
            $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            $this->state['phone'] = $phone->formatNational();
        }
    }


    /**
     * Update the profile's phone information.
     *
     * @return void
     */
    public function updateProfilePhone()
    {
        $activeProfile = session('activeProfileType')::find(session('activeProfileId'));

        if ($this->state['phone'] != null) {
            $this->validate();  // 2nd validation, just before save method
            $this->resetErrorBag();
            $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            $activeProfile->phone = $phone;
            
            // Check for the existence of public phone columns and update the one that exists
            if (isset($activeProfile->phone_public_for_friends)) {
                $activeProfile->phone_public_for_friends = $this->state['phone_public_for_friends'] ?? false;
            } elseif (isset($activeProfile->phone_public)) {
                $activeProfile->phone_public = $this->state['phone_public'] ?? false;
            }

        } else {
            $this->resetErrorBag();
            $activeProfile->phone = null;
            
            // Clear the phone_public or phone_public_for_friends field
            if (isset($activeProfile->phone_public_for_friends)) {
                $activeProfile->phone_public_for_friends = false;
            } elseif (isset($activeProfile->phone_public)) {
                $activeProfile->phone_public = false;
            }
        }

        $activeProfile->save();
        $this->dispatch('saved');
    }


    /**
     * Get the current active profile of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return getActiveProfile();
    }


    public function render()
    {
        return view('livewire.profile.update-profile-phone-form');
    }
}
