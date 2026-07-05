<!-- <x-slot:head-scripts>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js" referrerpolicy="origin"
        crossorigin="anonymous"></script>
</x-slot:head-scripts> -->

<div class="flex items-center justify-center p-gutter-desktop">
    <div class="w-full max-w-[700px]">
        <!-- Header Area -->
        <div class="mb-stack-lg text-center">
            <h2 class="font-headline-lg text-headline-lg text-on-surface">{{ $title ?? 'Create Task'}}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">Break your goals down into manageable
                steps.</p>
        </div>
        <!-- Form Card -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg form-card">
            <form action="{{ $action ?? route('tasks.store') }}" method="POST" class="space-y-stack-lg">
                @method($method ?? 'POST')
                @csrf
                <!-- Task Title -->
                <div>
                    <label
                        class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm uppercase tracking-wider"
                        for="task-title">Task Title</label>
                    <input
                        class="w-full bg-transparent border-b-2 border-outline-variant focus:border-primary-container py-3 font-headline-md text-headline-md outline-none transition-all placeholder:text-outline"
                        id="task-title" placeholder="What needs to be done?" type="text" name="title"
                        value="{{ old('title', $task->title) }}" />
                </div>
                <!-- Description -->
                <div>
                    <label class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm"
                        for="description">Description</label>
                    <textarea id="description"
                        class="w-full rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container p-3 font-body-md text-body-md bg-surface-container transition-all outline-none resize-none"
                        id="description" placeholder="Add some details or notes..." rows="3"
                        name="description">{{ old('description', $task->description) }}</textarea>
                </div>
                <!-- Grid for Date, Time, and Priority -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <!-- Due Date -->
                    <div class="relative">
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm"
                            for="due-date">Due Date</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary-container">event</span>
                            <input
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container font-body-md text-body-md bg-surface-container outline-none transition-all"
                                id="due-date" type="date" value="{{ old('due_date', $task->due_date) }}"
                                name="due_date" />
                        </div>
                    </div>
                    <!-- Due Time -->
                    <div class="relative">
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm"
                            for="due-time">Time</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary-container">schedule</span>
                            <input
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container font-body-md text-body-md bg-surface-container outline-none transition-all"
                                id="due-time" type="time" value="{{ old('due_time', $task->due_time) }}"
                                name="due_time" />
                        </div>
                    </div>
                </div>

                <!-- Grid for Sprint and Story Points -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <!-- Sprint Selection -->
                    <div>
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm"
                            for="sprint_id">Assigned Sprint</label>
                        <select
                            class="w-full px-4 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container font-body-md text-body-md bg-surface-container outline-none transition-all text-on-surface"
                            id="sprint_id" name="sprint_id">
                            <option value="">Unassigned / No Sprint</option>
                            @if(isset($sprints))
                                @foreach($sprints as $sprintOption)
                                    <option value="{{ $sprintOption->id }}" {{ old('sprint_id', $task->sprint_id) == $sprintOption->id ? 'selected' : '' }}>
                                        {{ $sprintOption->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <!-- Story Points -->
                    <div>
                        <label class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm"
                            for="story_points">Story Points</label>
                        <input
                            class="w-full px-4 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container font-body-md text-body-md bg-surface-container outline-none transition-all text-on-surface"
                            id="story_points" type="number" min="0" max="100" placeholder="e.g. 1, 2, 3, 5, 8"
                            value="{{ old('story_points', $task->story_points) }}" name="story_points" />
                    </div>
                </div>

                <!-- Priority -->
                <div>
                    <label
                        class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm">Priority</label>
                    <div class="flex gap-2 bg-surface-container-low p-1 rounded-lg border border-outline-variant">
                        <button type="button" id="btn-low" onclick="setPriority('low')"
                            class="flex-1 py-2 rounded-md transition-all text-on-surface-variant">Low</button>
                        <button type="button" id="btn-medium" onclick="setPriority('medium')"
                            class="flex-1 py-2 rounded-md transition-all bg-surface-container-high shadow-sm font-bold text-tertiary">Medium</button>
                        <button type="button" id="btn-high" onclick="setPriority('high')"
                            class="flex-1 py-2 rounded-md transition-all text-on-surface-variant">High</button>
                    </div>
                    <input type="hidden" name="priority" value="{{ old('priority', $task->priority) }}"
                        id="priority-input">
                </div>
                <!-- Actions -->
                <div class="pt-stack-md flex flex-col sm:flex-row items-center justify-end gap-stack-md">
                    <a href="{{ route('tasks.index') }}"
                        class="w-full sm:w-auto px-6 py-2.5 font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors rounded-lg text-center border border-outline-variant">
                        Cancel
                    </a>
                    <button
                        class="w-full sm:w-auto px-3 py-1 bg-primary-container text-on-primary-container hover:bg-primary transition-all rounded-lg font-headline-md text-headline-md active:scale-95 flex items-center justify-center gap-2"
                        type="submit">
                        <span class="material-symbols-outlined" data-icon="add_task">add_task</span>
                        Save Task
                    </button>
                </div>
            </form>
        </div>
        <!-- Contextual Hint -->
        <div class="mt-stack-lg flex items-center justify-center gap-2 text-on-surface-variant">
            <span class="material-symbols-outlined text-[20px]" data-icon="lightbulb">lightbulb</span>
            <span class="text-label-sm font-label-sm italic">Pro-tip: Tasks with due times send notifications 15
                minutes before.</span>
        </div>
    </div>
</div>
<script>
    // tinymce.init({
    //     selector: '#description',
    //     plugins: [
    //         'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount', 'image'
    //     ],
    //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    //     branding: false,
    //     promotion: false,
    //     setup: function (editor) {
    //         editor.on('change keyup', function () {
    //             editor.save();
    //             updateSEODescriptionFromEditor(editor.getContent({ format: 'text' }));
    //         });
    //     }
    // });

    function setPriority(level) {
        const btns = {
            low: document.getElementById('btn-low'),
            medium: document.getElementById('btn-medium'),
            high: document.getElementById('btn-high')
        };

        // Reset styles
        Object.values(btns).forEach(btn => {
            btn.classList.remove('bg-surface-container-high', 'text-secondary', 'text-tertiary', 'text-error', 'shadow-sm', 'font-bold');
            btn.classList.add('text-on-surface-variant');
        });

        // Apply active styles
        const active = btns[level];
        active.classList.remove('text-on-surface-variant');
        active.classList.add('bg-surface-container-high', 'shadow-sm', 'font-bold');

        if (level === 'low') active.classList.add('text-secondary');
        if (level === 'medium') active.classList.add('text-tertiary');
        if (level === 'high') active.classList.add('text-error');

        document.getElementById('priority-input').value = level;
    }

    // Simple scale effect for the card on entry
    document.addEventListener('DOMContentLoaded', () => {
        // Set initial priority style
        const initialPriority = document.getElementById('priority-input').value || 'medium';
        setPriority(initialPriority);

        const card = document.querySelector('.form-card');
        card.style.opacity = '0';
        card.style.transform = 'translateY(10px)';
        card.style.transition = 'all 0.4s ease-out';

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    });
</script>