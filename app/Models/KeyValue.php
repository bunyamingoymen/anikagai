<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'key',
        'value',
        'optional',
        'optional_2',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
