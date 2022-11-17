<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Mail\NewMessageMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Listeners\SendEmailNewMessage as ListenersSendEmailNewMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use RTippin\Messenger\Events\NewMessageEvent;

class SendEmailNewMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = [2,10,30]; // wait for 2, 10, or 30 sec before worker tries again

    protected $event;

    /**
     * Create a new job instance.
     *
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


        // info($this->event);

        $last_read_age = 0; // Minutes that a recipient did not read tha last message of a thread (conversation)
        $formatted_age = Carbon::now()->addMinutes($last_read_age)->toDateTimeString();

        // TODO: remove logs
        info('Send email with last_read:');
        info($formatted_age);

        info($this->event->message);


        $owner = $this->event->message->owner_type::where('id', $this->event->message->owner_id)->select('name', 'email', 'profile_photo_path')->first();
        $others = DB::table('participants')->where('thread_id', $this->event->thread->id)->where('last_read', '<', $formatted_age)->whereNotIn('owner_id', [$this->event->message->owner_id])->select('owner_type', 'owner_id', 'last_read')->get();

        $recipients = $others->map(function ($others, $key) {
            return $others->owner_type::where('id', $others->owner_id)->select('name', 'email', 'profile_photo_path')->get();
        });


        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new NewMessageMail($this->event, $owner, $recipient));

            info('Done!');
        }
    }
}
