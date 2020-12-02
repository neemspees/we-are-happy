<?php

namespace App\Repositories\Interfaces;

use App\Models\Vote;
use DateTime;
use Illuminate\Support\Collection;

interface IVoteRepository
{
    /**
     * @param Vote $vote
     *
     * @return Vote
     */
    public function store(Vote $vote): Vote;

    /**
     * @param DateTime $start
     * @param DateTime $end
     *
     * @return Vote[]|Collection
     */
    public function getBetweenDates(DateTime $start, DateTime $end): Collection;
}
