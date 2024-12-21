<?php

namespace App\Jobs;

use App\Mail\NewMessageMail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailNewMessage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $tries = 3;
    public $backoff = [2, 10, 30]; // wait for 2, 10, or 30 sec before worker tries again

    public $event;

    /**
     * Create a new job instance.
     *
     * @param object $event
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->event || !$this->event->message || !$this->event->thread) {
            Log::error('Event, message, or thread is null.');
            return;
        }

        $owner = $this->event->message->owner_type::find($this->event->message->owner_id);

        // Get participants who are not the sender
        $participants = DB::table('participants')
            ->where('thread_id', $this->event->thread->id)
            ->whereNotIn('owner_id', [$this->event->message->owner_id])
            ->select('owner_type', 'owner_id', 'last_read')
            ->get();

        foreach ($participants as $participant) {
            try {
                // TODO remove debug
                Log::info('Processing participant:', ['participant' => $participant]);
                // Get the recipient model
                $recipient = $participant->owner_type::find($participant->owner_id);

                // Retrieve recipient's message settings
                $messageSettings = $recipient->message_settings()->first();

                // Determine if the chat is personal or group
                $isPersonalChat = $this->event->thread->type === 1;
                $isGroupChat = $this->event->thread->type === 2;

                Log::info('Chat type:', ['isPersonalChat' => $isPersonalChat, 'isGroupChat' => $isGroupChat]);

                // Set default delay if no message settings are found
                $delayInHours = config('timebank-cc.messenger.default_unread_mail_delay');

                if ($messageSettings) {
                    Log::info('Message settings:', ['personal_chat' => $messageSettings->personal_chat, 'group_chat' => $messageSettings->group_chat]);

                    // Continue if message settings are found and the appropriate chat type is enabled
                    if (($isPersonalChat && $messageSettings->personal_chat) || ($isGroupChat && $messageSettings->group_chat)) {
                        // Get the recipient's 'chat_unread_delay' in hours
                        $delayInHours = $messageSettings->chat_unread_delay;
                    } else {
                        Log::info('Chat notifications disabled', ['recipient_id' => $recipient->id, 'chat_type' => $this->event->thread->type]);
                        continue;
                    }
                } else {
                    Log::info('No message settings found for recipient, using default delay', ['recipient_id' => $recipient->id]);
                }

                // Calculate if the message is already read
                $lastRead = $participant->last_read ? Carbon::parse($participant->last_read) : null;
                $messageCreatedAt = $this->event->message->created_at;

                if ($lastRead && $lastRead->greaterThanOrEqualTo($messageCreatedAt)) {
                    // The recipient has already read the message
                    Log::info('Recipient has already read the message', ['recipient_id' => $recipient->id]);
                    continue;
                }

                // Dispatch a job to send the email after the delay
                SendDelayedEmail::dispatch($this->event, $owner, $recipient)->delay(now()->addHours($delayInHours));
                Log::info('Dispatched SendDelayedEmail job', ['recipient_id' => $recipient->id, 'delay' => $delayInHours]);
            } catch (\Exception $e) {
                Log::error('Error processing participant', [
                    'participant' => $participant,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }
    }
}
