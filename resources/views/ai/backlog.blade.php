<x-layout title="SmartTask – Agile Backlog Generator">

    {{-- ── Header ──────────────────────────────────────────────────── --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center">
                <span class="material-symbols-outlined text-[22px]" style="font-variation-settings:'FILL' 1">sprint</span>
            </div>
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Agile Backlog Generator</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Turn your feature or product idea into a full Agile sprint backlog.
                </p>
            </div>
        </div>
    </div>

    {{-- ── Error Alert ──────────────────────────────────────────────── --}}
    @if (session('ai_error'))
        <div class="mb-6 flex items-start gap-3 p-4 bg-error-container text-on-error-container rounded-xl border border-error/20 shadow-sm animate-fade-in">
            <span class="material-symbols-outlined mt-0.5 shrink-0">error</span>
            <p class="font-body-md text-body-md">{{ session('ai_error') }}</p>
        </div>
    @endif

    {{-- ── Input Form ───────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
        <div class="lg:col-span-8">
            <div class="bg-surface-container/50 border border-outline-variant rounded-2xl p-6 shadow-sm backdrop-blur-md">
                <form action="{{ route('ai.backlog') }}" method="POST" id="backlog-form">
                    @csrf
                    <div class="mb-4">
                        <label for="idea" class="font-label-md text-label-md text-on-surface-variant block mb-2 uppercase tracking-wider">
                            Describe Your Feature or Product
                        </label>
                        <textarea
                            id="idea"
                            name="idea"
                            rows="5"
                            placeholder="e.g. Build an e-commerce platform with product catalog, shopping cart, Stripe payments, order management, and an admin dashboard for inventory management..."
                            class="w-full rounded-xl border border-outline-variant focus:border-secondary focus:ring-2 focus:ring-secondary/20 p-4 font-body-md text-body-md bg-surface outline-none transition-all resize-none text-on-surface"
                        >{{ old('idea', $idea ?? '') }}</textarea>
                        @error('idea')
                            <p class="mt-1 text-label-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sprint count selector --}}
                    <div class="mb-5">
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-2 uppercase tracking-wider">
                            Number of Sprints
                        </label>
                        <div class="flex gap-2">
                            @foreach ([2, 3, 4, 5] as $count)
                                <label class="flex-1">
                                    <input type="radio" name="sprint_count" value="{{ $count }}"
                                           class="sr-only sprint-radio"
                                           {{ (old('sprint_count', 3) == $count) ? 'checked' : '' }}>
                                    <div class="sprint-btn text-center py-2.5 border-2 rounded-xl cursor-pointer transition-all font-label-md text-label-md
                                        {{ (old('sprint_count', 3) == $count) ? 'border-secondary bg-secondary-container text-on-secondary-container font-bold shadow-sm' : 'border-outline-variant text-on-surface-variant hover:border-secondary/50' }}">
                                        {{ $count }} Sprints
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <p class="text-label-sm text-on-surface-variant italic">
                            <span class="material-symbols-outlined text-[14px] align-middle">info</span>
                            Each sprint will contain 3–5 user stories with sub-tasks.
                        </p>
                        <button
                            type="submit"
                            id="submit-btn"
                            class="flex items-center gap-2 px-6 py-2.5 bg-secondary text-on-secondary rounded-xl font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all shadow-md whitespace-nowrap"
                        >
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1">sprint</span>
                            <span id="btn-text">Generate Backlog</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Legend card --}}
        <div class="lg:col-span-4">
            <div class="bg-secondary/5 border border-secondary/10 rounded-2xl p-6 h-full backdrop-blur-sm">
                <h3 class="font-label-md text-label-md text-secondary uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">info</span> What you'll get
                </h3>
                <ul class="space-y-2 text-body-sm text-on-surface-variant font-body-sm">
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-secondary shrink-0">sprint</span>
                        Structured sprints with goals & duration
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-secondary shrink-0">person</span>
                        User stories in standard Agile format
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-secondary shrink-0">poker_chip</span>
                        Story points (Fibonacci: 1,2,3,5,8)
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-secondary shrink-0">task</span>
                        Sub-tasks for each user story
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-secondary shrink-0">add_task</span>
                        Import stories directly as tasks
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ── Loading Overlay ──────────────────────────────────────────── --}}
    <div id="loading-overlay" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-surface-container rounded-2xl p-8 shadow-2xl flex flex-col items-center gap-4 max-w-xs mx-4">
            <div class="relative w-16 h-16">
                <div class="absolute inset-0 border-4 border-secondary/20 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-t-secondary border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                <span class="absolute inset-0 flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary text-[24px]" style="font-variation-settings:'FILL' 1">sprint</span>
                </span>
            </div>
            <div class="text-center">
                <p class="font-headline-sm text-headline-sm text-on-surface mb-1">Planning sprints...</p>
                <p class="font-body-sm text-body-sm text-on-surface-variant">AI is generating your Agile backlog</p>
            </div>
        </div>
    </div>

    {{-- ── Results ───────────────────────────────────────────────────── --}}
    @if (!empty($backlog))
        @php
            $sprints = $backlog['sprints'] ?? [];
            $totalStories = collect($sprints)->sum(fn($s) => count($s['stories'] ?? []));
            $totalPoints  = collect($sprints)->sum(fn($s) => collect($s['stories'] ?? [])->sum(fn($st) => $st['story_points'] ?? 0));
        @endphp

        <div id="results-section" class="animate-fade-in">
            {{-- Project Title Box --}}
            <div class="mb-6 p-5 bg-primary/5 border border-primary/10 rounded-2xl flex items-center justify-between">
                <div>
                    <span class="text-label-sm text-primary uppercase font-bold tracking-wider">Generated Project Backlog</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface mt-1">{{ $backlog['project_title'] ?? 'My Project' }}</h3>
                </div>
            </div>

            {{-- Stats bar --}}
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-surface-container border border-outline-variant rounded-xl p-4 text-center">
                    <p class="font-headline-lg text-headline-lg text-secondary font-bold">{{ count($sprints) }}</p>
                    <p class="text-label-sm text-on-surface-variant uppercase tracking-wider">Sprints</p>
                </div>
                <div class="bg-surface-container border border-outline-variant rounded-xl p-4 text-center">
                    <p class="font-headline-lg text-headline-lg text-secondary font-bold">{{ $totalStories }}</p>
                    <p class="text-label-sm text-on-surface-variant uppercase tracking-wider">User Stories</p>
                </div>
                <div class="bg-surface-container border border-outline-variant rounded-xl p-4 text-center">
                    <p class="font-headline-lg text-headline-lg text-secondary font-bold">{{ $totalPoints }}</p>
                    <p class="text-label-sm text-on-surface-variant uppercase tracking-wider">Story Points</p>
                </div>
            </div>

            {{-- Sprint cards --}}
            <div class="space-y-6 mb-8">
                @foreach ($sprints as $sprintIndex => $sprint)
                    <div class="bg-surface-container border border-outline-variant rounded-2xl overflow-hidden shadow-sm">
                        {{-- Sprint header --}}
                        <div class="flex items-center justify-between p-5 bg-secondary-container/30 border-b border-outline-variant">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold text-label-md">
                                    {{ $sprintIndex + 1 }}
                                </div>
                                <div>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">
                                        {{ $sprint['name'] ?? "Sprint " . ($sprintIndex + 1) }}
                                    </h3>
                                    @if(isset($sprint['goal']))
                                        <p class="text-label-sm text-on-surface-variant mt-0.5">🎯 {{ $sprint['goal'] }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                @if(isset($sprint['duration_weeks']))
                                    <span class="px-2.5 py-1 bg-surface-container text-on-surface-variant rounded-lg text-label-sm font-label-sm border border-outline-variant">
                                        {{ $sprint['duration_weeks'] }} week{{ $sprint['duration_weeks'] > 1 ? 's' : '' }}
                                    </span>
                                @endif
                                <span class="px-2.5 py-1 bg-secondary-container text-on-secondary-container rounded-lg text-label-sm font-label-sm font-bold">
                                    {{ collect($sprint['stories'] ?? [])->sum(fn($s) => $s['story_points'] ?? 0) }} pts
                                </span>
                            </div>
                        </div>

                        {{-- User stories --}}
                        <div class="divide-y divide-outline-variant/50">
                            @foreach ($sprint['stories'] ?? [] as $storyIndex => $story)
                                @php
                                    $priority = strtolower($story['priority'] ?? 'medium');
                                    $priorityConfig = [
                                        'high'   => 'bg-error-container text-on-error-container',
                                        'medium' => 'bg-primary-container text-primary',
                                        'low'    => 'bg-secondary-container text-on-secondary-container',
                                    ];
                                    $pc = $priorityConfig[$priority] ?? $priorityConfig['medium'];
                                    $pts = $story['story_points'] ?? 3;
                                @endphp
                                <div class="p-5">
                                    <div class="flex items-start justify-between gap-4 mb-2">
                                        <h4 class="font-body-lg text-body-lg font-bold text-on-surface">
                                            {{ $story['title'] }}
                                        </h4>
                                        <div class="flex items-center gap-2 shrink-0">
                                            <span class="px-2 py-0.5 {{ $pc }} rounded-lg text-label-sm font-label-sm uppercase font-bold">{{ $priority }}</span>
                                            <span class="w-8 h-8 rounded-full bg-surface-container-high border border-outline-variant flex items-center justify-center text-label-md font-bold text-on-surface" title="Story Points">
                                                {{ $pts }}
                                            </span>
                                        </div>
                                    </div>
                                    @if(isset($story['description']))
                                        <p class="text-body-sm text-on-surface-variant italic mb-3">{{ $story['description'] }}</p>
                                    @endif
                                    @if(!empty($story['tasks']))
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($story['tasks'] as $subTask)
                                                <span class="flex items-center gap-1.5 px-2.5 py-1 bg-surface-container-low border border-outline-variant rounded-lg text-label-sm text-on-surface-variant">
                                                    <span class="material-symbols-outlined text-[12px]">arrow_right</span>
                                                    {{ $subTask }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Import form --}}
            <form action="{{ route('ai.import.backlog') }}" method="POST" id="import-form">
                @csrf
                @php $taskIdx = 0; @endphp
                @foreach ($sprints as $sprintIndex => $sprint)
                    @foreach ($sprint['stories'] ?? [] as $story)
                        @php
                            $fullDesc = $story['description'] ?? '';
                            if(!empty($story['tasks'])) {
                                $fullDesc .= "\n\nSub-tasks:\n";
                                foreach($story['tasks'] as $subTask) {
                                    $fullDesc .= "- [ ] " . $subTask . "\n";
                                }
                            }
                        @endphp
                        <input type="hidden" name="tasks[{{ $taskIdx }}][title]"       value="{{ $story['title'] }}">
                        <input type="hidden" name="tasks[{{ $taskIdx }}][description]" value="{{ $fullDesc }}">
                        <input type="hidden" name="tasks[{{ $taskIdx }}][priority]"    value="{{ strtolower($story['priority'] ?? 'medium') }}">
                        <input type="hidden" name="tasks[{{ $taskIdx }}][sprint_name]"  value="{{ $sprint['name'] ?? 'Sprint ' . ($sprintIndex + 1) }}">
                        <input type="hidden" name="tasks[{{ $taskIdx }}][sprint_goal]"  value="{{ $sprint['goal'] ?? '' }}">
                        <input type="hidden" name="tasks[{{ $taskIdx }}][sprint_duration_weeks]" value="{{ $sprint['duration_weeks'] ?? 2 }}">
                        <input type="hidden" name="tasks[{{ $taskIdx }}][story_points]" value="{{ $story['story_points'] ?? 3 }}">
                        <input type="hidden" name="tasks[{{ $taskIdx }}][project_name]" value="{{ $backlog['project_title'] ?? 'My Project' }}">
                        <input type="hidden" name="tasks[{{ $taskIdx }}][sprint_index]" value="{{ $sprintIndex }}">
                        @php $taskIdx++; @endphp
                    @endforeach
                @endforeach

                <div class="flex items-center justify-between p-4 bg-surface-container-low border border-outline-variant rounded-xl sticky bottom-4">
                    <p class="text-body-md text-on-surface-variant">
                        <strong class="text-on-surface">{{ $totalStories }}</strong> user stories ready to import
                    </p>
                    <div class="flex gap-3">
                        <a href="{{ route('ai.backlog.show') }}"
                           class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-xl text-label-md font-label-md hover:bg-surface-container transition-colors">
                            Generate New
                        </a>
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2 bg-secondary text-on-secondary rounded-xl font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all shadow-md">
                            <span class="material-symbols-outlined text-[18px]">add_task</span>
                            Import All as Tasks
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif

    <script>
        // Sprint count toggle styling
        document.querySelectorAll('.sprint-radio').forEach(radio => {
            radio.addEventListener('change', function () {
                document.querySelectorAll('.sprint-btn').forEach(btn => {
                    btn.className = btn.className.replace(/border-secondary[\w-]*/g, 'border-outline-variant');
                    btn.classList.remove('bg-secondary-container', 'text-on-secondary-container', 'font-bold');
                    btn.classList.add('text-on-surface-variant', 'hover:border-secondary/50');
                });
                const activeBtn = this.nextElementSibling;
                activeBtn.classList.remove('border-outline-variant', 'text-on-surface-variant', 'hover:border-secondary/50');
                activeBtn.classList.add('border-secondary', 'bg-secondary-container', 'text-on-secondary-container', 'font-bold');
            });
        });

        // Loading overlay
        document.getElementById('backlog-form').addEventListener('submit', function () {
            document.getElementById('loading-overlay').classList.remove('hidden');
            document.getElementById('submit-btn').disabled = true;
            document.getElementById('btn-text').textContent = 'Generating...';
        });

        // Entry animation
        document.addEventListener('DOMContentLoaded', () => {
            const section = document.getElementById('results-section');
            if (section) {
                section.style.opacity = '0';
                section.style.transform = 'translateY(16px)';
                setTimeout(() => {
                    section.style.transition = 'all 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>

</x-layout>
