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

        //Ücretler ----------------------------------------------------------------
        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'active_commission',
                'value'  => '1',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'commission_rate',
                'value'  => '5',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'active_free_cargo',
                'value'  => '1',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'free_cargo_price',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'other_sellers_change_free_cargo',
                'value'  => '1',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Modlar ----------------------------------------------------------------
        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'active_shop_mode',
                'value'  => 'mod_1',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'shop_modes',
                'value'  => 'mod_1',
                'optional' => 'Mod 1',
                'optional_2' => 'Kullanıcı hangi satıcıdan hangi ürünü alırsa alsın sadece tek bir kargo ücreti belirlenir. Ve satıcı Kargo ücreti belirleyemez.',
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
                'optional_2' => 'Kullanıcı hangi satıcıdan hangi ürünü alırsa alsın sadece tek bir kargo ücreti belirlenir. Ve satıcı Kargo ücreti belirleyebilir. Sadece tek bir satıcıdan ürün alınırsa bu kargo ücretini satıcı belirler. Aynı satıcıdan birden falza ürün alınırsa en yüksek kargo bedeli alınır.',
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
                'optional_2' => 'Kullanıcı farklı satıcılardan ürün alırsa her satıcı için ayrı ayrı kargo ücreti alınır. Satıcı belirli bir ücret üstüne o saticiya özel kargo ücreti ücretsiz yapılabilir.',
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
                'optional_2' => 'Kullanıcıdan her ürün için kargo ücreti alınır. Ve satıcı belirli bir ücret üstüne kargo ücretsiz yapamaz.',
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

        //Tema Ayarları ----------------------------------------------------------------
        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'use_same_color',
                'value'  => '0', //0 ise ana tema ile aynı renkler kullanılır, 1 ise girilen renkler
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'use_same_logo',
                'value'  => '0', // 0 ise aynı logo kullanılır, 1 ise aşağıdaki logo
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::connection('shop_mysql')->table('shop_key_values')->insert([
            [
                'code' => ShopKeyValue::max('code') + 1,
                'key'  => 'shop_logo',
                'value'  => '0',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
    }
}
