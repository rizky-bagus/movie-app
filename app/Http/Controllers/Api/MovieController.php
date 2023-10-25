<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieService;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function createMovie(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'artists' => 'required|string',
            'genres' => 'required|string',
            'watch_url' => 'required|url',
        ]);

        $movie = $this->movieService->createMovie($validatedData);

        return response()->json(['message' => 'Movie created successfully', 'movie' => $movie], 201);
    }

    public function updateMovie(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'duration' => 'integer',
            'artists' => 'string',
            'genres' => 'string',
            'watch_url' => 'url',
        ]);

        $movie = $this->movieService->updateMovie($id, $validatedData);

        return response()->json(['message' => 'Movie updated successfully', 'movie' => $movie], 200);
    }

    public function mostViewed()
    {
        $mostViewedMovie = $this->movieService->getMostViewedMovie();
        $mostViewedGenre = $this->movieService->getMostViewedGenre();

        return response()->json(['most_viewed_movie' => $mostViewedMovie, 'most_viewed_genre' => $mostViewedGenre], 200);
    }

    public function listMovies()
    {
        $movies = $this->movieService->listMovies();

        return response()->json($movies, 200);
    }

    public function searchMovies(Request $request)
    {
        $query = $request->input('query');
        $movies = $this->movieService->searchMovies($query);

        return response()->json($movies, 200);
    }

    public function trackViewership($id)
    {
        $this->movieService->trackViewership($id);

        return response()->json(['message' => 'Viewership tracked successfully'], 200);
    }
}
