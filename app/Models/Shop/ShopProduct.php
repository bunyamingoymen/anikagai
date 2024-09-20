<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    use HasFactory;

    // İkinci veritabanı bağlantısını belirtiyoruz
    protected $connection = 'shop_mysql';

    protected $fillable = [
        'code',
        'seller_code',
        'url',
        'name',
        'price',
        'priceType',
        'description',
        'is_trend',
        'score',
        'reviewCount',
        'cargo_day',
        'cargo_company',
        'create_user_code',
        'update_user_code',
        'is_approved',
        'is_active',
        'deleted',
    ];
}
