<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script>
        (function () {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            if (currentTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap"
        rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-fixed": "var(--on-tertiary-fixed)",
                        "surface-bright": "var(--surface-bright)",
                        "on-secondary": "var(--on-secondary)",
                        "surface-dim": "var(--surface-dim)",
                        "surface-container": "var(--surface-container)",
                        "on-primary": "var(--on-primary)",
                        "secondary-fixed": "var(--secondary-fixed)",
                        "surface-container-lowest": "var(--surface-container-lowest)",
                        "tertiary-fixed-dim": "var(--tertiary-fixed-dim)",
                        "tertiary": "var(--tertiary)",
                        "inverse-primary": "var(--inverse-primary)",
                        "on-primary-container": "var(--on-primary-container)",
                        "surface-container-low": "var(--surface-container-low)",
                        "secondary": "var(--secondary)",
                        "primary-fixed-dim": "var(--primary-fixed-dim)",
                        "on-tertiary": "var(--on-tertiary)",
                        "on-surface-variant": "var(--on-surface-variant)",
                        "error": "var(--error)",
                        "primary-fixed": "var(--primary-fixed)",
                        "inverse-on-surface": "var(--inverse-on-surface)",
                        "on-primary-fixed": "var(--on-primary-fixed)",
                        "on-secondary-fixed": "var(--on-secondary-fixed)",
                        "on-secondary-container": "var(--on-secondary-container)",
                        "outline-variant": "var(--outline-variant)",
                        "surface-tint": "var(--surface-tint)",
                        "secondary-fixed-dim": "var(--secondary-fixed-dim)",
                        "primary": "var(--primary)",
                        "tertiary-fixed": "var(--tertiary-fixed)",
                        "background": "var(--background)",
                        "surface-variant": "var(--surface-variant)",
                        "on-error": "var(--on-error)",
                        "on-tertiary-container": "var(--on-tertiary-container)",
                        "error-container": "var(--error-container)",
                        "on-surface": "var(--on-surface)",
                        "surface-container-highest": "var(--surface-container-highest)",
                        "on-error-container": "var(--on-error-container)",
                        "surface-container-high": "var(--surface-container-high)",
                        "on-secondary-fixed-variant": "var(--on-secondary-fixed-variant)",
                        "tertiary-container": "var(--tertiary-container)",
                        "primary-container": "var(--primary-container)",
                        "surface": "var(--surface)",
                        "inverse-surface": "var(--inverse-surface)",
                        "on-primary-fixed-variant": "var(--on-primary-fixed-variant)",
                        "on-tertiary-fixed-variant": "var(--on-tertiary-fixed-variant)",
                        "outline": "var(--outline)",
                        "on-background": "var(--on-background)",
                        "secondary-container": "var(--secondary-container)"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "base": "8px",
                        "stack-md": "12px",
                        "container-max": "1200px",
                        "stack-lg": "24px",
                        "gutter-desktop": "24px",
                        "gutter-mobile": "16px",
                        "stack-sm": "4px"
                    },
                    "fontFamily": {
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "label-md": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.02em",
                            "fontWeight": "500"
                        }],
                        "label-sm": ["11px", {
                            "lineHeight": "14px",
                            "letterSpacing": "0.03em",
                            "fontWeight": "500"
                        }],
                        "body-md": ["14px", {
                            "lineHeight": "20px",
                            "letterSpacing": "0",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "600"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "letterSpacing": "0",
                            "fontWeight": "400"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        :root {
            --on-tertiary-fixed: #1e1b4b;
            --surface-bright: #f8fafc;
            --on-secondary: #ffffff;
            --surface-dim: #e2e8f0;
            --surface-container: #f1f5f9;
            --on-primary: #ffffff;
            --secondary-fixed: #0ea5e9;
            --surface-container-lowest: #ffffff;
            --tertiary-fixed-dim: #fdba74;
            --tertiary: #d97706;
            --inverse-primary: #38bdf8;
            --on-primary-container: #0369a1;
            --surface-container-low: #f8fafc;
            --secondary: #6366f1;
            --primary-fixed-dim: #bae6fd;
            --on-tertiary: #ffffff;
            --on-surface-variant: #475569;
            --error: #ef4444;
            --primary-fixed: #e0f2fe;
            --inverse-on-surface: #ffffff;
            --on-primary-fixed: #0369a1;
            --on-secondary-fixed: #0c4a6e;
            --on-secondary-container: #0369a1;
            --outline-variant: #e2e8f0;
            --surface-tint: #0284c7;
            --secondary-fixed-dim: #38bdf8;
            --primary: #0284c7;
            --tertiary-fixed: #ffedd5;
            --background: #f8fafc;
            --surface-variant: #f1f5f9;
            --on-error: #ffffff;
            --on-tertiary-container: #92400e;
            --error-container: #fee2e2;
            --on-surface: #0f172a;
            --surface-container-highest: #cbd5e1;
            --on-error-container: #991b1b;
            --surface-container-high: #e2e8f0;
            --on-secondary-fixed-variant: #0369a1;
            --tertiary-container: #fef3c7;
            --primary-container: #e0f2fe;
            --surface: #ffffff;
            --inverse-surface: #090d16;
            --on-primary-fixed-variant: #0284c7;
            --on-tertiary-fixed-variant: #78350f;
            --outline: #94a3b8;
            --on-background: #0f172a;
            --secondary-container: #e0f2fe;
        }

        html.dark {
            --on-tertiary-fixed: #ffedd5;
            --surface-bright: #161e2b;
            --on-secondary: #0f1219;
            --surface-dim: #0f1219;
            --surface-container: #1f293b;
            --on-primary: #0f1219;
            --secondary-fixed: #38bdf8;
            --surface-container-lowest: #0b0d12;
            --tertiary-fixed-dim: #fdba74;
            --tertiary: #fbbf24;
            --inverse-primary: #0284c7;
            --on-primary-container: #dbeafe;
            --surface-container-low: #121824;
            --secondary: #818cf8;
            --primary-fixed-dim: #1e3a8a;
            --on-tertiary: #0f1219;
            --on-surface-variant: #94a3b8;
            --error: #f87171;
            --primary-fixed: #e0f2fe;
            --inverse-on-surface: #0f1219;
            --on-primary-fixed: #dbeafe;
            --on-secondary-fixed: #0c4a6e;
            --on-secondary-container: #e0f2fe;
            --outline-variant: #222e40;
            --surface-tint: #38bdf8;
            --secondary-fixed-dim: #38bdf8;
            --primary: #38bdf8;
            --tertiary-fixed: #ffedd5;
            --background: #0f1219;
            --surface-variant: #1f293b;
            --on-error: #ffffff;
            --on-tertiary-container: #fef3c7;
            --error-container: #7f1d1d;
            --on-surface: #e2e8f0;
            --surface-container-highest: #2e3f5b;
            --on-error-container: #fee2e2;
            --surface-container-high: #243249;
            --on-secondary-fixed-variant: #38bdf8;
            --tertiary-container: #78350f;
            --primary-container: #172554;
            --surface: #161e2b;
            --inverse-surface: #e2e8f0;
            --on-primary-fixed-variant: #38bdf8;
            --on-tertiary-fixed-variant: #fdba74;
            --outline: #2d3d54;
            --on-background: #e2e8f0;
            --secondary-container: #0c4a6e;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--background);
            color: var(--on-surface);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .glass-card {
            background-color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(226, 232, 240, 0.8);
            backdrop-filter: blur(12px);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.3s ease, border-color 0.3s ease;
        }

        .dark .glass-card {
            background-color: rgba(17, 22, 37, 0.7);
            border: 1px solid rgba(30, 41, 59, 0.8);
        }

        .hover-glow {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(14, 165, 144, 0.15), 0 8px 10px -6px rgba(14, 165, 144, 0.15);
        }

        .dark .hover-glow:hover {
            box-shadow: 0 10px 25px -5px rgba(45, 212, 191, 0.25), 0 8px 10px -6px rgba(45, 212, 191, 0.25);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }

        .task-checkbox:checked+label {
            text-decoration: line-through;
            color: var(--on-surface-variant);
        }

        .task-checkbox:checked {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: var(--outline-variant);
            border-radius: 10px;
        }
    </style>
    {{ $headScripts ?? '' }}
</head>

<body class="text-on-surface">
    <!-- Sidebar Backdrop for Mobile -->
    <div id="sidebar-overlay"
        class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden transition-opacity duration-300 opacity-0"></div>

    <!-- Side Navigation Shell -->
    <aside id="sidebar"
        class="h-screen w-64 fixed left-0 top-0 bg-white dark:bg-[#0f1219] border-r border-outline-variant dark:border-outline/40 flex flex-col py-6 px-4 z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300">

        <!-- Workspace Switcher Branding -->
        <div class="mb-6 px-2">
            <div
                class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-50 dark:bg-[#161e2b] border border-slate-200/60 dark:border-[#2d3d54]/60 shadow-sm">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-tr from-primary to-[#6366f1] text-white flex items-center justify-center font-black text-sm shadow-sm shrink-0">
                    S
                </div>
                <div class="flex-grow min-w-0">
                    <p class="text-xs font-bold text-on-surface truncate leading-tight">SmartTask</p>
                    <p class="text-[10px] font-semibold text-on-surface-variant/70 truncate leading-none mt-0.5">
                        Workspace</p>
                </div>
                <i data-lucide="chevrons-up-down" class="w-4 h-4 text-on-surface-variant/60 shrink-0"></i>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-grow space-y-1 overflow-y-auto custom-scrollbar pr-1">
            <span
                class="px-3 text-[10px] font-bold text-on-surface-variant/40 uppercase tracking-widest block mb-2 mt-4">Main
                Menu</span>

            <a class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-slate-50 dark:hover:bg-[#161e2b]/65' }} group"
                href="{{ route('dashboard') }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 shrink-0"></i>
                <span>Dashboard</span>
            </a>

            <a class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('tasks.*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-slate-50 dark:hover:bg-[#161e2b]/65' }} group"
                href="{{ route('tasks.index') }}">
                <i data-lucide="check-square" class="w-5 h-5 mr-3 shrink-0"></i>
                <span>Task List</span>
            </a>

            <a class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('profile.index') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-slate-50 dark:hover:bg-[#161e2b]/65' }} group"
                href="{{ route('profile.index') }}">
                <i data-lucide="user" class="w-5 h-5 mr-3 shrink-0"></i>
                <span>Profile</span>
            </a>

            {{-- AI Section --}}
            <div class="pt-5 pb-1">
                <span
                    class="px-3 text-[10px] font-bold text-on-surface-variant/40 uppercase tracking-widest block mb-2">AI
                    Assistants</span>
            </div>

            <a class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('ai.breakdown*') ? 'bg-primary/10 text-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-slate-50 dark:hover:bg-[#161e2b]/65' }} group"
                href="{{ route('ai.breakdown.show') }}">
                <i data-lucide="sparkles" class="w-5 h-5 mr-3 shrink-0"></i>
                <span>Task Breakdown</span>
                <span
                    class="ml-auto px-1.5 py-0.5 bg-primary/15 text-primary rounded text-[9px] font-bold uppercase tracking-wider">AI</span>
            </a>

            <a class="flex items-center px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('ai.backlog*') ? 'bg-secondary/15 text-secondary' : 'text-on-surface-variant hover:text-on-surface hover:bg-slate-50 dark:hover:bg-[#161e2b]/65' }} group"
                href="{{ route('ai.backlog.show') }}">
                <i data-lucide="kanban" class="w-5 h-5 mr-3 shrink-0"></i>
                <span>Agile Backlog</span>
                <span
                    class="ml-auto px-1.5 py-0.5 bg-secondary/15 text-secondary rounded text-[9px] font-bold uppercase tracking-wider">AI</span>
            </a>
        </nav>

        <!-- Bottom User Card & Quick Action -->
        <div class="pt-4 border-t border-slate-200/60 dark:border-outline-variant/60 space-y-3 mt-auto">
            <a href="{{ route('tasks.create') }}"
                class="w-full bg-gradient-to-r from-primary to-[#6366f1] text-white py-2.5 px-4 rounded-xl font-bold text-sm flex items-center justify-center gap-2 shadow-md shadow-primary/10 hover:shadow-primary/20 active:scale-[0.98] transition-all cursor-pointer">
                <i data-lucide="plus-circle" class="w-5 h-5 shrink-0"></i>
                Create Task
            </a>

            <!-- User Info Profile Card -->
            <div
                class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 dark:hover:bg-[#161e2b]/65 transition-colors">
                <img class="w-8 h-8 rounded-full border border-slate-200 dark:border-outline-variant object-cover shadow-sm"
                    src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-on-surface truncate leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-[9.5px] font-semibold text-on-surface-variant/70 truncate leading-none mt-0.5">
                        {{ auth()->user()->email }}</p>
                </div>
                <!-- Logout Trigger -->
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container/10 transition-colors"
                    title="Logout">
                    <i data-lucide="log-out" class="w-4 h-4 shrink-0"></i>
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="lg:ml-64 min-h-screen bg-surface transition-all duration-300">
        <!-- Top Nav Bar -->
        <header
            class="w-full h-16 flex justify-between items-center px-gutter-desktop max-w-container-max mx-auto border-b border-outline-variant dark:border-outline bg-surface sticky top-0 z-40">
            <div class="flex items-center gap-4 flex-1">
                <!-- Hamburger menu for mobile -->
                <button id="sidebar-toggle"
                    class="lg:hidden p-2 rounded-lg text-on-surface-variant hover:bg-surface-container transition-colors">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <form action="{{ route('tasks.index') }}" method="GET" class="relative w-full max-w-md m-0 p-0">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-on-surface-variant"></i>
                    <input
                        name="search"
                        value="{{ request('search') }}"
                        class="w-full bg-surface-container-low border border-outline-variant rounded-full py-2 pl-10 pr-4 text-body-md focus:outline-none focus:border-primary transition-all"
                        placeholder="Search tasks, descriptions..." type="text">
                </form>
            </div>
            <div class="flex items-center gap-stack-lg ml-gutter-desktop">
                <!-- Theme Toggle Button -->
                <button id="theme-toggle-btn"
                    class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer focus:outline-none">
                    <i id="theme-toggle-icon" data-lucide="moon" class="w-5 h-5"></i>
                </button>

                <button
                    class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer focus:outline-none">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                </button>

                <!-- Profile Dropdown Container -->
                <div class="relative">
                    <button id="profile-menu-btn"
                        class="flex items-center gap-2 cursor-pointer group focus:outline-none">
                        <img alt="User"
                            class="w-8 h-8 rounded-full border border-outline-variant object-cover shadow-sm transition-transform duration-200 hover:scale-105"
                            src="{{ auth()->user()->avatar_url }}">
                        <i data-lucide="chevron-down" class="w-4 h-4 text-on-surface-variant group-hover:text-primary transition-colors shrink-0"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="profile-dropdown"
                        class="absolute right-0 mt-2 w-48 bg-surface-container-high border border-outline-variant rounded-xl shadow-lg py-2 hidden z-50 transform origin-top-right transition-all scale-95 opacity-0 duration-150">
                        <div class="px-4 py-2 border-b border-outline-variant">
                            <p class="text-body-md font-bold text-on-surface">{{ auth()->user()->name }}</p>
                            <p class="text-label-sm text-on-surface-variant truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.index') }}"
                            class="flex items-center px-4 py-2 text-body-md text-on-surface hover:bg-surface-container transition-colors">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                            My Profile
                        </a>
                        <div class="border-t border-outline-variant my-1"></div>
                        <a href="{{ route('logout') }}"
                            class="flex items-center px-4 py-2 text-body-md text-error hover:bg-error-container/10 transition-colors"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i data-lucide="log-out" class="w-4 h-4 mr-2 text-error"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <div class="px-gutter-desktop py-stack-lg max-w-container-max mx-auto">
            {{-- Flash success message --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="mb-6 flex items-center justify-between gap-3 p-4 bg-secondary-container text-on-secondary-container rounded-xl border border-secondary/20 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined shrink-0"
                            style="font-variation-settings:'FILL' 1">task_alt</span>
                        <p class="font-body-md text-body-md font-bold">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none'"
                        class="shrink-0 text-on-secondary-container/70 hover:text-on-secondary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            @endif
            {{ $slot }}
        </div>
    </main>

    <!-- Sidebar & Dropdown Script -->
    <script>
        // Search highlight effect
        const searchInput = document.querySelector('input[type="text"]');
        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                searchInput.parentElement.classList.add('ring-2', 'ring-primary/20');
            });
            searchInput.addEventListener('blur', () => {
                searchInput.parentElement.classList.remove('ring-2', 'ring-primary/20');
            });
        }

        // Sidebar responsive functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                setTimeout(() => sidebarOverlay.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('opacity-0');
                setTimeout(() => sidebarOverlay.classList.add('hidden'), 300);
            }
        }

        if (sidebarToggle) sidebarToggle.addEventListener('click', toggleSidebar);
        if (sidebarClose) sidebarClose.addEventListener('click', toggleSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);

        // Profile Dropdown functionality
        const profileMenuBtn = document.getElementById('profile-menu-btn');
        const profileDropdown = document.getElementById('profile-dropdown');

        if (profileMenuBtn && profileDropdown) {
            profileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isHidden = profileDropdown.classList.contains('hidden');
                if (isHidden) {
                    profileDropdown.classList.remove('hidden');
                    setTimeout(() => {
                        profileDropdown.classList.remove('scale-95', 'opacity-0');
                        profileDropdown.classList.add('scale-100', 'opacity-100');
                    }, 10);
                } else {
                    profileDropdown.classList.remove('scale-100', 'opacity-100');
                    profileDropdown.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        profileDropdown.classList.add('hidden');
                    }, 150);
                }
            });

            document.addEventListener('click', (e) => {
                if (!profileDropdown.classList.contains('hidden') && !profileMenuBtn.contains(e.target)) {
                    profileDropdown.classList.remove('scale-100', 'opacity-100');
                    profileDropdown.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        profileDropdown.classList.add('hidden');
                    }, 150);
                }
            });
        }

        // Initialize Lucide Icons
        lucide.createIcons();

        // Theme Toggle Functionality
        const themeToggleBtn = document.getElementById('theme-toggle-btn');
        const themeToggleIcon = document.getElementById('theme-toggle-icon');
        if (themeToggleBtn && themeToggleIcon) {
            const isDark = document.documentElement.classList.contains('dark');
            themeToggleIcon.setAttribute('data-lucide', isDark ? 'sun' : 'moon');
            lucide.createIcons();
            
            themeToggleBtn.addEventListener('click', () => {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                    themeToggleIcon.setAttribute('data-lucide', 'moon');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                    themeToggleIcon.setAttribute('data-lucide', 'sun');
                }
                lucide.createIcons();
            });
        }
    </script>
</body>

</html>