<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        $totalTasks = App\Models\Task::count();
        $completedTasks = App\Models\Task::where('is_completed', true)->count();
        $progressPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        $upcomingTasks = App\Models\Task::where('is_completed', false)
            ->orderByRaw('due_date IS NULL, due_date ASC')
            ->orderByRaw('due_time IS NULL, due_time ASC')
            ->limit(4)
            ->get();

        return view(
            'tasks.dashboard'
            ,
            [
                'totalTasks' => $totalTasks,
                'completedTasks' => $completedTasks,
                'progressPercentage' => $progressPercentage,
                'upcomingTasks' => $upcomingTasks,
            ]
        );
    })->name('dashboard');

    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
});