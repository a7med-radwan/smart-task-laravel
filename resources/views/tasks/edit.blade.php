<x-layout title="Focus - Edit Task">
    @include('tasks._form', [
        'task' => $task,
        'action' => route('tasks.update', $task->id),
        'method' => 'PUT',
        'title' => 'Edit Task',
    ])
</x-layout>
