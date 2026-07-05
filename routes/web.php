<?php

use App\Http\Controllers\AiTaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('welcome');

Route::middleware('auth:web')->group(function () {

    Route::get('/dashboard', HomeController::class)->name('dashboard');

    // Tasks CRUD
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

    // Profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/update', [UserController::class, 'update'])->name('update');
        Route::put('/edit', [UserController::class, 'edit'])->name('edit');
    });

    // AI Assistant
    Route::prefix('ai')->name('ai.')->group(function () {
        // Task Breakdown
        Route::get('/breakdown', [AiTaskController::class, 'showBreakdown'])->name('breakdown.show');
        Route::post('/breakdown', [AiTaskController::class, 'breakdown'])->name('breakdown');
        Route::post('/import-tasks', [AiTaskController::class, 'importTasks'])->name('import.tasks');

        // Agile Backlog
        Route::get('/backlog', [AiTaskController::class, 'showBacklog'])->name('backlog.show');
        Route::post('/backlog', [AiTaskController::class, 'backlog'])->name('backlog');
        Route::post('/import-backlog', [AiTaskController::class, 'importBacklog'])->name('import.backlog');
    });
});
