<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebtoonCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'webtoon_code',
        'description',
        'publish_date',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
