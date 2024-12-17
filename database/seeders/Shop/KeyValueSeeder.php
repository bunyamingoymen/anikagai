<?php

namespace Database\Seeders\Shop;

use App\Models\Shop\ShopKeyValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('shop_mysql')->table('shop_key_values')->truncate();


        //Modlar ----------------------------------------------------------------
        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'shop_modes',
                'value'  => 'mod_1',
                'optional' => 'Mod 1',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'shop_modes',
                'value'  => 'mod_2',
                'optional' => 'Mod 2',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'shop_modes',
                'value'  => 'mod_3',
                'optional' => 'Mod 3',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'shop_modes',
                'value'  => 'mod_4',
                'optional' => 'Mod 4',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'shop_modes',
                'value'  => 'mod_5',
                'optional' => 'Mod 5',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Ayarlar ----------------------------------------------------------------
        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'store_active',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'new_seller_accept',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'approw_not_required',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'add_archive',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'archive_time',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'delete_automatic',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'delete_time',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
    }
}
