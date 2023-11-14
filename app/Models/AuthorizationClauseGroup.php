<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizationClauseGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'clause_id',
        'group_id',
        'create_user_code',
        'update_user_code',
    ];
}
