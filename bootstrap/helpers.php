<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('route_class')) {
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}

if (!function_exists('makeExcerpt')) {
    function makeExcerpt($value, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));

        return str_limit($excerpt, $length);
    }
}