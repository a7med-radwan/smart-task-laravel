<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SmartTask – AI-Powered Agile Task & Sprint Manager</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0284c7",
                        secondary: "#6366f1",
                    }
                }
            }
        };

        // Theme sync
        (function () {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            if (currentTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glow-effect::before {
            content: '';
            position: absolute;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, rgba(2, 132, 199, 0) 70%);
            border-radius: 50%;
            filter: blur(40px);
            z-index: -1;
        }
    </style>
</head>

<body
    class="bg-slate-50 dark:bg-[#090d16] text-slate-800 dark:text-slate-100 min-h-screen transition-colors duration-300 relative overflow-x-hidden">

    <!-- Background glows -->
    <div
        class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-indigo-500/10 dark:bg-indigo-500/5 rounded-full blur-[120px] pointer-events-none">
    </div>
    <div
        class="absolute top-[20%] right-[-10%] w-[45vw] h-[45vw] bg-cyan-500/10 dark:bg-cyan-500/5 rounded-full blur-[120px] pointer-events-none">
    </div>

    <!-- Navigation Header -->
    <header
        class="sticky top-0 z-50 backdrop-blur-md bg-white/75 dark:bg-[#090d16]/75 border-b border-slate-200/50 dark:border-slate-800/50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2.5">
                <div
                    class="w-9 h-9 rounded-xl bg-gradient-to-tr from-primary to-secondary flex items-center justify-center shadow-lg shadow-primary/20">
                    <i data-lucide="sparkles" class="w-5 h-5 text-white"></i>
                </div>
                <span
                    class="text-xl font-bold tracking-tight bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">SmartTask</span>
            </a>

            <div class="flex items-center gap-4">
                <!-- Theme Toggle -->
                <button id="theme-toggle"
                    class="p-2.5 rounded-xl border border-slate-200/50 dark:border-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800/50 transition-colors"
                    aria-label="Toggle Theme">
                    <i data-lucide="sun" id="sun-icon" class="w-4 h-4 hidden text-yellow-500"></i>
                    <i data-lucide="moon" id="moon-icon" class="w-4 h-4 text-slate-400"></i>
                </button>

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm bg-gradient-to-r from-primary to-secondary hover:from-primary/95 hover:to-secondary/95 text-white shadow-lg shadow-primary/10 transition-all">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-colors">
                        Log In
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm bg-gradient-to-r from-primary to-secondary hover:from-primary/95 hover:to-secondary/95 text-white shadow-lg shadow-primary/10 transition-all">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-6 text-center relative">
        <div class="max-w-3xl mx-auto">
            <!-- Badge Announcement -->
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 dark:bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-primary mb-3 animate-pulse">
                <i data-lucide="cpu" class="w-3.5 h-3.5"></i>
                Powered by Laravel AI Agents
            </div>

            <h1
                class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.15]">
                Decompose Software Ideas into <span
                    class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Agile
                    Sprints</span> Instantly
            </h1>

            <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                SmartTask integrates first-party AI agents directly into your software planning lifecycle. Decompose raw
                product descriptions into estimated tasks, story points, and scheduled sprints in seconds.
            </p>

            <div class="mt-5 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-sm bg-gradient-to-r from-primary to-secondary hover:from-primary/95 hover:to-secondary/95 text-white shadow-xl shadow-primary/15 hover:shadow-primary/20 hover:-translate-y-0.5 transition-all">
                    Start Planning for Free
                </a>
                <a href="#simulator"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-sm border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800/40 text-slate-800 dark:text-slate-200 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="play" class="w-4 h-4 fill-current"></i>
                    Try the Simulator
                </a>
            </div>
        </div>

        <!-- Hero Mockup App View -->
        <div
            class="mt-6 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-2 bg-slate-100/50 dark:bg-[#0f172a]/30 backdrop-blur shadow-2xl relative max-w-4xl mx-auto">
            <div
                class="border border-slate-200/50 dark:border-slate-800/50 rounded-xl overflow-hidden bg-white dark:bg-[#0f172a] shadow-inner text-left">
                <!-- Mockup Header -->
                <div
                    class="px-4 py-2.5 bg-slate-50 dark:bg-[#161e2b]/50 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                        <span class="ml-4 text-xs font-semibold text-slate-400">SmartTask Dashboard View</span>
                    </div>
                    <div
                        class="flex items-center gap-2 bg-slate-100 dark:bg-slate-800/50 px-2.5 py-1 rounded-md text-[10px] text-slate-400">
                        <i data-lucide="lock" class="w-2.5 h-2.5"></i>
                        smarttask.local/dashboard
                    </div>
                </div>

                <!-- Mockup Content -->
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Left: Sprint Panel -->
                    <div class="md:col-span-1 border-r border-slate-200/50 dark:border-slate-800/50 pr-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">AI Sprint
                                Backlog</span>
                            <span
                                class="px-2 py-0.5 rounded text-[9px] font-semibold bg-emerald-500/10 text-emerald-500">AI
                                Active</span>
                        </div>
                        <div
                            class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/30 border border-slate-200/50 dark:border-slate-800/50 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-950 dark:text-white">Sprint 1: Auth &
                                    Setup</span>
                                <span class="text-[10px] font-semibold text-slate-400">2 Weeks</span>
                            </div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400">Implement user authentication flow
                                & base DB schema structure.</p>
                            <div class="flex items-center justify-between text-[10px] text-slate-400 mt-1">
                                <span>3 tasks</span>
                                <span class="font-bold text-indigo-500">8 SP</span>
                            </div>
                        </div>
                        <div
                            class="p-2.5 rounded-xl bg-slate-50/50 dark:bg-slate-800/10 border border-dashed border-slate-200 dark:border-slate-800/60 opacity-60 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-950 dark:text-white">Sprint 2: AI Core
                                    Integration</span>
                                <span class="text-[10px] font-semibold text-slate-400">2 Weeks</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-slate-400 mt-1">
                                <span>4 tasks</span>
                                <span class="font-bold text-indigo-500">13 SP</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Task List -->
                    <div class="md:col-span-2 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Sprint Tasks</span>
                            <div class="flex gap-2">
                                <span
                                    class="px-2 py-0.5 rounded-full text-[9px] font-semibold bg-red-500/10 text-red-500">High
                                    Priority</span>
                                <span
                                    class="px-2 py-0.5 rounded-full text-[9px] font-semibold bg-primary/10 text-primary">Pending</span>
                            </div>
                        </div>

                        <!-- Task Rows -->
                        <div class="space-y-2">
                            <div
                                class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/20 border border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-5 h-5 rounded border border-slate-300 dark:border-slate-700 flex items-center justify-center shrink-0">
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-950 dark:text-white">Configure Fortify
                                            registration and login routes</h4>
                                        <p class="text-[10px] text-slate-400 mt-0.5">Due in 3 days • Sprint 1</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="px-2 py-0.5 rounded text-[9px] font-bold bg-amber-500/10 text-amber-500">5
                                        SP</span>
                                </div>
                            </div>

                            <div
                                class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/20 border border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-5 h-5 rounded border border-slate-300 dark:border-slate-700 flex items-center justify-center shrink-0">
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-950 dark:text-white">Create Sprints &
                                            Tasks database migrations</h4>
                                        <p class="text-[10px] text-slate-400 mt-0.5">Due in 5 days • Sprint 1</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-500/10 text-emerald-500">3
                                        SP</span>
                                </div>
                            </div>

                            <div
                                class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/20 border border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between opacity-50">
                                <div class="flex items-center gap-3">
                                    <div class="w-5 h-5 rounded bg-primary flex items-center justify-center shrink-0">
                                        <i data-lucide="check" class="w-3.5 h-3.5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-950 dark:text-white line-through">
                                            Install laravel/ai package & configure api key</h4>
                                        <p class="text-[10px] text-slate-400 mt-0.5">Completed</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="px-2 py-0.5 rounded text-[9px] font-bold bg-slate-500/10 text-slate-500">1
                                        SP</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features Section -->
    <section
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 bg-slate-100/50 dark:bg-slate-900/30 border-y border-slate-200/50 dark:border-slate-800/50 transition-colors duration-300">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-extrabold text-slate-950 dark:text-white">Everything you need to automate Agile
                planning</h2>
            <p class="mt-4 text-slate-500 dark:text-slate-400">Stop wasting time manually writing subtasks, guessing
                story points, and planning calendar deadlines.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-16">
            <!-- Feature 1 -->
            <div
                class="p-6 rounded-2xl bg-white dark:bg-[#0f172a] border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md hover:border-slate-300 dark:hover:border-slate-700 transition-all group">
                <div
                    class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                </div>
                <h3 class="mt-4 text-base font-bold text-slate-950 dark:text-white">AI Task Breakdown</h3>
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Decompose complex product
                    ideas into granular, estimated checklists automatically via first-party AI Agents.</p>
            </div>

            <!-- Feature 2 -->
            <div
                class="p-6 rounded-2xl bg-white dark:bg-[#0f172a] border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md hover:border-slate-300 dark:hover:border-slate-700 transition-all group">
                <div
                    class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="milestone" class="w-5 h-5"></i>
                </div>
                <h3 class="mt-4 text-base font-bold text-slate-950 dark:text-white">Agile Backlog Planner</h3>
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Instantly design multi-sprint
                    backlogs matching target goals, timeline phases, and task workloads.</p>
            </div>

            <!-- Feature 3 -->
            <div
                class="p-6 rounded-2xl bg-white dark:bg-[#0f172a] border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md hover:border-slate-300 dark:hover:border-slate-700 transition-all group">
                <div
                    class="w-10 h-10 rounded-xl bg-violet-500/10 text-violet-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="download-cloud" class="w-5 h-5"></i>
                </div>
                <h3 class="mt-4 text-base font-bold text-slate-950 dark:text-white">Smart Bulk Import</h3>
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Bulk-import AI sprints or
                    lists directly into your database. Deadlines are automatically structured in advance.</p>
            </div>

            <!-- Feature 4 -->
            <div
                class="p-6 rounded-2xl bg-white dark:bg-[#0f172a] border border-slate-200/50 dark:border-slate-800/50 shadow-sm hover:shadow-md hover:border-slate-300 dark:hover:border-slate-700 transition-all group">
                <div
                    class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                </div>
                <h3 class="mt-4 text-base font-bold text-slate-950 dark:text-white">Analytics Dashboard</h3>
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Visualize sprint completions,
                    story point counts, and task priorities cleanly in light or dark mode.</p>
            </div>
        </div>
    </section>

    <!-- Interactive AI Simulator -->
    <section id="simulator" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-3xl font-extrabold text-slate-950 dark:text-white">Test-Drive the AI Agent Planner</h2>
            <p class="mt-4 text-slate-500 dark:text-slate-400">See how SmartTask decomposes product goals. Select a
                template below to simulate the AI planning flow.</p>
        </div>

        <!-- Simulator Widget -->
        <div
            class="bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl overflow-hidden text-left transition-colors duration-300">
            <!-- Prompt Selector Header -->
            <div
                class="p-4 bg-slate-50 dark:bg-slate-800/40 border-b border-slate-200 dark:border-slate-800 flex flex-wrap gap-2 items-center">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-2">Choose Template:</span>
                <button onclick="runSimulation('fitness')"
                    class="sim-btn px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-primary text-white transition-colors">🏋️
                    Fitness Tracker</button>
                <button onclick="runSimulation('ecommerce')"
                    class="sim-btn px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">🛒
                    E-Commerce Platform</button>
                <button onclick="runSimulation('chat')"
                    class="sim-btn px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">💬
                    Real-time Chat App</button>
            </div>

            <!-- Console simulator body -->
            <div class="p-6 space-y-6">
                <!-- User Prompt Box -->
                <div class="flex items-start gap-3">
                    <div
                        class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 flex items-center justify-center shrink-0">
                        <i data-lucide="user" class="w-4 h-4 text-slate-600 dark:text-slate-400"></i>
                    </div>
                    <div
                        class="flex-1 bg-slate-50 dark:bg-slate-800/30 border border-slate-200/50 dark:border-slate-800/50 p-4 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-400">YOUR PRODUCT IDEA</span>
                        <p id="user-prompt" class="text-sm font-medium mt-1 text-slate-800 dark:text-slate-200">I want
                            to build a fitness tracking app with workouts and a dashboard.</p>
                    </div>
                </div>

                <!-- AI Response / Progress box -->
                <div class="flex items-start gap-3">
                    <div
                        class="w-8 h-8 rounded-full bg-gradient-to-tr from-primary to-secondary flex items-center justify-center shrink-0">
                        <i data-lucide="sparkles" class="w-4 h-4 text-white"></i>
                    </div>
                    <div class="flex-1 space-y-4">
                        <!-- Loading spinner -->
                        <div id="ai-loading" class="hidden flex items-center gap-3 py-2">
                            <svg class="animate-spin h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">AI Agile Agent is
                                analyzing and structuring backlog...</span>
                        </div>

                        <!-- Outputs -->
                        <div id="ai-output" class="space-y-4">
                            <!-- Sprint header -->
                            <div
                                class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-200 dark:border-slate-800 pb-3">
                                <div>
                                    <h4 id="sprint-name" class="text-base font-bold text-slate-900 dark:text-white">
                                        Sprint 1: Core Fitness Features</h4>
                                    <p id="sprint-goal" class="text-xs text-slate-400 mt-0.5">Sprint Goal: Set up user
                                        workout database models and authentication.</p>
                                </div>
                                <span
                                    class="px-2.5 py-1 rounded-md text-[10px] font-semibold bg-indigo-500/10 text-indigo-500">AI-Generated
                                    Backlog</span>
                            </div>

                            <!-- List of simulated tasks -->
                            <div id="tasks-list" class="space-y-3">
                                <!-- Tasks generated dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Call to Action Section -->
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center relative">
        <div
            class="p-8 sm:p-12 rounded-3xl bg-gradient-to-tr from-slate-900 via-[#0f172a] to-slate-900 dark:from-[#0b1329] dark:via-[#090d16] dark:to-[#0f172a] border border-slate-800/80 shadow-2xl relative overflow-hidden">
            <!-- Decorative circle -->
            <div
                class="absolute -right-16 -top-16 w-48 h-48 bg-primary/20 rounded-full blur-[80px] pointer-events-none">
            </div>

            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                Supercharge your Agile planning today.
            </h2>
            <p class="mt-4 text-slate-400 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
                Connect your AI providers, input your software goals, and watch your planning cycle transform from hours
                to seconds.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-base bg-gradient-to-r from-primary to-secondary hover:from-primary/95 hover:to-secondary/95 text-white shadow-xl shadow-primary/15 transition-all">
                    Register Now
                </a>
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-base bg-slate-800 hover:bg-slate-700/80 border border-slate-700 text-white transition-all">
                    Log In to Dashboard
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer
        class="border-t border-slate-200/50 dark:border-slate-800/50 py-8 bg-slate-50 dark:bg-[#090d16] transition-colors duration-300 text-xs text-slate-400 text-center">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div
                    class="w-6 h-6 rounded bg-gradient-to-tr from-primary to-secondary flex items-center justify-center">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-white"></i>
                </div>
                <span class="font-bold text-slate-900 dark:text-white">SmartTask</span>
                <span>© 2026. All rights reserved.</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="https://github.com/a7med-radwan/smart-task-laravel" target="_blank"
                    class="hover:text-slate-600 dark:hover:text-white transition-colors">GitHub Repository</a>
                <span>•</span>
                <a href="{{ route('login') }}"
                    class="hover:text-slate-600 dark:hover:text-white transition-colors">Login</a>
                <span>•</span>
                <a href="{{ route('register') }}"
                    class="hover:text-slate-600 dark:hover:text-white transition-colors">Register</a>
            </div>
        </div>
    </footer>

    <!-- Interactive script for simulation and theme toggle -->
    <script>
        // Lucide init
        lucide.createIcons();

        // Theme Toggle script
        const themeToggleBtn = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');

        function updateThemeIcons() {
            if (document.documentElement.classList.contains('dark')) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }

        updateThemeIcons();

        themeToggleBtn.addEventListener('click', () => {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
            updateThemeIcons();
        });

        // Simulation script
        const prompts = {
            fitness: {
                text: "I want to build a fitness tracking app with workouts and a dashboard.",
                sprint: "Sprint 1: Workout Tracking Core",
                goal: "Sprint Goal: Implement user workout registration, activity logs, and exercise models.",
                tasks: [
                    { title: "Define Exercise and Workout database models", points: 5, priority: "High" },
                    { title: "Create user custom workout routine controller action", points: 8, priority: "High" },
                    { title: "Implement workout completion logs API with calendar association", points: 3, priority: "Medium" },
                    { title: "Design dashboard widget for weekly activity progression chart", points: 5, priority: "Medium" }
                ]
            },
            ecommerce: {
                text: "I want to build an e-commerce platform with product catalog, shopping cart, and Stripe.",
                sprint: "Sprint 1: Catalog & Shopping Cart Setup",
                goal: "Sprint Goal: Set up database products table, product grid view, and session-based cart.",
                tasks: [
                    { title: "Create product catalog migration with categories & tags", points: 3, priority: "High" },
                    { title: "Develop catalog grid interface view with filters and search", points: 8, priority: "High" },
                    { title: "Write shopping cart add/remove controller actions utilizing session", points: 5, priority: "High" },
                    { title: "Integrate base Stripe checkout gateway redirect service", points: 8, priority: "Medium" }
                ]
            },
            chat: {
                text: "I want to build a real-time chat application with room history and attachments.",
                sprint: "Sprint 1: Socket Setup & Core Chatting",
                goal: "Sprint Goal: Configure WebSocket server broadcasting and chat message persistence.",
                tasks: [
                    { title: "Configure Laravel Reverb websocket broadcaster support", points: 5, priority: "High" },
                    { title: "Create room chat channel and configure route authentication", points: 8, priority: "High" },
                    { title: "Develop message sending form with blade/js client listener", points: 5, priority: "High" },
                    { title: "Configure file upload action for chat message attachments", points: 3, priority: "Medium" }
                ]
            }
        };

        function runSimulation(key) {
            // Update active buttons styling
            const buttons = document.querySelectorAll('.sim-btn');
            buttons.forEach(btn => {
                btn.className = "sim-btn px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors";
            });
            event.target.className = "sim-btn px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-primary text-white transition-colors";

            const data = prompts[key];

            // Set loading state
            document.getElementById('user-prompt').textContent = data.text;
            document.getElementById('ai-output').style.opacity = '0.3';
            document.getElementById('ai-loading').classList.remove('hidden');

            setTimeout(() => {
                document.getElementById('ai-loading').classList.add('hidden');
                document.getElementById('ai-output').style.opacity = '1';

                // Bind data
                document.getElementById('sprint-name').textContent = data.sprint;
                document.getElementById('sprint-goal').textContent = data.goal;

                const listContainer = document.getElementById('tasks-list');
                listContainer.innerHTML = '';

                data.tasks.forEach(task => {
                    const priorityClass = task.priority === 'High' ? 'bg-red-500/10 text-red-500' : 'bg-amber-500/10 text-amber-500';
                    const html = `
                        <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/20 border border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between animate-fade-in">
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded border border-slate-300 dark:border-slate-700 flex items-center justify-center shrink-0"></div>
                                <span class="text-xs font-bold text-slate-950 dark:text-white">${task.title}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-semibold ${priorityClass}">${task.priority}</span>
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-indigo-500/10 text-indigo-500">${task.points} SP</span>
                            </div>
                        </div>
                    `;
                    listContainer.insertAdjacentHTML('beforeend', html);
                });
            }, 1000);
        }

        // Run default simulation
        runSimulation('fitness');
    </script>
</body>

</html>