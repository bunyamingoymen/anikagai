<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'notification_title',
        'notification_text',
        'from_user_code',
        'to_user_code',
        'notification_date',
        'readed',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
