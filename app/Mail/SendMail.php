<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private string $title,
        private array $data,
        private $files
    ) {
        //
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Запрос с сайта',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.mail',
            with: [
                'title' => $this->title,
                'data' => $this->data,
            ]
        );
    }

    public function attachments()
    {
        $attachments = [];

        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $attachments[] = Attachment::fromPath($file->getRealPath())
                    ->as($file->getClientOriginalName())
                    ->withMime($file->getMimeType());
            }
        }

        return $attachments;
    }
}
