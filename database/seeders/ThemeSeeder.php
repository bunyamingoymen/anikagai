<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\ThemeSetting;
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

        //1.Tema
        DB::table('themes')->insert([
            [
                'code' => Theme::max('code') + 1,
                'themeName'  => 'mox',
                'themePath' => 'themes.mox',
                'images' => 'user/img/themes/theme_1.png',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);

        //2.Tema
        DB::table('themes')->insert([
            [
                'code' => Theme::max('code') + 1,
                'themeName'  => 'Animex',
                'themePath' => 'themes.animex',
                'images' => 'user/img/themes/theme_2.png',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);

        //3.Tema
        DB::table('themes')->insert([
            [
                'code' => Theme::max('code') + 1,
                'themeName'  => 'MovieFX',
                'themePath' => 'themes.moviefx',
                'images' => 'user/img/themes/theme_3.png',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);

        //Tema Ayarları ----------------------------------------------------------------

        //1.Tema
        DB::table('theme_settings')->insert([
            [
                'code' => ThemeSetting::max('code') + 1,
                'theme_code'  => 1,
                'setting_name' => 'listCount',
                'setting_value' => '8',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 2,
                'theme_code'  => 1,
                'setting_name' => 'showSlider',
                'setting_value' => '1',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 3,
                'theme_code'  => 1,
                'setting_name' => 'indexShowContent',
                'setting_value' => '20',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 4,
                'theme_code'  => 1,
                'setting_name' => 'colors_code',
                'setting_value' => 'e4d804',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 5,
                'theme_code'  => 1,
                'setting_name' => 'colors_code',
                'setting_value' => '252631',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 6,
                'theme_code'  => 1,
                'setting_name' => 'colors_code',
                'setting_value' => '20212B',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 7,
                'theme_code'  => 1,
                'setting_name' => 'colors_code',
                'setting_value' => '171B27',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 8,
                'theme_code'  => 1,
                'setting_name' => 'colors_code',
                'setting_value' => '12151E',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 9,
                'theme_code'  => 1,
                'setting_name' => 'colors_code_default',
                'setting_value' => 'e4d804',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 10,
                'theme_code'  => 1,
                'setting_name' => 'colors_code_default',
                'setting_value' => '252631',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 11,
                'theme_code'  => 1,
                'setting_name' => 'colors_code_default',
                'setting_value' => '20212B',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 12,
                'theme_code'  => 1,
                'setting_name' => 'colors_code_default',
                'setting_value' => '171B27',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 13,
                'theme_code'  => 1,
                'setting_name' => 'colors_code_default',
                'setting_value' => '12151E',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);

        //2.Tema
        DB::table('theme_settings')->insert([
            [
                'code' => ThemeSetting::max('code') + 1,
                'theme_code'  => 2,
                'setting_name' => 'listCount',
                'setting_value' => '12',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 2,
                'theme_code'  => 2,
                'setting_name' => 'showSlider',
                'setting_value' => '1',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 3,
                'theme_code'  => 2,
                'setting_name' => 'indexShowContent',
                'setting_value' => '6',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 4,
                'theme_code'  => 2,
                'setting_name' => 'colors_code',
                'setting_value' => '14161D',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 5,
                'theme_code'  => 2,
                'setting_name' => 'colors_code',
                'setting_value' => '111216',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 6,
                'theme_code'  => 2,
                'setting_name' => 'colors_code',
                'setting_value' => 'e53637',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 7,
                'theme_code'  => 2,
                'setting_name' => 'colors_code_default',
                'setting_value' => '14161D',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 8,
                'theme_code'  => 2,
                'setting_name' => 'colors_code_default',
                'setting_value' => '111216',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 9,
                'theme_code'  => 2,
                'setting_name' => 'colors_code_default',
                'setting_value' => 'e53639',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);

        //3.Tema
        DB::table('theme_settings')->insert([
            [
                'code' => ThemeSetting::max('code') + 1,
                'theme_code'  => 3,
                'setting_name' => 'listCount',
                'setting_value' => '10',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 2,
                'theme_code'  => 3,
                'setting_name' => 'showSlider',
                'setting_value' => '1',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 3,
                'theme_code'  => 3,
                'setting_name' => 'indexShowContent',
                'setting_value' => '8',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 4,
                'theme_code'  => 3,
                'setting_name' => 'colors_code',
                'setting_value' => 'FDFD96',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 5,
                'theme_code'  => 3,
                'setting_name' => 'colors_code',
                'setting_value' => '14161D',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 6,
                'theme_code'  => 3,
                'setting_name' => 'colors_code',
                'setting_value' => '111216',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 7,
                'theme_code'  => 3,
                'setting_name' => 'colors_code',
                'setting_value' => 'FDFD96',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 8,
                'theme_code'  => 3,
                'setting_name' => 'colors_code',
                'setting_value' => '1E2029',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 9,
                'theme_code'  => 3,
                'setting_name' => 'colors_code',
                'setting_value' => '491f1f',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 10,
                'theme_code'  => 3,
                'setting_name' => 'colors_code_default',
                'setting_value' => 'FDFD96',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 11,
                'theme_code'  => 3,
                'setting_name' => 'colors_code_default',
                'setting_value' => '14161D',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 12,
                'theme_code'  => 3,
                'setting_name' => 'colors_code_default',
                'setting_value' => '111216',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 13,
                'theme_code'  => 3,
                'setting_name' => 'colors_code_default',
                'setting_value' => 'FDFD96',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 14,
                'theme_code'  => 3,
                'setting_name' => 'colors_code_default',
                'setting_value' => '1E2029',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'code' => ThemeSetting::max('code') + 15,
                'theme_code'  => 3,
                'setting_name' => 'colors_code_default',
                'setting_value' => '491f1f',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
