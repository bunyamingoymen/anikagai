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
        'description',
        'episode_short',
        'click_count',
        'publish_date',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
