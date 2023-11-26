<?php
// Config::get('success.success_codes.5001')

/*
Hata Kodu Tanımı:
1=> success olduğunun ispati
0 => Hatanın Bulunduğu Sayfa
0 => Hatanın Bulunduğu Sayfa
0 => Hatanın Bulunduğu Sayfa
0=>(sıra. Her 1.sayı ve 4.sayı ile aynı olduğunda birer birer artar. 1 den başlar)
0=>(sıra. Her 1.sayı ve 4.sayı ile aynı olduğunda birer birer artar. 1 den başlar)
0=>(post ya da get olup olmadığını belirtir. 0: get, 1: post)
0=> Hangi işlem (0: create, 1: read,2:update,3:delete, 5:other)

Sayfaların kodları:
0=> KeyValue
1=> User
2=> Admin
3=> Yetki Maddeleri
4=> Yetki Grupları
5=> Yetkilendirme
6=> Anime
7=> Anime Takvimi
8=> Anime Episode
9=> Webtoon
10=> Webtoon Takvimi
11=> Webtoon Episode
12=> Data
13=> NotificationAdmin
14=> FollowUser
15=>Page
16=> Category
17=> Tag
18=> Index

*/
$success = " Başarılı Bir Şekilde ";
$add = "Eklendi";
$update = "Güncellendi";
$delete = "Silindi";
return [
    'success_codes' => [
        '10000010' => 'KeyValue' . $success . $add,
        '10000012' => 'KeyValue' . $success . $update,
        '10000013' => 'KeyValue' . $success . $delete,

        '10010010' => "Kullanıcı" . $success . $add,
        '10010012' => 'Kullanıcı' . $success . $update,
        '10010013' => 'Kullanıcı' . $success . $delete,
        '10010112' => 'Kullanıcının Şifresi' . $success . $update,

        '10020011' => 'Giriş Başarılı',

        '10030010' => 'Yetki Maddesi' . $success . $add,
        '10030012' => 'Yetki Maddesi' . $success . $update,
        '10030013' => 'Yetki Maddesi' . $success . $delete,

        '10040010' => 'Kullanıcı Grubu' . $success . $add,
        '10040012' => 'Kullanıcı Grubu' . $success . $update,
        '10040013' => 'Kullanıcı Grubu' . $success . $delete,

        '10050012' => 'Grubun Yetkileri' . $success . $update,

        '10060010' => 'Anime' . $success . $add,
        '10060012' => 'Anime' . $success . $update,
        '10060013' => 'Anime' . $success . $delete,

        '10070010' => "Takvim'e Anime" . $success . $add,

        '10080012' => 'Anime Bölümü' . $success . $update,
        '10080013' => 'Anime Bölümü' . $success . $delete,

        '10090010' => 'Webtoon' . $success . $add,
        '10090012' => 'Webtoon' . $success . $update,
        '10090013' => 'Webtoon' . $success . $delete,

        '10100010' => "Takvim'e Webtoon" . $success . $add,

        '10110012' => 'Webtoon Bölümü' . $success . $update,
        '10110013' => 'Webtoon Bölümü' . $success . $delete,

        '10120012' => 'Logo' . $success . $update,

        '10120010' => 'Menü' . $success . $add,
        '10120112' => 'Menü' . $success . $update,
        '10120013' => 'Menü' . $success . $delete,

        '10120110' => 'Meta' . $success . $add,
        '10120212' => 'Meta' . $success . $update,
        '10120113' => 'Meta' . $success . $delete,

        '10120210' => 'Sosyal Medya Linki' . $success . $add,
        '10120312' => 'Sosyal Medya Linki' . $success . $update,
        '10120213' => 'Sosyal Medya Linki' . $success . $delete,

        '10120412' => 'Başlık' . $success . $update,

        '10120512' => 'Anaysafa Ayarları' . $success . $update,

        '10130012' => 'Mesaj Başarılı Bir Şekilde Gönderildi',
        '10130112' => 'Bildirim Okundu Olarak İşaretlendi',

        '10140012' => 'Kullanıcı Takip edildi',
        '10140112' => 'Kullanıcı Takipten Çıkartıldı',

        '10150010' => 'Sayfa' . $success . $add,
        '10150012' => 'Sayfa' . $success . $update,
        '10150013' => 'Sayfa' . $success . $delete,

        '10160010' => 'Kategori' . $success . $add,
        '10160012' => 'Kategori' . $success . $update,
        '10160013' => 'Kategori' . $success . $delete,

        '10170010' => 'Etiket' . $success . $add,
        '10170012' => 'Etiket' . $success . $update,
        '10170013' => 'Etiket' . $success . $delete,
    ],
];
