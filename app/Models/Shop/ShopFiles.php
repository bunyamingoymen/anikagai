<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopFiles extends Model
{
    use HasFactory;

    // İkinci veritabanı bağlantısını belirtiyoruz
    protected $connection = 'shop_mysql';

    protected $fillable = [
        'code',
        'parent_code',
        'name',
        'path',
        'type',
        'description',
        'create_user_code',
        'update_user_code',
        'deleted',
    ];
}
