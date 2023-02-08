<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
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
            // Use a transaction for creating the new user
            DB::transaction(function () use ($valid): void {
                $user = User::create([
                    'name' => $valid['name'],
                    'email' => $valid['email'],
                    'password' => Hash::make($valid['password']),
                    'profile_photo_path' => 'app-images/new-profile.svg',
                    'city_id_1' => $valid['city'],
                    'district_id_1' => $this->district
                ]);

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
