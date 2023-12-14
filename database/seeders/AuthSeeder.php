<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AuthSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('authorization_groups')->truncate();
        DB::table('authorization_clauses')->truncate();

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
                'code' => intval(Config::get('access.path_access_codes.admin/user/create')),
                'text'  => 'Kullanıcı Ekleme',
                'description'  => 'Kullanıcı Ekleme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/user/list')),
                'text'  => 'Kullanıcı Listeleme',
                'description'  => 'Kullanıcı Ekleme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/user/update')),
                'text'  => 'Kullanıcı Güncelleme',
                'description'  => 'Kullanıcı Güncelleyebilme Yetkisi',
            ],
            [
                'text'  => 'Kullanıcı Silme',
                'code' => intval(Config::get('access.path_access_codes.admin/user/delete')),
                'description'  => 'Kullanıcı Silebilme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/authGroup/create')),
                'text'  => 'Kullanıcı Grupları Ekleme',
                'description'  => 'Kullanıcı Grupları Ekleme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/authGroup/list')),
                'text'  => 'Kullanıcı Grupları Listeleme',
                'description'  => 'Kullanıcı Grupları Ekleme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/authGroup/update')),
                'text'  => 'Kullanıcı Grupları Güncelleme',
                'description'  => 'Kullanıcı Grupları Güncelleyebilme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/authGroup/delete')),
                'text'  => 'Kullanıcı Grupları Silme',
                'description'  => 'Kullanıcı Grupları Silebilme Yetkisi',
            ],
            [
                'code' => 0,
                'text'  => 'Grup Yetkileri Ekleme',
                'description'  => 'Grup Yetkileri Ekleme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/auth/list')),
                'text'  => 'Grup Yetkileri Listeleme',
                'description'  => 'Grup Yetkileri Ekleme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/auth/change')),
                'text'  => 'Grup Yetkileri Güncelleme',
                'description'  => 'Grup Yetkileri Güncelleyebilme Yetkisi',
            ],
            [
                'code' => 0,
                'text'  => 'Grup Yetkileri Silme',
                'description'  => 'Grup Yetkileri Silebilme Yetkisi',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/data/home')),
                'text'  => 'Anasayfa Ayarlarını Değiştirebilme',
                'description'  => 'Anasayfa Ayarlarını Değiştirebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/data/logo')),
                'text'  => 'Logoları Değiştirebilme',
                'description'  => 'Logoları Değiştirebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/data/meta')),
                'text'  => 'Meta Etiketlerini Değiştirebilme',
                'description'  => 'Meta Etiketlerini Değiştirebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/data/title')),
                'text'  => 'Başlıkları Değiştirebilme',
                'description'  => 'Başlıkları Değiştirebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/data/menu')),
                'text'  => 'Menüleri Değiştirebilme',
                'description'  => 'Menüleri Değiştirebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/data/social')),
                'text'  => 'Sosyal Medya Linkerini Değiştirebilme',
                'description'  => 'Sosyal Medya Linkerini Değiştirebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/anime/create')),
                'text'  => 'Anime Ekleyebilme',
                'description'  => 'Anime Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/anime/list')),
                'text'  => 'Anime Listeleyebilme',
                'description'  => 'Anime Listeleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/anime/update')),
                'text'  => 'Anime Güncelleyebilme',
                'description'  => 'Anime Güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/anime/delete')),
                'text'  => 'Anime Silebilme',
                'description'  => 'Anime Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/animeEpisodes/create')),
                'text'  => 'Anime Bölümü Ekleyebilme',
                'description'  => 'Anime Bölümü Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/animeEpisodes/list')),
                'text'  => 'Anime Bölümü Listeleyebilme',
                'description'  => 'Anime Bölümü Listeleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/animeEpisodes/update',)),
                'text'  => 'Anime Bölümü Güncelleyebilme',
                'description'  => 'Anime Bölümü Güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/animeEpisodes/delete',)),
                'text'  => 'Anime Bölümü Silebilme',
                'description'  => 'Anime Bölümü Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/anime/calendar/addEvent')),
                'text'  => 'Anime Takvimi Ekleyebilme',
                'description'  => 'Anime Takvimi Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/anime/calendar')),
                'text'  => 'Anime Takvimi Listeleyebilme',
                'description'  => 'Anime Takvimi Listeleyebilme',
            ],
            [
                'code' => 0,
                'text'  => 'Anime Takvimi Güncelleyebilme',
                'description'  => 'Anime Takvimi Güncelleyebilme',
            ],
            [
                'code' => 0,
                'text'  => 'Anime Takvimi Silebilme',
                'description'  => 'Anime Takvimi Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoon/create')),
                'text'  => 'Webtoon Ekleyebilme',
                'description'  => 'Webtoon Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoon/list')),
                'text'  => 'Webtoon Listeleyebilme',
                'description'  => 'Webtoon Listeleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoon/update')),
                'text'  => 'Webtoon Güncelleyebilme',
                'description'  => 'Webtoon Güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoon/delete')),
                'text'  => 'Webtoon Silebilme',
                'description'  => 'Webtoon Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoonEpisodes/create')),
                'text'  => 'Webtoon Bölümü Ekleyebilme',
                'description'  => 'Webtoon Bölümü Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoonEpisodes/list')),
                'text'  => 'Webtoon Bölümü Listeleyebilme',
                'description'  => 'Webtoon Bölümü Listeleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoonEpisodes/update')),
                'text'  => 'Webtoon Bölümü Güncelleyebilme',
                'description'  => 'Webtoon Bölümü Güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoonEpisodes/delete')),
                'text'  => 'Webtoon Bölümü Silebilme',
                'description'  => 'Webtoon Bölümü Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoon/calendar/addEvent')),
                'text'  => 'Webtoon Takvimi Ekleyebilme',
                'description'  => 'Webtoon Takvimi Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/webtoon/calendar')),
                'text'  => 'Webtoon Takvimi Listeleyebilme',
                'description'  => 'Webtoon Takvimi Listeleyebilme',
            ],
            [
                'code' => 0,
                'text'  => 'Webtoon Takvimi Güncelleyebilme',
                'description'  => 'Webtoon Takvimi Güncelleyebilme',
            ],
            [
                'code' => 0,
                'text'  => 'Webtoon Takvimi Silebilme',
                'description'  => 'Webtoon Takvimi Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/page/create')),
                'text'  => 'Sayfa Ekleyebilme',
                'description'  => 'Sayfa Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/page/list')),
                'text'  => 'Sayfa Listeleyebilme',
                'description'  => 'Sayfa Listeleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/page/update')),
                'text'  => 'Sayfa Güncelleyebilme',
                'description'  => 'Sayfa Güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/page/delete')),
                'text'  => 'Sayfa Silebilme',
                'description'  => 'Sayfa Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/category/create')),
                'text'  => 'Kategori Ekleyebilme',
                'description'  => 'Kategori Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/category/list')),
                'text'  => 'Kategori Listeleyebilme',
                'description'  => 'Kategori Listeleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/category/update')),
                'text'  => 'Kategori Güncelleyebilme',
                'description'  => 'Kategori Güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/category/delete')),
                'text'  => 'Kategori Silebilme',
                'description'  => 'Kategori Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/tag/create')),
                'text'  => 'Etiket Ekleyebilme',
                'description'  => 'Etiket Ekleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/tag/list')),
                'text'  => 'Etiket Listeleyebilme',
                'description'  => 'Etiket Listeleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/tag/update')),
                'text'  => 'Etiket Güncelleyebilme',
                'description'  => 'Etiket Güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/tag/delete')),
                'text'  => 'Etiket Silebilme',
                'description'  => 'Etiket Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/comment')),
                'text'  => 'Yorumları Görüntüleyebilme',
                'description'  => 'Yorumları Görüntüleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/comment/delete')),
                'text'  => 'Yorumları Silebilme',
                'description'  => 'Yorumları Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/contact')),
                'text'  => 'İletişimleri Görebilme',
                'description'  => 'İletişimleri Görebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/contact/delete')),
                'text'  => 'İletişimleri Silebilme',
                'description'  => 'İletişimleri Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/contact/answer')),
                'text'  => 'İletişimleri Cevaplayabilme',
                'description'  => 'İletişimleri Cevaplayabilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/indexUser/create')),
                'text'  => 'Üye oluşturabilme',
                'description'  => 'Üye Oluşturabilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/indexUser/list')),
                'text'  => 'Üye Listeleyebilme',
                'description'  => 'Üye Listeleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/indexUser/update')),
                'text'  => 'Üye Güncelleyebilme',
                'description'  => 'Üye Güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/indexUser/delete')),
                'text'  => 'Üye Silebilme',
                'description'  => 'Üye Silebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/data/sliderVideo')),
                'text'  => 'Slider videolarını listeleyip güncelleyebilme',
                'description'  => 'Slider videolarını listeleyip güncelleyebilme',
            ],
            [
                'code' => intval(Config::get('access.path_access_codes.admin/data/theme')),
                'text'  => 'Tema ayarlarını güncelleyebilme',
                'description'  => 'Tema ayarlarını güncelleyebilme',
            ],
        ]);
    }
}
