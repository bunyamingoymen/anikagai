<?php

if (!function_exists('isDesktop')) {
    function isDesktop()
    {
        return !preg_match('/mobile|android|touch|silk|kindle|phone|tablet/i', $_SERVER['HTTP_USER_AGENT']);
    }
}

if (!function_exists('isMobile')) {
    function isMobile()
    {
        return preg_match('/mobile|android|touch|silk|kindle|phone|tablet/i', $_SERVER['HTTP_USER_AGENT']);
    }
}
