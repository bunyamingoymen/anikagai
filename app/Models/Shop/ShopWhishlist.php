<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopWhishlist extends Model
{
    use HasFactory;

    protected $connection = 'shop_mysql';

    protected $fillable = [
        'code',
        'user_code',
        'product_code',
        'wishlist_price',
        'deleted',
    ];
}
