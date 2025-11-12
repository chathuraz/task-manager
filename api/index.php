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
    $db = new \PDO('sqlite:' . $dbPath);
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    // Check if users table exists
    $result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'")->fetch();
    if (!$result) {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    }
} catch (\Exception $e) {
    error_log("Migration error: " . $e->getMessage());
}

try {
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    // Catch any errors and display them
    http_response_code(500);
    if (env('APP_DEBUG', false)) {
        echo "<h1>Error</h1>";
        echo "<pre>";
        echo "Message: " . $e->getMessage() . "\n\n";
        echo "File: " . $e->getFile() . "\n";
        echo "Line: " . $e->getLine() . "\n\n";
        echo "Stack Trace:\n" . $e->getTraceAsString();
        echo "</pre>";
    } else {
        echo "500 Server Error";
    }
    error_log("Laravel Error: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());
}