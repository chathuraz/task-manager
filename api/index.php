<?php

// Vercel serverless function entry point for Laravel

// Define base path
define('LARAVEL_START', microtime(true));

// Ensure storage directories exist in /tmp for serverless
$storagePath = '/tmp/storage';
$dirs = ['framework/sessions', 'framework/views', 'framework/cache', 'logs'];
foreach ($dirs as $dir) {
    $path = $storagePath . '/' . $dir;
    if (!is_dir($path)) {
        @mkdir($path, 0755, true);
    }
}

// Register the Composer autoloader
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request
$app = require_once __DIR__.'/../bootstrap/app.php';

// Override storage path for serverless
$app->useStoragePath($storagePath);

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);