<?php

namespace App\Repositories;

use App\Models\VoteCast;
use App\Repositories\Interfaces\IVoteCastRepository;

class VoteCastRepository implements IVoteCastRepository
{
    /**
     * {@inheritDoc}
     */
    public function store(VoteCast $voteCast): VoteCast
    {
        $voteCast->save();
        return $voteCast;
    }
}
