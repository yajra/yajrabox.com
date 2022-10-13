<?php

use Illuminate\Support\Str;

/**
 * SVG helper
 *
 * @param  string  $src  Path to svg in the cp image directory
 * @return string
 */
if (! function_exists('svg')) {
    function svg(string $src): string
    {
        return file_get_contents(public_path('assets/svg/'.$src.'.svg'));
    }
}

/**
 * Fetch github repo information.
 *
 * @param  string  $repo
 * @return mixed
 */
if (! function_exists('github')) {
    function github(string $repo)
    {
        return app('cache.store')->remember($repo.':stats', 60, function () use ($repo) {
            return app('github')->repositories()->show('yajra', $repo);
        });
    }
}

/**
 * Convert package name to title.
 *
 * @param  string  $package
 * @return string
 */
if (! function_exists('package_to_title')) {
    function package_to_title(string $package): string
    {
        $title = implode(' ', array_map('ucwords', explode('-', $package)));
        if (Str::contains($title, 'Datatables')) {
            return str_replace('Datatables', 'DataTables', $title);
        }

        return $title;
    }
}
