<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'description', 'duration', 'artists', 'genres', 'watch_url', 'views'];
    protected $table = 'movies';

    public function voters()
    {
        return $this->belongsToMany(User::class, 'votes');
    }
}
