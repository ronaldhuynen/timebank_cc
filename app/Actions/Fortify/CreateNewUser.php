<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use RTippin\Messenger\Facades\Messenger;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string','max:25', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        // if ($request->hasFile('photo')) {
        //     auth()->user()->updateProfilePhoto($request->photo);
        // }


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);


        // Attach (Rtippin Messenger) Provider:
        // Messenger::getProviderMessenger($user);


        // Always move this section to the final registration.
        Session([
            'activeProfileType' => User::class,
            'activeProfileId' => auth()->user()->id,
            'activeProfileName'=> auth()->user()->name,
            'activeProfilePhoto'=> auth()->user()->profile_photo_path,
            'firstLogin' => true
        ]);
        //TODO: Welcome and introduction with Session('firstLogin') on rest of site views
        return $user;

    }
}
