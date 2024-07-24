<?php

namespace App\Actions\Jetstream;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\DatabaseManager;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesUsers;
use RTippin\Messenger\Actions\Friends\RemoveFriend;
use RTippin\Messenger\Actions\Messages\PurgeDocumentMessages;
use RTippin\Messenger\Contracts\BroadcastDriver;
use RTippin\Messenger\Models\Message;
use RTippin\Messenger\Services\FileService;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
     
     try {
            // Use a transaction for creating the new user
            DB::transaction(function () use ($valid): void {
        
            
            // Detach all relationships that do not need any historic record.
            $user->locations()->detach();
            $user->languages()->detach();
            $user->socials()->detach();
            $user->friends()->detach();
            $user->pendingFriends()->detach();
            $user->organizations()->detach();   // historic actions are recorded by user id, and will be anonymized
            $user->banks()->detach();   // historic actions are recorded by user id, and will be anonymized
            
            
            // Anonymize profile
            
            // Initial anonymized name
            $newName = 'Removed user ' . $user->id;
            // Check if the new name exists and append a random number if it does
            while (User::where('name', $newName)->exists()) {
                $randomNumber = rand(1, 1000); // Generate a random number
                $newName = 'Removed user ' . $user->id . '-' . $randomNumber; // Append the random number to the name
            }
            $user->name = $newName;
            
            $user->full_name = 'Removed user ' . $user->id;

            // Initial anonymized email
            $newEmail = $user->id . '@remove.ed';
            // Check if the new email exists and append a random number if it does
            while (User::where('email', $newEmail)->exists()) {
                $randomNumber = rand(1, 1000); // Generate a random number
                $newEmail = $user->id . $randomNumber . '@remove.ed'; // Append the random number to the user's ID in the email
            }
            $user->email = $newEmail;
            $user->email_verified_at = null;
            $user->password = "";
            $user->deleteProfilePhoto();
            $user->about = null;
            $user->about_short = null;
            $user->motivation = null;
            $user->date_of_birth = null;
            $user->website = null;
            $user->phone = null;
            $user->phone_public_for_friends = 0;
            $user->current_team_id = null;
            $user->limit_min = 0;
            $user->limit_max = 0;
            $user->inactive_at = now();
            $user->save();


            // Detach Messenger profile? No not needed 

            // Softdelete messenger participant from messenger thread
            // By timestamping the deleted_at collumn in the participants table where owner_id = $user->id


            // Remove Messenger message files                              
            $messages = Message::where('owner_type', 'App\Models\User')
                ->where('owner_id', $user->id)
                ->where('type', '<>', Message::MESSAGE)
                ->get(['id']);

            $app = app(); // Get the Laravel application instance
            $fileSystemManager = new \Illuminate\Filesystem\FilesystemManager($app);
            $fileService = new FileService($fileSystemManager);

            $purgeClasses = [
                PurgeAudioMessages::class,
                PurgeDocumentMessages::class,
                PurgeImageMessages::class,
                PurgeVideoMessages::class,
            ];
            
            foreach ($purgeClasses as $purgeClass) {
                (new $purgeClass($fileService))->execute($messages);
            }

            // Remove Messenger messages            
            DB::table('messages')
                ->where('owner_type', 'App\Models\User')
                ->where('owner_id', $user->id)
                ->update(['body' => __('Removed message')]);           


            // Remove Messenger friends
            $friends = Friend::where('owner_type', 'App\Models\User')
                ->where('owner_id', $user->id)
                ->get();
            
            $broadcaster = app(BroadcastDriver::class);
            $database = app(DatabaseManager::class);
            $dispatcher = app(Dispatcher::class);
            
            $removeFriendAction = new RemoveFriend($broadcaster, $database, $dispatcher);
            
            foreach ($friends as $friend) {
                $removeFriendAction->execute($friend);
            }

                        

            // Detach Laravel-love 
            
            
            
            
            $user->tokens->each->delete();

            

            // $user->delete();
     });
            // End of transaction

            // $this->waitMessage = false;
            
            // WireUI notification
            $this->notification()->success(
                $title = __('Your profile has been deleted'),
                $description = __('Sorry to see you go.') . '<br /><br />' . __('Your balance totals and data have been successfully deleted. All your transactions have been anonymized.')
            );


            return redirect()->route('verification.notice');

        } catch (Throwable $e) {

            // $this->waitMessage = false;

            // WireUI notification
            // TODO!: create event to send error notification to admin
            $this->notification([
            'title' => __('Can not delete profile!'),
            'description' => __('Sorry, it was not possible to delete your profile.') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
            'icon' => 'error',
            'timeout' => 200000
            ]);

            return back();
        }
}
