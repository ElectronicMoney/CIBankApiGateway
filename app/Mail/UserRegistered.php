<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User $user.
     *
     * @return void
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@cafafanscoders.com')
        ->view('emails.users.registered')
        ->with([
            'name'=> $this->user->name,
            'username'=> $this->user->username,
            'email'=> $this->user->email,
        ]);
    }
}
