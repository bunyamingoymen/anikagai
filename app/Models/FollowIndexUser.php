<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowIndexUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'followed_user_code',
        'user_code',
    ];
}
