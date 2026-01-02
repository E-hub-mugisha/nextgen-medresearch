<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $messageBody;
    public $projectTitle;

    public function __construct($sender, $messageBody, $projectTitle)
    {
        $this->sender = $sender;
        $this->messageBody = $messageBody;
        $this->projectTitle = $projectTitle;
    }

    public function build()
    {
        return $this->subject('New Message About Project: ' . $this->projectTitle)
                    ->view('emails.new-message');
    }
}
