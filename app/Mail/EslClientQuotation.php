<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EslClientQuotation extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $lead;
    protected $url;
    public $subject;
    protected $message;
    protected $identifier;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $lead, $url, $subject, $message, $identifier)
    {
        $this->user = $user;
        $this->lead = $lead;
        $this->url = $url;
        $this->subject = $subject;
        $this->message = $message;
        $this->identifier = $identifier;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->user->email)
        ->subject(ucwords($this->subject))
        ->markdown('emails.quotations.send-customer-quotation',[
            'name' => $this->user->name,
            'lead' => $this->lead->name,
            'url' => $this->url,
            'message' => $this->message,
            'identifier' => $this->identifier
        ]);
    }
}
