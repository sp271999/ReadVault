<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // available in the view

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Welcome to ReadVault!')
                    ->markdown('emails.registration');
    }
}
