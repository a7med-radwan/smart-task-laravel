<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script>
        (function() {
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
            --on-tertiary-fixed: #2a1700;
            --surface-bright: #fcfdff;
            --on-secondary: #ffffff;
            --surface-dim: #e2e4e9;
            --surface-container: #f1f3f9;
            --on-primary: #ffffff;
            --secondary-fixed: #34d399;
            --surface-container-lowest: #ffffff;
            --tertiary-fixed-dim: #ffb95f;
            --tertiary: #d97706;
            --inverse-primary: #6d28d9;
            --on-primary-container: #5b21b6;
            --surface-container-low: #f8fafc;
            --secondary: #059669;
            --primary-fixed-dim: #c3c0ff;
            --on-tertiary: #ffffff;
            --on-surface-variant: #4b5563;
            --error: #e11d48;
            --primary-fixed: #e2dfff;
            --inverse-on-surface: #ffffff;
            --on-primary-fixed: #0f0069;
            --on-secondary-fixed: #002113;
            --on-secondary-container: #065f46;
            --outline-variant: #e5e7eb;
            --surface-tint: #6d28d9;
            --secondary-fixed-dim: #34d399;
            --primary: #6d28d9;
            --tertiary-fixed: #ffddb8;
            --background: #f4f6fa;
            --surface-variant: #e2e6f0;
            --on-error: #ffffff;
            --on-tertiary-container: #92400e;
            --error-container: #ffe4e6;
            --on-surface: #1f2937;
            --surface-container-highest: #e2e6f0;
            --on-error-container: #9f1239;
            --surface-container-high: #eef1f6;
            --on-secondary-fixed-variant: #047857;
            --tertiary-container: #fef3c7;
            --primary-container: #ede9fe;
            --surface: #ffffff;
            --inverse-surface: #1a1b23;
            --on-primary-fixed-variant: #8b5cf6;
            --on-tertiary-fixed-variant: #653e00;
            --outline: #9ca3af;
            --on-background: #1f2937;
            --secondary-container: #d1fae5;
        }

        html.dark {
            --on-tertiary-fixed: #2a1700;
            --surface-bright: #22242f;
            --on-secondary: #121318;
            --surface-dim: #121318;
            --surface-container: #1a1b23;
            --on-primary: #121318;
            --secondary-fixed: #34d399;
            --surface-container-lowest: #0e0f14;
            --tertiary-fixed-dim: #ffb95f;
            --tertiary: #ffb95f;
            --inverse-primary: #c3c0ff;
            --on-primary-container: #ede9fe;
            --surface-container-low: #15161d;
            --secondary: #34d399;
            --primary-fixed-dim: #c3c0ff;
            --on-tertiary: #ffffff;
            --on-surface-variant: #8a8d98;
            --error: #fb7185;
            --primary-fixed: #e2dfff;
            --inverse-on-surface: #121318;
            --on-primary-fixed: #0f0069;
            --on-secondary-fixed: #002113;
            --on-secondary-container: #a7f3d0;
            --outline-variant: #262936;
            --surface-tint: #a78bfa;
            --secondary-fixed-dim: #34d399;
            --primary: #a78bfa;
            --tertiary-fixed: #ffddb8;
            --background: #121318;
            --surface-variant: #22242f;
            --on-error: #ffffff;
            --on-tertiary-container: #ffd4a4;
            --error-container: #881337;
            --on-surface: #e2e4e9;
            --surface-container-highest: #2c2e3c;
            --on-error-container: #fecdd3;
            --surface-container-high: #22242f;
            --on-secondary-fixed-variant: #34d399;
            --tertiary-container: #885500;
            --primary-container: #6d28d9;
            --surface: #1a1b23;
            --inverse-surface: #e2e4e9;
            --on-primary-fixed-variant: #8b5cf6;
            --on-tertiary-fixed-variant: #653e00;
            --outline: #4c4f5d;
            --on-background: #e2e4e9;
            --secondary-container: #064e3b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--background);
            color: var(--on-surface);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .glass-card {
            background-color: var(--surface);
            border: 1px solid var(--outline-variant);
            backdrop-filter: blur(12px);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.3s ease, border-color 0.3s ease;
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
        class="h-screen w-64 fixed left-0 top-0 bg-surface-container-low dark:bg-surface-dim shadow-sm flex flex-col py-stack-lg px-stack-md z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <div class="mb-10 px-stack-sm flex items-center justify-between">
            <div>
                <h1 class="text-headline-md font-headline-md font-black text-primary dark:text-primary-fixed-dim">Focus
                </h1>
                <p class="text-label-md font-label-md text-on-surface-variant">Productivity Workspace</p>
            </div>
            <!-- Close button for mobile sidebar -->
            <button id="sidebar-close"
                class="lg:hidden p-1 rounded-lg hover:bg-surface-container text-on-surface-variant transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="flex-grow space-y-1">
            <a class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} rounded-lg transition-all duration-200 group"
                href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined mr-3">dashboard</span>
                <span class="font-label-md text-label-md">Dashboard</span>
            </a>
            <a class="flex items-center px-4 py-3 {{ request()->routeIs('tasks.index') ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} rounded-lg transition-all duration-200"
                href="{{ route('tasks.index') }}">
                <span class="material-symbols-outlined mr-3">format_list_bulleted</span>
                <span class="font-label-md text-label-md">Task List</span>
            </a>
            <a class="flex items-center px-4 py-3 text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-all duration-200 rounded-lg group"
                href="#">
                <span class="material-symbols-outlined mr-3">calendar_month</span>
                <span class="font-label-md text-label-md">Calendar</span>
            </a>
            <a class="flex items-center px-4 py-3 {{ request()->routeIs('profile.index') ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} rounded-lg transition-all duration-200 group"
                href="{{ route('profile.index') }}">
                <span class="material-symbols-outlined mr-3">person</span>
                <span class="font-label-md text-label-md">Profile</span>
            </a>
        </nav>
        <a href="{{ route('tasks.create') }}"
            class="mb-20 mx-2 bg-primary text-on-primary py-3 px-4 rounded-lg font-label-md text-label-md flex items-center justify-center gap-2 cursor-pointer active:scale-95 transition-transform">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Create Task
        </a>

        <div class="border-t border-outline-variant my-1"></div>
        <a href="{{ route('logout') }}"
            class="flex items-center px-4 py-2 text-body-md text-error hover:bg-error-container/10 transition-colors"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="material-symbols-outlined mr-2 text-[18px]">logout</span>
            Logout
        </a>
        <form id="logout-form" action="http://127.0.0.1:8000/auth/logout" method="POST" class="hidden">
            <input type="hidden" name="_token" value="0QsthG9xzS8U7APlWTbOSOcQEnz8F5C7IqSm78cJ" autocomplete="off">
        </form>
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
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="relative w-full max-w-md">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input
                        class="w-full bg-surface-container-low border border-outline-variant rounded-full py-2 pl-10 pr-4 text-body-md focus:outline-none focus:border-primary transition-all"
                        placeholder="Search tasks, tags, or projects..." type="text">
                </div>
            </div>
            <div class="flex items-center gap-stack-lg ml-gutter-desktop">
                <button
                    class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors cursor-pointer">notifications</button>

                <!-- Profile Dropdown Container -->
                <div class="relative">
                    <button id="profile-menu-btn"
                        class="flex items-center gap-2 cursor-pointer group focus:outline-none">
                        <img alt="User"
                            class="w-8 h-8 rounded-full border border-outline-variant object-cover shadow-sm transition-transform duration-200 hover:scale-105"
                            src="{{ auth()->user()->avatar_url }}">
                        <span
                            class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors text-[18px]">keyboard_arrow_down</span>
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
                            <span class="material-symbols-outlined mr-2 text-[18px]">person</span>
                            My Profile
                        </a>
                        <div class="border-t border-outline-variant my-1"></div>
                        <a href="{{ route('logout') }}"
                            class="flex items-center px-4 py-2 text-body-md text-error hover:bg-error-container/10 transition-colors"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="material-symbols-outlined mr-2 text-[18px]">logout</span>
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
    </script>
</body>

</html>
