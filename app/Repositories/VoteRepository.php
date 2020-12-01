<?php

namespace App\Repositories;

use App\Models\Vote;
use App\Repositories\Interfaces\IVoteRepository;
use DateTime;
use Illuminate\Support\Collection;

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

    /**
     * {@inheritDoc}
     */
    public function getBetweenDates(DateTime $start, DateTime $end): Collection
    {
        return Vote::query()
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->get();
    }
}
