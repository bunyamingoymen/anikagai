<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            [
                'id' => 55,
                'code' => 55,
                'text'  => 'Yorumları Görüntüleyebilme',
                'description'  => 'Yorumları Görüntüleyebilme',
            ],
            [
                'id' => 56,
                'code' => 56,
                'text'  => 'Yorumları Silebilme',
                'description'  => 'Yorumları Silebilme',
            ],
            [
                'id' => 57,
                'code' => 57,
                'text'  => 'İletişimleri Görebilme',
                'description'  => 'İletişimleri Görebilme',
            ],
            [
                'id' => 58,
                'code' => 58,
                'text'  => 'İletişimleri Silebilme',
                'description'  => 'İletişimleri Silebilme',
            ],
            [
                'id' => 59,
                'code' => 59,
                'text'  => 'İletişimleri Cevaplayabilme',
                'description'  => 'İletişimleri Cevaplayabilme',
            ],
            [
                'id' => 60,
                'code' => 60,
                'text'  => 'Üye oluşturabilme',
                'description'  => 'Üye Oluşturabilme',
            ],
            [
                'id' => 61,
                'code' => 61,
                'text'  => 'Üye Listeleyebilme',
                'description'  => 'Üye Listeleyebilme',
            ],
            [
                'id' => 62,
                'code' => 62,
                'text'  => 'Üye Güncelleyebilme',
                'description'  => 'Üye Güncelleyebilme',
            ],
            [
                'id' => 63,
                'code' => 63,
                'text'  => 'Üye Silebilme',
                'description'  => 'Üye Silebilme',
            ],
            [
                'id' => 64,
                'code' => 64,
                'text'  => 'Slider videolarını listeleyip güncelleyebilme',
                'description'  => 'Slider videolarını listeleyip güncelleyebilme',
            ],
        ]);
    }
}
