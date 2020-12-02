<?php

namespace App\Exceptions;

use App\Models\User;
use Exception;

class UserAlreadyVotedException extends Exception
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct('This user already voted');
    }
}
