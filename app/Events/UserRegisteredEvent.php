<?php

namespace App\Events;

use App\Models\User;

class UserRegisteredEvent extends Event
{

    /**
     * User $user.
     *
     * @return void
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
