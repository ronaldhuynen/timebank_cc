<?php

namespace App\Http\Livewire\ProfileBank;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateSettingsForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the active profile.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Determine if the verification email was sent.
     *
     * @var bool
     */
    public $verificationLinkSent = false;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $activeProfile = session('activeProfileType')::find(session('activeProfileId'));

        $this->state = array_merge([
            'email' => $activeProfile->email,
            ], $activeProfile->withoutRelations()->toArray());
    }

    /**
     * Update the active profile's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation()
    {
        $this->resetErrorBag();


        $activeProfile = getActiveProfile();

        if ($this->photo) {
            // Delete old file if it doesn't start with "app-images/" (as those are default images)
            if ($activeProfile->profile_photo_path
                && !Str::startsWith($activeProfile->profile_photo_path, 'app-images/')) {
                Storage::disk('public')->delete($activeProfile->profile_photo_path);
            }

            // Store the new file
            $photoPath = $this->photo->store('profile-photos', 'public');
            $this->state['profile_photo_path'] = $photoPath;
        }

        // Update records of active profile
        $activeProfile->update($this->state);

        $this->state = $activeProfile->fresh()->toArray();

        session(['activeProfilePhoto' => $this->state['profile_photo_path']]);

        if (isset($this->photo)) {
            return redirect()->route('profile.bank.settings');
        }

        $this->dispatch('saved');

        $this->dispatch('refresh-navigation-menu');
    }

    /**
     * Delete active profile's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        $activeProfile = getActiveProfile();

        // If the existing photo path is not one of the default images, delete it
        if ($activeProfile->profile_photo_path
            && !Str::startsWith($activeProfile->profile_photo_path, 'app-images/')) {
            Storage::disk('public')->delete($activeProfile->profile_photo_path);
        }

        // Set the profile photo path to the configured default in your config file
        $defaultPath = config('timebank-cc.profiles.' . strtolower(getActiveProfileType()) . '.profile_photo_path_default');
        $this->state['profile_photo_path'] = $defaultPath;


        // Refresh the component state with the updated model data
        $this->state = $activeProfile->fresh()->toArray();

        // Update the session variable so the Blade view can display the new photo
        session(['activeProfilePhoto' => $defaultPath]);

        redirect()->route('profile.bank.settings');

        // Dispatch any events if desired, for example:
        $this->dispatch('saved');

        $this->dispatch('refresh-navigation-menu');

    }

    /**
     * Sent the email verification.
     *
     * @return void
     */
    public function sendEmailVerification()
    {
        getActiveProfile()->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;
    }

    /**
     * Get the current active profile of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return getActiveProfile();
    }



    public function render()
    {
        return view('livewire.profile-bank.update-settings-form');
    }
}
