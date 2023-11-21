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
1=> User  => 0010013
2=> Yetki Maddeleri
3=> Yetki Grupları
4=> Yetkilendirme
5=> Anime
6=> Anime Takvimi
7=> Anime Episode
8=> Webtoon
9=> Webtoon Takvimi
10=> Webtoon Episode
11=> Logo_Data
12=> Menu_Data
13=> Meta_Data
14=> Social_Data
15=> Title_Data


*/
return [
    'error_codes' => [
        '0000000' => "Bu İşlemi Yapmak İçin Erişim Yetkiniz Bulunmamaktadır.",
        '0000002' => 'KeyValue Güncellenirken Bir Hata Meydana Geldi',
        '0000012' => 'KeyValue Güncellenirken Post işleminde bir hata meydana geldi',
        '0000013' => 'KeyValue Silinirken Bir Hata Meydana Geldi',
        '0010010' => "Bu E-Mail'e ait başka bir kullanıcı bulunmaktadır.",
        '0010002' => 'Kullanıcı Güncelleme Ekranına Giderken Bir Sorun Oluştu',
        '0010012' => 'Kullanıcı Güncellenirken Bir Hata Meydana Geldi',
        '0010013' => 'Kullanıcı Silinirken Bir Hata Meydana Geldi',
        '0010112' => 'Kullanıcının Şifresi Güncellenirken Bir Hata Meydana Geldi',
        '5008' => 'Custom Error 2',
        '5009' => 'Custom Error 2',
        '5010' => 'Custom Error 2',
        '5011' => 'Custom Error 2',
        '5012' => 'Custom Error 2',
        '5013' => 'Custom Error 2',
        '5014' => 'Custom Error 2',
        '5015' => 'Custom Error 2',
        '5016' => 'Custom Error 2',
        '5017' => 'Custom Error 2',
        '5018' => 'Custom Error 2',
        '5019' => 'Custom Error 2',
        '5020' => 'Custom Error 2',
        '5021' => 'Custom Error 2',
        '5022' => 'Custom Error 2',
        '5023' => 'Custom Error 2',
        '5024' => 'Custom Error 2',
        '5025' => 'Custom Error 2',
        '5026' => 'Custom Error 2',
        '5027' => 'Custom Error 2',
        '5028' => 'Custom Error 2',
        '5029' => 'Custom Error 2',
        '5030' => 'Custom Error 2',
        '5031' => 'Custom Error 2',
    ],
];
