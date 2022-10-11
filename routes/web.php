<?php

use App\Documentation;
use App\Http\Controllers\DocsController;
use Illuminate\Support\Facades\Route;

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
        'laravel-oci8',
        'laravel-acl',
        'laravel-auditable',
        'pdo-via-oci8',
    ];

    $projects = collect($repositories)->map(function ($repo) {
        return cache()->remember($repo, now()->addDay(), function () use ($repo) {
            return github($repo);
        });
    })->map(function ($project) {
        $project['doc_url'] = route('docs.version', [
            'package' => $project['name'],
            'version' => Documentation::getDefaultVersion($project['name']),
        ]);

        return $project;
    });

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
