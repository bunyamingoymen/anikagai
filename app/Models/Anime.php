<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'image',
        'description',
        'episode_count',
        'click_count',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
