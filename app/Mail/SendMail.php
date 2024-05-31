<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private string $title,
        private string $body
    ) {
        //
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Send Mail',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.mail',
            with: [
                'title' => $this->title,
                'body' => $this->body,
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}
