<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransferReceived extends Mailable implements ShouldQueue  // ShouldQueue here creates the class as a background job
{
    use Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)     // Binds the Transaction model to $transaction
    {
        $this->transaction = $transaction;                    // and assigns it to the public $transaction object.
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = __("Payment received from {$this->transaction->creator->name}");
        return $this
            ->from('info@timebank_2.cc', 'Ronald de admin')      // Optional, alternative from data, other than the global one.
            ->subject($subject)
            ->markdown('emails.transfers.received');
    }
}
