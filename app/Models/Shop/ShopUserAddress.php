<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopUserAddress extends Model
{
    use HasFactory;

    protected $connection = 'shop_mysql';
}
