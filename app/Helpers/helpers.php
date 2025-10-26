<?php

if (!function_exists('active_class')) {
    function active_class($paths, $active = 'active') {
        $paths = is_array($paths) ? $paths : [$paths];
        foreach ($paths as $path) {
            if (request()->is($path)) {
                return $active;
            }
        }
        return '';
    }
}

if (!function_exists('is_active_route')) {
    function is_active_route($paths) {
        $paths = is_array($paths) ? $paths : [$paths];
        foreach ($paths as $path) {
            if (request()->routeIs($path)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('show_class')) {
    function show_class($paths, $show = 'show') {
        $paths = is_array($paths) ? $paths : [$paths];
        foreach ($paths as $path) {
            if (request()->is($path)) {
                return $show;
            }
        }
        return '';
    }
}
