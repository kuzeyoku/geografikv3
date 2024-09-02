<?php

namespace App\Mail\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class ReplyMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;
    protected $message;

    public function __construct(Request $request, Message $message)
    {
        $this->request = $request;
        $this->message = $message;
    }

    public function envelope(): Envelope
    {
        $fromAddress = settings("smtp.from_address", env("MAIL_FROM_ADDRESS"));
        $fromName = settings("smtp.from_name", env("MAIL_FROM_NAME"));

        $from = new Address($fromAddress, $fromName);
        $subject = $this->request->subject;

        return new Envelope(from: $from, subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'admin.emails.reply_message',
            with: [
                'text' => $this->request->message,
                'name' => $this->message->name,
                'title' => settings("general.title", env("APP_NAME"))
            ]
        );
    }
}
