<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeContentUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_code',
        'content_episode_code',
        'content_type',
        'comment_code',
        'like_type',
        'user_code',
    ];
}
