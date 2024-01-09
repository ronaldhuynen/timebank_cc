<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Locations\Country;
use App\Models\Locations\Location;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Livewire\Component;
use Stevebauman\Location\Facades\Location as IpLocation;
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
    public $division;
    public $city;
    public $district;
    public $validateCountry = true;
    public $validateDivision = true;
    public $validateCity = true;
    public $waitMessage = false;


    protected $listeners = ['countryToParent', 'divisionToParent', 'cityToParent', 'districtToParent'];

    public function rules()
    {
        return [
        'name' => config('timebank-cc.rules.profile_user.name'),
        // 'name' => [ Rule::notIn(['admin', 'administrator'])], // Disallow 'admin' and 'administrator'
        'email' => config('timebank-cc.rules.profile_user.email'),
        'password' => config('timebank-cc.rules.profile_user.password'),
        'country' => 'required_if:validateCountry,true|integer',
        'division' => 'required_if:validateDivision,true',
        'city' => 'required_if:validateCity,true',
        'district' => 'sometimes',
        ];
    }

    public function mount(Request $request)
    {
        if (App::environment(['local', 'staging'])) {
            $ip = '103.75.231.255'; // Static IP address Brussels for testing
            //$ip = '31.20.250.12'; // Static IP address The Hague for testing
            //$ip = '101.33.29.255'; // Static IP address in Amsterdam for testing
            //$ip = '102.129.156.0'; // Static IP address Berlin for testing
        } else {
            // TODO: Test ip lookup in production
            $ip = $request->ip(); // Dynamic IP address
        }
        $IpLocationInfo = IpLocation::get($ip);
        if ($IpLocationInfo) {

            $country = Country::select('id')->where('code', $IpLocationInfo->countryCode)->first();
            if ($country) {
                $this->country = $country->id;
            }


            $division = DB::table('division_locales')->select('division_id')->where('name', 'LIKE', $IpLocationInfo->regionName)->where('locale', app()->getLocale())->first(); //We only need the city_id, therefore we use the default app locale in the where query.
            if ($division) {
                $this->division = $division->division_id;
            }


            $city = DB::table('city_locales')->select('city_id')->where('name', $IpLocationInfo->cityName)->where('locale', app()->getLocale())->first(); //We only need the city_id, therefore we use the default app locale in the where query.
            if ($city) {
                $this->city = $city->city_id;
            };
        }

        $this->setValidationOptions();
    }


    public function emitLocationToChildren()
    {
        $this->emit('countryToChildren', $this->country);
        $this->emit('divisionToChildren', $this->division);
        $this->emit('cityToChildren', $this->city);
        $this->emit('districtToChildren', $this->district);
    }


    public function countryToParent($value)
    {
        $this->country = $value;
        $this->setValidationOptions();
    }


    public function divisionToParent($value)
    {
        $this->division = $value;
        $this->setValidationOptions();

    }


    public function cityToParent($value)
    {
        $this->city = $value;
        $this->setValidationOptions();
    }


    public function districtToParent($value)
    {
        $this->district = $value;
        $this->setValidationOptions();
    }


    public function updated($field)
    {
        $this->validateOnly($field);
    }


    public function setValidationOptions()
    {
        $this->validateCountry = $this->validateDivision = $this->validateCity = true;

        // In case no cities or divisions for selected country are seeded in database
        if ($this->country) {
            $countDivisions = Country::find($this->country)->divisions->count();
            $countCities = Country::find($this->country)->cities->count();

            if ($countDivisions > 0 && $countCities < 1) {
                $this->validateDivision = true;
                $this->validateCity = false;
            } elseif ($countDivisions < 1 && $countCities > 1) {
                $this->validateDivision = false;
                $this->validateCity = true;
            } elseif ($countDivisions < 1 && $countCities < 1) {
                $this->validateDivision = false;
                $this->validateCity = false;
            } elseif ($countDivisions > 0 && $countCities > 0) {
                $this->validateDivision = false;
                $this->validateCity = true;
            }

        }
        // In case no country is selected, no need to show other validation errors
        if (!$this->country) {
            $this->validateCountry = true;
            $this->validateDivision = $this->validateCity = false;
        }
    }


    public function create($input = null)
    {
        $this->waitMessage = true;

        $valid = $this->validate();

        try {
            // Use a transaction for creating the new user
            DB::transaction(function () use ($valid): void {

                $user = User::create([
                    'name' => $valid['name'],
                    'email' => $valid['email'],
                    'password' => Hash::make($valid['password']),
                    'profile_photo_path' => config('timebank-cc.files.profile_user.photo_new'),
                    'lang_preference' => app()->getLocale()     // App locale is set by mcamara/laravel-localization package: set app locale according to browser language
                ]);

                $location = new Location();
                $location->name = __('Default location');
                $location->country_id = $valid['country'];
                $location->division_id = $valid['division'];
                $location->city_id = $valid['city'];
                $location->district_id = $valid['district'];
                $user->locations()->save($location); // save the new location for the user

                $account = new Account();
                $account->name = __(config('timebank-cc.accounts.personal.name'));
                $account->limit_min = config('timebank-cc.accounts.personal.limit_min');
                $account->limit_max = config('timebank-cc.accounts.personal.limit_max');
                $user->accounts()->save($account); // create the new account for the user

                // TODO: Attach Messenger when profile has been further completed
                // TODO: Check if this is needed, and where this also is being done?
                // // Attach (Rtippin Messenger) Provider:
                // Messenger::getProviderMessenger($user);

                // WireUI notification
                $this->notification()->success(
                    $title = __('Your registration is saved!'),
                );

                $this->reset();
                auth()->login($user);
                event(new Registered($user));
            });
            // End of transaction

            $this->waitMessage = false;

            return redirect()->route('verification.notice');

        } catch (Throwable $e) {

            $this->waitMessage = false;

            // WireUI notification
            // TODO!: create event to send error notification to admin
            $this->notification([
            'title' => __('Registration failed!'),
            'description' => __('Sorry, your data could not be saved!') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
            'icon' => 'error',
            'timeout' => 100000
            ]);

            return back();
        }
    }

    public function render()
    {
        return view('livewire.registration');
    }
}
