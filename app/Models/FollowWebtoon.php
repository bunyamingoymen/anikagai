<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowWebtoon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'followed_webtoon_code',
        'user_code',
    ];
}
