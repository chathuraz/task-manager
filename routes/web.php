<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('home');
    // Also support legacy '/dashboard' redirect used by Breeze
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete'])->name('tasks.toggle-complete');
});

require __DIR__.'/auth.php';
