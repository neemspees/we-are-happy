<?php

namespace App\Services\Interfaces;

use App\Exceptions\UserAlreadyVotedException;
use App\Models\VoteStatistics;
use App\Models\User;
use App\Models\Vote;

interface IVoteService
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function canUserVote(User $user): bool;

    /**
     * @param User $user
     * @param Vote $vote
     *
     * @throws UserAlreadyVotedException
     */
    public function castVote(User $user, Vote $vote): void;

    /**
     * @return VoteStatistics
     */
    public function getStatistics(): VoteStatistics;
}
