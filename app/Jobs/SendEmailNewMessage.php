<?php

namespace App\Jobs;

use App\Mail\NewMessageMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailNewMessage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $tries = 3;
    public $backoff = [2,10,30]; // wait for 2, 10, or 30 sec before worker tries again

    protected $event;
    protected $read_before;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event, $read_before)
    {
        $this->event = $event;
        $this->read_before = $read_before;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $owner = $this->event->message->owner_type::where('id', $this->event->message->owner_id)->select('name', 'email', 'profile_photo_path')->first();
        $others = DB::table('participants')->where('thread_id', $this->event->thread->id)->where('last_read', '<', $this->read_before)->whereNotIn('owner_id', [$this->event->message->owner_id])->select('owner_type', 'owner_id', 'last_read')->get();

        $recipients = $others->map(function ($others, $key) {
            return $others->owner_type::where('id', $others->owner_id)->select('name', 'email', 'profile_photo_path')->get();
        });


        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new NewMessageMail($this->event, $owner, $recipient));
        }
    }
}
