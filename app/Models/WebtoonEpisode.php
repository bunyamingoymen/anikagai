<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebtoonEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'webtoon_code',
        'image',
        'file',
        'description',
        'season_short',
        'episode_short',
        'click_count',
        'minute',
        'publish_date',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
