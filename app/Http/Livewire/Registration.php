<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\Division;
use App\Models\Locations\Location;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    public $validateCountry = true;
    public $validateDivision = true; 
    public $validateCity = true;

    protected $listeners = ['countryToParent', 'divisionToParent', 'cityToParent'];

    public function rules()
    {
        return [
        'name' => config('timebank-cc.rules.profile_user.name'),
        'email' => config('timebank-cc.rules.profile_user.email'),
        'password' => config('timebank-cc.rules.profile_user.password'),
        'country' => 'required_if:validateCountry,true',
        'division' => 'required_if:validateDivision,true',
        'city' => 'required_if:validateCity,true',
        ];
    }

    public function mount(Request $request)
    {
        if (App::environment(['local', 'staging'])) {
            // $ip = '103.75.231.255'; // Static IP address Brussels for testing
            $ip = '31.20.250.12'; // Static IP address The Hague for testing
            //  $ip = '102.129.156.0'; // Static IP address Berlin for testing
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


            $division = DB::table('division_locales')->select('division_id')->where('name', $IpLocationInfo->regionName)->where('locale', app()->getLocale())->first(); //We only need the city_id, therefore we use the default app locale in the where query.
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


    public function updated($field)
    {
        $this->validateOnly($field);
    }


    public function setValidationOptions()
    {        
        $this->validateCountry = $this->validateDivision = $this->validateCity = true;

        // In case no cities or divisions for selected country are seeded in database
        if ($this->country) {            
            $countDivisions = Country::find($this->country)->division()->count();
            $countCities = Country::find($this->country)->city()->count();

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
        $valid = $this->validate();

        try {
            // Use a transaction for creating the new user
            DB::transaction(function () use ($valid): void {
                $user = User::create([
                    'name' => $valid['name'],
                    'email' => $valid['email'],
                    'password' => Hash::make($valid['password']),
                    'profile_photo_path' => config('timebank-cc.files.profile_user.photo_new'),
                ]);

                $location = new Location();
                $location->name = 'Default location';
                $user->locations()->save($location); // create a new location

                $country = new Country();
                $country->id = $valid['country'];
                $location->country()->save($country->id); // attach country to location
                
                $division = new Division();
                $division->id = $valid['division'];
                $location->division()->save($division->id); // attach division to location

                $city = new City();
                $city->id = $valid['city'];
                $location->city()->save($city->id); // attach country to location

                $account = new Account();
                $account->name = __(config('timebank-cc.accounts.personal.name'));
                $account->limit_min = config('timebank-cc.accounts.personal.limit_min');
                $account->limit_max = config('timebank-cc.accounts.personal.limit_max');
                $user->accounts()->save($account);

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

            return redirect()->route('verification.notice');

        } catch (Throwable $e) {
            // WireUI notification
            // TODO: create event to send error notification to admin
            $this->notification([
            'title' => __('Registration failed!'),
            'description' => __('Sorry, your data could not be saved!') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
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
