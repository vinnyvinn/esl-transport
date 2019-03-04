<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientResponse extends Mailable
{
    use Queueable, SerializesModels;

    protected $quotation;
    protected $accepted;
    public $subject;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quotation,$accepted,$subject,$message)
    {
        $this->quotation = $quotation;
        $this->accepted = $accepted;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->quotation->lead->email)
        ->subject(ucwords($this->subject))
        ->markdown('emails.quotations.client-response',[
            'user' => $this->quotation->user->name,
            'lead' => $this->quotation->lead->name,
            'accepted' => $this->accepted,
            'id' => $this->quotation->id,
            'message' => $this->message,
        ]);
    }
}
