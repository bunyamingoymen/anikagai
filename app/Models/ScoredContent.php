<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoredContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_code',
        'content_code',
        'score',
        'content_type'
    ];
}
