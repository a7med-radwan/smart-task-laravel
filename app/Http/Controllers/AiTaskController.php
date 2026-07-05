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
        // Get the validated idea string from our BreakdownRequest class.
        $idea = $request->validated('idea');

        try {
            // Using laravel/ai: make a new instance of TaskBreakdownAgent and prompt it with the user's idea.
            $response = TaskBreakdownAgent::make()->prompt($idea);
            
            // Convert the structured JSON response from AI into a readable PHP associative array.
            $data = $response->toArray();
            $tasks = $data['tasks'] ?? [];

            // If the AI failed to generate any tasks, redirect back with an error.
            if (empty($tasks)) {
                return back()->withInput()->with('ai_error', 'AI returned an empty task list. Please try again with more detail.');
            }

            // Return the view showing the list of AI breakdown tasks for confirmation.
            return view('ai.breakdown', [
                'idea'  => $idea,
                'tasks' => $tasks,
            ]);

        } catch (\Exception $e) {
            // If the connection fails or API key is wrong, log the error and notify the user.
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

        // Loop through each task marked/selected by the user for import.
        foreach ($request->validated('tasks') as $taskData) {
            // Convert the relative "days from now" estimate into a real calendar date (e.g. 3 days from now).
            $days = isset($taskData['days_from_now']) ? (int)$taskData['days_from_now'] : 3;
            
            // Create and persist the Task record in the database.
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

        // Redirect the user to their task backlog list with a success notification badge.
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
        // Extract the user's software idea and desired number of sprints from inputs.
        $idea = $request->validated('idea');
        $sprintCount = $request->validated('sprint_count') ?? 3;

        try {
            // Using laravel/ai: construct the backlog agent and prompt it to divide the idea into the requested sprints.
            $response = AgileBacklogAgent::make()->prompt("Create exactly {$sprintCount} sprints for: " . $idea);
            
            // Convert structured output format to a PHP array.
            $backlog = $response->toArray();

            // If the response structure does not match our defined backlog schema, return an error.
            if (empty($backlog) || !isset($backlog['sprints'])) {
                return back()->withInput()->with('ai_error', 'AI returned an unexpected format. Please try again.');
            }

            // Return the backlog view rendering the sprint timelines and stories.
            return view('ai.backlog', [
                'idea'    => $idea,
                'backlog' => $backlog,
            ]);

        } catch (\Exception $e) {
            // Catch error, log it for developers, and inform the user.
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

        // Iterate through all user stories generated by the AI backlog agent.
        foreach ($request->validated('tasks') as $taskData) {
            // Find an existing sprint matching this name/project for the user, or create a new sprint record.
            $sprint = Sprint::firstOrCreate([
                'user_id'      => $userId,
                'name'         => $taskData['sprint_name'],
                'project_name' => $taskData['project_name'] ?: 'My Project',
            ], [
                'goal'           => $taskData['sprint_goal'] ?: null,
                'duration_weeks' => $taskData['sprint_duration_weeks'] ?: 2,
            ]);

            // Calculate when tasks in this sprint are due relative to their sprint sequence order.
            // E.g., Sprint 1 is due in 2 weeks, Sprint 2 in 4 weeks, etc.
            $sprintIndex = isset($taskData['sprint_index']) ? (int)$taskData['sprint_index'] : 0;
            $durationWeeks = isset($taskData['sprint_duration_weeks']) ? (int)$taskData['sprint_duration_weeks'] : 2;
            $weeksOffset = ($sprintIndex + 1) * $durationWeeks;
            $dueDate = now()->addWeeks($weeksOffset)->toDateString();

            // Create the database record representing the imported user story as a task.
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

        // Redirect back to task lists.
        return redirect()->route('tasks.index')
            ->with('success', "{$count} backlog item(s) imported successfully into Sprints!");
    }
}
