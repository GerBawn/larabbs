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

function model_admin_link($title, $model)
{
    return model_link($title, $model, 'admin');
}

if (!function_exists('model_link')) {
    function model_link($title, $model, $prefix = '')
    {
        $modelName = model_plural_name($model);
        $prefix = $prefix ? "/$prefix/" : '/';

        $url = config('app.url') . $prefix . $modelName . '/' . $model->id;

        return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
    }
}

if (!function_exists('model_plural_name')) {
    function model_plural_name($model)
    {
        $fullClassName = get_class($model);
        $className = class_basename($fullClassName);
        $snakeCaseName = snake_case($className);

        return str_plural($snakeCaseName);
    }
}