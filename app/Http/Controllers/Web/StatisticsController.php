<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\IVoteService;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function statistics(IVoteService $voteService)
    {
        return view('statistics', ['statistics' => $voteService->getStatistics()]);
    }
}
