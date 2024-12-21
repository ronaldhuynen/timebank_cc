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

class SendDelayedEmail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $event;
    public $owner;
    public $recipient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event, $owner, $recipient)
    {
        $this->event = $event;
        $this->owner = $owner;
        $this->recipient = $recipient;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try {
            // Check if the recipient has read the message after the job was dispatched
            $participant = DB::table('participants')
                ->where('thread_id', $this->event->thread->id)
                ->where('owner_id', $this->recipient->id)
                ->select('last_read')
                ->first();

            $lastRead = $participant->last_read ? Carbon::parse($participant->last_read) : null;
            $messageCreatedAt = $this->event->message->created_at;

            if ($lastRead && $lastRead->greaterThanOrEqualTo($messageCreatedAt)) {
                // The recipient has already read the message; do not send the email
                Log::info('Recipient has already read the message', ['recipient_id' => $this->recipient->id]);
                return;
            }

            // Send the email
            Mail::to($this->recipient->email)->send(new NewMessageMail($this->event, $this->owner, $this->recipient));
            // TODO remove debug
            Log::info('Email sent to recipient', ['recipient_id' => $this->recipient->id]);
        
        } catch (\Exception $e) {
            Log::error('Error sending SendDelayedEmail', [
                'recipient_id' => $this->recipient->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
