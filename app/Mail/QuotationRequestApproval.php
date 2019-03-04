<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuotationRequestApproval extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $url;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->user->email)
        ->subject(ucwords('Quotation request approved'))
        ->markdown('emails.quotations.request-approval',[
            'name' => $this->user->name,
            'url' => $this->url,
        ]);
    }
}
