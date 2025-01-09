<?php

namespace App\Mail;

use App\Models\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class TagAddedMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;
    
    public $tagId;

    /**
     * Create a new message instance.
     *
     * @param $tagInfo
     */
    public function __construct($tagId)
    {
        $this->tagId = $tagId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tagInfo = collect((new Tag())->translateTagIdsWithContexts($this->tagId, App::getLocale(), App::getFallbackLocale()));
        
        return $this
                ->from('admin@timebank.cc', 'Timebank.cc Administration') // Optional: set alternative from data, other than the global one.
                ->subject(trans('messages.new_tag_added', [], $this->locale) . ': ' . $tagInfo->first()['tag'])
                ->markdown('emails.tags.' . App::getLocale() . '.new')
                ->with(['tagInfo' => $tagInfo->first() ]); 

    }
}
