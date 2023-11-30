<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebtoonCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'webtoon_code',
        'description',
        'first_date',
        'cycle_type',
        'special_type',
        'special_count',
        'end_date',
        'background_color',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
