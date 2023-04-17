<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\User;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Propaganistas\LaravelPhone\PhoneNumber;

class UpdateProfilePhoneForm extends Component
{
    public $phoneCodeOptions;
    public $phonecode;
    public $state = [];


    protected $rules = [
        'state.phone' => 'phone:phonecode,mobile',
        'phonecode'  => 'required_with:state.phone',
        'state.phone_public_for_friends' =>'boolean',
    ];


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount(Request $request, Repository $config)
    {
        $this->state = Auth::user()->withoutRelations()->toArray();

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
        // Fill country code dropdown
        $this->phoneCodeOptions->toArray();
        if ($this->state['phone'] != '') {
            $country = new PhoneNumber($this->state['phone']);
            $this->phonecode = $country->getCountry();
            $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            $phone->formatNational();
            $this->state['phone'] = $phone->formatNational();
        } else {
            $country = User::find($this->state['id'])->locations()->with('cities')->first()->cities[0]['country_id'];
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
        info($this->state['phone']);
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
            $user->phone_public_for_friends = $this->state['phone_public_for_friends'];
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
