<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (! defined('DEFAULT_VERSION')) {
    define('DEFAULT_VERSION', 'master');
}

if (! defined('DEFAULT_PACKAGE')) {
    define('DEFAULT_PACKAGE', 'laravel-datatables');
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
