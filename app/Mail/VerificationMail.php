<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
 
    public string $nameUser;
    public $code;

    public function __construct(string $code, string $nameUser)
    {
        $this->code = $code;
        $this->nameUser = $nameUser;
    }

    public function build()
    {
        return $this->view('emails.verification')
            ->with([
                'code' => $this->code,
                'nameUser' => $this->nameUser
            ]);
    }
}
