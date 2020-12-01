<?php

namespace App\Repositories\Interfaces;

use App\Models\Vote;

interface IVoteRepository
{
    /**
     * @param Vote $vote
     *
     * @return Vote
     */
    public function store(Vote $vote): Vote;
}
