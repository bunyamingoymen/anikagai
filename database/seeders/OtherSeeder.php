<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'code' => Category::max('code') + 1,
                'name'  => 'Genel',
                'short_name' => 'genel',
                'description'  => 'Varsayılan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 2,
                'name'  => 'Bilim Kurgu',
                'short_name' => 'bilim_kurgu',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 3,
                'name'  => 'Doğa üstü',
                'short_name' => 'doga_ustu',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 4,
                'name'  => 'Murim',
                'short_name' => 'murim',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 5,
                'name'  => 'Macera',
                'short_name' => 'macera',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 6,
                'name'  => 'Romantizm',
                'short_name' => 'romantizm',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 7,
                'name'  => 'Sihir',
                'short_name' => 'sihir',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 8,
                'name'  => 'Büyü',
                'short_name' => 'buyu',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 9,
                'name'  => 'Dövüş Sanatları',
                'short_name' => 'dovus_sanatlari',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 10,
                'name'  => 'Komedi',
                'short_name' => 'komedi',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 11,
                'name'  => 'Sanal Gerçeklik',
                'short_name' => 'sanal_gerceklik',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 12,
                'name'  => 'Sistem',
                'short_name' => 'sistem',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 13,
                'name'  => 'Zamanda Yolculuk',
                'short_name' => 'zamanda_yolculuk',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 14,
                'name'  => 'Canavar',
                'short_name' => 'canavar',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 15,
                'name'  => 'Dram',
                'short_name' => 'dram',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 16,
                'name'  => 'Fantezi',
                'short_name' => 'fantezi',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 17,
                'name'  => 'Korku',
                'short_name' => 'korku',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 18,
                'name'  => 'Manga',
                'short_name' => 'manga',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 19,
                'name'  => 'Okul Hayatı',
                'short_name' => 'okul_hayati',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 20,
                'name'  => 'İsekai',
                'short_name' => 'isekai',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 21,
                'name'  => 'Manhwa',
                'short_name' => 'manhwa',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 22,
                'name'  => 'Modern',
                'short_name' => 'modern',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 23,
                'name'  => 'Reenkarnasyon',
                'short_name' => 'reenkarnasyon',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => Category::max('code') + 24,
                'name'  => 'Villain',
                'short_name' => 'villain',
                'description'  => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
