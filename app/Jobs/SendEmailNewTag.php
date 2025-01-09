<?php

namespace App\Jobs;

use App\Mail\TagAddedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class SendEmailNewTag implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tagId;

    /**
     * Create a new job instance.
     *
     * @param $tagId
     */
    public function __construct($tagId)
    {
        $this->tagId = $tagId;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send the email notification
        Mail::to('admin@timebank.cc')->send(new TagAddedMail($this->tagId));
    }
}
