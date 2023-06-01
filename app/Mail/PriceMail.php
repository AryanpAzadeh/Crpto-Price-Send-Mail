<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PriceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $MailData;
    /**
     * Create a new message instance.
     */
    public function __construct($MailData)
    {
        $this->MailData = $MailData;
    }

    public function build()
    {
        return $this->subject('قیمت ارز')
            ->view('price_mail');
    }
}
