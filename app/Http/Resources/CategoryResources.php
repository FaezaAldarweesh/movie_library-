<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'category name' => $this->name, 
            'movie that have this category' => $this->movies->map(function ($movie) {
                return [
                    'title' => $movie->title,
                    'director' => $movie->director,
                    'release_year' => $movie->release_year,
                    'description' => $movie->description,
                ];
            }),
        ];
    }
}
