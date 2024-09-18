<?php
// Config::get('access.path_access_codes.5001')

return [
    'groups' => [
        '1' => [
            'id' => 1,
            'start' => 1,
        ],
        '2' => [
            'id' => 2,
            'start' => 1001,
        ],
    ],
    'urls' => [
        'admin/shop/category' => ['group' => '1', 'text' => 'Yazı', 'same_as_previous' => true],
        'admin/shop/category/ajax' => ['group' => '1', 'text' => 'Yazı'],
        'admin/shop/feature' => ['group' => '2', 'text' => 'Özellik'],
        'admin/shop/feature/create' => ['group' => '2', 'text' => 'Özellik Oluştur'],




        'admin/user/list' => ['group' => '1', 'text' => 'Kullanıcı listeleme'],
        'admin/user/list/ajax' => ['group' => '1', 'text' => 'Kullanıcı Listeleme', 'same_as_previous' => true],
        'admin/user/create' => ['group' => '1', 'text' => 'Kullanıcı Oluşturma'],
        'admin/user/update' => ['group' => '1', 'text' => 'Kullanıcı Güncelleme'],
        'admin/user/delete' => ['group' => '1', 'text' => 'Kullanıcı Silme'],
        //'admin/user/changePassword' => 1,  //NOTE Burası kapalı. Bu access'ye bu bağlı değil

        'admin/authGroup/list' => ['group' => '1', 'text' => 'Kullanıcı Grubu listeleme'],
        'admin/authGroup/list/ajax' => ['group' => '1', 'text' => 'Kullanıcı Grubu Listeleme', 'same_as_previous' => true],
        'admin/authGroup/create' => ['group' => '1', 'text' => 'Kullanıcı Grubu Oluşturma'],
        'admin/authGroup/update' => ['group' => '1', 'text' => 'Kullanıcı Grubu Güncelleme'],
        'admin/authGroup/delete' => ['group' => '1', 'text' => 'Kullanıcı Grubu Silme'],

        'admin/auth/list' => ['group' => '1', 'text' => 'Grup Yetkilerini Listeleme'],
        'admin/auth/list/getGroup/ajax' => ['group' => '1', 'text' => 'Grup Yetkilerini Listeleme', 'same_as_previous' => true],
        'admin/auth/list/change' => ['group' => '1', 'text' => 'Grup Yetkilerini Güncelleyebilme'],


        'admin/data/home' => ['group' => '1', 'text' => 'Anasayfa Ayarlarını Değiştirebilme'],
        'admin/data/home/showContent' => ['group' => '1', 'text' => 'Anasayfa Ayarlarını Değiştirebilme', 'same_as_previous' => true],
        'admin/data/home/changeThemeSettings' => ['group' => '1', 'text' => 'Anasayfa Ayarlarını Değiştirebilme', 'same_as_previous' => true],
        'admin/data/home/changeSliderImages' => ['group' => '1', 'text' => 'Anasayfa Ayarlarını Değiştirebilme', 'same_as_previous' => true],
        'admin/data/home/deleteSliderImages' => ['group' => '1', 'text' => 'Anasayfa Ayarlarını Değiştirebilme', 'same_as_previous' => true],
        'admin/data/home/addSliderImages' => ['group' => '1', 'text' => 'Anasayfa Ayarlarını Değiştirebilme', 'same_as_previous' => true],

        'admin/data/logo' => ['group' => '1', 'text' => 'Logoları Değiştirebilme'],

        'admin/data/meta' => ['group' => '1', 'text' => 'Meta Etiketlerini Değiştirebilme'],
        'admin/data/meta/add' => ['group' => '1', 'text' => 'Meta Etiketlerini Değiştirebilme', 'same_as_previous' => true],
        'admin/data/meta/update' => ['group' => '1', 'text' => 'Meta Etiketlerini Değiştirebilme', 'same_as_previous' => true],
        'admin/data/meta/delete' => ['group' => '1', 'text' => 'Meta Etiketlerini Değiştirebilme', 'same_as_previous' => true],

        'admin/data/title' => ['group' => '1', 'text' => 'Başlıkları Değiştirebilme',],

        'admin/data/menu' => ['group' => '1', 'text' => 'Menüleri Değiştirebilme',],
        'admin/data/menu/add' => ['group' => '1', 'text' => 'Menüleri Değiştirebilme', 'same_as_previous' => true],
        'admin/data/menu/update' => ['group' => '1', 'text' => 'Menüleri Değiştirebilme', 'same_as_previous' => true],
        'admin/data/menu/delete' => ['group' => '1', 'text' => 'Menüleri Değiştirebilme', 'same_as_previous' => true],

        'admin/data/social' => ['group' => '1', 'text' => 'Sosyal Medya Linkerini Değiştirebilme',],
        'admin/data/social/add' => ['group' => '1', 'text' => 'Sosyal Medya Linkerini Değiştirebilme', 'same_as_previous' => true],
        'admin/data/social/update' => ['group' => '1', 'text' => 'Sosyal Medya Linkerini Değiştirebilme', 'same_as_previous' => true],
        'admin/data/social/delete' => ['group' => '1', 'text' => 'Sosyal Medya Linkerini Değiştirebilme', 'same_as_previous' => true],

        'admin/anime/list' => ['group' => '1', 'text' => 'Animeleri Listeleyebilme'],
        'admin/anime/list/ajax' => ['group' => '1', 'text' => 'Animeleri Listeleyebilme', 'same_as_previous' => true],
        'admin/anime/season/ajax' => ['group' => '1', 'text' => 'Animeleri Listeleyebilme', 'same_as_previous' => true],
        'admin/anime/create' => ['group' => '1', 'text' => 'Animeleri Oluşturabilme'],
        'admin/anime/update' => ['group' => '1', 'text' => 'Animeleri Güncelleyebilme'],
        'admin/anime/delete' => ['group' => '1', 'text' => 'Animeleri Silebilme'],

        'admin/animeEpisodes/list' => ['group' => '1', 'text' => 'Anime Bölümlerini Listeleyebilme'],
        'admin/animeEpisodes/list/ajax' => ['group' => '1', 'text' => 'Anime Bölümlerini Listeleyebilme', 'same_as_previous' => true],
        'admin/animeEpisodes/create' => ['group' => '1', 'text' => 'Anime Bölümü Oluşturabilme'],
        'admin/animeEpisodes/createURL' => ['group' => '1', 'text' => 'Anime Bölümü Oluşturabilme', 'same_as_previous' => true],
        'admin/animeEpisodes/update' => ['group' => '1', 'text' => 'Anime Bölümü Güncelleyebilme'],
        'admin/animeEpisodes/delete' => ['group' => '1', 'text' => 'Anime Bölümü Silebilme'],

        'admin/anime/calendar' => ['group' => '1', 'text' => 'Anime Takvimi Listeleyebilme'],
        'admin/anime/calendar/ajax' => ['group' => '1', 'text' => 'Anime Takvimi Listeleyebilme', 'same_as_previous' => true],
        'admin/anime/calendar/addEvent' => ['group' => '1', 'text' => 'Anime Takvimi Ekleyebilme'],
        'admin/anime/calendar/changeEvent' => ['group' => '1', 'text' => 'Anime Takvimi Güncelleme'],
        'admin/anime/calendar/deleteEvent' => ['group' => '1', 'text' => 'Anime Takvimi Silebilme'],

        'admin/webtoon/list' => ['group' => '1', 'text' => 'Webtoon Listeleyebilme'],
        'admin/webtoon/list/ajax' => ['group' => '1', 'text' => 'Webtoon Listeleyebilme', 'same_as_previous' => true],
        'admin/webtoon/season/ajax' => ['group' => '1', 'text' => 'Webtoon Listeleyebilme', 'same_as_previous' => true],
        'admin/webtoon/create' => ['group' => '1', 'text' => 'Webtoon Ekleyebilme'],
        'admin/webtoon/update' => ['group' => '1', 'text' => 'Webtoon Güncelleyebilme'],
        'admin/webtoon/delete' => ['group' => '1', 'text' => 'Webtoon Silebilme'],

        'admin/webtoonEpisodes/list' => ['group' => '1', 'text' => 'Webtoon Bölümlerini Listeleyebilme'],
        'admin/webtoonEpisodes/list/ajax' => ['group' => '1', 'text' => 'Webtoon Bölümlerini Listeleyebilme', 'same_as_previous' => true],
        'admin/webtoonEpisodes/create' => ['group' => '1', 'text' => 'Webtoon Bölümlerini Ekleyebilme'],
        'admin/webtoonEpisodes/update' => ['group' => '1', 'text' => 'Webtoon Bölümlerini Güncelleyebilme'],
        'admin/webtoonEpisodes/delete' => ['group' => '1', 'text' => 'Webtoon Bölümlerini Silebilme'],

        'admin/webtoon/calendar' => ['group' => '1', 'text' => 'Webtoon Takvimi Listeleyebilme'],
        'admin/webtoon/calendar/ajax' => ['group' => '1', 'text' => 'Webtoon Takvimi Listeleyebilme', 'same_as_previous' => true],
        'admin/webtoon/calendar/addEvent' => ['group' => '1', 'text' => 'Webtoon Takvimi Ekleyebilme'],
        'admin/webtoon/calendar/changeEvent' => ['group' => '1', 'text' => 'Webtoon Takvimi Güncelleyebilme'],
        'admin/webtoon/calendar/deleteEvent' => ['group' => '1', 'text' => 'Webtoon Takvimi Silebilme'],

        'admin/page/list' => ['group' => '1', 'text' => 'Sayfa Listeleyebilme'],
        'admin/page/list/ajax' => ['group' => '1', 'text' => 'Sayfa Listeleyebilme', 'same_as_previous' => true],
        'admin/page/show' => ['group' => '1', 'text' => 'Sayfa Görüntüleyebilme', 'same_as_previous' => true],
        'admin/page/create' => ['group' => '1', 'text' => 'Sayfa Oluşturabilme'],
        'admin/page/update' => ['group' => '1', 'text' => 'Sayfa Güncelleme'],
        'admin/page/delete' => ['group' => '1', 'text' => 'Sayfa Silebilme'],

        'admin/category/list' => ['group' => '1', 'text' => 'Kategori Listeleyebilme'],
        'admin/category/list/ajax' => ['group' => '1', 'text' => 'Kategori Listeleyebilme', 'same_as_previous' => true],
        'admin/category/create' => ['group' => '1', 'text' => 'Kategori Oluşturabilme'],
        'admin/category/update' => ['group' => '1', 'text' => 'Kategori Güncelleyebilme'],
        'admin/category/delete' => ['group' => '1', 'text' => 'Kategori Silebilme'],

        'admin/tag/list' => ['group' => '1', 'text' => 'Etiket Listeleyebilme'],
        'admin/tag/list/ajax' => ['group' => '1', 'text' => 'Etiket Listeleyebilme', 'same_as_previous' => true],
        'admin/tag/create' => ['group' => '1', 'text' => 'Etiket Oluşturabilme'],
        'admin/tag/update' => ['group' => '1', 'text' => 'Etiket Güncelleyebilme'],
        'admin/tag/delete' => ['group' => '1', 'text' => 'Etiket Silebilme'],

        'admin/comment' => ['group' => '1', 'text' => 'Yorumları Görüntüleyebilme'],
        'admin/comment/ajax' => ['group' => '1', 'text' => 'Yorumları Görüntüleyebilme', 'same_as_previous' => true],
        'admin/comment/delete' => ['group' => '1', 'text' => 'Yorumları Silebilme'],
        'admin/comment/pinned' => ['group' => '1', 'text' => 'Yorumları Pinleyebilme'],

        'admin/contact' => ['group' => '1', 'text' => 'İletişimleri Görebilme'],
        'admin/contact/ajax' => ['group' => '1', 'text' => 'İletişimleri Görebilme', 'same_as_previous' => true],
        'admin/contact/delete' => ['group' => '1', 'text' => 'İletişimleri Silebilme'],
        'admin/contact/answer' => ['group' => '1', 'text' => 'İletişimleri Cevaplayabilme'],

        'admin/indexUser/list' => ['group' => '1', 'text' => 'Üye Listeleyebilme'],
        'admin/indexUser/list/ajax' => ['group' => '1', 'text' => 'Üye Listeleyebilme', 'same_as_previous' => true],
        'admin/indexUser/create' => ['group' => '1', 'text' => 'Üye Oluşturabilme'],
        'admin/indexUser/update' => ['group' => '1', 'text' => 'Üye Güncelleyebilme'],
        'admin/indexUser/active' => ['group' => '1', 'text' => 'Üye Aktiflik Durumunu Güncelleyebilme'],
        'admin/indexUser/delete' => ['group' => '1', 'text' => 'Üye Silebilme'],

        'admin/data/sliderVideo' => ['group' => '1', 'text' => 'Slider Videolarını Listeleme / Güncelleme'],
        'admin/data/sliderVideo/ajax' => ['group' => '1', 'text' => 'Slider Videolarını Listeleme / Güncelleme', 'same_as_previous' => true],

        'admin/data/theme' => ['group' => '1', 'text' => 'Tema Ayalarını Güncelleyebilme'],
        'admin/data/changeThemeColor' => ['group' => '1', 'text' => 'Tema Ayalarını Güncelleyebilme', 'same_as_previous' => true],

        'admin/notification/list' => ['group' => '1', 'text' => 'Bildirimleri Listeleyebilme'],
        'admin/notification/list/ajax' => ['group' => '1', 'text' => 'Bildirimleri Listeleyebilme','same_as_previous' => true],
        'admin/notification/create' => ['group' => '1', 'text' => 'Bildirim Ekleyebilme'],
        'admin/notification/delete' => ['group' => '1', 'text' => 'Bildirim Güncelleyebilme'],


        //----------------------------------------------------------------


        'admin/shop/category' => ['group' => '2', 'text' => 'Mağaza Kategorisi Görüntüleyebilme'],
        'admin/shop/category/ajax' => ['group' => '2', 'text' => 'Mağaza Kategorisi Görüntüleyebilme','same_as_previous' => true],
        'admin/shop/category/create' => ['group' => '2', 'text' => 'Mağaza Kategorisi Oluşturabilme'],
        'admin/shop/category/update' => ['group' => '2', 'text' => 'Mağaza Kategorisi Güncelleyebilme'],
        'admin/shop/category/delete' => ['group' => '2', 'text' => 'Mağaza Kategorisi Silebilme'],

        'admin/shop/feature' => ['group' => '2', 'text' => 'Mağaza Özelliklerini Görüntüleyebilme'],
        'admin/shop/feature/ajax' => ['group' => '2', 'text' => 'Mağaza Özelliklerini Görüntüleyebilme','same_as_previous' => true],
        'admin/shop/feature/create' => ['group' => '2', 'text' => 'Mağaza Özelliklerini Oluşturabilme'],
        'admin/shop/feature/update' => ['group' => '2', 'text' => 'Mağaza Özelliklerini Güncelleyebilme'],
        'admin/shop/feature/delete' => ['group' => '2', 'text' => 'Mağaza Özelliklerini Silebilme'],

        'admin/shop/order' => ['group' => '2', 'text' => 'Siparişleri Görüntüleyebilme'],
        'admin/shop/order/ajax' => ['group' => '2', 'text' => 'Siparişleri Görüntüleyebilme','same_as_previous' => true],
        'admin/shop/order/create' => ['group' => '2', 'text' => 'Siparişleri Oluşturabilme'],
        'admin/shop/order/update' => ['group' => '2', 'text' => 'Siparişleri Güncelleyebilme'],
        'admin/shop/order/delete' => ['group' => '2', 'text' => 'Siparişleri Silebilme'],

        'admin/shop/product' => ['group' => '2', 'text' => 'Ürünleri Görüntüleyebilme'],
        'admin/shop/product/ajax' => ['group' => '2', 'text' => 'Ürünleri Görüntüleyebilme','same_as_previous' => true],
        'admin/shop/product/create' => ['group' => '2', 'text' => 'Ürünleri Oluşturabilme'],
        'admin/shop/product/update' => ['group' => '2', 'text' => 'Ürünleri Güncelleyebilme'],
        'admin/shop/product/delete' => ['group' => '2', 'text' => 'Ürünleri Silebilme'],
        'admin/shop/product/changeApproval' => ['group' => '2', 'text' => 'Ürünlerin Onaylanma Durumunu Değiştirebilme'],
        'admin/shop/product/changeActive' => ['group' => '2', 'text' => 'Ürünlerin Aktiflik Durumunu Değiştirebilme'],

        'admin/shop/seller' => ['group' => '2', 'text' => 'Satıcıları Görüntüleyebilme'],
        'admin/shop/seller/ajax' => ['group' => '2', 'text' => 'Satıcıları Görüntüleyebilme', 'same_as_previous' => true],
        'admin/shop/seller/create' => ['group' => '2', 'text' => 'Satıcıları Oluşturabilme'],
        'admin/shop/seller/update' => ['group' => '2', 'text' => 'Satıcıları Güncelleyebilme'],
        'admin/shop/seller/delete' => ['group' => '2', 'text' => 'Satıcıları Silebilme'],
        'admin/shop/seller/changeActive' => ['group' => '2', 'text' => 'Satıcıların Aktiflik Durumunu Değiştirebilme'],

        'admin/shop/settings' => ['group' => '2', 'text' => 'Mağaza Ayarlarını Değiştirebilme'],

        'admin/shop/user' => ['group' => '2', 'text' => 'Mağaza Üyelerini Görüntüleyebilme'],
        'admin/shop/user/ajax' => ['group' => '2', 'text' => 'Mağaza Üyelerini Görüntüleyebilme', 'same_as_previous' => true],
        'admin/shop/user/create' => ['group' => '2', 'text' => 'Mağaza Üyelerini Oluşturabilme'],
        'admin/shop/user/update' => ['group' => '2', 'text' => 'Mağaza Üyelerini Güncelleyebilme'],
        'admin/shop/user/delete' => ['group' => '2', 'text' => 'Mağaza Üyelerini Silebilme'],
        'admin/shop/user/changeActive' => ['group' => '2', 'text' => 'Mağaza Üyelerinin Aktiflik Durumunu Değiştirebilme'],


        'admin/shop/cargoCompany' =>  ['group' => '2', 'text' => 'Kargo Firmalarını Görüntüleyebilme'],
        'admin/shop/cargoCompany/ajax' => ['group' => '2', 'text' => 'Kargo Firmalarını Görüntüleyebilme','same_as_previous' => true],
        'admin/shop/cargoCompany/create' => ['group' => '2', 'text' => 'Kargo Firmalası Oluşturabilme'],
        'admin/shop/cargoCompany/update' => ['group' => '2', 'text' => 'Kargo Firmasını Güncelleyebilme'],
        'admin/shop/cargoCompany/delete' => ['group' => '2', 'text' => 'Kargo Firmasını Silebilme'],
    ],
];
