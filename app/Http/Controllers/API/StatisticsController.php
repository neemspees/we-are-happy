<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VoteStatisticsResource;
use App\Services\Interfaces\IVoteService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function get(Request $request, IVoteService $voteService)
    {
        return new VoteStatisticsResource($voteService->getStatistics());
    }
}
