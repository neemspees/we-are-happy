<?php

namespace App\Repositories;

use App\Models\Vote;
use App\Repositories\Interfaces\IVoteRepository;

class VoteRepository implements IVoteRepository
{
    /**
     * {@inheritDoc}
     */
    public function store(Vote $vote): Vote
    {
        $vote->save();
        return $vote;
    }
}
