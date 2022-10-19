<?php

use App\Documentation;
use App\Http\Controllers\DocsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (! defined('DEFAULT_VERSION')) {
    define('DEFAULT_VERSION', 'master');
}

if (! defined('DEFAULT_PACKAGE')) {
    define('DEFAULT_PACKAGE', 'laravel-datatables');
}

Route::get('/', function () {
    $repositories = [
        'laravel-datatables',
        'laravel-datatables-html',
        'laravel-datatables-buttons',
        'laravel-datatables-editor',
        'laravel-datatables-fractal',
        'laravel-datatables-assets',
        'laravel-datatables-scout',
        'laravel-datatables-ui',
        'laravel-oci8',
        'laravel-acl',
        'laravel-auditable',
        'laravel-address',
        'datatables',
        'zillow',
        'pdo-via-oci8',
        'yajrabox.com',
        'homestead-oracle',
        'laravel-admin-template',
    ];

    $projects = collect($repositories)
        ->map(function ($repo) {
            return github($repo);
        })
        ->map(function ($project) {
            $projectName = $project['name'];

            if (Str::contains(strtolower($project['name']), 'datatables-')) {
                $projectName = 'laravel-datatables';
            }

            if (Str::contains(strtolower($project['name']), 'oci8')) {
                $projectName = 'laravel-oci8';
            }

            if (! Documentation::exists($projectName)) {
                $project['doc_url'] = $project['html_url'];

                return $project;
            }

            $project['doc_url'] = route('docs.version', [
                'package' => $projectName,
                'version' => Documentation::getDefaultVersion($projectName),
            ]);

            return $project;
        })
        ->sortBy('stargazers_count')
        ->reverse();

    return view('welcome')->with('title', 'Welcome')->with('projects', $projects);
});

Route::get('docs/{package?}', [DocsController::class, 'showRootPage'])->name('docs.show-root-page');
Route::get('docs/{package}/{version}/index.json', [DocsController::class, 'index']);
Route::get('docs/{package}/{version}/{page?}', [DocsController::class, 'show'])->name('docs.version');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
