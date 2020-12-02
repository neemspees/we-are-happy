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

    /**
     * {@inheritDoc}
     */
    public function getLastByUserId(int $userId): ?VoteCast
    {
        return VoteCast::query()
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
