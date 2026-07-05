<x-layout title="SmartTask – AI Task Breakdown">

    {{-- ── Header ──────────────────────────────────────────────────── --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-[22px]" style="font-variation-settings:'FILL' 1">auto_awesome</span>
            </div>
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">AI Task Breakdown</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Describe a feature or idea and let AI break it into actionable tasks.
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
            <div class="bg-surface-container/40 border border-outline-variant rounded-2xl p-6 shadow-sm backdrop-blur-md">
                <form action="{{ route('ai.breakdown') }}" method="POST" id="breakdown-form">
                    @csrf
                    <div class="mb-4">
                        <label for="idea" class="font-label-md text-label-md text-on-surface-variant block mb-2 uppercase tracking-wider">
                            Describe Your Feature or Idea
                        </label>
                        <textarea
                            id="idea"
                            name="idea"
                            rows="5"
                            placeholder="e.g. Build a user authentication system with email verification, social login (Google, GitHub), two-factor authentication, and password reset flow..."
                            class="w-full rounded-xl border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/20 p-4 font-body-md text-body-md bg-surface outline-none transition-all resize-none text-on-surface"
                        >{{ old('idea', $idea ?? '') }}</textarea>
                        @error('idea')
                            <p class="mt-1 text-label-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-label-sm text-on-surface-variant italic">
                            <span class="material-symbols-outlined text-[14px] align-middle">info</span>
                            Be descriptive — the more detail you provide, the better the results.
                        </p>
                        <button
                            type="submit"
                            id="submit-btn"
                            class="flex items-center gap-2 px-6 py-2.5 bg-primary text-on-primary rounded-xl font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all shadow-md whitespace-nowrap"
                        >
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1">auto_awesome</span>
                            <span id="btn-text">Generate Tasks</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tip card --}}
        <div class="lg:col-span-4">
            <div class="bg-primary/5 border border-primary/10 rounded-2xl p-6 h-full backdrop-blur-sm">
                <h3 class="font-label-md text-label-md text-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">lightbulb</span> Tips
                </h3>
                <ul class="space-y-2 text-body-md text-on-surface-variant font-body-md text-[13.5px]">
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-primary shrink-0">check_circle</span>
                        Include the user role and context
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-primary shrink-0">check_circle</span>
                        Mention the tech stack if relevant
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-primary shrink-0">check_circle</span>
                        Specify key constraints or integrations
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[14px] mt-1 text-primary shrink-0">check_circle</span>
                        Mention the expected outcome or deliverable
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ── Loading Overlay ──────────────────────────────────────────── --}}
    <div id="loading-overlay" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-surface-container rounded-2xl p-8 shadow-2xl flex flex-col items-center gap-4 max-w-xs mx-4">
            <div class="relative w-16 h-16">
                <div class="absolute inset-0 border-4 border-primary/20 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-t-primary border-r-transparent border-b-transparent border-l-transparent rounded-full animate-spin"></div>
                <span class="absolute inset-0 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-[24px]" style="font-variation-settings:'FILL' 1">auto_awesome</span>
                </span>
            </div>
            <div class="text-center">
                <p class="font-headline-sm text-headline-sm text-on-surface mb-1">AI is thinking...</p>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Breaking down your idea into tasks</p>
            </div>
        </div>
    </div>

    {{-- ── Results ───────────────────────────────────────────────────── --}}
    @if (!empty($tasks))
        <div id="results-section" class="animate-fade-in">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-headline-md text-headline-md text-on-surface">
                        Generated Tasks
                        <span class="ml-2 px-2.5 py-0.5 bg-primary text-on-primary rounded-full text-label-sm font-label-sm">{{ count($tasks) }}</span>
                    </h3>
                    <p class="text-body-sm text-on-surface-variant mt-1">Select tasks to import into your task list.</p>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" id="select-all-btn"
                        class="px-3 py-1.5 text-label-sm font-label-sm text-on-surface-variant border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                        Select All
                    </button>
                    <button type="button" id="deselect-all-btn"
                        class="px-3 py-1.5 text-label-sm font-label-sm text-on-surface-variant border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                        Deselect All
                    </button>
                </div>
            </div>

            <form action="{{ route('ai.import.tasks') }}" method="POST" id="import-form">
                @csrf
                <div class="space-y-3 mb-6">
                    @foreach ($tasks as $index => $task)
                        @php
                            $priorityConfig = [
                                'high'   => ['bg' => 'bg-error-container text-on-error-container', 'dot' => 'bg-error'],
                                'medium' => ['bg' => 'bg-primary-container text-primary', 'dot' => 'bg-primary'],
                                'low'    => ['bg' => 'bg-secondary-container text-on-secondary-container', 'dot' => 'bg-secondary'],
                            ];
                            $priority = strtolower($task['priority'] ?? 'medium');
                            $pc = $priorityConfig[$priority] ?? $priorityConfig['medium'];
                        @endphp
                        <div class="task-card bg-surface-container border border-outline-variant hover:border-primary/30 rounded-xl p-4 flex items-start gap-4 hover-glow transition-all duration-300 cursor-pointer"
                             onclick="toggleTask({{ $index }})">

                            {{-- Checkbox --}}
                            <input type="checkbox"
                                name="tasks[{{ $index }}][title]"
                                id="task-check-{{ $index }}"
                                value="{{ $task['title'] }}"
                                class="task-checkbox mt-1 w-5 h-5 rounded text-primary focus:ring-primary cursor-pointer shrink-0 hidden"
                                checked>
                            {{-- Hidden fields for other data --}}
                            <input type="hidden" name="tasks[{{ $index }}][description]" value="{{ $task['description'] ?? '' }}">
                            <input type="hidden" name="tasks[{{ $index }}][priority]" value="{{ $priority }}">

                            {{-- Visual checkbox --}}
                            <div class="task-visual-check w-6 h-6 rounded-full border-2 border-primary bg-primary flex items-center justify-center shrink-0 mt-0.5 transition-all"
                                 id="visual-check-{{ $index }}">
                                <span class="material-symbols-outlined text-on-primary text-[14px]">check</span>
                            </div>

                            {{-- Content --}}
                            <div class="flex-grow min-w-0">
                                <div class="flex items-start justify-between gap-2 mb-1">
                                    <h4 class="font-body-lg text-body-lg text-on-surface font-bold">{{ $task['title'] }}</h4>
                                    <div class="flex items-center gap-2 shrink-0">
                                        @if(isset($task['estimated_hours']))
                                            <span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant rounded-lg text-label-sm font-label-sm whitespace-nowrap">
                                                ~{{ $task['estimated_hours'] }}h
                                            </span>
                                        @endif
                                        <span class="px-2.5 py-0.5 {{ $pc['bg'] }} rounded-lg text-label-sm font-label-sm uppercase font-bold whitespace-nowrap">
                                            {{ $priority }}
                                        </span>
                                    </div>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $task['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-between p-4 bg-surface-container-low border border-outline-variant rounded-xl sticky bottom-4">
                    <p class="text-body-md text-on-surface-variant">
                        <span id="selected-count" class="font-bold text-on-surface">{{ count($tasks) }}</span> task(s) selected
                    </p>
                    <div class="flex gap-3">
                        <a href="{{ route('ai.breakdown.show') }}"
                           class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-xl text-label-md font-label-md hover:bg-surface-container transition-colors">
                            Try Again
                        </a>
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2 bg-primary text-on-primary rounded-xl font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all shadow-md">
                            <span class="material-symbols-outlined text-[18px]">add_task</span>
                            Import Selected Tasks
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @elseif (!empty($idea))
        {{-- Empty state after submission --}}
        <div class="text-center py-12 border border-dashed border-outline-variant rounded-2xl">
            <span class="material-symbols-outlined text-[48px] text-on-surface-variant mb-2">sentiment_dissatisfied</span>
            <p class="font-body-lg text-on-surface font-bold">No tasks generated</p>
            <p class="text-body-md text-on-surface-variant mt-1">Please try again with a more detailed description.</p>
        </div>
    @endif

    <script>
        // ── Loading state ──
        document.getElementById('breakdown-form').addEventListener('submit', function () {
            document.getElementById('loading-overlay').classList.remove('hidden');
            document.getElementById('submit-btn').disabled = true;
            document.getElementById('btn-text').textContent = 'Generating...';
        });

        // ── Task selection toggle ──
        function toggleTask(index) {
            const checkbox = document.getElementById('task-check-' + index);
            const visualCheck = document.getElementById('visual-check-' + index);
            const card = visualCheck.closest('.task-card');

            checkbox.checked = !checkbox.checked;

            if (checkbox.checked) {
                visualCheck.classList.add('bg-primary', 'border-primary');
                visualCheck.classList.remove('bg-transparent', 'border-outline-variant');
                card.classList.add('ring-1', 'ring-primary/30');
            } else {
                visualCheck.classList.remove('bg-primary', 'border-primary');
                visualCheck.classList.add('bg-transparent', 'border-outline-variant');
                card.classList.remove('ring-1', 'ring-primary/30');
            }
            updateCount();
        }

        function updateCount() {
            const checked = document.querySelectorAll('.task-checkbox:checked').length;
            document.getElementById('selected-count').textContent = checked;
        }

        // ── Select / Deselect all ──
        document.getElementById('select-all-btn')?.addEventListener('click', function () {
            document.querySelectorAll('.task-checkbox').forEach((cb, i) => {
                if (!cb.checked) toggleTask(i);
            });
        });

        document.getElementById('deselect-all-btn')?.addEventListener('click', function () {
            document.querySelectorAll('.task-checkbox').forEach((cb, i) => {
                if (cb.checked) toggleTask(i);
            });
        });

        // ── Prevent import if nothing selected ──
        document.getElementById('import-form')?.addEventListener('submit', function (e) {
            const count = document.querySelectorAll('.task-checkbox:checked').length;
            if (count === 0) {
                e.preventDefault();
                alert('Please select at least one task to import.');
            }
        });

        // ── Entry animation ──
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
