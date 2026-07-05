<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Sprint;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->tasks();


        // Apply priority filter
        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }

        // Apply status filter
        if ($request->filled('status')) {
            $isCompleted = $request->input('status') === 'completed';
            $query->where('is_completed', $isCompleted);
        }

        $tasks = $query->paginate(8)->withQueryString();
        $sprints = $user->sprints()->with('tasks')->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'sprints' => $sprints,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sprints = Auth::user()->sprints;
        return view('tasks.create', [
            'task' => new Task(),
            'sprints' => $sprints,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        Task::create($validated);
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        abort_if($task->user_id !== auth()->id(), 403, 'You do not have permission to view this task.');
        return view('tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        abort_if($task->user_id !== auth()->id(), 403, 'You do not have permission to edit this task.');
        $sprints = Auth::user()->sprints;
        return view('tasks.edit', [
            'task' => $task,
            'sprints' => $sprints,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        abort_if($task->user_id !== auth()->id(), 403, 'You do not have permission to update this task.');

        $validated = $request->validated();

        if ($request->has('is_completed')) {
            $validated['is_completed'] = $request->boolean('is_completed');
        }

        $task->update($validated);
        return redirect()->route('tasks.index');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        abort_if($task->user_id !== auth()->id(), 403, 'You do not have permission to delete this task.');
        
        $sprintId = $task->sprint_id;
        $task->delete();

        if ($sprintId) {
            $sprint = Sprint::find($sprintId);
            if ($sprint && $sprint->tasks()->count() === 0) {
                $sprint->delete();
            }
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Toggle completion status of the task.
     */
    public function toggle(string $id)
    {
        $task = Task::findOrFail($id);
        abort_if($task->user_id !== auth()->id(), 403, 'You do not have permission to toggle this task.');
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->route('tasks.index');
    }
}
