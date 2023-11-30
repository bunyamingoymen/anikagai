<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowAnime extends Model
{
    use HasFactory;

    protected $fillable = [
        'anime_code',
        'user_code',
    ];
}
