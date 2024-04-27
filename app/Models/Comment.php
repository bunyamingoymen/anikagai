<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'content_code',
        'content_top_code',
        'content_type',
        'comment_type',
        'comment_top_code',
        'comment_short',
        'message',
        'user_code',
        'date',
        'deleted'
    ];
}
