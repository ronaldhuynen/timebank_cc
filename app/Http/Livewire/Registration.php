<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\Location;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Livewire\Component;
use RTippin\Messenger\Facades\Messenger;
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
    public $city;

    protected $listeners = ['countryToParent', 'cityToParent'];

    public function rules()
    {
        return [
        'name' => config('timebank-cc.rules.profile_user.name'),
        'email' => config('timebank-cc.rules.profile_user.email'),
        'password' => config('timebank-cc.rules.profile_user.password'),
        'country' => 'required',
        'city' => 'required'
        ];
    }

    public function mount(Request $request)
    {
        if (App::environment(['local', 'staging'])) {
            // $ip = '103.75.231.255'; // Static IP address Brussels for testing
            $ip = '31.20.250.12'; // Statis IP address The Hague for testing
        // $ip = '102.129.156.0'; // Statis IP address Berlin for testing
        } else {
            $ip = $request->ip(); // Dynamic IP address
        }
        $IpLocationInfo = IpLocation::get($ip);
        if ($IpLocationInfo) {

            //HIERZO: VERGELIJK OPGEZOCHTE LOCATIE MET AANWEZIGE LOCATIES IN DB !

            $country = Country::select('id')->where('code', $IpLocationInfo->countryCode)->first();
            if ($country) {
                $this->country = $country->id;
            }

            $city = DB::table('city_locales')->select('city_id')->where('name', $IpLocationInfo->cityName)->where('locale', 'en')->first();
            if ($city) {
                $this->city = $city->city_id;
            };
        }
    }


    public function emitLocationToChildren()
    {
        $this->emit('countryToChildren', $this->country);
        $this->emit('cityToChildren', $this->city);
    }


    public function countryToParent($value)
    {
        $this->country = $value;
    }


    public function cityToParent($value)
    {
        $this->city = $value;
    }


    public function updated($field)
    {
        $this->validateOnly($field);
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
                $location->countries()->attach($country->id); // attach country to location

                $city = new City();
                $city->id = $valid['city'];
                $location->cities()->attach($city->id); // attach country to location

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
