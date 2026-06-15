<x-layout title="Focus - Dashboard">
    <!-- Hero Welcoming Section -->
    <section class="mb-stack-lg animate-fade-in">
        <div class="flex flex-col md:flex-row justify-between items-end gap-stack-md">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Good morning, {{ auth()->user()->name }}
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">Here's what's happening with your
                    workspace today.</p>
            </div>
            <div class="bg-surface-container rounded-xl p-stack-md flex items-center gap-4 card-elevation">
                <div class="relative h-12 w-12 flex items-center justify-center">
                    <svg class="absolute inset-0 w-full h-full transform -rotate-90">
                        <circle class="text-outline-variant" cx="24" cy="24" fill="transparent" r="20"
                            stroke="currentColor" stroke-width="4"></circle>
                        <circle class="text-secondary" cx="24" cy="24" fill="transparent" r="20"
                            stroke="currentColor" stroke-dasharray="125.6"
                            stroke-dashoffset="{{ 125.6 * (1 - $progressPercentage / 100) }}" stroke-width="4"></circle>
                    </svg>
                    <span class="font-label-md text-label-md text-on-surface">{{ $progressPercentage }}%</span>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-secondary-container font-bold">Today's Progress</p>
                    <p class="font-body-md text-body-md text-on-surface">{{ $completedTasks }} of {{ $totalTasks }}
                        tasks completed</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Metric Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-gutter-desktop mb-stack-lg animate-fade-in">
        <!-- Total Tasks -->
        <div
            class="bg-surface-container p-6 rounded-xl card-elevation border border-outline-variant flex items-center gap-4">
            <div class="p-3 bg-primary-container/10 text-primary rounded-lg">
                <span class="material-symbols-outlined text-[28px]">format_list_bulleted</span>
            </div>
            <div>
                <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-[11px]">
                    Total Tasks</p>
                <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface mt-1">{{ $totalTasks }}</h3>
            </div>
        </div>

        <!-- Completed Tasks -->
        <div
            class="bg-surface-container p-6 rounded-xl card-elevation border border-outline-variant flex items-center gap-4">
            <div class="p-3 bg-secondary-container/20 text-secondary rounded-lg">
                <span class="material-symbols-outlined text-[28px]">task_alt</span>
            </div>
            <div>
                <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-[11px]">
                    Completed Tasks</p>
                <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface mt-1">{{ $completedTasks }}</h3>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div
            class="bg-surface-container p-6 rounded-xl card-elevation border border-outline-variant flex items-center gap-4">
            <div class="p-3 bg-error-container/20 text-error rounded-lg">
                <span class="material-symbols-outlined text-[28px]">pending_actions</span>
            </div>
            <div>
                <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-[11px]">
                    Pending Tasks</p>
                <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface mt-1">
                    {{ $totalTasks - $completedTasks }}</h3>
            </div>
        </div>
    </section>

    <!-- Bento Grid Metrics & Overview -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter-desktop">
        <!-- Upcoming Deadlines (Large) -->
        <section
            class="md:col-span-8 bg-surface-container p-stack-lg rounded-xl card-elevation border border-outline-variant animate-fade-in">
            <div class="flex justify-between items-center mb-stack-lg">
                <h3 class="font-headline-md text-headline-md flex items-center gap-2">
                    <span class="material-symbols-outlined text-error">event_busy</span>
                    Upcoming Deadlines
                </h3>
                <a href="{{ route('tasks.index') }}"
                    class="text-primary font-label-md text-label-md hover:underline font-bold">View All</a>
            </div>
            <div class="space-y-3">
                @forelse ($upcomingTasks as $task)
                    <a href="{{ route('tasks.show', $task->id) }}"
                        class="flex items-center p-4 rounded-lg border border-outline-variant hover:bg-surface-container-high transition-all group cursor-pointer">
                        @php
                            $priorityColors = [
                                'high' => 'bg-error-container text-on-error-container',
                                'medium' => 'bg-primary-container text-primary',
                                'low' => 'bg-secondary-container text-on-secondary-container',
                            ];
                            $priorityIcons = [
                                'high' => 'warning',
                                'medium' => 'error_outline',
                                'low' => 'check_circle',
                            ];
                            $priorityColor =
                                $priorityColors[strtolower($task->priority)] ??
                                'bg-surface-container text-on-surface-variant';
                            $priorityIcon = $priorityIcons[strtolower($task->priority)] ?? 'task_alt';
                        @endphp
                        <div class="h-10 w-10 {{ $priorityColor }} rounded-lg flex items-center justify-center mr-4">
                            <span class="material-symbols-outlined">{{ $priorityIcon }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4
                                class="font-body-lg text-body-lg font-bold group-hover:text-primary transition-colors truncate">
                                {{ $task->title }}</h4>
                            <p class="text-label-sm text-on-surface-variant truncate max-w-xs md:max-w-md">
                                {{ $task->description ?: 'No description' }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-label-md font-bold text-on-surface">
                                {{ $task->due_date ? $task->due_date : 'No due date' }}
                                @if ($task->due_time)
                                    , {{ $task->due_time }}
                                @endif
                            </p>
                            <span
                                class="text-label-sm px-2 py-0.5 rounded-full {{ $priorityColor }} font-bold uppercase tracking-wider">
                                {{ $task->priority }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-10 border border-dashed border-outline-variant rounded-xl">
                        <span class="material-symbols-outlined text-[48px] text-on-surface-variant mb-2">task_alt</span>
                        <p class="text-body-lg font-bold text-on-surface">All caught up!</p>
                        <p class="text-label-md text-on-surface-variant">You have no upcoming incomplete tasks.</p>
                        <a href="{{ route('tasks.create') }}"
                            class="mt-4 inline-flex items-center gap-2 bg-primary text-on-primary px-4 py-2 rounded-lg font-label-md text-label-md">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Create Task
                        </a>
                    </div>
                @endforelse
            </div>
            <div class="mt-6 flex justify-center">
                <div
                    class="inline-flex rounded-full bg-primary-container/15 border border-primary/20 px-4 py-3 shadow-sm">
                    {{ $upcomingTasks->links() }}
                </div>
            </div>
        </section>

        <!-- Sidebar Actions & Motivation -->
        <section class="md:col-span-4 space-y-gutter-desktop animate-fade-in">
            <!-- Quick Actions Card -->
            <div class="bg-surface-container p-stack-lg rounded-xl card-elevation border border-outline-variant">
                <h3 class="font-headline-md text-headline-md mb-stack-lg">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('tasks.create') }}"
                        class="w-full flex items-center gap-3 p-3 rounded-lg border border-outline-variant hover:bg-surface-container-high transition-all">
                        <div
                            class="w-8 h-8 rounded-full bg-primary-container/10 text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">add</span>
                        </div>
                        <div>
                            <p class="text-body-md font-bold">New Task</p>
                            <p class="text-label-sm text-on-surface-variant">Add a task to your list</p>
                        </div>
                    </a>

                    <a href="{{ route('tasks.index') }}"
                        class="w-full flex items-center gap-3 p-3 rounded-lg border border-outline-variant hover:bg-surface-container-high transition-all">
                        <div
                            class="w-8 h-8 rounded-full bg-secondary-container/20 text-secondary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">format_list_bulleted</span>
                        </div>
                        <div>
                            <p class="text-body-md font-bold">View Tasks</p>
                            <p class="text-label-sm text-on-surface-variant">Manage all your active tasks</p>
                        </div>
                    </a>

                    <a href="{{ route('profile.index') }}"
                        class="w-full flex items-center gap-3 p-3 rounded-lg border border-outline-variant hover:bg-surface-container-high transition-all">
                        <div
                            class="w-8 h-8 rounded-full bg-surface-container text-on-surface-variant flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                        </div>
                        <div>
                            <p class="text-body-md font-bold">Profile Settings</p>
                            <p class="text-label-sm text-on-surface-variant">Manage your account profile</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Quote/Inspirational Card -->
            <div class="rounded-xl h-48 relative overflow-hidden group border border-outline-variant card-elevation">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    data-alt="A serene, minimalist digital workspace illustration featuring a single laptop on a clean desk, surrounded by green plants, cast in soft morning light."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuARjmg7Gymep-jXDWnZm751nqu1S2WarD6Nef4xntgKwQShpMx2EBltSxwklKyTblDjx5HaqgmyQG3Mg5lL9rhumi6fn-5DHMbLHH4zxwCvyEF6HGJcGY3w_mYXidJfp0Md861a9qlEBLYYs6CMrgjfxojQIQtHC1v4ZbXjrv4wK90Pm4Vji5LRjn8jLBc4dDbvrr17CgA6JL3au-iREPq4hJH9m6Z7C_2ic03Edt31QAh3dTThyfzqLYJThQAtxlMy3l_AhvSLveN4">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end p-6">
                    <p class="text-white font-label-md text-label-md italic">"Focus is the art of knowing what to
                        ignore."</p>
                </div>
            </div>
        </section>
    </div>

    <!-- Micro-interaction Scripts -->
    <script>
        // Simple animation on load
        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.animate-fade-in');
            items.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</x-layout>
