<?php
// Config::get('error.error_codes.5001')

/*
Hata Kodu Tanımı:
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
15=> Index

*/
return [
    'error_codes' => [
        '0000000' => "Bu İşlemi Yapmak İçin Erişim Yetkiniz Bulunmamaktadır.", // Özel kod, Erişim yetkinisin bulunmamasına istinaden

        '0000002' => 'KeyValue Güncellenirken Bir Hata Meydana Geldi',
        '0000012' => 'KeyValue Güncellenirken Post işleminde bir hata meydana geldi',
        '0000013' => 'KeyValue Silinirken Bir Hata Meydana Geldi',

        '0010010' => "Bu E-Mail'e ait başka bir kullanıcı bulunmaktadır.",
        '0010002' => 'Kullanıcı Güncelleme Ekranına Giderken Bir Sorun Oluştu',
        '0010012' => 'Kullanıcı Güncellenirken Bir Hata Meydana Geldi',
        '0010013' => 'Kullanıcı Silinirken Bir Hata Meydana Geldi',
        '0010112' => 'Kullanıcının Şifresi Güncellenirken Bir Hata Meydana Geldi',

        '0020011' => 'E-mail Ya da Şifre Hatalı',

        '0030002' => 'Yetki Maddeleri Güncelleme Ekranına Giderken Bir Hata Meydana Geldi',
        '0030012' => 'Yetki Maddeleri Güncellenirken Bir Hata Meydaan Geldi',
        '0030013' => 'Yetki Maddesi Silinirken Bir Hata Meydana Geldi',

        '0040002' => 'Kullanıcı Grupları Güncelleme Ekranına Giderken Bir Hata Meydana Geldi',
        '0040012' => 'Kullanıcı Grupları Güncellenirken bir Hata Meydana Geldi',
        '0040013' => 'Kullanıcı Grupları Silinirken Bir Hata Meydana Geldi',

        '0060002' => 'Anime Güncelleme Ekranına Giderken Bir Hata Meydana Geldi',
        '0060012' => 'Anime Güncellenirken bir Hata Meydana Geldi',
        '0060013' => 'Anime Silinirken Bir Hata Meydana Geldi',

        '0080002' => 'Anime Bölümleri Güncelleme Ekranına Giderken Bir Hata Meydana Geldi',
        '0080012' => 'Anime Bölümleri Güncellenirken bir Hata Meydana Geldi',
        '0080013' => 'Anime Bölümleri Silinirken Bir Hata Meydana Geldi',

        '0090002' => 'Webtoon Güncelleme Ekranına Giderken Bir Hata Meydana Geldi',
        '0090012' => 'Webtoon Güncellenirken bir Hata Meydana Geldi',
        '0090013' => 'Webtoon Silinirken Bir Hata Meydana Geldi',

        '0110002' => 'Webtoon Bölümleri Güncelleme Ekranına Giderken Bir Hata Meydana Geldi',
        '0110012' => 'Webtoon Bölümleri Güncellenirken bir Hata Meydana Geldi',
        '0110013' => 'Webtoon Bölümleri Silinirken Bir Hata Meydana Geldi',

        '0120001' => 'Logo Ekranına Gidilirken Bir Hata Meydana Geldi',

        '0120101' => 'Menü Düzenleme Ekranına Gidilirken bir Hata Meydana',
        '0120012' => 'Menüler Güncellenirken Bir Hata Meydana Geldi',
        '0120013' => 'Menüler Silinirken Bir Hata Meydana Geldi',

        '0120201' => 'Meta Etiketleri Getirilirken Bir Hata Meydana Geldi',
        '0120112' => 'Meta Etiketleri Güncellenirken Bir Hata Meydana Geldi',
        '0120113' => 'Meta Etiketleri Silinirken Bir Hata Meydana Geldi',

        '0120301' => 'Sosyal Medya Linkleri Getirilirken Bir Hata Meydana Geldi',
        '0120212' => 'Sosyal Medya Linkleri Güncellenirken Bir Hata Meydana Geldi',
        '0120213' => 'Sosyal Medya Linkleri Silinirken Bir Hata Meydana Geldi',

        '0120401' => 'Başlık Getirilirken Bir Hata Meydana Geldi',
        '0120312' => 'Başlık Güncellenirken Bir Hata Meydana Geldi',

        '0130012' => 'Bildirim Okundu Olarak İşaretlenirken Bir Hata Meydana Geldi',

        '0140012' => 'Kullanıcı Takipten Çıkartılırken Bir Hata Meydana Geldi',
    ],
];
