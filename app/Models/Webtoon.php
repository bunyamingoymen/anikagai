<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webtoon extends Model
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
        'main_category',
        'main_category_name',
        'date',
        'click_count',
        'comment_count',
        'scoreUsers',
        'score',
        'showStatus',
        'plusEighteen',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
