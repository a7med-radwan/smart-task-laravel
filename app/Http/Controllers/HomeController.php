<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('is_completed', true)->count();
        $progressPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        $upcomingTasks = $user->tasks()->where('is_completed', false)
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
    }
}
