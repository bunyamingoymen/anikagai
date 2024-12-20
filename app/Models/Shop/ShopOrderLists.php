<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrderLists extends Model
{
    use HasFactory;

    // İkinci veritabanı bağlantısını belirtiyoruz
    protected $connection = 'shop_mysql';

    protected $fillable = [
        'code',
        'order_code',
        'product_code',
        'product_count',
    ];
}
