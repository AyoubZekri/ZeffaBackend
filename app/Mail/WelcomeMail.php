<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codeverfy;

    public function __construct($codeverfy)
    {
        $this->codeverfy = $codeverfy;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'مرحبا بك في موقعنا'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
            with: [
                'codeverfy' => $this->codeverfy
            ]
        );
    }
}
