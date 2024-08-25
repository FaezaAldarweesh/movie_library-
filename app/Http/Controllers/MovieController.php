<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Services\MovieService;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    /**
     * construct to inject Movie Service
     * @param MovieService $movieservices
     */
    protected $movieservices;
    public function __construct(MovieService $movieservices)
    {
        $this->movieservices = $movieservices;
    }

    //========================================================================================================================
    /**
     * method to view all movies
     * @return /Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {  
        return $this->movieservices->getAllMovies($request);
    }

    //========================================================================================================================
    /**
     * method to store a new movie
     * @param  StoreMovieRequest $request
     * @return /Illuminate\Http\JsonResponse
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = $request->validated();
        return $this->movieservices->createMovie($movie);
    }

    //========================================================================================================================
    /**
     * method to show movie alraedy exist
     * @param  Movie $movie
     * @return /Illuminate\Http\JsonResponse
     */
    public function show(Movie $movie)
    {
        return $this->movieservices->showMovie($movie);
    }

    //========================================================================================================================
    /**
     * method to update movie alraedy exist
     * @param  UpdateMovieRequest $request
     * @param  Movie $movie
     * @return /Illuminate\Http\JsonResponse
     */
    public function update(UpdateMovieRequest $request,Movie $movie)
    {
        return $this->movieservices->updateMovie($request->validated(),$movie);
    }

    //========================================================================================================================
    /**
     * method to destroy movie alraedy exist
     * @param  Movie $movie
     * @return /Illuminate\Http\JsonResponse
     */
    public function destroy(Movie $movie)
    {
        return $this->movieservices->deleteMovie($movie);
    }
}
