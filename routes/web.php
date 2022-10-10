<?php

use App\Http\Controllers\DocsController;
use Illuminate\Support\Facades\Route;

if (! defined('DEFAULT_VERSION')) {
    define('DEFAULT_VERSION', 'master');
}

if (! defined('DEFAULT_PACKAGE')) {
    define('DEFAULT_PACKAGE', 'laravel-datatables');
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('docs/{package?}', [DocsController::class, 'showRootPage']);
Route::get('docs/{package}/{version}/index.json', [DocsController::class, 'index']);
Route::get('docs/{package}/{version}/{page?}', [DocsController::class, 'show']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
