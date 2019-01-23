<?php

if (! function_exists('storage_path')) {
    function storage_path($path)
    {
        return __DIR__.'/../storage/'.$path;
    }
}

if (! function_exists('assets_path')) {
    function assets_path($path)
    {
        return __DIR__.'/../assets/'.$path;
    }
}
