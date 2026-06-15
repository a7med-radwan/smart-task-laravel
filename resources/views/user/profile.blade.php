<x-layout title="User Profile">
    <div class="space-y-stack-lg">
        <!-- Profile Header Card -->
        <div class="glass-card rounded-xl p-8 flex flex-col md:flex-row items-center gap-8 animate-in fade-in duration-500">
            <div class="relative group">
                <img alt="User Profile"
                    class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover transition-transform group-hover:scale-105"
                    src="{{ auth()->user()->avatar_url }}">
                <button
                    class="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full shadow-lg hover:scale-110 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-sm">edit</span>
                </button>
            </div>
            <div class="text-center md:text-left flex-1">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-1">{{ auth()->user()->name }}</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-4">{{ auth()->user()->email }}</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-2">
                    <span
                        class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label-md font-label-md flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                        Member since {{ auth()->user()->created_at->format('M Y') }}
                    </span>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('profile.update') }}"
                    class="px-5 py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    Edit Profile
                </a>
            </div>
        </div>

        <!-- Bento Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-desktop">
            <div class="md:col-span-2 glass-card rounded-xl p-6 flex flex-col justify-between hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-3 bg-primary-container/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined">format_list_bulleted</span>
                    </div>
                    <span class="text-on-secondary-fixed-variant font-label-md bg-secondary-container px-2 py-1 rounded-md font-bold">
                        {{ $progressPercentage }}% Completed
                    </span>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Task Completion Rate</p>
                    <h3 class="font-headline-lg text-headline-lg text-on-surface font-bold">{{ $completedTasks }} / {{ $totalTasks }}</h3>
                </div>
                <div class="mt-4 w-full bg-surface-container h-1.5 rounded-full overflow-hidden">
                    <div class="bg-secondary h-full transition-all duration-1000" style="width: {{ $progressPercentage }}%"></div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6 flex flex-col justify-between hover:shadow-lg transition-shadow">
                <div class="mb-6">
                    <div class="p-3 bg-secondary-container/30 rounded-lg text-secondary w-fit">
                        <span class="material-symbols-outlined">task_alt</span>
                    </div>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Completed Tasks</p>
                    <h3 class="font-headline-lg text-headline-lg text-on-surface font-bold">{{ $completedTasks }}</h3>
                </div>
                <p class="text-label-sm font-label-sm text-on-surface-variant mt-2">Done and dusted</p>
            </div>

            <div class="glass-card rounded-xl p-6 flex flex-col justify-between hover:shadow-lg transition-shadow">
                <div class="mb-6">
                    <div class="p-3 bg-error-container/20 rounded-lg text-error w-fit">
                        <span class="material-symbols-outlined">pending_actions</span>
                    </div>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Pending Tasks</p>
                    <h3 class="font-headline-lg text-headline-lg text-on-surface font-bold">{{ $pendingTasks }}</h3>
                </div>
                <p class="text-label-sm font-label-sm text-on-surface-variant mt-2">Awaiting action</p>
            </div>
        </div>

        <!-- Preferences Section -->
        <div class="glass-card rounded-xl overflow-hidden">
            <div class="p-6 border-b border-outline-variant">
                <h4 class="font-headline-md text-headline-md text-on-surface">Preferences</h4>
            </div>
            <div class="divide-y divide-outline-variant">
                <!-- Theme Selection -->
                <div class="p-6 flex items-center justify-between group">
                    <div class="flex gap-4 items-center">
                        <div class="p-2 bg-surface-container text-on-surface-variant rounded-lg">
                            <span class="material-symbols-outlined">contrast</span>
                        </div>
                        <div>
                            <p class="font-body-lg text-body-lg text-on-surface">App Theme</p>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Switch between Light and Dark mode</p>
                        </div>
                    </div>
                    <div class="flex bg-surface-container p-1 rounded-lg">
                        <button id="theme-light-btn" class="px-3 py-1 text-on-surface-variant text-label-sm font-label-md hover:text-on-surface transition-all">Light</button>
                        <button id="theme-dark-btn" class="px-3 py-1 text-on-surface-variant text-label-sm font-label-md hover:text-on-surface transition-all">Dark</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Action -->
        <div class="flex justify-between items-center pt-stack-lg border-t border-outline-variant text-on-surface-variant">
            <p class="font-label-sm text-label-sm">Manage your account settings</p>
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="text-error font-label-md flex items-center gap-2 hover:bg-error-container/20 px-4 py-2 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                Sign Out
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lightBtn = document.getElementById('theme-light-btn');
            const darkBtn = document.getElementById('theme-dark-btn');

            // Set active class styling helpers
            const activeClasses = ['bg-surface-container-high', 'shadow-sm', 'font-bold', 'text-on-surface'];
            const inactiveClasses = ['text-on-surface-variant', 'hover:text-on-surface'];

            function updateThemeUI(theme) {
                if (theme === 'dark') {
                    // Dark active, Light inactive
                    darkBtn.classList.add(...activeClasses);
                    darkBtn.classList.remove(...inactiveClasses);

                    lightBtn.classList.remove(...activeClasses);
                    lightBtn.classList.add(...inactiveClasses);
                } else {
                    // Light active, Dark inactive
                    lightBtn.classList.add(...activeClasses);
                    lightBtn.classList.remove(...inactiveClasses);

                    darkBtn.classList.remove(...activeClasses);
                    darkBtn.classList.add(...inactiveClasses);
                }
            }

            // Get initial theme from html tag or localStorage
            const initialTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
            updateThemeUI(initialTheme);

            // Click Handlers
            lightBtn.addEventListener('click', () => {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                updateThemeUI('light');
            });

            darkBtn.addEventListener('click', () => {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                updateThemeUI('dark');
            });

            // Hover effect for bento cards
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-2px)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</x-layout>
