<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class MovieService
{
    public function createMovie($data)
    {
        return Movie::create($data);
    }

    public function updateMovie($id, $data)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($data);
        return $movie;
    }

    public function getMostViewedMovie()
    {
        return Movie::orderBy('views', 'desc')->first();
    }

    public function getMostViewedGenre()
    {
        return Movie::select('genres', DB::raw('SUM(views) as total_views'))
            ->groupBy('genres')
            ->orderBy('total_views', 'desc')
            ->first();
    }

    public function listMovies()
    {
        return Movie::paginate(10);
    }

    public function searchMovies($query)
    {
        return Movie::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('artists', 'like', "%$query%")
            ->orWhere('genres', 'like', "%$query%")
            ->get();
    }

    public function trackViewership($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->views++;
        $movie->save();
    }
}
