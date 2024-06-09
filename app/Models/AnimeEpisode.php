<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'anime_code',
        'image',
        'video',
        'description',
        'season_short',
        'episode_short',
        'click_count',
        'video_minute',
        'video_second',
        'intro_start_time_min',
        'intro_start_time_sec',
        'intro_end_time_min',
        'intro_end_time_sec',
        'next_episode_time_min',
        'next_episode_time_sec',
        'show_intro_button',
        'show_next_episode_button',
        'is_url',
        'publish_date',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
