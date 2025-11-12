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

// Create SQLite database file if it doesn't exist
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
    chmod($dbPath, 0666);
}

// Register the Composer autoloader
require __DIR__.'/../vendor/autoload.php';

// Load production environment file for Vercel
if (file_exists(__DIR__.'/../.env.production')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../', '.env.production');
    $dotenv->load();
}

// Bootstrap Laravel and handle the request
$app = require_once __DIR__.'/../bootstrap/app.php';

// Override storage path for serverless
$app->useStoragePath($storagePath);

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Run migrations on first request (simple auto-migration)
try {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
} catch (\Exception $e) {
    // Migrations already run or error - continue anyway
}

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);