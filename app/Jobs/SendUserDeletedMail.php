<?php

namespace App\Jobs;

use App\Mail\UserDeletedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendUserDeletedMail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;


    public $tries = 3;
    public $backoff = [5,10,30]; // wait for 5, 10, or 30 sec before worker tries again
    public $result;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($result)
    {
        $this->result = $result;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send the email
        Mail::to($this->result->email)->send(new UserDeletedMail($this->result));
    }

}
