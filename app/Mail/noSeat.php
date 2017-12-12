<?php

namespace busRegistration\Mail;

use busRegistration\Child;
use busRegistration\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class noSeat extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $child;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Child $child)
    {

        $this->user = $user;

        $this->child = $child;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // get the data content for the email from the database.

        return $this
            ->subject("RE: {$this->child->first_name} {$this->child->last_name} - Transportation Request")
            ->markdown('email.noSeat');

    }
}
