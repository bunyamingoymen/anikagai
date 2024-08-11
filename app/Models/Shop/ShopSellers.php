<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSellers extends Model
{
    use HasFactory;

    // İkinci veritabanı bağlantısını belirtiyoruz
    protected $connection = 'shop_mysql';
}
