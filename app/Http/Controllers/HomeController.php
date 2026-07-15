<?php

namespace App\Http\Controllers;

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
        $completedTasks = $user->tasks()->completed()->count();
        $progressPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        $upcomingTasks = $user->tasks()->pending()
            ->orderByRaw('due_date IS NULL, due_date ASC')
            ->orderByRaw('due_time IS NULL, due_time ASC')
            ->paginate(8);

        return view(
            'home',
            [
                'totalTasks' => $totalTasks,
                'completedTasks' => $completedTasks,
                'progressPercentage' => $progressPercentage,
                'upcomingTasks' => $upcomingTasks,
            ]
        );
    }
}
