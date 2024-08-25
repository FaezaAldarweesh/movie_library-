<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Services\RatingService;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Movie;

class RatingController extends Controller
{    /**
     * construct to inject Rating Service 
     * @param RatingService $ratingservices
     */
    protected $ratingservices;
    public function __construct(RatingService $ratingservices)
    {
        $this->ratingservices = $ratingservices;
    }

    //========================================================================================================================
    /**
     * method to store a new rating
     * @param  StoreRatingRequest $request
     * @param  $id_movie
     * @return /Illuminate\Http\JsonResponse
     */
    public function store(StoreRatingRequest $request ,  $id_movie)
    {
        $rating = $request->validated();
        return $this->ratingservices->createRating($rating , $id_movie);
    }
    //========================================================================================================================
    /**
     * method to show rating alraedy exist
     * @param  $id //id rating
     * @return /Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        return $this->ratingservices->showRating($id);
    }

    //========================================================================================================================
    /** 
     * method to update rating alraedy exist
     * @param  UpdateRatingRequest $request
     * @param  $id_rating
     * @return /Illuminate\Http\JsonResponse
     */
    public function update(UpdateRatingRequest $request, $id_rating)
    {
        return $this->ratingservices->updateRating($request->validated(),$id_rating);
    }

    //========================================================================================================================
    /**
     * method to destroy rating alraedy exist
     * @param  $id_rating
     * @return /Illuminate\Http\JsonResponse
     */
    public function destroy($id_rating)
    {
        return $this->ratingservices->deleteRating($id_rating);
    }
}
