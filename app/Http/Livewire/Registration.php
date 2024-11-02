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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Livewire\Component;
use Stevebauman\Location\Facades\Location as IpLocation;
use Throwable;
use WireUi\Traits\WireUiActions;

class Registration extends Component implements CreatesNewUsers
{
    use WireUiActions;


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
    public $captcha;

    protected $listeners = ['countryToParent', 'divisionToParent', 'cityToParent', 'districtToParent'];

    public function rules()
    {
        return [
        'name' => config('timebank-cc.rules.profile_user.name'),
        'email' => config('timebank-cc.rules.profile_user.email'),
        'password' => config('timebank-cc.rules.profile_user.password'),
        'country' => 'required_if:validateCountry,true|integer',
        'division' => 'required_if:validateDivision,true',
        'city' => 'required_if:validateCity,true',
        'district' => 'sometimes',
        // 'captcha' => 'hiddencaptcha:3,300', // min, max time in sec for submitting form without captcha validation error
        ];
    }

    public function messages()
    {
        return [
            'captcha.hiddencaptcha' => __('Automatic form completion detected. Try again filling in the form manually. Robots are not allowed to register.'),
        ];
    }

    public function mount(Request $request)
    {
        if (App::environment(['local', 'development', 'staging'])) {
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
        $this->dispatch('countryToChildren', $this->country);
        $this->dispatch('divisionToChildren', $this->division);
        $this->dispatch('cityToChildren', $this->city);
        $this->dispatch('districtToChildren', $this->district);
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
                $account->name = __(config('timebank-cc.accounts.user.name'));
                $account->limit_min = config('timebank-cc.accounts.user.limit_min');
                $account->limit_max = config('timebank-cc.accounts.user.limit_max');

                // TODO: remove testing comment for production
                // Uncomment to test a failed transaction
                // Simulate an error by throwing an exception
                // throw new \Exception('Simulated error before saving account');

                $user->accounts()->save($account); // create the new account for the user

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
            $this->notification()->send([
            'title' => __('Registration failed') . '! ',
            'description' => __('Sorry, your data could not be saved!') . '<br /><br />' . __('Our team has been notified. Please try again later.') . '<br /><br />' . __('Error') . ': ' . $e->getMessage(),
            'icon' => 'error',
            'timeout' => 100000
            ]);

            $warningMessage = 'User registration failed';
            $error = $e;
            $eventTime = now()->toDateTimeString();
            $ip = request()->ip();
            $ipLocationInfo = IpLocation::get($ip);
            // Escape ipLocation errors when not in production
            if (!$ipLocationInfo || App::environment(['local', 'development', 'staging'])) {
                $ipLocationInfo = (object) [
                    'cityName' => 'local City',
                    'regionName' => 'local Region',
                    'countryName' => 'local Country',
                ];
            }
            $lang_preference = app()->getLocale();
            $country = DB::table('country_locales')->where('country_id', $valid['country'])->where('locale', config('timebank-cc.base_language'))->value('name');
            $division = DB::table('division_locales')->where('division_id', $valid['division'])->where('locale', config('timebank-cc.base_language'))->value('name');
            $city = DB::table('city_locales')->where('city_id', $valid['city'])->where('locale', config('timebank-cc.base_language'))->value('name');
            $district = DB::table('district_locales')->where('district_id', $valid['district'])->where('locale', config('timebank-cc.base_language'))->value('name');
            
                // Log this event and mail to admin
            Log::warning($warningMessage, [
                'name' => $valid['name'],
                'email' => $valid['email'],
                'lang_preference' => $lang_preference,
                'country' => $country,
                'division' => $division,
                'city' => $city,
                'district' => $district,
                'IP address' => $ip,
                'IP location' => $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName,
                'Event Time' => $eventTime,
                'Message' => $error,
            ]);
            Mail::raw(
                $warningMessage . '.' . "\n\n" .
                'Name: ' . $valid['name'] . "\n" .
                'Email: ' . $valid['email'] . "\n" .
                'Language preference: ' . $lang_preference . "\n" .
                'Country: ' . $country . "\n" .
                'Division: ' . $division . "\n" .
                'City: ' . $city . "\n" .
                'District: ' . $district . "\n" .
                'IP address: ' . $ip . "\n" .
                'IP location: ' . $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName . "\n" .
                'Event Time: ' . $eventTime . "\n\n" .
                $error,
                function ($message) use ($warningMessage) {
                    $message->to(config('timebank-cc.mail.system_admin'))->subject($warningMessage);
                },
            );

            return back();
        }
    }

    public function render()
    {
        return view('livewire.registration');
    }
}
