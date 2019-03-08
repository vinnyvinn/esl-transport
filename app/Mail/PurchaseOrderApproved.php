<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PurchaseOrderApproved extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $recepient;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$recepient, $url)
    {
        $this->user = $user;
        $this->recepient = $recepient;
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
        ->subject(ucwords('Purchase Order Approved '))
        ->markdown('emails.po.po-approved',[
            'sendee' => $this->recepient,
            'sender' => $this->user->name,
            'url' => $this->url
        ]);
    }
}
