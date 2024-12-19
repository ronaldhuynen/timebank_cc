<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                // Log::info('Processing participant:', ['participant' => $participant]);
                // Get the recipient model
                $recipient = $participant->owner_type::find($participant->owner_id);

                // Retrieve recipient's message settings
                $messageSettings = $recipient->message_settings()->first();

                // Continue if message settings are found and 'personal_chat' is enabled
                if ($messageSettings && $messageSettings->personal_chat) {
                    // Get the recipient's 'chat_unread_delay' in seconds
                    $delayInSeconds = $messageSettings->chat_unread_delay;

                    // Calculate if the message is already read
                    $lastRead = $participant->last_read ? Carbon::parse($participant->last_read) : null;
                    $messageCreatedAt = $this->event->message->created_at;

                    if ($lastRead && $lastRead->greaterThanOrEqualTo($messageCreatedAt)) {
                        // The recipient has already read the message
                        Log::info('Recipient has already read the message', ['recipient_id' => $recipient->id]);
                        continue;
                    }

                    // Dispatch a job to send the email after the delay
                    SendDelayedEmail::dispatch($this->event, $owner, $recipient)->delay(now()->addSeconds($delayInSeconds));
                    Log::info('Dispatched SendDelayedEmail job', ['recipient_id' => $recipient->id, 'delay' => $delayInSeconds]);
                } else {
                    Log::info('Personal chat notifications disabled', ['recipient_id' => $recipient->id]);
                }
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
