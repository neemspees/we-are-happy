<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\UserAlreadyVotedException;
use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Services\Interfaces\IVoteService;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function doVote(Request $request, IVoteService $voteService)
    {
        $request->validate([
            'mood' => ['integer', 'between:0,2', 'required']
        ]);

        $user = $request->user();

        $vote = new Vote();
        $vote->mood = $request->post('mood');

        try {
            $voteService->castVote($user, $vote);
        } catch (UserAlreadyVotedException $e) {
            return redirect()->back()->withErrors(['form' => 'You already voted today.']);
        }

        return redirect()->route('vote.success');
    }
}
