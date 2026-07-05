<?php

namespace App\Http\Controllers;

use App\Ai\Agents\AgileBacklogAgent;
use App\Ai\Agents\TaskBreakdownAgent;
use App\Http\Requests\BacklogRequest;
use App\Http\Requests\BreakdownRequest;
use App\Http\Requests\ImportBacklogRequest;
use App\Http\Requests\ImportTasksRequest;
use App\Models\Sprint;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AiTaskController extends Controller
{
    // ─── Task Breakdown ──────────────────────────────────────────────

    /**
     * Show the AI Task Breakdown form.
     */
    public function showBreakdown()
    {
        return view('ai.breakdown');
    }

    /**
     * Call the AI Agent to break down a feature/idea into tasks.
     */
    public function breakdown(BreakdownRequest $request)
    {
        $idea = $request->validated('idea');

        try {
            // Using laravel/ai TaskBreakdownAgent
            $response = TaskBreakdownAgent::make()->prompt($idea);
            $data = $response->toArray();
            $tasks = $data['tasks'] ?? [];

            if (empty($tasks)) {
                return back()->withInput()->with('ai_error', 'AI returned an empty task list. Please try again with more detail.');
            }

            return view('ai.breakdown', [
                'idea'  => $idea,
                'tasks' => $tasks,
            ]);

        } catch (\Exception $e) {
            Log::error('AI breakdown error', ['message' => $e->getMessage()]);
            return back()->withInput()->with('ai_error', 'Could not connect to AI service or parse response: ' . $e->getMessage());
        }
    }

    /**
     * Bulk import selected AI-generated tasks for the current user.
     */
    public function importTasks(ImportTasksRequest $request)
    {
        $userId = Auth::id();
        $count  = 0;

        foreach ($request->validated('tasks') as $taskData) {
            $days = isset($taskData['days_from_now']) ? (int)$taskData['days_from_now'] : 3;
            Task::create([
                'user_id'      => $userId,
                'title'        => $taskData['title'],
                'description'  => $taskData['description'] ?? null,
                'priority'     => $taskData['priority'],
                'due_date'     => now()->addDays($days)->toDateString(),
                'due_time'     => $taskData['due_time'] ?? '17:00',
                'is_completed' => false,
            ]);
            $count++;
        }

        return redirect()->route('tasks.index')
            ->with('success', "{$count} task(s) imported successfully with due dates/times from AI breakdown!");
    }

    // ─── Agile Backlog ────────────────────────────────────────────────

    /**
     * Show the Agile Backlog Generator form.
     */
    public function showBacklog()
    {
        return view('ai.backlog');
    }

    /**
     * Call the AI Agent to generate an Agile backlog and sprints.
     */
    public function backlog(BacklogRequest $request)
    {
        $idea = $request->validated('idea');
        $sprintCount = $request->validated('sprint_count') ?? 3;

        try {
            // Using laravel/ai AgileBacklogAgent
            $response = AgileBacklogAgent::make()->prompt("Create exactly {$sprintCount} sprints for: " . $idea);
            $backlog = $response->toArray();

            if (empty($backlog) || !isset($backlog['sprints'])) {
                return back()->withInput()->with('ai_error', 'AI returned an unexpected format. Please try again.');
            }

            return view('ai.backlog', [
                'idea'    => $idea,
                'backlog' => $backlog,
            ]);

        } catch (\Exception $e) {
            Log::error('AI backlog error', ['message' => $e->getMessage()]);
            return back()->withInput()->with('ai_error', 'Could not connect to AI service or parse response: ' . $e->getMessage());
        }
    }

    /**
     * Import all stories from a backlog as tasks.
     */
    public function importBacklog(ImportBacklogRequest $request)
    {
        $userId = Auth::id();
        $count  = 0;

        foreach ($request->validated('tasks') as $taskData) {
            // Find or create the Sprint for this user and project
            $sprint = Sprint::firstOrCreate([
                'user_id'      => $userId,
                'name'         => $taskData['sprint_name'],
                'project_name' => $taskData['project_name'] ?: 'My Project',
            ], [
                'goal'           => $taskData['sprint_goal'] ?: null,
                'duration_weeks' => $taskData['sprint_duration_weeks'] ?: 2,
            ]);

            // Calculate due date based on sprint sequence
            $sprintIndex = isset($taskData['sprint_index']) ? (int)$taskData['sprint_index'] : 0;
            $durationWeeks = isset($taskData['sprint_duration_weeks']) ? (int)$taskData['sprint_duration_weeks'] : 2;
            $weeksOffset = ($sprintIndex + 1) * $durationWeeks;
            $dueDate = now()->addWeeks($weeksOffset)->toDateString();

            Task::create([
                'user_id'      => $userId,
                'title'        => $taskData['title'],
                'description'  => $taskData['description'] ?? null,
                'priority'     => $taskData['priority'],
                'sprint_id'    => $sprint->id,
                'story_points' => $taskData['story_points'] ?? null,
                'due_date'     => $dueDate,
                'due_time'     => $taskData['due_time'] ?? '17:00',
                'is_completed' => false,
            ]);
            $count++;
        }

        return redirect()->route('tasks.index')
            ->with('success', "{$count} backlog item(s) imported successfully into Sprints!");
    }
}
