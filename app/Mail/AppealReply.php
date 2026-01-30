<?php

namespace App\Mail;

use App\Models\Appeal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppealReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Appeal $appeal,
        public string $replyMessage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Відповідь на ваше звернення: {$this->appeal->subject}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appeal-reply',
        );
    }
}
