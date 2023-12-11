<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //logo, footer, sosyal_medya
        DB::table('key_values')->insert([
            [
                'id' => 1,
                'code' => 1,
                'key'  => 'index_logo',
                'value'  => 'user/img/logo/logo.png',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 2,
                'code' => 2,
                'key'  => 'index_logo_footer',
                'value'  => 'user/img/logo/logo.png',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 3,
                'code' => 3,
                'key'  => 'index_icon',
                'value'  => 'user/img/favicon.png',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 4,
                'code' => 4,
                'key'  => 'index_title',
                'value'  => 'Anikagai - Webtoon Ve Anime',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 5,
                'code' => 5,
                'key'  => 'index_text',
                'value'  => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas illo animi dolore vitae nemo assumenda praesentium aperiam commodi, eum repellendus sint error, veritatis tempora unde maxime rerum corporis ipsum sunt.',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 6,
                'code' => 6,
                'key'  => 'footer_copyright',
                'value'  => 'Copyright &copy; 2023. All Rights Reserved By <a href="index.html">Anikagai</a>',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 7,
                'code' => 7,
                'key'  => 'social_media',
                'value'  => 'facebook',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 8,
                'code' => 8,
                'key'  => 'social_media',
                'value'  => 'instagram',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 9,
                'code' => 9,
                'key'  => 'social_media',
                'value'  => 'twitter',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 10,
                'code' => 10,
                'key'  => 'social_media',
                'value'  => 'discord',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
        ]);

        //Menüler
        DB::table('key_values')->insert([
            [
                'id' => 11,
                'code' => 11,
                'key'  => 'menu',
                'value'  => 'Anasayfa',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => '/', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 12,
                'code' => 12,
                'key'  => 'menu',
                'value'  => 'Animeler',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'animeler', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 13,
                'code' => 13,
                'key'  => 'menu',
                'value'  => 'Webtoonlar',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'webtoonlar', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 14,
                'code' => 14,
                'key'  => 'menu',
                'value'  => 'İletişim',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'contact', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 15,
                'code' => 15,
                'key'  => 'menu_alt',
                'value'  => 'Hakkımızda',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'p/about', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 16,
                'code' => 16,
                'key'  => 'menu_alt',
                'value'  => 'Discord',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'https://discord.com/', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ],
        ]);

        //Meta Etiketleri
        DB::table('key_values')->insert([
            [
                'id' => 17,
                'code' => 17,
                'key'  => 'meta',
                'value'  => 'description', //name
                'optional'  => 'Webtoon okuyabilir ve Anime izleyebilirsiniz', //content
                'optional_2'  => '', //http-equiv
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 18,
                'code' => 18,
                'key'  => 'meta',
                'value'  => ' ',
                'optional'  => 'tr',
                'optional_2'  => 'language',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 19,
                'code' => 19,
                'key'  => 'meta',
                'value'  => ' ',
                'optional'  => 'ie=edge',
                'optional_2'  => 'x-ua-compatible',
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 20,
                'code' => 20,
                'key'  => 'admin_meta',
                'value'  => 'author', //name
                'optional'  => 'Bünyamin Göymen', //content
                'optional_2'  => '', //http-equiv
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 21,
                'code' => 21,
                'key'  => 'admin_meta',
                'value'  => 'author2', //name
                'optional'  => 'bgoymen', //content
                'optional_2'  => '', //http-equiv
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 22,
                'code' => 22,
                'key'  => 'admin_meta',
                'value'  => 'Copyright', //name
                'optional'  => "Bu sitenin hakları Bünyamin Göymen ve Anikagai'ye aittir", //content
                'optional_2'  => '', //http-equiv
                'create_user_code' => 1,
                'deleted' => 0,
            ],

        ]);

        //diğerleri
        DB::table('key_values')->insert([
            [
                'id' => 23,
                'code' => 23,
                'key'  => 'anime_active',
                'value'  => '1', //1: Aktif,2: pasif
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 24,
                'code' => 24,
                'key'  => 'webtoon_active',
                'value'  => '1', //1: Aktif,2: pasif
                'create_user_code' => 1,
                'deleted' => 0,
            ],

        ]);

        //silder_lar
        DB::table('key_values')->insert([
            [
                'id' => 25,
                'code' => 25,
                'key'  => 'slider_image',
                'value'  => 'Tokyo Ghoul',
                'optional' => 'user/img/images/gallery_01.jpg',
                'optional_2' => '/', //url
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 26,
                'code' => 26,
                'key'  => 'slider_image',
                'value'  => 'Attack On Titan',
                'optional' => 'user/img/images/gallery_02.jpg',
                'optional_2' => '/', //url
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 27,
                'code' => 27,
                'key'  => 'slider_image',
                'value'  => 'Bleach',
                'optional' => 'user/img/images/gallery_03.jpg',
                'optional_2' => '/', //url
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 28,
                'code' => 28,
                'key'  => 'slider_image',
                'value'  => 'One Piece',
                'optional' => 'user/img/images/gallery_04.jpg',
                'optional_2' => '/', //url
                'create_user_code' => 1,
                'deleted' => 0,
            ],
        ]);

        //selected_theme
        DB::table('key_values')->insert([
            [
                'id' => 29,
                'code' => 29,
                'key'  => 'selected_theme',
                'value'  => '1',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);

        //slider_video
        DB::table('key_values')->insert([
            [
                'id' => 30,
                'code' => 30,
                'key'  => 'slider_video',
                'value'  => '25', //slider_code
                'optional' => 'user/animex/videos/1.mp4',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 31,
                'code' => 31,
                'key'  => 'slider_video',
                'value'  => '26', //slider_code
                'optional' => 'user/animex/videos/2.mp4',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 32,
                'code' => 32,
                'key'  => 'slider_video',
                'value'  => '27', //slider_code
                'optional' => 'user/animex/videos/3.mp4',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 33,
                'code' => 33,
                'key'  => 'slider_video',
                'value'  => '28', //slider_code
                'optional' => 'user/animex/videos/4.mp4',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
