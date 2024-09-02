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

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function envelope(): Envelope
    {
        $replyTo = [new Address($this->request->email)];
        $subject = config("general.title") . " İletişim";

        return new Envelope(replyTo: $replyTo, subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact',
            with: [
                'name' => $this->request->name,
                'email' => $this->request->email,
                'phone' => $this->request->phone,
                "subject" => $this->request->subject,
                "message" => $this->request->message
            ]
        );
    }
}
