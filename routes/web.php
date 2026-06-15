<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:web')->group(function(){

    Route::get('/',HomeController::class)->name('dashboard');

    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/update', [UserController::class, 'update'])->name('update');
    Route::put('/edit', [UserController::class, 'edit'])->name('edit');
});

});
