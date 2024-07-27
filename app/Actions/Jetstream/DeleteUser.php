<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesUsers;
use RTippin\Messenger\Actions\Friends\RemoveFriend;
use RTippin\Messenger\Actions\Messages\PurgeAudioMessages;
use RTippin\Messenger\Actions\Messages\PurgeDocumentMessages;
use RTippin\Messenger\Actions\Messages\PurgeImageMessages;
use RTippin\Messenger\Actions\Messages\PurgeVideoMessages;
use RTippin\Messenger\Contracts\BroadcastDriver;
use RTippin\Messenger\Models\Friend;
use RTippin\Messenger\Models\Message;
use RTippin\Messenger\Services\FileService;
use Throwable;

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
            // START
            // DB::transaction(function () use ($user): void {

            //     // Detach all relationships that do not need any historic record.
            //     $user->locations()->delete();
            //     $user->languages()->detach();
            //     $user->socials()->detach();
            //     $user->friends()->delete();
            //     $user->pendingFriends()->delete();
            //     $user->organizations()->detach();   // historic actions are recorded by user id, and will be anonymized
            //     $user->banks()->detach();   // historic actions are recorded by user id, and will be anonymized


            //     // Anonymize profile

            //     // Initial anonymized name
            //     $newName = 'Removed user ' . $user->id;
            //     // Check if the new name exists and append a random number if it does
            //     while (User::where('name', $newName)->exists()) {
            //         $randomNumber = rand(1, 1000); // Generate a random number
            //         $newName = 'Removed user ' . $user->id . '-' . $randomNumber; // Append the random number to the name
            //     }
            //     $user->name = $newName;

            //     $user->full_name = 'Removed user ' . $user->id;

            //     // Initial anonymized email
            //     $newEmail = $user->id . '@remove.ed';
            //     // Check if the new email exists and append a random number if it does
            //     while (User::where('email', $newEmail)->exists()) {
            //         $randomNumber = rand(1, 1000); // Generate a random number
            //         $newEmail = $user->id . $randomNumber . '@remove.ed'; // Append the random number to the user's ID in the email
            //     }
            //     $user->email = $newEmail;
            //     $user->email_verified_at = null;
            //     $user->password = "";
            //     $user->deleteProfilePhoto();
            //     $user->profile_photo_path = 'app-images/profile-user-removed.svg';
            //     $user->about = null;
            //     $user->about_short = null;
            //     $user->motivation = null;
            //     $user->date_of_birth = null;
            //     $user->website = null;
            //     $user->phone = null;
            //     $user->phone_public_for_friends = 0;
            //     $user->current_team_id = null;
            //     $user->limit_min = 0;
            //     $user->limit_max = 0;
            //     $user->inactive_at = now();
            //     $user->lang_preference = null;
            //     $user->save();

            //     // Remove participant from messenger threads and  remove threads where user is sole admin.

            //     // Fetch thread IDs where the user is the sole admin
            //     $singleAdminThreads = DB::table('participants')
            //         ->select('thread_id')
            //         ->where('admin', true)
            //         ->groupBy('thread_id')
            //         ->havingRaw('COUNT(*) = 1')
            //         ->pluck('thread_id');

            //     // Fetch participant records for the user as admin in those threads
            //     $participantsThreadAdminOwned = DB::table('participants')
            //         ->whereIn('thread_id', $singleAdminThreads)
            //         ->where('owner_id', $user->id)
            //         ->where('admin', true)
            //         ->whereNull('deleted_at')
            //         ->get(['id', 'thread_id']); // Only select necessary fields

            //     // Extract thread IDs from the participants
            //     $threadIds = $participantsThreadAdminOwned->pluck('thread_id');

            //     // Update threads to mark them as deleted
            //     DB::table('threads')
            //         ->whereIn('id', $threadIds)
            //         ->whereNull('deleted_at')
            //         ->update(['deleted_at' => now()]);

            //     // Update participant records to mark them as deleted
            //     DB::table('participants')
            //         ->whereIn('thread_id', $threadIds)
            //         ->where('owner_id', $user->id)
            //         ->where('admin', true)
            //         ->whereNull('deleted_at')
            //         ->update(['deleted_at' => now()]);

            //     // Update non-admin participant records for the user to mark them as deleted
            //     DB::table('participants')
            //         ->where('owner_id', $user->id)
            //         ->where('admin', false)
            //         ->whereNull('deleted_at')
            //         ->update(['deleted_at' => now()]);


            //     // Purge Messenger message files
            //     $messages = Message::where('owner_type', 'App\Models\User')
            //         ->where('owner_id', $user->id)
            //         ->where('type', '<>', Message::MESSAGE)
            //         ->get(['id']);

            //     $app = app(); // Get the Laravel application instance
            //     $fileSystemManager = new \Illuminate\Filesystem\FilesystemManager($app);
            //     $fileService = new FileService($fileSystemManager);

            //     $purgeClasses = [
            //         PurgeAudioMessages::class,
            //         PurgeDocumentMessages::class,
            //         PurgeImageMessages::class,
            //         PurgeVideoMessages::class,
            //     ];

            //     foreach ($purgeClasses as $purgeClass) {
            //         (new $purgeClass($fileService))->execute($messages);
            //     }


            //     // Remove Messenger messages
            //     DB::table('messages')
            //         ->where('owner_type', 'App\Models\User')
            //         ->where('owner_id', $user->id)
            //         ->update(['body' => __('Removed message')]);


            //     // Remove Messenger friends
            //     $friends = Friend::where('owner_type', 'App\Models\User')
            //         ->where('owner_id', $user->id)
            //         ->get();

            //     $broadcaster = app(BroadcastDriver::class);
            //     $database = app(DatabaseManager::class);
            //     $dispatcher = app(Dispatcher::class);

            //     $removeFriendAction = new RemoveFriend($broadcaster, $database, $dispatcher);

            //     foreach ($friends as $friend) {
            //         $removeFriendAction->execute($friend);
            //     }

            //     // Unreact all Laravel-love reactions (i.e. stars, likes, etc)        
            //     // Unreact each send reaction
            //     $reacterFacade = $user->getloveReacter();
            //     $reactions = $reacterFacade->getReactions()->load(['reactant', 'type']);
            //     foreach ($reactions as $reaction) {
            //         if ($reaction->reactant && $reaction->type) {
            //             $reacterFacade->unReactTo($reaction->reactant, $reaction->type);
            //         }
            //     }
            //     // Unreact each received reaction
            //     $reactantFacade = $user->getloveReactant();
            //     $receivedReactions = $reactantFacade->getReactions()->load(['reacter', 'type']);
            //     foreach ($receivedReactions as $reaction) {
            //         if ($reaction->reacter && $reaction->type) {
            //             $reaction->reacter->unReactTo($reaction->reactant, $reaction->type);
            //         }
            //     }

            //     // Remove all taggable skills
            //     $user->detag();

            //     // Delete tokens and logout

            //     $user->tokens->each->delete();

            // });
            // STOP

            // End of transaction

            // // WireUI notification
            // $this->notification()->success(
            //     $title = __('Your profile has been deleted'),
            //     $description = __('Sorry to see you go.') . '<br /><br />' . __('Your balance totals and data have been successfully deleted. All your transactions have been anonymized.')
            // );

            
            //return redirect()->route('welcome');

            return ['status' => 'success'];



        } catch (Throwable $e) {

            // $this->waitMessage = false;

            // WireUI notification
            // // TODO!: create event to send error notification to admin
            // $this->notification([
            // 'title' => __('Can not delete profile!'),
            // 'description' => __('Sorry, it was not possible to delete your profile.') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
            // 'icon' => 'error',
            // 'timeout' => 200000
            // ]);

            // return back();
            
            return ['status' => 'error', 'message' => $e->getMessage()];

        }
    }
}
