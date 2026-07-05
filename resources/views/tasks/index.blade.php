<x-layout title="SmartTask - Task List">
    <!-- Header & Action -->
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Task List</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">You have
                {{ $tasks->where('is_completed', false)->count() }} tasks remaining.
            </p>
        </div>
        <div class="flex gap-stack-md">
            <button
                class="px-4 py-2 bg-surface-container-high text-on-surface rounded-lg font-label-md text-label-md border border-outline-variant hover:bg-surface-container-highest transition-colors flex items-center gap-2">
                <i data-lucide="filter" class="w-4 h-4"></i>
                Filters
            </button>
            <a href='{{ route('tasks.create') }}'
                class="px-4 py-2 bg-primary text-on-primary rounded-lg font-label-md text-label-md flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-md">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Task
            </a>
        </div>
    </div>

    <!-- View Switcher Tabs -->
    <div class="flex border-b border-outline-variant dark:border-[#2d3d54]/60 mb-6">
        <button id="tab-all-btn" class="px-5 py-3 border-b-2 border-primary text-primary font-bold font-label-md text-label-md transition-all focus:outline-none cursor-pointer">
            All Tasks
        </button>
        <button id="tab-sprints-btn" class="px-5 py-3 border-b-2 border-transparent text-on-surface-variant hover:text-on-surface font-label-md text-label-md transition-all flex items-center gap-2 focus:outline-none cursor-pointer">
            <i data-lucide="kanban" class="w-4 h-4"></i>
            Agile Sprints
            @if($sprints->count() > 0)
                <span class="ml-1 px-1.5 py-0.5 bg-primary/10 text-primary rounded-full text-[10px] font-bold">{{ $sprints->count() }}</span>
            @endif
        </button>
    </div>

    <!-- Filters / Chips -->
    <div class="flex flex-wrap items-center gap-4 mb-6 bg-surface-container-low/40 border border-outline-variant p-4 rounded-xl">
        <div class="flex items-center gap-2 pr-4 border-r border-outline-variant/60">
            <span class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Priority</span>
            <a href="{{ request('priority') === 'high' ? route('tasks.index', request()->except(['priority', 'page'])) : route('tasks.index', ['priority' => 'high'] + request()->except('page')) }}"
                class="px-3 py-1.5 rounded-full text-label-sm font-label-sm transition-all {{ request('priority') === 'high' ? 'bg-error text-on-error font-bold ring-2 ring-error/20' : 'bg-error-container/20 text-error hover:brightness-95' }}">
                High
            </a>
            <a href="{{ request('priority') === 'medium' ? route('tasks.index', request()->except(['priority', 'page'])) : route('tasks.index', ['priority' => 'medium'] + request()->except('page')) }}"
                class="px-3 py-1.5 rounded-full text-label-sm font-label-sm transition-all {{ request('priority') === 'medium' ? 'bg-primary text-on-primary font-bold ring-2 ring-primary/20' : 'bg-primary-container/20 text-primary hover:brightness-95' }}">
                Medium
            </a>
            <a href="{{ request('priority') === 'low' ? route('tasks.index', request()->except(['priority', 'page'])) : route('tasks.index', ['priority' => 'low'] + request()->except('page')) }}"
                class="px-3 py-1.5 rounded-full text-label-sm font-label-sm transition-all {{ request('priority') === 'low' ? 'bg-secondary text-on-secondary font-bold ring-2 ring-secondary/20' : 'bg-secondary-container/20 text-secondary hover:brightness-95' }}">
                Low
            </a>
        </div>

        <div class="flex items-center gap-2 pr-4 border-r border-outline-variant/60">
            <span class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Status</span>
            <a href="{{ request('status') === 'incomplete' ? route('tasks.index', request()->except(['status', 'page'])) : route('tasks.index', ['status' => 'incomplete'] + request()->except('page')) }}"
                class="px-3 py-1.5 rounded-full text-label-sm font-label-sm transition-all {{ request('status') === 'incomplete' ? 'bg-primary/25 text-primary border border-primary/20 font-bold' : 'bg-surface-container text-on-surface-variant hover:brightness-95 border border-outline-variant/60' }}">
                Incomplete
            </a>
            <a href="{{ request('status') === 'completed' ? route('tasks.index', request()->except(['status', 'page'])) : route('tasks.index', ['status' => 'completed'] + request()->except('page')) }}"
                class="px-3 py-1.5 rounded-full text-label-sm font-label-sm transition-all {{ request('status') === 'completed' ? 'bg-secondary/20 text-secondary border border-secondary/20 font-bold' : 'bg-surface-container text-on-surface-variant hover:brightness-95 border border-outline-variant/60' }}">
                Completed
            </a>
        </div>

        @if(request()->has('priority') || request()->has('status'))
            <a href="{{ route('tasks.index') }}" class="ml-auto text-label-sm font-label-sm text-error hover:underline flex items-center gap-1">
                <i data-lucide="x-circle" class="w-4 h-4"></i>
                Clear Filters
            </a>
        @endif
    </div>

    <!-- Bento Layout Content -->
    <div class="grid grid-cols-12 gap-gutter-desktop">
        <!-- Main Content Column -->
        <div class="col-span-12 lg:col-span-8">
            
            <!-- VIEW 1: All Tasks (Standard List) -->
            <div id="all-tasks-view" class="space-y-4">
                @foreach ($tasks as $task)
                    <div
                        class="bg-surface-container border border-outline-variant hover:border-primary/30 rounded-xl p-4 flex items-center gap-4 hover-glow transition-all duration-300 group">

                        <!-- Checkbox Form for Toggling Status -->
                        <form action="{{ route('tasks.toggle', $task->id) }}" method="POST"
                            class="m-0 p-0 flex items-center">
                            @csrf
                            @method('PATCH')
                            <input
                                class="task-checkbox w-5 h-5 rounded-full border-2 border-outline-variant text-secondary focus:ring-secondary cursor-pointer transition-transform group-hover:scale-110"
                                id="task-{{ $task->id }}" type="checkbox" onchange="this.form.submit()"
                                {{ $task->is_completed ? 'checked' : '' }}>
                        </form>

                        <div class="flex-grow">
                            <label for="task-{{ $task->id }}"
                                class="font-body-lg text-body-lg text-on-surface block cursor-pointer transition-all {{ $task->is_completed ? 'line-through text-on-surface-variant/50' : 'font-semibold' }}">{{ $task->title }}
                            </label>
                            <div class="flex flex-wrap items-center gap-4 mt-1.5">
                                <span class="flex items-center gap-1 text-label-sm font-label-sm text-on-surface-variant/80">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                    {{ $task->due_date ?: 'No due date' }}
                                </span>
                                @if ($task->due_time)
                                    <span class="flex items-center gap-1 text-label-sm font-label-sm text-on-surface-variant/80">
                                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                        {{ $task->due_time }}
                                    </span>
                                @endif
                                @if($task->sprint)
                                    <span class="flex items-center gap-1 text-label-sm font-label-sm text-secondary/90 bg-secondary/5 px-2 py-0.5 rounded border border-secondary/10">
                                        <i data-lucide="sprint" class="w-3 h-3"></i>
                                        {{ $task->sprint->name }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            @if($task->story_points)
                                <span class="px-2 py-0.5 bg-primary/10 text-primary border border-primary/20 rounded-md text-[10px] font-bold" title="Story Points">
                                    {{ $task->story_points }} pts
                                </span>
                            @endif

                            @php
                                $priorityColors = [
                                    'high' => 'bg-error-container/20 text-error border border-error/10',
                                    'medium' => 'bg-primary-container/20 text-primary border border-primary/10',
                                    'low' => 'bg-secondary-container/20 text-secondary border border-secondary/10',
                                ];
                                $colorClass =
                                    $priorityColors[strtolower($task->priority)] ??
                                    'bg-surface-container text-on-surface-variant';
                            @endphp
                            <span
                                class="px-2.5 py-1 {{ $colorClass }} rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                {{ $task->priority }}
                            </span>

                            <!-- Status Badge -->
                            <span
                                class="px-2.5 py-1 {{ $task->is_completed ? 'bg-secondary/10 text-secondary border border-secondary/10' : 'bg-primary/10 text-primary border border-primary/10' }} rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                {{ $task->is_completed ? 'Completed' : 'Incomplete' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <a href="{{ route('tasks.edit', $task->id) }}"
                                class="p-1 rounded-lg hover:bg-surface-container-high text-on-surface-variant hover:text-primary transition-colors"
                                title="Edit Task">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this task?');"
                                class="m-0 p-0 flex items-center">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-1 rounded-lg hover:bg-error-container/10 text-on-surface-variant hover:text-error transition-colors"
                                    title="Delete Task">
                                    <i data-lucide="trash-2" class="w-4 h-4 text-error"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="mt-6 flex justify-center">
                    <div class="inline-flex rounded-full bg-surface-container p-3 shadow-sm">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>

            <div id="sprints-view" class="hidden space-y-6">
                @if($sprints->isEmpty())
                    <div class="bg-surface-container border border-outline-variant rounded-2xl p-8 text-center max-w-lg mx-auto my-8">
                        <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="kanban" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2">No Active Sprints</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-6">
                            You haven't generated any Agile backlogs yet. Use our AI Assistant to plan your sprints and import them.
                        </p>
                        <a href="{{ route('ai.backlog.show') }}" class="px-5 py-2.5 bg-primary text-on-primary rounded-xl font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all inline-flex items-center gap-2 shadow-md">
                            <i data-lucide="sparkles" class="w-4 h-4"></i>
                            Generate Backlog
                        </a>
                    </div>
                @else
                    <div class="space-y-10">
                        @foreach($sprints->groupBy('project_name') as $projectName => $projectSprints)
                            <div class="border border-outline-variant/60 rounded-3xl p-6 bg-surface-container-low/30 space-y-6">
                                <div class="flex items-center gap-2 pb-3 border-b border-outline-variant/60">
                                    <i data-lucide="folder" class="w-5 h-5 text-primary"></i>
                                    <h4 class="font-body-lg text-body-lg text-on-surface font-bold">
                                        Project: <span class="text-primary">{{ $projectName ?: 'General Sprints' }}</span>
                                    </h4>
                                    <span class="ml-auto px-2.5 py-0.5 bg-primary/10 text-primary rounded-full text-[10px] font-bold">
                                        {{ $projectSprints->count() }} Sprint{{ $projectSprints->count() > 1 ? 's' : '' }}
                                    </span>
                                </div>

                                <div class="space-y-6">
                                    @foreach($projectSprints as $sprint)
                                        @php
                                            $sprintTasks = $sprint->tasks;
                                            $total = $sprintTasks->count();
                                            $completed = $sprintTasks->where('is_completed', true)->count();
                                            $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
                                            $points = $sprintTasks->sum('story_points');
                                            $completedPoints = $sprintTasks->where('is_completed', true)->sum('story_points');
                                        @endphp
                                        <div class="bg-surface-container border border-outline-variant rounded-2xl overflow-hidden shadow-sm">
                                            <!-- Sprint Header -->
                                            <div class="p-5 bg-surface-container-high/40 border-b border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-4">
                                                <div>
                                                    <div class="flex items-center gap-2">
                                                        <h5 class="font-body-lg text-body-lg text-on-surface font-bold">{{ $sprint->name }}</h5>
                                                        <span class="px-2 py-0.5 bg-secondary/10 text-secondary border border-secondary/20 rounded-md text-[10px] font-bold uppercase tracking-wide">
                                                            {{ $sprint->duration_weeks }} Weeks
                                                        </span>
                                                    </div>
                                                    @if($sprint->goal)
                                                        <p class="text-body-sm text-on-surface-variant mt-1 italic">🎯 {{ $sprint->goal }}</p>
                                                    @endif
                                                </div>
                                                <div class="flex items-center gap-4">
                                                    <div class="text-right">
                                                        <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Velocity</p>
                                                        <p class="text-body-md font-bold text-on-surface mt-0.5">
                                                            {{ $completedPoints }} / {{ $points }} pts
                                                        </p>
                                                    </div>
                                                    <div class="w-24 bg-surface-container-low h-2 rounded-full relative overflow-hidden" title="{{ $percentage }}% Complete">
                                                        <div class="bg-primary h-full rounded-full" style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tasks List in Sprint -->
                                            <div class="divide-y divide-outline-variant/40">
                                                @forelse($sprintTasks as $task)
                                                    <div class="p-4 flex items-center gap-4 hover:bg-surface-container-low/30 transition-all duration-150 group">
                                                        <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="m-0 p-0 flex items-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input
                                                                class="task-checkbox w-5 h-5 rounded-full border-2 border-outline-variant text-secondary focus:ring-secondary cursor-pointer transition-transform group-hover:scale-110"
                                                                id="task-sprint-{{ $task->id }}" type="checkbox" onchange="this.form.submit()"
                                                                {{ $task->is_completed ? 'checked' : '' }}>
                                                        </form>

                                                        <div class="flex-grow">
                                                            <label for="task-sprint-{{ $task->id }}" class="font-body-md text-body-md text-on-surface block cursor-pointer {{ $task->is_completed ? 'line-through text-on-surface-variant/50' : 'font-semibold' }}">
                                                                {{ $task->title }}
                                                            </label>
                                                        </div>

                                                        <div class="flex items-center gap-3">
                                                            @if($task->story_points)
                                                                <span class="px-2 py-0.5 bg-primary/10 text-primary border border-primary/20 rounded-md text-[10px] font-bold" title="Story Points">
                                                                    {{ $task->story_points }} pts
                                                                </span>
                                                            @endif

                                                            @php
                                                                $priorityColors = [
                                                                    'high' => 'bg-error-container/20 text-error border border-error/10',
                                                                    'medium' => 'bg-primary-container/20 text-primary border border-primary/10',
                                                                    'low' => 'bg-secondary-container/20 text-secondary border border-secondary/10',
                                                                ];
                                                                $colorClass = $priorityColors[strtolower($task->priority)] ?? 'bg-surface-container text-on-surface-variant';
                                                            @endphp
                                                            <span class="px-2 py-0.5 {{ $colorClass }} rounded-md text-[10px] font-bold uppercase tracking-wider">
                                                                    {{ $task->priority }}
                                                                </span>
                                                        </div>

                                                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                            <a href="{{ route('tasks.edit', $task->id) }}" class="p-1 rounded-lg hover:bg-surface-container-high text-on-surface-variant hover:text-primary transition-colors" title="Edit Task">
                                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                                            </a>
                                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="m-0 p-0 flex items-center">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="p-1 rounded-lg hover:bg-error-container/10 text-on-surface-variant hover:text-error transition-colors" title="Delete Task">
                                                                    <i data-lucide="trash-2" class="w-4 h-4 text-error"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="p-8 text-center text-on-surface-variant text-body-sm italic">
                                                        No tasks assigned to this sprint.
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        <!-- Right Column (Stats & Visual) -->
        <div class="col-span-12 lg:col-span-4 space-y-gutter-desktop">
            <!-- Progress Card -->
            <div class="bg-primary text-on-primary rounded-2xl p-6 shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="font-headline-md text-headline-md mb-2">Goal Progress</h3>
                    @php
                        $total = $tasks->count();
                        $completed = $tasks->where('is_completed', true)->count();
                        $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
                    @endphp
                    <p class="font-body-md text-body-md opacity-90 mb-6">You've completed {{ $percentage }}% of your
                        tasks. Keep it up!</p>
                    <div class="w-full bg-white/20 h-2 rounded-full mb-2">
                        <div class="bg-secondary-fixed h-full rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                    <span class="text-label-sm font-label-sm">{{ $completed }}/{{ $total }} tasks
                        finished</span>
                </div>
                <div class="absolute -right-4 -bottom-4 opacity-10">
                    <i data-lucide="trending-up" class="w-28 h-28 text-white"></i>
                </div>
            </div>
            <!-- Decorative/Atmospheric Graphic Card -->
            <div class="rounded-2xl h-48 relative overflow-hidden group">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    data-alt="A serene, minimalist digital workspace illustration featuring a single sleek laptop on a clean white desk, surrounded by lush green indoor plants. The lighting is ethereal and bright, casting soft, long shadows that suggest a peaceful morning atmosphere. The color palette is composed of soft blues, crisp whites, and vibrant emerald greens, evoking a sense of mental clarity and calm productivity."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuARjmg7Gymep-jXDWnZm751nqu1S2WarD6Nef4xntgKwQShpMx2EBltSxwklKyTblDjx5HaqgmyQG3Mg5lL9rhumi6fn-5DHMbLHH4zxwCvyEF6HGJcGY3w_mYXidJfp0Md861a9qlEBLYYs6CMrgjfxojQIQtHC1v4ZbXjrv4wK90Pm4Vji5LRjn8jLBc4dDbvrr17CgA6JL3au-iREPq4hJH9m6Z7C_2ic03Edt31QAh3dTThyfzqLYJThQAtxlMy3l_AhvSLveN4">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                    <p class="text-white font-label-md text-label-md italic">"Focus is the art of knowing what
                        to ignore."</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Switching Script -->
    <script>
        const tabAllBtn = document.getElementById('tab-all-btn');
        const tabSprintsBtn = document.getElementById('tab-sprints-btn');
        const allTasksView = document.getElementById('all-tasks-view');
        const sprintsView = document.getElementById('sprints-view');

        if (tabAllBtn && tabSprintsBtn && allTasksView && sprintsView) {
            tabAllBtn.addEventListener('click', () => {
                tabAllBtn.classList.add('border-primary', 'text-primary', 'font-bold');
                tabAllBtn.classList.remove('border-transparent', 'text-on-surface-variant');
                tabSprintsBtn.classList.add('border-transparent', 'text-on-surface-variant');
                tabSprintsBtn.classList.remove('border-primary', 'text-primary', 'font-bold');
                allTasksView.classList.remove('hidden');
                sprintsView.classList.add('hidden');
            });

            tabSprintsBtn.addEventListener('click', () => {
                tabSprintsBtn.classList.add('border-primary', 'text-primary', 'font-bold');
                tabSprintsBtn.classList.remove('border-transparent', 'text-on-surface-variant');
                tabAllBtn.classList.add('border-transparent', 'text-on-surface-variant');
                tabAllBtn.classList.remove('border-primary', 'text-primary', 'font-bold');
                sprintsView.classList.remove('hidden');
                allTasksView.classList.add('hidden');
            });
        }
    </script>
</x-layout>
