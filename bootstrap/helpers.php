<?php

use Illuminate\Support\Str;

/**
 * SVG helper
 */
if (! function_exists('svg')) {
    function svg(string $src): string
    {
        $contents = file_get_contents(public_path('assets/svg/'.$src.'.svg'));

        if ($contents === false) {
            return '';
        }

        return $contents;
    }
}

/**
 * Fetch github repo information.
 */
if (! function_exists('github')) {
    function github(string $repo): array
    {
        return app('cache.store')->remember($repo.':stats', now()->addDay(), function () use ($repo) {
            return app('github')->repositories()->show('yajra', $repo);
        });
    }
}

/**
 * Convert package name to title.
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

