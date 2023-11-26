<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadedWebtoon extends Model
{
    use HasFactory;
    protected $fillable = [
        'webtoon_code',
        'user_code',
    ];
}
