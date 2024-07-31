<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserDeletedMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    protected $result;

    /**
     * Create a new message instance.
     */
    public function __construct($result)
    {
        $this->result = $result;
        $this->locale = $result['deletedUser']->lang_preference;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {      
        return $this
                ->from('admin@timebank.cc', 'Timebank.cc Administration') // Optional: set alternative from data, other than the global one.
                ->subject(trans('messages.Your_profile_has_been_deleted', [], $this->locale))
                ->markdown('emails.administration.' . $this->locale . '.user-deleted')
                ->with([
                    'name' => $this->result['deletedUser']->name,
                    'full_name' => $this->result['deletedUser']->full_name,
                    'deletedMail' => $this->result['mail'],
                    'time' => $this->result['time']
                ]);
    }
    

}
