<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrders extends Model
{
    use HasFactory;

    // İkinci veritabanı bağlantısını belirtiyoruz
    protected $connection = 'shop_mysql';

    protected $fillable = [
        'code',
        'order_code',
        'user_code',
        'product_count',
        'is_approved',
        'status',
        'order_date',
        'estimated_date',
        'is_archive',
        'deleted',
    ];
}
