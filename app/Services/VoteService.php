<?php

namespace App\Services;

use App\Exceptions\UserAlreadyVotedException;
use App\Models\User;
use App\Models\Vote;
use App\Models\VoteCast;
use App\Repositories\Interfaces\IVoteCastRepository;
use App\Repositories\Interfaces\IVoteRepository;
use App\Services\Interfaces\IVoteService;
use Carbon\Carbon;

class VoteService implements IVoteService
{
    /** @var IVoteRepository */
    protected $voteRepository;
    /** @var IVoteCastRepository */
    protected $voteCastRepository;

    public function __construct(IVoteRepository $voteRepository, IVoteCastRepository $voteCastRepository)
    {
        $this->voteRepository = $voteRepository;
        $this->voteCastRepository = $voteCastRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function canUserVote(User $user): bool
    {
        $lastCast = $this->voteCastRepository->getLastByUserId($user->id);

        if ($lastCast === null) {
            return true;
        }

        $lastCastDateTime = Carbon::instance($lastCast->created_at);

        return Carbon::now()->startOfDay()->isAfter($lastCastDateTime);
    }

    /**
     * {@inheritDoc}
     */
    public function castVote(User $user, Vote $vote): void
    {
        if (!$this->canUserVote($user)) {
            throw new UserAlreadyVotedException($user);
        }

        $this->storeVoteCast($user);

        $this->voteRepository->store($vote);
    }

    /**
     * @param User $user
     */
    protected function storeVoteCast(User $user)
    {
        $voteCast = new VoteCast();
        $voteCast->user_id = $user->id;
        $voteCast->created_at = Carbon::now()->startOfDay();

        $this->voteCastRepository->store($voteCast);
    }
}
