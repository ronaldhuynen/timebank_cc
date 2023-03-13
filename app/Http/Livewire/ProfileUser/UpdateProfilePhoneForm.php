<?php

namespace App\Http\Livewire\ProfileUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
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
    ];



    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();

        $phoneCodeOptions = DB::table('location_countries')->get();
        $this->phoneCodeOptions = $phoneCodeOptions->Map(function ($options, $key) {
            return [
                'id' => $options->id,
                'code' => $options->country_code,
                'label' => $options->flag . ' +' . $options->phone_code,
            ];
        });
        $this->phoneCodeOptions->toArray();

        // HIERZO: check wanneer geen tel nummer en cast phone field naar juiset weergave zonder landcode
        if (isset($this->state['phone'])) {
            $country = new PhoneNumber($this->state['phone']);
            $this->phonecode = $country->getCountry();
            $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            $phone->formatNational();
            $this->state['phone'] = $phone->formatNational();
        } else {
            $this->phonecode =  $this->phoneCodeOptions[0]['code'];
        }
    }


    // public function updatedPhonecode()
    // {
    //     $this->state['phone'] = '';
    // }

    /**
     * Validate a single field when updated.
     * This is the 1st validation method on this form.
     *
     * @param  mixed $field
     * @return void
     */
    public function updated($propertyPhone)
    {
        if (isset($this->state['phone'])) {
            $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            $phone->formatNational();
            $this->state['phone'] = $phone->formatNational();
        }
        $this->validateOnly($propertyPhone);
    }


    /**
     * Update the user's profile contact information.
     *
     * @return void
     */
    public function updateProfilePhone()
    {
        $this->validate();  // 2nd validation, just before save method
        $this->resetErrorBag();
        $user = Auth::user();

        $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
        $user->phone = $phone;
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
