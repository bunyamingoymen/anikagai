<?php
// Config::get('access.path_access_codes.5001')


return [
    'path_access_codes' => [
        'admin/user/list' => 2,
        'admin/user/list/ajax' => 2,
        'admin/user/create' => 1,
        'admin/user/update' => 3,
        'admin/user/delete' => 4,
        //'admin/user/changePassword' => 1,  //NOTE Burası kapalı. Bu access'ye bu bağlı değil

        'admin/authGroup/list' => 6,
        'admin/authGroup/list/ajax' => 6,
        'admin/authGroup/create' => 5,
        'admin/authGroup/update' => 7,
        'admin/authGroup/delete' => 8,

        'admin/auth/list' => 10,
        'admin/auth/list/change' => 11,
        'admin/auth/list/getGroup/ajax' => 10,

        'admin/data/home' => 13,
        'admin/data/home/showContent' => 13,
        'admin/data/home/changeThemeSettings' => 13,
        'admin/data/home/changeSliderImages' => 13,
        'admin/data/home/deleteSliderImages' => 13,
        'admin/data/home/addSliderImages' => 13,

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
        'admin/anime/season/ajax' => 20,
        'admin/anime/create' => 19,
        'admin/anime/update' => 21,
        'admin/anime/delete' => 22,

        'admin/animeEpisodes/list' => 24,
        'admin/animeEpisodes/list/ajax' => 24,
        'admin/animeEpisodes/create' => 23,
        'admin/animeEpisodes/createURL' => 23,
        'admin/animeEpisodes/update' => 25,
        'admin/animeEpisodes/delete' => 26,

        'admin/anime/calendar' => 28,
        'admin/anime/calendar/ajax' => 28,
        'admin/anime/calendar/addEvent' => 27,
        'admin/anime/calendar/changeEvent' => 29,
        'admin/anime/calendar/deleteEvent' => 30,

        'admin/webtoon/list' => 32,
        'admin/webtoon/list/ajax' => 32,
        'admin/webtoon/season/ajax' => 32,
        'admin/webtoon/create' => 31,
        'admin/webtoon/update' => 33,
        'admin/webtoon/delete' => 34,

        'admin/webtoonEpisodes/list' => 36,
        'admin/webtoonEpisodes/list/ajax' => 36,
        'admin/webtoonEpisodes/create' => 35,
        'admin/webtoonEpisodes/update' => 37,
        'admin/webtoonEpisodes/delete' => 38,

        'admin/webtoon/calendar' => 40,
        'admin/webtoon/calendar/ajax' => 40,
        'admin/webtoon/calendar/addEvent' => 39,
        'admin/webtoon/calendar/changeEvent' => 41,
        'admin/webtoon/calendar/deleteEvent' => 42,

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

        'admin/comment' => 55,
        'admin/comment/ajax' => 55,
        'admin/comment/delete' => 56,
        'admin/comment/pinned' => 66,

        'admin/contact' => 57,
        'admin/contact/ajax' => 57,
        'admin/contact/delete' => 58,
        'admin/contact/answer' => 59,

        'admin/indexUser/list' => 61,
        'admin/indexUser/list/ajax' => 61,
        'admin/indexUser/create' => 60,
        'admin/indexUser/update' => 62,
        'admin/indexUser/active' => 63,
        'admin/indexUser/delete' => 63,

        'admin/data/sliderVideo' => 64,
        'admin/data/sliderVideo/ajax' => 64,

        'admin/data/theme' => 65,
        'admin/data/changeThemeColor' => 65,

        'admin/notification/list' => 67,
        'admin/notification/list/ajax' => 67,
        'admin/notification/create' => 68,
        'admin/notification/delete' => 69,


        //----------------------------------------------------------------


        'admin/shop/category' => 1001,
        'admin/shop/category/ajax' => 1001,
        'admin/shop/category/create' => 1002,
        'admin/shop/category/update' => 1003,
        'admin/shop/category/delete' => 1004,

        'admin/shop/feature' => 1005,
        'admin/shop/feature/ajax' => 1005,
        'admin/shop/feature/create' => 1006,
        'admin/shop/feature/update' => 1007,
        'admin/shop/feature/delete' => 1008,

        'admin/shop/order' => 1009,
        'admin/shop/order/ajax' => 1009,
        'admin/shop/order/create' => 1010,
        'admin/shop/order/update' => 1011,
        'admin/shop/order/delete' => 1012,

        'admin/shop/product' => 1013,
        'admin/shop/product/ajax' => 1013,
        'admin/shop/product/create' => 1014,
        'admin/shop/product/update' => 1015,
        'admin/shop/product/delete' => 1016,

        'admin/shop/seller' => 1017,
        'admin/shop/seller/ajax' => 1017,
        'admin/shop/seller/create' => 1018,
        'admin/shop/seller/update' => 1019,
        'admin/shop/seller/delete' => 1020,

        'admin/shop/settings' => 1021,

        'admin/shop/user' => 1022,
        'admin/shop/user/ajax' => 1022,
        'admin/shop/user/create' => 1023,
        'admin/shop/user/update' => 1024,
        'admin/shop/user/delete' => 1025,


        'admin/shop/cargoCompanies' => 1026,

    ],
];
