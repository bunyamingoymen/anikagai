<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopComment extends Model
{
    use HasFactory;

    protected $connection = 'shop_mysql';

    protected $fillable = [
        'code',
        'product_code',
        'user_code',
        'comment',
        'is_active',
        'deleted',
    ];
}
