<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizationClause extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'text',
        'description',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
