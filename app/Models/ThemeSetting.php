<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'theme_code',
        'setting_name',
        'setting_value',
        'optional',
        'deleted',
    ];
}
