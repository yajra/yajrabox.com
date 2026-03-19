<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * SVG helper
 */
if (! function_exists('svg')) {
    function svg(string $src): string
    {
        $path = public_path('assets/svg/'.$src.'.svg');

        if (! file_exists($path)) {
            return '';
        }

        return file_get_contents($path) ?: '';
    }
}

/**
 * Fetch github repo information.
 */
if (! function_exists('github')) {
    function github(string $repo): array
    {
        return Cache::remember($repo.':stats', now()->addDay(), function () use ($repo) {
            return Http::github()->get("repos/yajra/{$repo}")->json();
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
