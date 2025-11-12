<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Load environment variables from .env.netlify
if (file_exists(__DIR__ . '/../../.env.netlify')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..', '.env.netlify');
    $dotenv->load();
}

// Register the Composer autoloader
require __DIR__ . '/../../vendor/autoload.php';

// Bootstrap Laravel and handle the request
$app = require_once __DIR__ . '/../../bootstrap/app.php';

// Override storage paths for serverless environment
$app->useStoragePath('/tmp/storage');

// Create necessary directories in /tmp
$storageDirs = [
    '/tmp/storage',
    '/tmp/storage/framework',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/logs',
    '/tmp/storage/app',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
