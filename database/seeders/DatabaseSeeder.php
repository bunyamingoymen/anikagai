<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            [
                'id' => 1,
                'code' => 0,
                'name'  => 'Bünyamin',
                'surname'  => 'Göymen',
                'email' => 'bunyamingoymen@gmail.com',
                'password' => Hash::make("123"),
                'image' => 'admin/assets/images/users/avatar-1.jpg',
                'description' => "Sitenin kurucusu",
                'user_type' => 0, //0: Super User, 1: Admin, 2 ve daha sonrası:Yetkilendirme sistemi
                'admin' => 1,
                'create_user_code' => 0,
                'update_user_code' => 0,
                'deleted' => 0,
            ],
            [
                'id' => 2,
                'code' => 1,
                'name'  => 'Bünyamin',
                'surname'  => 'Göymen',
                'email' => 'bunyamingoymen2@gmail.com',
                'password' => Hash::make("123"),
                'image' => 'admin/assets/images/users/avatar-2.jpg',
                'description' => "Site Sahibi",
                'user_type' => 0, //0: Super User, 1: Admin, 2 ve daha sonrası:Yetkilendirme sistemi
                'admin' => 1,
                'create_user_code' => 0,
                'update_user_code' => 0,
                'deleted' => 0,
            ],
        ]);

        DB::table('authorization_groups')->insert([
            [
                'id' => 1,
                'code' => 1,
                'text'  => 'Admin',
                'description'  => 'Site Yöneticisi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('authorization_clauses')->insert([
            [
                'id' => 1,
                'code' => 1,
                'text'  => 'Kullanıcı Ekleme',
                'description'  => 'Kullanıcı Ekleme Yetkisi',
            ],
            [
                'id' => 2,
                'code' => 2,
                'text'  => 'Kullanıcı Listeleme',
                'description'  => 'Kullanıcı Ekleme Yetkisi',
            ],
            [
                'id' => 3,
                'code' => 3,
                'text'  => 'Kullanıcı Güncelleme',
                'description'  => 'Kullanıcı Güncelleyebilme Yetkisi',
            ],
            [
                'id' => 4,
                'code' => 4,
                'text'  => 'Kullanıcı Silme',
                'description'  => 'Kullanıcı Silebilme Yetkisi',
            ],
            [
                'id' => 5,
                'code' => 5,
                'text'  => 'Kullanıcı Grupları Ekleme',
                'description'  => 'Kullanıcı Grupları Ekleme Yetkisi',
            ],
            [
                'id' => 6,
                'code' => 6,
                'text'  => 'Kullanıcı Grupları Listeleme',
                'description'  => 'Kullanıcı Grupları Ekleme Yetkisi',
            ],
            [
                'id' => 7,
                'code' => 7,
                'text'  => 'Kullanıcı Grupları Güncelleme',
                'description'  => 'Kullanıcı Grupları Güncelleyebilme Yetkisi',
            ],
            [
                'id' => 8,
                'code' => 8,
                'text'  => 'Kullanıcı Grupları Silme',
                'description'  => 'Kullanıcı Grupları Silebilme Yetkisi',
            ],
            [
                'id' => 9,
                'code' => 9,
                'text'  => 'Grup Yetkileri Ekleme',
                'description'  => 'Grup Yetkileri Ekleme Yetkisi',
            ],
            [
                'id' => 10,
                'code' => 10,
                'text'  => 'Grup Yetkileri Listeleme',
                'description'  => 'Grup Yetkileri Ekleme Yetkisi',
            ],
            [
                'id' => 11,
                'code' => 11,
                'text'  => 'Grup Yetkileri Güncelleme',
                'description'  => 'Grup Yetkileri Güncelleyebilme Yetkisi',
            ],
            [
                'id' => 12,
                'code' => 12,
                'text'  => 'Grup Yetkileri Silme',
                'description'  => 'Grup Yetkileri Silebilme Yetkisi',
            ],
            [
                'id' => 13,
                'code' => 13,
                'text'  => 'Anasayfa Ayarlarını Değiştirebilme',
                'description'  => 'Anasayfa Ayarlarını Değiştirebilme',
            ],
            [
                'id' => 14,
                'code' => 14,
                'text'  => 'Logoları Değiştirebilme',
                'description'  => 'Logoları Değiştirebilme',
            ],
            [
                'id' => 15,
                'code' => 15,
                'text'  => 'Meta Etiketlerini Değiştirebilme',
                'description'  => 'Meta Etiketlerini Değiştirebilme',
            ],
            [
                'id' => 16,
                'code' => 16,
                'text'  => 'Başlıkları Değiştirebilme',
                'description'  => 'Başlıkları Değiştirebilme',
            ],
            [
                'id' => 17,
                'code' => 17,
                'text'  => 'Menüleri Değiştirebilme',
                'description'  => 'Menüleri Değiştirebilme',
            ],
            [
                'id' => 18,
                'code' => 18,
                'text'  => 'Sosyal Medya Linkerini Değiştirebilme',
                'description'  => 'Sosyal Medya Linkerini Değiştirebilme',
            ],
            [
                'id' => 19,
                'code' => 19,
                'text'  => 'Anime Ekleyebilme',
                'description'  => 'Anime Ekleyebilme',
            ],
            [
                'id' => 20,
                'code' => 20,
                'text'  => 'Anime Listeleyebilme',
                'description'  => 'Anime Listeleyebilme',
            ],
            [
                'id' => 21,
                'code' => 21,
                'text'  => 'Anime Güncelleyebilme',
                'description'  => 'Anime Güncelleyebilme',
            ],
            [
                'id' => 22,
                'code' => 22,
                'text'  => 'Anime Silebilme',
                'description'  => 'Anime Silebilme',
            ],
            [
                'id' => 23,
                'code' => 23,
                'text'  => 'Anime Bölümü Ekleyebilme',
                'description'  => 'Anime Bölümü Ekleyebilme',
            ],
            [
                'id' => 24,
                'code' => 24,
                'text'  => 'Anime Bölümü Listeleyebilme',
                'description'  => 'Anime Bölümü Listeleyebilme',
            ],
            [
                'id' => 25,
                'code' => 25,
                'text'  => 'Anime Bölümü Güncelleyebilme',
                'description'  => 'Anime Bölümü Güncelleyebilme',
            ],
            [
                'id' => 26,
                'code' => 26,
                'text'  => 'Anime Bölümü Silebilme',
                'description'  => 'Anime Bölümü Silebilme',
            ],
            [
                'id' => 27,
                'code' => 27,
                'text'  => 'Anime Takvimi Ekleyebilme',
                'description'  => 'Anime Takvimi Ekleyebilme',
            ],
            [
                'id' => 28,
                'code' => 28,
                'text'  => 'Anime Takvimi Listeleyebilme',
                'description'  => 'Anime Takvimi Listeleyebilme',
            ],
            [
                'id' => 29,
                'code' => 29,
                'text'  => 'Anime Takvimi Güncelleyebilme',
                'description'  => 'Anime Takvimi Güncelleyebilme',
            ],
            [
                'id' => 30,
                'code' => 30,
                'text'  => 'Anime Takvimi Silebilme',
                'description'  => 'Anime Takvimi Silebilme',
            ],
            [
                'id' => 31,
                'code' => 31,
                'text'  => 'Webtoon Ekleyebilme',
                'description'  => 'Webtoon Ekleyebilme',
            ],
            [
                'id' => 32,
                'code' => 32,
                'text'  => 'Webtoon Listeleyebilme',
                'description'  => 'Webtoon Listeleyebilme',
            ],
            [
                'id' => 33,
                'code' => 33,
                'text'  => 'Webtoon Güncelleyebilme',
                'description'  => 'Webtoon Güncelleyebilme',
            ],
            [
                'id' => 34,
                'code' => 34,
                'text'  => 'Webtoon Silebilme',
                'description'  => 'Webtoon Silebilme',
            ],
            [
                'id' => 35,
                'code' => 35,
                'text'  => 'Webtoon Bölümü Ekleyebilme',
                'description'  => 'Webtoon Bölümü Ekleyebilme',
            ],
            [
                'id' => 36,
                'code' => 36,
                'text'  => 'Webtoon Bölümü Listeleyebilme',
                'description'  => 'Webtoon Bölümü Listeleyebilme',
            ],
            [
                'id' => 37,
                'code' => 37,
                'text'  => 'Webtoon Bölümü Güncelleyebilme',
                'description'  => 'Webtoon Bölümü Güncelleyebilme',
            ],
            [
                'id' => 38,
                'code' => 38,
                'text'  => 'Webtoon Bölümü Silebilme',
                'description'  => 'Webtoon Bölümü Silebilme',
            ],
            [
                'id' => 39,
                'code' => 39,
                'text'  => 'Webtoon Takvimi Ekleyebilme',
                'description'  => 'Webtoon Takvimi Ekleyebilme',
            ],
            [
                'id' => 40,
                'code' => 40,
                'text'  => 'Webtoon Takvimi Listeleyebilme',
                'description'  => 'Webtoon Takvimi Listeleyebilme',
            ],
            [
                'id' => 41,
                'code' => 41,
                'text'  => 'Webtoon Takvimi Güncelleyebilme',
                'description'  => 'Webtoon Takvimi Güncelleyebilme',
            ],
            [
                'id' => 42,
                'code' => 42,
                'text'  => 'Webtoon Takvimi Silebilme',
                'description'  => 'Webtoon Takvimi Silebilme',
            ],
            [
                'id' => 43,
                'code' => 43,
                'text'  => 'Sayfa Ekleyebilme',
                'description'  => 'Sayfa Ekleyebilme',
            ],
            [
                'id' => 44,
                'code' => 44,
                'text'  => 'Sayfa Listeleyebilme',
                'description'  => 'Sayfa Listeleyebilme',
            ],
            [
                'id' => 45,
                'code' => 45,
                'text'  => 'Sayfa Güncelleyebilme',
                'description'  => 'Sayfa Güncelleyebilme',
            ],
            [
                'id' => 46,
                'code' => 46,
                'text'  => 'Sayfa Silebilme',
                'description'  => 'Sayfa Silebilme',
            ],
            [
                'id' => 47,
                'code' => 47,
                'text'  => 'Kategori Ekleyebilme',
                'description'  => 'Kategori Ekleyebilme',
            ],
            [
                'id' => 48,
                'code' => 48,
                'text'  => 'Kategori Listeleyebilme',
                'description'  => 'Kategori Listeleyebilme',
            ],
            [
                'id' => 49,
                'code' => 49,
                'text'  => 'Kategori Güncelleyebilme',
                'description'  => 'Kategori Güncelleyebilme',
            ],
            [
                'id' => 50,
                'code' => 50,
                'text'  => 'Kategori Silebilme',
                'description'  => 'Kategori Silebilme',
            ],
            [
                'id' => 51,
                'code' => 51,
                'text'  => 'Etiket Ekleyebilme',
                'description'  => 'Etiket Ekleyebilme',
            ],
            [
                'id' => 52,
                'code' => 52,
                'text'  => 'Etiket Listeleyebilme',
                'description'  => 'Etiket Listeleyebilme',
            ],
            [
                'id' => 53,
                'code' => 53,
                'text'  => 'Etiket Güncelleyebilme',
                'description'  => 'Etiket Güncelleyebilme',
            ],
            [
                'id' => 54,
                'code' => 54,
                'text'  => 'Etiket Silebilme',
                'description'  => 'Etiket Silebilme',
            ],
        ]);

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
                'optional_2'  => '/animeler', //Gideceği Link
                'create_user_code' => 1,
                'deleted' => 0,
            ],
            [
                'id' => 13,
                'code' => 13,
                'key'  => 'menu',
                'value'  => 'Webtoonlar',
                'optional'  => '1', //1: Aktif, 2: Aktif Değil
                'optional_2'  => '/webtoonlar', //Gideceği Link
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
                'optional_2'  => '/p/about', //Gideceği Link
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
                'value'  => '1',
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
                'theme_code'  => 2,
                'setting_name' => 'listCount',
                'setting_value' => '15',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'code' => 4,
                'theme_code'  => 2,
                'setting_name' => 'showSlider',
                'setting_value' => '1',
                'deleted' => 0,
                'created_at' => Carbon::now(),
            ],
        ]);

        DB::table('animes')->insert([
            [
                'id' => 1,
                'code' => 1,
                'name'  => 'Tokyo Ghoul',
                'short_name' => 'tokyo_ghoul',
                'image' => 'files/animes/animesImages/1.jpg',
                'description' => 'Tokyo Ghoul Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 2,
                'code' => 2,
                'name'  => 'Attack On Titan',
                'short_name' => 'attack_on_titan',
                'image' => 'files/animes/animesImages/2.jpg',
                'description' => 'Atack On titan Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 3,
                'code' => 3,
                'name'  => 'One Piece',
                'short_name' => 'one_piece',
                'image' => 'files/animes/animesImages/3.jpg',
                'description' => 'One Piece Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 4,
                'code' => 4,
                'name'  => 'Tokyo Ghoul 2 ',
                'short_name' => 'tokyo_ghoul',
                'image' => 'files/animes/animesImages/4.jpg',
                'description' => 'Tokyo Ghoul 2 Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 5,
                'code' => 5,
                'name'  => 'Attack On Titan 2',
                'short_name' => 'attack_on_titan',
                'image' => 'files/animes/animesImages/5.jpg',
                'description' => 'Atack On titan 2 Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 6,
                'code' => 6,
                'name'  => 'Tower Of God',
                'short_name' => 'tower_of_god',
                'image' => 'files/animes/animesImages/6.jpg',
                'description' => 'Tower of God Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 7,
                'code' => 7,
                'name'  => 'Naruto',
                'short_name' => 'naruto',
                'image' => 'files/animes/animesImages/7.jpg',
                'description' => 'Naruto Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 8,
                'code' => 8,
                'name'  => 'Unordinary',
                'short_name' => 'unordinary',
                'image' => 'files/animes/animesImages/8.jpg',
                'description' => 'Unordinary Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 9,
                'code' => 9,
                'name'  => 'One Piece 2',
                'short_name' => 'one_piece_2',
                'image' => 'files/animes/animesImages/9.jpg',
                'description' => 'One Piece 2 Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 10,
                'code' => 10,
                'name'  => 'Naruto 2',
                'short_name' => 'naruto_2',
                'image' => 'files/animes/animesImages/10.jpg',
                'description' => 'Naruto 2 Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
        ]);

        DB::table('webtoons')->insert([
            [
                'id' => 1,
                'code' => 1,
                'name'  => 'Webtoon Tokyo Ghoul',
                'short_name' => 'webtoon_tokyo_ghoul',
                'image' => 'files/webtoons/webtoonImages/1.jpg',
                'description' => 'Tokyo Ghoul Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 2,
                'code' => 2,
                'name'  => 'Webtoon Attack On Titan',
                'short_name' => 'webtoon_attack_on_titan',
                'image' => 'files/webtoons/webtoonImages/2.jpg',
                'description' => 'Atack On titan Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 3,
                'code' => 3,
                'name'  => 'Webtoon One Piece',
                'short_name' => 'webtoon_one_piece',
                'image' => 'files/webtoons/webtoonImages/3.jpg',
                'description' => 'One Piece Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 4,
                'code' => 4,
                'name'  => 'Webtoon Tokyo Ghoul 2 ',
                'short_name' => 'webtoon_tokyo_ghoul',
                'image' => 'files/webtoons/webtoonImages/4.jpg',
                'description' => 'Tokyo Ghoul 2 Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 5,
                'code' => 5,
                'name'  => 'Webtoon Attack On Titan 2',
                'short_name' => 'webtoon_attack_on_titan',
                'image' => 'files/webtoons/webtoonImages/5.jpg',
                'description' => 'Atack On titan 2 Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 6,
                'code' => 6,
                'name'  => 'Webtoon Tower Of God',
                'short_name' => 'webtoon_tower_of_god',
                'image' => 'files/webtoons/webtoonImages/6.jpg',
                'description' => 'Tower of God Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 7,
                'code' => 7,
                'name'  => 'Webtoon Naruto',
                'short_name' => 'webtoon_naruto',
                'image' => 'files/webtoons/webtoonImages/7.jpg',
                'description' => 'Naruto Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 8,
                'code' => 8,
                'name'  => 'Webtoon Unordinary',
                'short_name' => 'webtoon_unordinary',
                'image' => 'files/webtoons/webtoonImages/8.jpg',
                'description' => 'Unordinary Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 9,
                'code' => 9,
                'name'  => 'Webtoon One Piece 2',
                'short_name' => 'webtoon_one_piece_2',
                'image' => 'files/webtoons/webtoonImages/9.jpg',
                'description' => 'One Piece 2 Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
            [
                'id' => 10,
                'code' => 10,
                'name'  => 'Webtoon Naruto 2',
                'short_name' => 'webtoon_naruto_2',
                'image' => 'files/webtoons/webtoonImages/10.jpg',
                'description' => 'Naruto 2 Açıklama Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate nisi esse ipsam tempora doloremque ut, repudiandae explicabo, quam omnis delectus autem minus tempore reprehenderit, assumenda officiis soluta culpa accusantium. Nam.',
                'create_user_code' => 1,
            ],
        ]);
    }
}
