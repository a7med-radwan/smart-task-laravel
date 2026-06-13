<x-layout title="Focus - Task List">
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
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filters
            </button>
            <a href='{{ route('tasks.create') }}'
                class="px-4 py-2 bg-primary text-on-primary rounded-lg font-label-md text-label-md flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-md">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Add Task
            </a>
        </div>
    </div>
    <!-- Filters / Chips -->
    <div class="flex flex-wrap gap-stack-md mb-8">
        <div class="flex items-center gap-2 pr-4 border-outline-variant">
            <span class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Priority</span>
            <button
                class="px-3 py-1 bg-error-container text-on-error-container rounded-full text-label-sm font-label-sm hover:brightness-95 transition-all">High</button>
            <button
                class="px-3 py-1 bg-surface-variant text-on-secondary-fixed-variant rounded-full text-label-sm font-label-sm hover:brightness-95 transition-all">Medium</button>
            <button
                class="px-3 py-1 bg-secondary-container text-on-secondary-fixed-variant rounded-full text-label-sm font-label-sm hover:brightness-95 transition-all">Low</button>
        </div>
    </div>
    <!-- Bento Layout Content -->
    <div class="grid grid-cols-12 gap-gutter-desktop">
        <!-- Main Task List Column -->
        <div class="col-span-12 lg:col-span-8 space-y-4">
            <!-- Task Item 1 -->
            @foreach ($tasks as $task)
                <div
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl p-4 flex items-center gap-4 hover:shadow-sm transition-all group">

                    <!-- Checkbox Form for Toggling Status -->
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="m-0 p-0 flex items-center">
                        @csrf
                        @method('PATCH')
                        <input
                            class="task-checkbox w-5 h-5 rounded-full border-2 border-outline-variant text-secondary focus:ring-secondary cursor-pointer"
                            id="task-{{ $task->id }}" type="checkbox" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                    </form>

                    <div class="flex-grow">
                        <label for="task-{{ $task->id }}"
                            class="font-body-lg text-body-lg text-on-surface block cursor-pointer transition-colors {{ $task->is_completed ? 'line-through text-outline' : '' }}">{{ $task->title }}
                        </label>
                        <div class="flex items-center gap-4 mt-1">
                            <span class="flex items-center gap-1 text-label-sm font-label-sm text-on-surface-variant">
                                <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                {{$task->due_date}}
                            </span>
                            <span class="flex items-center gap-1 text-label-sm font-label-sm text-on-surface-variant">
                                <span class="material-symbols-outlined text-[14px]">schedule</span>
                                {{$task->due_time}}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Priority Badge -->
                        @php
                            $priorityColors = [
                                'high' => 'bg-error-container text-on-secondary-fixed-variant',
                                'medium' => 'bg-surface-variant text-on-secondary-fixed-variant',
                                'low' => 'bg-secondary-container text-on-secondary-fixed-variant',
                            ];
                            $colorClass = $priorityColors[strtolower($task->priority)] ?? 'bg-surface-container text-on-secondary-fixed-variant';
                        @endphp
                        <span
                            class="px-2.5 py-1 {{ $colorClass }} rounded-lg text-label-sm font-label-sm uppercase tracking-wider mr-10 font-bold">
                            {{ $task->priority }}
                        </span>

                        <!-- Status Badge -->
                        <span
                            class="px-2.5 py-1 {{ $task->is_completed ? 'bg-secondary-container text-on-secondary-container' : 'bg-error-container text-on-error-container' }} rounded-lg text-label-sm font-label-sm">
                            {{ $task->is_completed ? 'Completed' : 'Incomplete' }}
                        </span>
                    </div>

                    <div class="flex items-center gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('tasks.edit', $task->id) }}"
                            class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors"
                            title="Edit Task">edit</a>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this task?');"
                            class="m-0 p-0 flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="material-symbols-outlined text-on-surface-variant hover:text-error transition-colors"
                                title="Delete Task">delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
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
                    <span class="text-label-sm font-label-sm">{{ $completed }}/{{ $total }} tasks finished</span>
                </div>
                <div class="absolute -right-4 -bottom-4 opacity-10">
                    <span class="material-symbols-outlined text-[120px]"
                        style="font-variation-settings: 'FILL' 1;">insights</span>
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
        <div class="col-span-5 flex justify-end mt-gutter-desktop">
            {{ $tasks->links() }}
        </div>
        <!-- Micro-interaction Script -->
        <script>
            // Initialize Tinymce
            document.querySelectorAll('.task-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const parent = this.closest('.bg-surface-container-lowest');
                    if (this.checked) {
                        parent.classList.add('opacity-60');
                    } else {
                        parent.classList.remove('opacity-60');
                    }
                });
            });
        </script>
</x-layout>