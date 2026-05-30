<x-layout title="Focus - Dashboard">
            <!-- Hero Welcoming Section -->
            <section class="mb-stack-lg animate-fade-in">
                <div class="flex flex-col md:flex-row justify-between items-end gap-stack-md">
                    <div>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">Good morning, Alex</h2>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">Here's what's happening with
                            your workspace today.</p>
                    </div>
                    <div class="bg-surface-container rounded-xl p-stack-md flex items-center gap-4 card-elevation">
                        <div class="relative h-12 w-12 flex items-center justify-center">
                            <svg class="absolute inset-0 w-full h-full transform -rotate-90">
                                <circle class="text-outline-variant" cx="24" cy="24" fill="transparent" r="20"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <circle class="text-secondary" cx="24" cy="24" fill="transparent" r="20"
                                    stroke="currentColor" stroke-dasharray="125.6" stroke-dashoffset="{{ 125.6 * (1 - $progressPercentage / 100) }}"
                                    stroke-width="4"></circle>
                            </svg>
                            <span class="font-label-md text-label-md text-on-surface">{{ $progressPercentage }}%</span>
                        </div>
                        <div>
                            <p class="font-label-md text-label-md text-on-secondary-container font-bold">Today's
                                Progress</p>
                            <p class="font-body-md text-body-md text-on-surface">{{ $completedTasks }} of {{ $totalTasks }} tasks completed</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bento Grid Metrics & Overview -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter-desktop">
                <!-- Upcoming Deadlines (Large) -->
                <section
                    class="md:col-span-8 bg-white p-stack-lg rounded-xl card-elevation border border-outline-variant">
                    <div class="flex justify-between items-center mb-stack-lg">
                        <h3 class="font-headline-md text-headline-md flex items-center gap-2">
                            <span class="material-symbols-outlined text-error" data-icon="event_busy">event_busy</span>
                            Upcoming Deadlines
                        </h3>
                        <a href="{{ route('tasks.index') }}" class="text-primary font-label-md text-label-md hover:underline">View All</a>
                    </div>
                    <div class="space-y-3">
                        @forelse ($upcomingTasks as $task)
                            <a href="{{ route('tasks.show', $task->id) }}"
                                class="flex items-center p-4 rounded-lg border border-slate-200 hover:elevation-2 hover:bg-surface-container-low transition-all group cursor-pointer">
                                @php
                                    $priorityColors = [
                                        'high' => 'bg-error-container text-error',
                                        'medium' => 'bg-surface-variant text-on-surface-variant',
                                        'low' => 'bg-secondary-container text-secondary',
                                    ];
                                    $priorityColor = $priorityColors[strtolower($task->priority)] ?? 'bg-surface-container text-on-surface-variant';
                                    
                                    $priorityIcons = [
                                        'high' => 'priority_high',
                                        'medium' => 'description',
                                        'low' => 'chat',
                                    ];
                                    $priorityIcon = $priorityIcons[strtolower($task->priority)] ?? 'task_alt';
                                @endphp
                                <div class="h-10 w-10 {{ $priorityColor }} rounded-lg flex items-center justify-center mr-4">
                                    <span class="material-symbols-outlined">{{ $priorityIcon }}</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-body-lg text-body-lg font-bold group-hover:text-primary transition-colors">{{ $task->title }}</h4>
                                    <p class="text-label-sm text-on-surface-variant truncate max-w-xs md:max-w-md">{{ $task->description ?: 'No description' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-label-md font-bold {{ strtolower($task->priority) === 'high' ? 'text-error' : 'text-on-surface' }}">
                                        {{ $task->due_date ? $task->due_date : 'No due date' }}
                                        @if($task->due_time)
                                            , {{ $task->due_time }}
                                        @endif
                                    </p>
                                    <span class="text-label-sm px-2 py-0.5 rounded-full {{ $priorityColor }} font-bold uppercase tracking-wider">
                                        {{ $task->priority }}
                                    </span>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-10 border border-dashed border-outline-variant rounded-xl">
                                <span class="material-symbols-outlined text-[48px] text-on-surface-variant mb-2">task_alt</span>
                                <p class="text-body-lg font-bold text-on-surface">All caught up!</p>
                                <p class="text-label-md text-on-surface-variant">You have no upcoming incomplete tasks.</p>
                                <a href="{{ route('tasks.create') }}" class="mt-4 inline-flex items-center gap-2 bg-primary text-on-primary px-4 py-2 rounded-lg font-label-md text-label-md">
                                    <span class="material-symbols-outlined text-[18px]">add</span>
                                    Create Task
                                </a>
                            </div>
                        @endforelse
                    </div>
                </section>
                <!-- Project Overview (Sidebar Grid) -->
                <section class="md:col-span-4 space-y-gutter-desktop">
                    <!-- Stat Card 1 -->
                    <div
                        class="bg-primary-container text-on-primary-container p-stack-lg rounded-xl card-elevation relative overflow-hidden group">
                        <div class="relative z-10">
                            <p class="font-label-md text-label-md opacity-80 mb-2">Active Projects</p>
                            <h3 class="font-headline-lg text-headline-lg font-bold">12</h3>
                            <div class="mt-4 flex -space-x-2">
                                <img class="h-8 w-8 rounded-full border-2 border-primary-container"
                                    data-alt="Close up professional headshot of a woman with short dark hair in a bright studio, wearing a minimalist white shirt, soft natural lighting and clean background."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4JLukV0gcovFUfh5bJ5neOeW2kqLeIk7wkSBaXmkD6HjhdzoOM-TGrridk8DYf7q4gHSNS_5oM-LMPx1UAbORbYTx8vjH8lPSSbZEETbpsdOaUcY7zeQw3GBCeAwDI_cglPrtWs0u2uULzAarvDe7MZ53YDAX7eF2B82M5OiGKjrURc7mC76yFYDFJSy-NEMEAryflAlFUIGswF8yl5vlABLxJAx-r37HCdBwf7KeE0ZnusA03rIQS3IW-R_kbkKYRZSLAoSBFx76">
                                <img class="h-8 w-8 rounded-full border-2 border-primary-container"
                                    data-alt="Close up professional headshot of a man with a friendly expression, wearing a tailored navy blazer in a modern office environment with soft bokeh background."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrgHZicbcGXmdT3tPuAPpo-aK9BbZrOUWAXgsuxmgTC89BuIr1jHELG_g8UtcMj2XXMSRsg-1t_kRWx04hTbVWLDQh_OMEc4Vp4iJ6UsEoHLmxIKOpL-7DoZqutXYWZ3LqP1xIvmq27qxW_dnfbi_atU0mhxWK06DXtTtfsHWaX5AqEB-FRjLfe3V9_CCqEzo74wNKEU2T33FHEIwyC8L3yeRYy5kLK1u47Q7g1OmMDhk-lVJZv8Lck12xqWpyQb8GaeijXMUSWZ7v">
                                <div
                                    class="h-8 w-8 rounded-full border-2 border-primary-container bg-primary flex items-center justify-center text-label-sm">
                                    +4</div>
                            </div>
                        </div>
                        <span
                            class="material-symbols-outlined absolute -right-4 -bottom-4 text-[120px] opacity-10 group-hover:scale-110 transition-transform"
                            data-icon="folder_managed">folder_managed</span>
                    </div>
                    <!-- Project Snapshot List -->
                    <div class="bg-white p-stack-lg rounded-xl card-elevation border border-outline-variant">
                        <h3 class="font-headline-md text-headline-md mb-stack-lg">Project Overview</h3>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-label-md text-label-md font-bold">Design System</span>
                                    <span class="text-label-sm text-on-surface-variant">80%</span>
                                </div>
                                <div class="h-1 bg-surface-container-high rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary w-[80%]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-label-md text-label-md font-bold">Mobile App Dev</span>
                                    <span class="text-label-sm text-on-surface-variant">45%</span>
                                </div>
                                <div class="h-1 bg-surface-container-high rounded-full overflow-hidden">
                                    <div class="h-full bg-primary w-[45%]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-label-md text-label-md font-bold">Marketing Deck</span>
                                    <span class="text-label-sm text-on-surface-variant">15%</span>
                                </div>
                                <div class="h-1 bg-surface-container-high rounded-full overflow-hidden">
                                    <div class="h-full bg-tertiary-container w-[15%]"></div>
                                </div>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 py-2 border border-outline-variant rounded-lg font-label-md text-label-md hover:bg-surface-container-low transition-colors">Manage
                            Projects</button>
                    </div>
                </section>
                <!-- Activity Feed / Quick Actions -->
                <section
                    class="md:col-span-12 bg-white p-stack-lg rounded-xl card-elevation border border-outline-variant">
                    <div class="flex items-center justify-between mb-stack-lg">
                        <h3 class="font-headline-md text-headline-md">Recent Activity</h3>
                        <div class="flex gap-2">
                            <span class="text-label-sm bg-surface-container px-3 py-1 rounded-full text-on-surface">Last
                                24 hours</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-container-low transition-colors group">
                            <div
                                class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-secondary text-[18px]"
                                    data-icon="check_circle">check_circle</span>
                            </div>
                            <div>
                                <p class="text-body-md font-bold">Task Completed</p>
                                <p class="text-label-sm text-on-surface-variant">Landing page assets uploaded by Sarah
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-container-low transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center shrink-0 text-on-primary">
                                <span class="material-symbols-outlined text-[18px]"
                                    data-icon="add_comment">add_comment</span>
                            </div>
                            <div>
                                <p class="text-body-md font-bold">New Comment</p>
                                <p class="text-label-sm text-on-surface-variant">James left a note on the Budget sheet
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-container-low transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-tertiary-fixed flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-tertiary text-[18px]"
                                    data-icon="schedule">schedule</span>
                            </div>
                            <div>
                                <p class="text-body-md font-bold">Meeting Moved</p>
                                <p class="text-label-sm text-on-surface-variant">Sync-up delayed by 30 mins</p>
                            </div>
                        </div>
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-container-low transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-error-container flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-error text-[18px]"
                                    data-icon="report">report</span>
                            </div>
                            <div>
                                <p class="text-body-md font-bold">High Priority</p>
                                <p class="text-label-sm text-on-surface-variant">Bug reported on production site</p>
                            </div>
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