<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Fortify;
use Livewire\Component;
use RTippin\Messenger\Facades\Messenger;
use Throwable;
use WireUi\Traits\Actions;

class Registration extends Component implements CreatesNewUsers
{
    use Actions;

    public $name;
    public $email;
    public $password;
    public $passwordConfirmation;
    public $country;
    public $city;
    public $district;

    protected $listeners = ['countryToParent', 'cityToParent', 'districtToParent'];

    protected $rules = [
        'name' => 'required|min:3|unique:users,name',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|same:passwordConfirmation',
        'country' => 'required',
        'city' => 'required'
    ];

    public function countryToParent($value)
    {
        $this->country = $value;
    }

    public function cityToParent($value)
    {
        $this->city = $value;
    }

    public function districtToParent($value)
    {
        $this->district = $value;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function create($input = null)
    {
        $valid = $this->validate();

        try {
            $user = User::create([
                'name' => $valid['name'],
                'email' => $valid['email'],
                'password' => Hash::make($valid['password']),
                'profile_photo_path' => 'app-images/new-profile.svg',
                'city_id_1' => $valid['city'],
                'district_id_1' => $this->district
            ]);


            // TODO: Attach Messenger when profile has been further completed
            // // Attach (Rtippin Messenger) Provider:
            // Messenger::getProviderMessenger($user);


            // WireUI notification
            $this->notification()->success(
                $title = __('Your registration is saved!'),
                // $description = __('Please check your email to verify your email address.')
            );

            $this->reset();
            auth()->login($user);
            event(new Registered($user));

            return redirect()->route('verification.notice');


        } catch (Throwable $e) {
            // WireUI notification
            // TODO: create event to send error notification to admin
            $this->notification([
            'title' => __('Registration failed!'),
            'description' => __('Sorry, your registration could not be saved!') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
            'icon' => 'error',
            'timeout'=> 100000
            ]);

            return back();
        }
    }

    public function render()
    {
        return view('livewire.registration');
    }
}
