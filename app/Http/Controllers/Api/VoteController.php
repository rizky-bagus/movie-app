<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VoteService;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function voteMovie(Request $request, $movieId)
    {
        $user = Auth::user();
        $this->voteService->voteMovie($user->id, $movieId);

        return response()->json(['message' => 'Vote recorded successfully'], 200);
    }

    public function unvoteMovie(Request $request, $movieId)
    {
        $user = Auth::user();
        $this->voteService->unvoteMovie($user->id, $movieId);

        return response()->json(['message' => 'Unvote recorded successfully'], 200);
    }

    public function userVotedMovies()
    {
        $user = Auth::user();
        $votedMovies = $this->voteService->getUserVotedMovies($user->id);

        return response()->json($votedMovies, 200);
    }

    public function mostVoted()
    {
        $mostVoted = $this->voteService->getMostVotedMovie();

        return response()->json(['most_voted_movie' => $mostVoted], 200);
    }

    public function mostVotedGenre()
    {
        $mostVotedGenre = $this->voteService->getMostVotedGenre();

        return response()->json(['most_voted_genre' => $mostVotedGenre], 200);
    }
}
