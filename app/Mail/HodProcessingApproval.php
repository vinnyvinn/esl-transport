<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HodProcessingApproval extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $owner;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$owner,$url)
    {
        $this->user = $user;
        $this->owner = $owner;
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
        ->subject('Quotation Processing Approval')
        ->markdown('emails.quotations.hod_processing_approval',[
            'name' => $this->user->name,
            'owner' => $this->owner->name,
            'url' => $this->url,
        ]);
    }
}
