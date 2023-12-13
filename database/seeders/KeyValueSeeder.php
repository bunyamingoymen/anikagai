<?php

namespace Database\Seeders;

use App\Models\KeyValue;
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
        DB::table('key_values')->truncate();


        //Temel ----------------------------------------------------------------

        //logo
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'index_logo',
                'value'  => 'user/img/logo/logo.png',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //footer_logo
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'index_logo_footer',
                'value'  => 'user/img/logo/logo.png',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //icon
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'index_icon',
                'value'  => 'user/img/favicon.png',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //title
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'index_title',
                'value'  => 'Anikagai - Webtoon Ve Anime',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //index_text
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'index_text',
                'value'  => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas illo animi dolore vitae nemo assumenda praesentium aperiam commodi, eum repellendus sint error, veritatis tempora unde maxime rerum corporis ipsum sunt.',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //footer_copyright
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'footer_copyright',
                'value'  => 'Copyright &copy; 2023. All Rights Reserved By <a href="index.html">Anikagai</a>',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);










        //Sosyal Medya --------------------------------

        //sosyal_medya facebook
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'social_media',
                'value'  => 'facebook',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //sosyal_medya instagram
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'social_media',
                'value'  => 'instagram',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //sosyal_medya twitter
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'social_media',
                'value'  => 'twitter',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //sosyal_medya discord
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'social_media',
                'value'  => 'discord',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);










        //Menüler-----------------------------------------------

        //Anaysafa
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'menu',
                'value'  => 'Anasayfa',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => '/', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Animeler
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'menu',
                'value'  => 'Animeler',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'animeler', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Anime Takvimi sub
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'menu_sub',
                'value'  => 'Anime Takvimi',
                'optional'  => 'Animeler', //Hangi Menünün altı olduğu(value değeri)
                'optional_2'  => 'animeler', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Webtoonlar
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'menu',
                'value'  => 'Webtoonlar',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'webtoonlar', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Webtoon Takvimi sub
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'menu_sub',
                'value'  => 'Webtoon Takvimi',
                'optional'  => 'Webtoonlar', //Hangi Menünün altı olduğu(value değeri)
                'optional_2'  => 'webtoonlar', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //İletişim
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'menu',
                'value'  => 'İletişim',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'contact', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Hakkımızda alt
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'menu_alt',
                'value'  => 'Hakkımızda',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'p/about', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Discord Alt
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'menu_alt',
                'value'  => 'Discord',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => 'https://discord.com/', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);










        //Meta Etiketleri--------------------------------------------------------

        //Description
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'meta',
                'value'  => 'description', //name
                'optional'  => 'Webtoon okuyabilir ve Anime izleyebilirsiniz', //content
                'optional_2'  => '', //http-equiv
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Language
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'meta',
                'value'  => ' ',
                'optional'  => 'tr',
                'optional_2'  => 'language',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //ie=edge
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'meta',
                'value'  => ' ',
                'optional'  => 'ie=edge',
                'optional_2'  => 'x-ua-compatible',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //author
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'admin_meta',
                'value'  => 'author', //name
                'optional'  => 'Bünyamin Göymen', //content
                'optional_2'  => '', //http-equiv
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //author2
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'admin_meta',
                'value'  => 'author2', //name
                'optional'  => 'bgoymen', //content
                'optional_2'  => '', //http-equiv
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //Copyright
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'admin_meta',
                'value'  => 'Copyright', //name
                'optional'  => "Bu sitenin hakları Bünyamin Göymen ve Anikagai'ye aittir", //content
                'optional_2'  => '', //http-equiv
                'create_user_code' => 1,
                'deleted' => 0,
            ]

        ]);










        //Slider İşlemleri ----------------------------------------------------------------

        //slider_image_1
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'slider_image',
                'value'  => 'Tokyo Ghoul',
                'optional' => 'user/img/images/gallery_01.jpg',
                'optional_2' => '/', //url
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //slider_image_2
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'slider_image',
                'value'  => 'Attack On Titan',
                'optional' => 'user/img/images/gallery_02.jpg',
                'optional_2' => '/', //url
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //slider_image_3
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'slider_image',
                'value'  => 'Bleach',
                'optional' => 'user/img/images/gallery_03.jpg',
                'optional_2' => '/', //url
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //slider_image_4
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'slider_image',
                'value'  => 'One Piece',
                'optional' => 'user/img/images/gallery_04.jpg',
                'optional_2' => '/', //url
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //selected_theme
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'selected_theme',
                'value'  => '1',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ]
        ]);

        //slider_video_1
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'slider_video',
                'value'  => '25', //slider_code
                'optional' => 'user/animex/videos/1.mp4',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ]
        ]);

        //slider_video_2
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'slider_video',
                'value'  => '26', //slider_code
                'optional' => 'user/animex/videos/2.mp4',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ]
        ]);

        //slider_video_3
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'slider_video',
                'value'  => '27', //slider_code
                'optional' => 'user/animex/videos/3.mp4',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ]
        ]);

        //slider_video_4
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'slider_video',
                'value'  => '28', //slider_code
                'optional' => 'user/animex/videos/4.mp4',
                'create_user_code' => 1,
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ]
        ]);










        //Diğerleri-------------------------------------------------

        //anime_active
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'anime_active',
                'value'  => '1', //1: Aktif,2: pasif
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        //webtoon_active
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'webtoon_active',
                'value'  => '1', //1: Aktif,2: pasif
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

    }
}
