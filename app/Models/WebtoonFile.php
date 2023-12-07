<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebtoonFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'webtoon_episode_code',
        'file_type',
        'file',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
