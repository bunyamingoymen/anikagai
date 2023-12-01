<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchedAnime extends Model
{
    use HasFactory;
    protected $fillable = [
        'anime_code',
        'anime_episode_code',
        'user_code',
    ];
}
