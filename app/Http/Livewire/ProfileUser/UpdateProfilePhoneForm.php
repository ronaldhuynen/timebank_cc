<?php

namespace App\Http\Livewire\ProfileUser;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Propaganistas\LaravelPhone\PhoneNumber;
use Stevebauman\Location\Location as IpLocation;

class UpdateProfilePhoneForm extends Component
{
    public $phoneCodeOptions;
    public $phonecode;
    public $ipLocation;
    public $state = [];


    protected $rules = [
        'state.phone' => 'phone:phonecode,mobile',
        'phonecode'  => 'required_with:state.phone',
    ];


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount(Request $request, Repository $config)
    {
        $this->state = Auth::user()->withoutRelations()->toArray();

        $phoneCodeOptions = DB::table('countries')->get();
        $this->phoneCodeOptions = $phoneCodeOptions->Map(function ($options, $key) {
            return [
                'id' => $options->id,
                'code' => $options->phonecode,
                'label' => $options->flag . ' +' . $options->phonecode,
            ];
        });

        // Pre-fill country code dropdown
        $this->phoneCodeOptions->toArray();
        if ($this->state['phone'] != '') {
            $country = new PhoneNumber($this->state['phone']);
            $this->phonecode = $country->getCountry();
            $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            $phone->formatNational();
            $this->state['phone'] = $phone->formatNational();
        } else {
            // When phone field is empty, look up country using ip location service
            //TODO: Switch comments to Dynamic IP for production!
            //  $ip = $request->ip(); // Dynamic IP address of remote user
            // $ip = '145.103.110.142'; // Static IP address for testing: NL The Hague 2518
            $ip = '103.75.231.205'; // Static IP address for testing: BE Brussels Capital 1000
            $ipLocation = (new IpLocation($config))->get($ip);
            $ipCountry = $ipLocation->countryCode;
            $countries = ($phoneCodeOptions->pluck('country_code')->toArray());
            // dd($ipCountry);
            if (in_array($ipCountry, $countries)) {
                $this->phonecode = $ipCountry;
            } else {
                $this->phonecode =  $this->phoneCodeOptions[0]['code'];
            }

        }
    }


    public function updatedPhonecode()
    {
        $this->state['phone'] = null;
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

        if  ($this->state['phone'] != '') {
            $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            $phone->formatNational();
            $this->state['phone'] = $phone->formatNational();
        }
    }


    /**
     * Update the user's profile phone information.
     *
     * @return void
     */
    public function updateProfilePhone()
    {
        $user = Auth::user();

        if ($this->state['phone'] != null) {
            $this->validate();  // 2nd validation, just before save method
            $this->resetErrorBag();
            $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            $user->phone = $phone;
        } else {
            $this->resetErrorBag();
            $user->phone = null;
        }

        $user->save();
        $this->emit('saved');
        $this->emit('refresh-navigation-menu');
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
        return view('livewire.profile-user.update-profile-phone-form');
    }
}
