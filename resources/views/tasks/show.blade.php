<x-layout title="SmartTask - Task Details">
    <div class="max-w-2xl mx-auto space-y-6">
        <!-- Back Navigation -->
        <a href="{{ route('tasks.index') }}" class="inline-flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Back to Task List
        </a>

        <!-- Task Details Card -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl p-8 shadow-sm space-y-6">
            <!-- Header Section -->
            <div class="flex flex-wrap justify-between items-start gap-4 pb-6 border-b border-outline-variant">
                <div class="space-y-1 flex-1 min-w-[280px]">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface break-words">{{ $task->title }}</h2>
                    <p class="text-label-sm text-on-surface-variant uppercase tracking-wider">Task Details</p>
                </div>
                
                <div class="flex items-center gap-2">
                    <!-- Priority Badge -->
                    @php
                        $priorityColors = [
                            'high' => 'bg-error-container text-on-secondary-fixed-variant border border-error/20',
                            'medium' => 'bg-surface-variant text-on-secondary-fixed-variant border border-outline-variant',
                            'low' => 'bg-secondary-container text-on-secondary-fixed-variant border border-secondary/20',
                        ];
                        $colorClass = $priorityColors[strtolower($task->priority)] ?? 'bg-surface-container text-on-secondary-fixed-variant';
                    @endphp
                    <span class="px-3 py-1.5 {{ $colorClass }} rounded-lg text-label-sm font-label-sm uppercase tracking-wider font-bold">
                        {{ $task->priority }}
                    </span>

                    <!-- Status Badge -->
                    <span class="px-3 py-1.5 {{ $task->is_completed ? 'bg-secondary-container text-on-secondary-container' : 'bg-error-container text-on-error-container' }} rounded-lg text-label-sm font-label-sm font-bold">
                        {{ $task->is_completed ? 'Completed' : 'Incomplete' }}
                    </span>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Description</h3>
                @if($task->description)
                    <p class="text-body-lg text-on-surface leading-relaxed whitespace-pre-line">{{ $task->description }}</p>
                @else
                    <p class="text-body-lg text-on-surface-variant italic">No description provided for this task.</p>
                @endif
            </div>

            <!-- Date & Time Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-surface-container-low rounded-xl">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary p-2 bg-surface-container rounded-lg shadow-sm">calendar_today</span>
                    <div>
                        <p class="text-label-sm text-on-surface-variant uppercase tracking-wider">Due Date</p>
                        <p class="text-body-md font-bold text-on-surface">{{ $task->due_date ?: 'No date set' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary p-2 bg-surface-container rounded-lg shadow-sm">schedule</span>
                    <div>
                        <p class="text-label-sm text-on-surface-variant uppercase tracking-wider">Due Time</p>
                        <p class="text-body-md font-bold text-on-surface">{{ $task->due_time ?: 'No time set' }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions Footer -->
            <div class="pt-6 border-t border-outline-variant flex flex-wrap justify-between items-center gap-4">
                <!-- Toggle Complete Form -->
                <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="m-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-5 py-2.5 bg-surface-container text-on-surface rounded-xl font-label-md text-label-md hover:bg-surface-container-highest transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">{{ $task->is_completed ? 'check_box' : 'check_box_outline_blank' }}</span>
                        {{ $task->is_completed ? 'Mark as Incomplete' : 'Mark as Completed' }}
                    </button>
                </form>

                <div class="flex items-center gap-3">
                    <!-- Edit Button -->
                    <a href="{{ route('tasks.edit', $task->id) }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-xl font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all flex items-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                        Edit Task
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2.5 bg-surface-container border border-error text-error rounded-xl font-label-md text-label-md hover:bg-error/10 active:scale-95 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
