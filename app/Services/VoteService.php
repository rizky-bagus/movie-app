<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class VoteService
{
    public function voteMovie($userId, $movieId)
    {
        $user = User::findOrFail($userId);
        $user->votedMovies()->attach($movieId);
    }

    public function unvoteMovie($userId, $movieId)
    {
        $user = User::findOrFail($userId);
        $user->votedMovies()->detach($movieId);
    }

    public function getUserVotedMovies($userId)
    {
        $user = User::findOrFail($userId);
        return $user->votedMovies;
    }

    public function getMostVotedMovie()
    {
        return Movie::withCount('voters')->orderBy('voters_count', 'desc')->first();
    }

    public function getMostVotedGenre()
    {
        return Movie::select('genres', DB::raw('COUNT(votes.movie_id) as total_votes'))
            ->join('votes', 'movies.id', '=', 'votes.movie_id')
            ->groupBy('genres')
            ->orderBy('total_votes', 'desc')
            ->first();
    }
}
