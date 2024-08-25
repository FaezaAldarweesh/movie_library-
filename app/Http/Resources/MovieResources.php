<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'movie title' => $this->title,
            'movie director' => $this->director,
            'movie category' => $this->category->name,
            'movie release_year' => $this->release_year,
            'movie description' => $this->description,
            'movie rating' => $this->ratings->map(function ($rating) {
                return [
                    'user name' => $rating->user->name,
                    'movie name' => $rating->movie->title,
                    'rating' => $rating->rating,
                    'review' => $rating->review,
                ];
            }),
        ];
    }
}
