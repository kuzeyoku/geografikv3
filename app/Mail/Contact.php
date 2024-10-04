<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected array $data)
    {
    }

    public function envelope(): Envelope
    {
        $replyTo = [new Address($this->data["email"])];
        $subject = setting("general", "title") . " İletişim";

        return new Envelope(replyTo: $replyTo, subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact',
            with: [
                'name' => $this->data["name"],
                'email' => $this->data["email"],
                'phone' => $this->data["phone"],
                "subject" => $this->data["subject"],
                "message" => $this->data["message"]
            ]
        );
    }
}
