<?php

namespace App\Services;

use App\Exceptions\UserAlreadyVotedException;
use App\Models\User;
use App\Models\Vote;
use App\Models\VoteCast;
use App\Models\VoteStatistics;
use App\Repositories\Interfaces\IVoteCastRepository;
use App\Repositories\Interfaces\IVoteRepository;
use App\Services\Interfaces\IVoteService;
use Illuminate\Support\Collection;

class VoteService implements IVoteService
{
    const PERIOD_DAY = 'day';
    const PERIOD_WEEK = 'week';
    const PERIOD_MONTH = 'month';

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

        $lastCastDateTime = $lastCast->created_at;

        return now()->startOfDay()->isAfter($lastCastDateTime);
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
     * {@inheritDoc}
     */
    public function getStatistics(): VoteStatistics
    {
        $votes = $this->getVotes();

        $statistics = new VoteStatistics();
        $statistics->dailyAverage = $this->getAverageVotesForPeriod($votes, self::PERIOD_DAY);
        $statistics->weeklyAverage = $this->getAverageVotesForPeriod($votes, self::PERIOD_WEEK);
        $statistics->monthlyAverage = $this->getAverageVotesForPeriod($votes, self::PERIOD_MONTH);

        return $statistics;
    }

    /**
     * @param User $user
     */
    protected function storeVoteCast(User $user)
    {
        $voteCast = new VoteCast();
        $voteCast->user_id = $user->id;
        $voteCast->created_at = now()->startOfDay();

        $this->voteCastRepository->store($voteCast);
    }

    /**
     * @return Vote[]|Collection
     */
    protected function getVotes(): Collection
    {
        $start = now()->startOfMonth();
        $startOfWeek = now()->startOfWeek();

        if ($startOfWeek->isBefore($start)) {
            $start = $startOfWeek;
        }

        return $this->voteRepository->getBetweenDates($start, now());
    }

    /**
     * @param Collection $votes
     * @param string $period
     *
     * @return float
     */
    protected function getAverageVotesForPeriod(Collection $votes, string $period): float
    {
        $votesInPeriod = $votes->filter(function ($vote) use ($period) {
            return $vote->created_at->isCurrentUnit($period);
        });

        $totalMood = $votesInPeriod->sum(function ($vote) {
            return $vote->mood;
        });

        if ($totalMood == 0) {
            return 0;
        }

        return $totalMood / $votesInPeriod->count();
    }
}
