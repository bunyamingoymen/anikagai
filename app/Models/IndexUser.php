<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  \Illuminate\Foundation\Auth\User as Authenticatable;

class IndexUser extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'username',
        'email',
        'password',
        'image',
        'description',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
