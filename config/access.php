<?php
// Config::get('access.path_access_codes.5001')


return [
    'path_access_codes' => [
        'admin/user/list' => 2,
        'admin/user/list/ajax' => 2,
        'admin/user/create' => 1,
        'admin/user/update' => 3,
        'admin/user/delete' => 4,
        //'admin/user/changePassword' => 1, //TODO Buna özel bir sistem geliştir

        'admin/authGroup/list' => 6,
        'admin/authGroup/list/ajax' => 6,
        'admin/authGroup/create' => 5,
        'admin/authGroup/update' => 7,
        'admin/authGroup/delete' => 8,

        'admin/auth/list' => 10,
        'admin/auth/list/change' => 11,
        'admin/auth/list/getGroup/ajax' => 10,

        //TODO Anasayfa Değişiklikleri için eklenecek. Anasayfa değişikliği 13

        'admin/data/logo' => 14,

        'admin/data/meta' => 15,
        'admin/data/meta/add' => 15,
        'admin/data/meta/update' => 15,
        'admin/data/meta/delete' => 15,

        'admin/data/title' => 16,

        'admin/data/menu' => 17,
        'admin/data/menu/add' => 17,
        'admin/data/menu/update' => 17,
        'admin/data/menu/delete' => 17,

        'admin/data/social' => 18,
        'admin/data/social/add' => 18,
        'admin/data/social/update' => 18,
        'admin/data/social/delete' => 18,

        'admin/anime/list' => 20,
        'admin/anime/list/ajax' => 20,
        'admin/anime/create' => 19,
        'admin/anime/update' => 21,
        'admin/anime/delete' => 22,

        'admin/animeEpisodes/list' => 24,
        'admin/animeEpisodes/list/ajax' => 24,
        'admin/animeEpisodes/create' => 23,
        'admin/animeEpisodes/update' => 25,
        'admin/animeEpisodes/delete' => 26,

        'admin/anime/calendar' => 28,
        'admin/anime/calendar/addEvent' => 27,

        'admin/webtoon/list' => 32,
        'admin/webtoon/list/ajax' => 32,
        'admin/webtoon/create' => 31,
        'admin/webtoon/update' => 33,
        'admin/webtoon/delete' => 34,

        'admin/webtoonEpisodes/list' => 36,
        'admin/webtoonEpisodes/list/ajax' => 36,
        'admin/webtoonEpisodes/create' => 35,
        'admin/webtoonEpisodes/update' => 37,
        'admin/webtoonEpisodes/delete' => 38,

        'admin/webtoon/calendar' => 40,
        'admin/webtoon/calendar/addEvent' => 39,

        'admin/page/list' => 44,
        'admin/page/list/ajax' => 44,
        'admin/page/show' => 44,
        'admin/page/create' => 43,
        'admin/page/update' => 45,
        'admin/page/delete' => 46,

        'admin/category/list' => 48,
        'admin/category/list/ajax' => 48,
        'admin/category/create' => 47,
        'admin/category/update' => 49,
        'admin/category/delete' => 50,

        'admin/tag/list' => 52,
        'admin/tag/list/ajax' => 52,
        'admin/tag/create' => 51,
        'admin/tag/update' => 53,
        'admin/tag/delete' => 54,
    ],
];
