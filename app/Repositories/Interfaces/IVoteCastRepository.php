<?php

namespace App\Repositories\Interfaces;

use App\Models\VoteCast;

interface IVoteCastRepository
{
    /**
     * @param VoteCast $voteCast
     *
     * @return VoteCast
     */
    public function store(VoteCast $voteCast): VoteCast;
}
