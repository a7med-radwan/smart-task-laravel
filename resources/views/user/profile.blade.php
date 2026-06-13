<x-layout title="User Profile">
    <div class="space-y-stack-lg">
            <!-- Profile Header Card -->
            <div
                class="glass-card rounded-xl p-8 flex flex-col md:flex-row items-center gap-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
                <div class="relative group">
                    <img alt="User Profile"
                        class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover transition-transform group-hover:scale-105"
                        data-alt="A professional headshot of a person with a warm and approachable expression, set against a soft, out-of-focus modern office background. The lighting is natural and flattering, emphasizing a professional yet calm aura. The overall aesthetic is clean and high-end, utilizing a light-mode color palette with subtle blue and grey undertones, perfectly suited for a productivity app interface."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBejaqFDvDKfpGiLnRX8V4dt3rhc1peiPzqO9lxPu__bN-6xevdvJNd020I5hcew4IEctjUKsZpidAfOYhZB21yeFDdVM_rpuz95FcKgJbYve5dwrLbVuhw0h8dzQgd13Uf7wYoC3YbqETvFe2C0buGIsfobYJt-dP5K35pB5eY5X2JEZDP55qIJqLdkmn8YLy8Eottt8YsAv6Jskxty7lbqIKjNNWTq7JeMa4XxCeIJS1aYGjnWzOJaJjFs6FZl8LkAGcV-bHcebN">
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
                            class="px-3 py-1 bg-secondary-container text-on-secondary-fixed-variant rounded-full text-label-md font-label-md">Pro
                            Member</span>
                        <span
                            class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label-md font-label-md">New
                            York, US</span>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button
                        class="px-6 py-2.5 bg-primary text-white rounded-lg font-label-md hover:opacity-90 active:scale-95 transition-all">
                        Edit Profile
                    </button>
                </div>
            </div>
            <!-- Bento Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-desktop">
                <div
                    class="md:col-span-2 glass-card rounded-xl p-6 flex flex-col justify-between hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-primary-container/10 rounded-lg text-primary">
                            <span class="material-symbols-outlined">task_alt</span>
                        </div>
                        <span
                            class="text-on-secondary-fixed-variant font-label-md bg-secondary-container px-2 py-1 rounded-md">+12%
                            this week</span>
                    </div>
                    <div>
                        <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total
                            Tasks Completed</p>
                        <h3 class="font-headline-lg text-headline-lg text-on-surface">450</h3>
                    </div>
                    <div class="mt-4 w-full bg-surface-container h-1.5 rounded-full overflow-hidden">
                        <div class="bg-secondary h-full transition-all duration-1000" style="width: 75%"></div>
                    </div>
                </div>
                <div class="glass-card rounded-xl p-6 flex flex-col justify-between hover:shadow-lg transition-shadow">
                    <div class="mb-6">
                        <div class="p-3 bg-tertiary-fixed-dim/20 rounded-lg text-tertiary w-fit">
                            <span class="material-symbols-outlined">timer</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Focus
                            Hours</p>
                        <h3 class="font-headline-lg text-headline-lg text-on-surface">120</h3>
                    </div>
                    <p class="text-label-sm font-label-sm text-on-surface-variant mt-2">Avg. 4.2h / day</p>
                </div>
                <div class="glass-card rounded-xl p-6 flex flex-col justify-between hover:shadow-lg transition-shadow">
                    <div class="mb-6">
                        <div class="p-3 bg-secondary-container/30 rounded-lg text-secondary w-fit">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                            Efficiency Score</p>
                        <h3 class="font-headline-lg text-headline-lg text-on-surface">94%</h3>
                    </div>
                    <p class="text-label-sm font-label-sm text-on-surface-variant mt-2">Top 5% of users</p>
                </div>
            </div>
            <!-- Settings & Preferences Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter-desktop">
                <!-- Main Settings -->
                <div class="lg:col-span-2 space-y-stack-lg">
                    <div class="glass-card rounded-xl overflow-hidden">
                        <div class="p-6 border-b border-outline-variant">
                            <h4 class="font-headline-md text-headline-md text-on-surface">Preferences</h4>
                        </div>
                        <div class="divide-y divide-outline-variant">
                            <!-- Notification Preference -->
                            <div
                                class="p-6 flex items-center justify-between hover:bg-surface-container-low transition-colors group cursor-pointer">
                                <div class="flex gap-4 items-center">
                                    <div
                                        class="p-2 bg-surface-container text-on-surface-variant rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">notifications_active</span>
                                    </div>
                                    <div>
                                        <p class="font-body-lg text-body-lg text-on-surface">Push Notifications</p>
                                        <p class="font-label-sm text-label-sm text-on-surface-variant">Manage how you
                                            receive alerts and updates</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input checked="" class="sr-only peer" type="checkbox">
                                    <div
                                        class="w-11 h-6 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                </label>
                            </div>
                            <!-- Theme Selection -->
                            <div
                                class="p-6 flex items-center justify-between hover:bg-surface-container-low transition-colors group cursor-pointer">
                                <div class="flex gap-4 items-center">
                                    <div
                                        class="p-2 bg-surface-container text-on-surface-variant rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">contrast</span>
                                    </div>
                                    <div>
                                        <p class="font-body-lg text-body-lg text-on-surface">App Theme</p>
                                        <p class="font-label-sm text-label-sm text-on-surface-variant">Switch between
                                            Light, Dark, or System mode</p>
                                    </div>
                                </div>
                                <div class="flex bg-surface-container p-1 rounded-lg">
                                    <button
                                        class="px-3 py-1 text-on-surface-variant text-label-sm font-label-md hover:text-on-surface">Light</button>
                                    <button
                                        class="px-3 py-1 bg-surface-container-high shadow-sm rounded-md text-label-sm font-label-md font-bold text-on-surface">Dark</button>
                                </div>
                            </div>
                            <!-- Focus Mode -->
                            <div
                                class="p-6 flex items-center justify-between hover:bg-surface-container-low transition-colors group cursor-pointer">
                                <div class="flex gap-4 items-center">
                                    <div
                                        class="p-2 bg-surface-container text-on-surface-variant rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">do_not_disturb_on</span>
                                    </div>
                                    <div>
                                        <p class="font-body-lg text-body-lg text-on-surface">Auto Focus Mode</p>
                                        <p class="font-label-sm text-label-sm text-on-surface-variant">Automatically
                                            enable DND during scheduled hours</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input class="sr-only peer" type="checkbox">
                                    <div
                                        class="w-11 h-6 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Secondary Info -->
                <div class="space-y-stack-lg">
                    <div class="glass-card rounded-xl p-6">
                        <h4 class="font-headline-md text-headline-md text-on-surface mb-6">Security</h4>
                        <div class="space-y-4">
                            <button
                                class="w-full flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:bg-surface-container transition-all">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary">key</span>
                                    <span class="font-label-md text-label-md">Change Password</span>
                                </div>
                                <span class="material-symbols-outlined text-sm">chevron_right</span>
                            </button>
                            <button
                                class="w-full flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:bg-surface-container transition-all">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary">verified_user</span>
                                    <span class="font-label-md text-label-md">Two-Factor Auth</span>
                                </div>
                                <span class="material-symbols-outlined text-sm">chevron_right</span>
                            </button>
                        </div>
                    </div>
                    <div class="bg-primary-container p-6 rounded-xl text-white relative overflow-hidden group">
                        <div class="relative z-10">
                            <h4 class="font-headline-md text-headline-md mb-2">Upgrade to Team</h4>
                            <p class="font-body-md text-body-md opacity-80 mb-4">Collaborate with your team and unlock
                                advanced workflows.</p>
                            <button
                                class="bg-white text-primary px-4 py-2 rounded-lg font-label-md hover:shadow-xl transition-shadow">Learn
                                More</button>
                        </div>
                        <!-- Abstract Background Decoration -->
                        <div
                            class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700">
                        </div>
                        <div class="absolute -left-4 top-0 w-16 h-16 bg-white/5 rounded-full blur-xl"></div>
                    </div>
                </div>
            </div>
            <!-- Footer Action -->
            <div
                class="flex justify-between items-center pt-stack-lg border-t border-outline-variant text-on-surface-variant">
                <p class="font-label-sm text-label-sm">Last login: 2 hours ago from Chrome (macOS)</p>
                <button
                    class="text-error font-label-md flex items-center gap-2 hover:bg-error-container/20 px-4 py-2 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    Sign Out
                </button>
            </div>
    </div>
    <script>
        // Simple micro-interaction for checkboxes and buttons
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const parent = this.closest('.group');
                if (this.checked) {
                    parent.style.borderColor = 'var(--primary)';
                } else {
                    parent.style.borderColor = 'transparent';
                }
            });
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
    </script>
</x-layout>