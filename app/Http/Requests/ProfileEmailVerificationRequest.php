<?php

namespace App\Http\Requests;

use App\Events\ProfileVerified;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;

class ProfileEmailVerificationRequest extends FormRequest
{
    public $profileModel;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $type = $this->route('type');
        $profileId = $this->route('id');
        $modelClass = 'App\\Models\\' . \Illuminate\Support\Str::studly($type);

        if (!class_exists($modelClass)) {
            return false;   // not authorized
        }

        $profileModel = $modelClass::find($profileId);
        if (!$profileModel) {
            return false;    // not authorized
        }

        // Relationship check (User vs other profile role i.e. organization, bank, admin)
        if ($profileModel instanceof \App\Models\User) {
            // If it's a User model, compare IDs
            if ($profileModel->id !== $this->user()->id) {
                return false;   // not authorized, route id does not match logged user id
            }
            // Use the user's email for verification
            $emailToVerify = $this->user()->getEmailForVerification();
        } else {
            // For Organization/Bank/Admin using many-to-many relation
            if (
                !$profileModel
                    ->users()
                    ->where('users.id', $this->user()->id)
                    ->exists()
            ) {
                return false;   // not authorized, profile is not related to logged user id
            }
            // Use the profileModel's email for verification
            // If the profileModel doesn't provide getEmailForVerification() by default,
            // just call $profileModel->email or implement it.
            $emailToVerify = method_exists($profileModel, 'getEmailForVerification') ? $profileModel->getEmailForVerification() : $profileModel->email;
        }

        // Compare hash with the correct email
        $routeHash = (string) $this->route('hash');
        if (!hash_equals(sha1($emailToVerify), $routeHash)) {
            Log::error("Email hash mismatch: emailToVerify {$emailToVerify}, routeHash {$routeHash}");
            return false;   // not authorized, email hash mismatch with route's email hash
        }

        $this->profileModel = $profileModel;

        Log::info("Verification of email successful for " . class_basename($profileModel) . " id: " . $profileModel->id . " by user id: " . $this->user()->id );

        return true;    // authorized, proceed to fulfull() method to dispatch ProfileVerified event
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                //
            ];
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        if (!$this->profileModel->hasVerifiedEmail()) {
            $this->profileModel->markEmailAsVerified();

            event(new ProfileVerified($this->profileModel));
        }
        
        // Redirect to a view where the flash message will be displayed
        return redirect()->route('dashboard');
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return \Illuminate\Validation\Validator
     */
    public function withValidator(Validator $validator)
    {
        return $validator;
    }
}
