<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategoryFeatures extends Model
{
    use HasFactory;

    // İkinci veritabanı bağlantısını belirtiyoruz
    protected $connection = 'shop_mysql';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'category_code',
        'feature_code',
    ];
}
