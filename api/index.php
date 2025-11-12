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

// Test database connection and run migrations
try {
    // Test database connection
    $pdo = new \PDO(
        "mysql:host=" . env('DB_HOST') . ";port=" . env('DB_PORT') . ";dbname=" . env('DB_DATABASE'),
        env('DB_USERNAME'),
        env('DB_PASSWORD'),
        [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_TIMEOUT => 5
        ]
    );
    
    // Run migrations if tables don't exist
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if (!$stmt->fetch()) {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        error_log("Migrations completed successfully");
    }
} catch (\PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
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