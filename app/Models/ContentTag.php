<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'tag_code',
        'content_code',
        'content_type',
    ];
}
