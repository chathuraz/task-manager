<?php

use Illuminate\Support\Facades\Route;

// Test route to verify environment
Route::get('/test-vercel', function () {
    return response()->json([
        'status' => 'working',
        'php_version' => PHP_VERSION,
        'app_key_set' => !empty(env('APP_KEY')),
        'db_path' => env('DB_DATABASE'),
        'db_exists' => file_exists(env('DB_DATABASE')),
        'storage_path' => storage_path(),
        'storage_writable' => is_writable(storage_path()),
        'tmp_writable' => is_writable('/tmp'),
    ]);
});