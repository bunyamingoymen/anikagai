<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ShopSellers extends Authenticatable
{
    use HasFactory;

    // İkinci veritabanı bağlantısını belirtiyoruz
    protected $connection = 'shop_mysql';

    protected $fillable = [
        'code',
        'show_name',
        'username',
        'email',
        'password',
        'image',
        'product_count',
        'description',
        'phone',
        'facebook',
        'instagram',
        'twitter',
        'discord',
        'website',
        'is_active',
        'create_user_code',
        'update_user_code',
        'deleted'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
