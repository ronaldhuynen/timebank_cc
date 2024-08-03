<?php

namespace App\Http\Livewire\Profile;

use App\Mail\UserDeletedMail;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Livewire\Component;
use WireUi\Traits\WireUiActions;


class DeleteUserForm extends Component
{
    use WireUiActions;



    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingUserDeletion = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmUserDeletion()
    {
        $this->resetErrorBag();

        $this->password = '';

        $this->dispatch('confirming-delete-user');

        $this->confirmingUserDeletion = true;
    }

    /**
     * Delete the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Jetstream\Contracts\DeletesUsers  $deleter
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $auth
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
        public function deleteUser(Request $request, DeletesUsers $deleter, StatefulGuard $auth)
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $user = Auth::user();
        $time = DB::table('users')
                ->where('id', $user->id)
                ->pluck('updated_at')
                ->first();
                
        $time = Carbon::parse($time); // Convert the time to a Carbon instance

        $result = $deleter->delete(Auth::user()->fresh());

        $this->confirmingUserDeletion = false;

        if ($result['status'] === 'success') {

            $result['time'] = $time->translatedFormat('j F Y, H:i');
            $result['deletedUser'] = $user;
            $result['mail'] = $user->email;
            
            session()->flash('result', $result);
            Log::notice('User deleted: ' . $result['deletedUser']);
            Mail::to($user->email)->queue(new UserDeletedMail($result));
        
            $auth->logout();

            return redirect()->route('goodbye-deleted-user');
            
        } else {
            // Trigger WireUi error notification
            $this->notification()->error(
                $title = __('Deletion Failed'),
                $description = __('There was an error deleting your profile: ') . $result['message']
            );

            Log::warning('User deletion failed: ' . $result['deletedUser']);
            Log::error('Error message: ' . $result['message']);

            return redirect()->back();
        }
    }


    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('profile.delete-user-form');
    }
}
