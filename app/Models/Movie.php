<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'director',
        'category_id',
        'release_year',
        'description'
    ];
    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
       return $this->hasMany(Rating::class);
    }
}
