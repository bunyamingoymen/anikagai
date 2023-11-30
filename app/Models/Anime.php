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
        'short_name',
        'image',
        'description',
        'episode_count',
        'season_count',
        'average_min',
        'date',
        'main_category',
        'main_category_name',
        'click_count',
        'comment_count',
        'scoreUsers',
        'score',
        'create_user_code',
        'onlyUsers',
        'update_user_code',
        'deleted',
    ];
}
