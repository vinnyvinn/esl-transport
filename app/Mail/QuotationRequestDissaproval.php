<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuotationRequestDissaproval extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $url;
    protected $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$url,$reason)
    {
        $this->user = $user;
        $this->url = $url;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->user->email)
        ->markdown('emails.quotations.request-disapproval',[
            'name' => $this->user->name,
            'url' => $this->url,
            'reason' => $this->reason
        ]);
    }
}
