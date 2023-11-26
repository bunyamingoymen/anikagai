<?php
// Config::get('title.titles.aa')

/*
Başında hiçbirşey yoksa bulunduğu sayfanın adı
Başında / varsa o sayfanın yoluna ait isimler
Başında // varsa o sayfaya gitmek için gereken route(url'ler).
*/
return [
    'titles' => [
        'admin/index' => "Admin",
        '/admin/index' => ["Admin"],
        '//admin/index' => ["#"],

        'admin/profile' => "Profil",
        '/admin/profile' => ["Admin", "Profil"],
        '//admin/profile' => ["admin_index", "#"],





        'admin/keyValue/list' => "KeyValue",
        '/admin/keyValue/list' => ["Admin", "KeyValue"],
        '//admin/keyValue/list' => ["admin_index", "#"],

        'admin/keyValue/create' => "KayValue Oluştur",
        '/admin/keyValue/create' => ["Admin", "KeyValue", "KeyValue Oluştur"],
        '//admin/keyValue/create' => ["admin_index", "admin_keyvalue_list", "#"],

        'admin/keyValue/update' => "KeyValue Güncelle",
        '/admin/keyValue/update' => ["Admin", "KeyValue", "KeyValue Güncelle"],
        '//admin/keyValue/update' => ["admin_index", "admin_keyvalue_list", "#"],





        'admin/user/list' => "Kullanıcılar",
        '/admin/user/list' => ["Admin", "Kullanıcılar"],
        '//admin/user/list' => ["admin_index", "#"],

        'admin/user/create' => "Kullanıcı Oluştur",
        '/admin/user/create' => ["Admin", "Kullanıcılar", "Kullanıcı Oluştur"],
        '//admin/user/create' => ["admin_index", "admin_user_list", "#"],

        'admin/user/update' => "Kullanıcı Güncelle",
        '/admin/user/update' => ["Admin", "Kullanıcılar", "Kullanıcı Güncelle"],
        '//admin/user/update' => ["admin_index", "admin_user_list", "#"],





        'admin/authClause/list' => "Yetki Maddeleri",
        '/admin/authClause/list' => ["Admin", "Yetki Madeleri"],
        '//admin/authClause/list' => ["admin_index", "#"],

        'admin/authClause/create' => "Yetki Maddesi Oluştur",
        '/admin/authClause/create' => ["Admin", "Yetki Maddeleri", "Yetki Madesi oluştur"],
        '//admin/authClause/create' => ["admin_index", "admin_authclause_list", "#"],

        'admin/authClause/update' => "Yetki Maddesi Güncelle",
        '/admin/authClause/update' => ["Admin", "Yetki Maddeleri", "Yetki Madesi Güncelle"],
        '//admin/authClause/update' => ["admin_index", "admin_authclause_list", "#"],





        'admin/authGroup/list' => "Kullanıcı Grupları",
        '/admin/authGroup/list' => ["Admin", "Kullanıcı Grupları"],
        '//admin/authGroup/list' => ["admin_index", "#"],

        'admin/authGroup/create' => "Kullanıcı Grubu Oluştur",
        '/admin/authGroup/create' => ["Admin", "Kullanıcı Grupları", "Kullanıcı Grubu Oluştur"],
        '//admin/authGroup/create' => ["admin_index", "admin_authgroup_list", "#"],

        'admin/authGroup/update' => "Kullanıcı Grubunu Güncelle",
        '/admin/authGroup/update' => ["Admin", "Kullanıcı", "Kullanıcı Grubunu Güncelle"],
        '//admin/authGroup/update' => ["admin_index", "admin_authgroup_list", "#"],





        'admin/auth/list' => "Grup Yetkileri",
        '/admin/auth/list' => ["Admin", "Grup Yetkileri"],
        '//admin/auth/list' => ["admin_index", "#"],





        'admin/anime/list' => "Animeler",
        '/admin/anime/list' => ["Admin", "Animeler"],
        '//admin/anime/list' => ["admin_index", "#"],

        'admin/anime/create' => "Yeni Anime Oluştur",
        '/admin/anime/create' => ["Admin", "Animeler", "Yeni Anime Oluştur"],
        '//admin/anime/create' => ["admin_index", "admin_anime_list", "#"],

        'admin/anime/update' => "Anime Güncelle",
        '/admin/anime/update' => ["Admin", "Animeler", "Anime Güncelle"],
        '//admin/anime/update' => ["admin_index", "admin_anime_list", "#"],





        'admin/animeEpisodes/list' => "Anime Bölümleri",
        '/admin/animeEpisodes/list' => ["Admin", "Animeler", "Anime Bölümleri"],
        '//admin/animeEpisodes/list' => ["admin_index", "admin_anime_list", "#"],

        'admin/animeEpisodes/create' => "Yeni Anime Bölümü Oluştur",
        '/admin/animeEpisodes/create' => ["Admin", "Animeler", "Anime Bölümleri", "Yeni Anime Bölümü Oluştur"],
        '//admin/animeEpisodes/create' => ["admin_index", "admin_anime_list", "admin_anime_episodes_list", "#"],

        'admin/animeEpisodes/update' => "Anime Bölümü Güncelle",
        '/admin/animeEpisodes/update' => ["Admin", "Animeler", "Anime Bölümleri", "Anime Bölümü Güncelle"],
        '//admin/animeEpisodes/update' => ["admin_index", "admin_anime_list", "admin_anime_episodes_list", "#"],





        'admin/anime/calendar' => "Anime Takvimi",
        '/admin/anime/calendar' => ["Admin", "Animeler", "Anime Takvimi"],
        '//admin/anime/calendar' => ["admin_index", "admin_anime_list", "#"],





        'admin/webtoon/list' => "Webtoonlar",
        '/admin/webtoon/list' => ["Admin", "Webtoonlar"],
        '//admin/webtoon/list' => ["admin_index", "#"],

        'admin/webtoon/create' => "Yeni Webtoon Oluştur",
        '/admin/webtoon/create' => ["Admin", "Webtoonlar", "Yeni Webtoon Oluştur"],
        '//admin/webtoon/create' => ["admin_index", "admin_webtoon_list", "#"],

        'admin/webtoon/update' => "Webtoon Güncelle",
        '/admin/webtoon/update' => ["Admin", "Webtoonlar", "Webtoon Güncelle"],
        '//admin/webtoon/update' => ["admin_index", "admin_webtoon_list", "#"],





        'admin/webtoonEpisodes/list' => "Webtoon Bölümleri",
        '/admin/webtoonEpisodes/list' => ["Admin", "Webtoonlar", "Webtoon Bölümleri"],
        '//admin/webtoonEpisodes/list' => ["admin_index", "admin_webtoon_list", "#"],

        'admin/webtoonEpisodes/create' => "Yeni Webtoon Bölümü Oluştur",
        '/admin/webtoonEpisodes/create' => ["Admin", "Webtoonlar", "Webtoon Bölümleri", "Yeni Webtoon Bölümü Oluştur"],
        '//admin/webtoonEpisodes/create' => ["admin_index", "admin_webtoon_list", "admin_webtoon_episodes_list", "#"],

        'admin/webtoonEpisodes/update' => "Webtoon Bölümü Güncelle",
        '/admin/webtoonEpisodes/update' => ["Admin", "Webtoonlar", "Webtoon Bölümleri", "Webtoon Bölümü Güncelle"],
        '//admin/webtoonEpisodes/update' => ["admin_index", "admin_webtoon_list", "admin_webtoon_episodes_list", "#"],





        'admin/webtoon/calendar' => "Webtoon Takvimi",
        '/admin/webtoon/calendar' => ["Admin", "Webtoonlar", "Anime Takvimi"],
        '//admin/webtoon/calendar' => ["admin_index", "admin_webtoon_list", "#"],





        'admin/data/home' => "Anasayfa Ayarları",
        '/admin/data/home' => ["Admin", "Anasayfa Ayarları"],
        '//admin/data/home' => ["admin_index", "#"],

        'admin/data/logo' => "Logolar/Resimler",
        '/admin/data/logo' => ["Admin", "Logolar"],
        '//admin/data/logo' => ["admin_index", "#"],

        'admin/data/menu' => "Menüler",
        '/admin/data/menu' => ["Admin", "Menüler"],
        '//admin/data/menu' => ["admin_index", "#"],

        'admin/data/adminMeta' => "Meta Etiketleri",
        '/admin/data/adminMeta' => ["Admin", "Meta Etiketleri"],
        '//admin/data/adminMeta' => ["admin_index", "#"],

        'admin/data/meta' => "Meta Etiketleri",
        '/admin/data/meta' => ["Admin", "Meta Etiketleri"],
        '//admin/data/meta' => ["admin_index", "#"],

        'admin/data/social' => "Sosyal Medya Linkleri",
        '/admin/data/social' => ["Admin", "Sosyal Medya Linkleri"],
        '//admin/data/social' => ["admin_index", "#"],

        'admin/data/title' => "Başlık",
        '/admin/data/title' => ["Admin", "Başlık"],
        '//admin/data/title' => ["admin_index", "#"],





        'admin/page/list' => "Sayfalar",
        '/admin/page/list' => ["Admin", "Sayfalar"],
        '//admin/page/list' => ["admin_index", "#"],

        'admin/page/show' => "Sayfa Görüntüle",
        '/admin/page/show' => ["Admin", "Sayfalar", "Sayfa Görüntüle"],
        '//admin/page/show' => ["admin_index", "admin_page_list", "#"],

        'admin/page/create' => "Yeni Sayfa Oluştur",
        '/admin/page/create' => ["Admin", "Sayfalar", "Yeni Sayfa Oluştur"],
        '//admin/page/create' => ["admin_index", 'admin_page_list', "#"],

        'admin/page/update' => "Sayfayı Güncelle",
        '/admin/page/update' => ["Admin", "Sayfalar", "Sayfayı Güncelle"],
        '//admin/page/update' => ["admin_index", 'admin_page_list', "#"],





        'admin/category/list' => "Kategoriler",
        '/admin/category/list' => ["Admin", "Kategori"],
        '//admin/category/list' => ["admin_index", "#"],

        'admin/category/create' => "Kategori Oluştur",
        '/admin/category/create' => ["Admin", "Kategoriler", "Kategori Oluştur"],
        '//admin/category/create' => ["admin_index", "admin_category_list", "#"],

        'admin/category/update' => "Kategori Güncelle",
        '/admin/category/update' => ["Admin", "Kategoriler", "Kategori Güncelle"],
        '//admin/category/update' => ["admin_index", "admin_category_list", "#"],





        'admin/tag/list' => "Etiketler",
        '/admin/tag/list' => ["Admin", "Kategori"],
        '//admin/tag/list' => ["admin_index", "#"],

        'admin/tag/create' => "Etiket Oluştur",
        '/admin/tag/create' => ["Admin", "Etiketler", "Etiket Oluştur"],
        '//admin/tag/create' => ["admin_index", "admin_tag_list", "#"],

        'admin/tag/update' => "Etiket Güncelle",
        '/admin/tag/update' => ["Admin", "Etiketler", "Etiket Güncelle"],
        '//admin/tag/update' => ["admin_index", "admin_tag_list", "#"],
    ],
];
