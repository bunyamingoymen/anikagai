<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('themes')->truncate();
        DB::table('theme_settings')->truncate();

        DB::table('themes')->insert([
            [
                'id' => 1,
                'code' => 1,
                'themeName'  => 'mox',
                'themePath' => 'themes.mox',
                'images' => 'user/img/themes/theme_1.png',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'code' => 2,
                'themeName'  => 'Animex',
                'themePath' => 'themes.animex',
                'images' => 'user/img/themes/theme_2.png',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'code' => 3,
                'themeName'  => 'MovieFX',
                'themePath' => 'themes.moviefx',
                'images' => 'user/img/themes/theme_3.png',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);

        DB::table('theme_settings')->insert([
            [
                'id' => 1,
                'code' => 1,
                'theme_code'  => 1,
                'setting_name' => 'listCount',
                'setting_value' => '8',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'code' => 2,
                'theme_code'  => 1,
                'setting_name' => 'showSlider',
                'setting_value' => '1',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'code' => 3,
                'theme_code'  => 1,
                'setting_name' => 'indexShowContent',
                'setting_value' => '20',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'code' => 4,
                'theme_code'  => 2,
                'setting_name' => 'listCount',
                'setting_value' => '12',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'code' => 5,
                'theme_code'  => 2,
                'setting_name' => 'showSlider',
                'setting_value' => '1',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'code' => 6,
                'theme_code'  => 2,
                'setting_name' => 'indexShowContent',
                'setting_value' => '6',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'code' => 7,
                'theme_code'  => 3,
                'setting_name' => 'listCount',
                'setting_value' => '10',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'code' => 8,
                'theme_code'  => 3,
                'setting_name' => 'showSlider',
                'setting_value' => '1',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 9,
                'code' => 9,
                'theme_code'  => 3,
                'setting_name' => 'indexShowContent',
                'setting_value' => '8',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
