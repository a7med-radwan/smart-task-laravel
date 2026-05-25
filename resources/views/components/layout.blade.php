<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-fixed": "#2a1700",
                        "surface-bright": "#f8f9ff",
                        "on-secondary": "#ffffff",
                        "surface-dim": "#cbdbf5",
                        "surface-container": "#e5eeff",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#6ffbbe",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-fixed-dim": "#ffb95f",
                        "tertiary": "#684000",
                        "inverse-primary": "#c3c0ff",
                        "on-primary-container": "#dad7ff",
                        "surface-container-low": "#eff4ff",
                        "secondary": "#006c49",
                        "primary-fixed-dim": "#c3c0ff",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#464555",
                        "error": "#ba1a1a",
                        "primary-fixed": "#e2dfff",
                        "inverse-on-surface": "#eaf1ff",
                        "on-primary-fixed": "#0f0069",
                        "on-secondary-fixed": "#002113",
                        "on-secondary-container": "#00714d",
                        "outline-variant": "#c7c4d8",
                        "surface-tint": "#4d44e3",
                        "secondary-fixed-dim": "#4edea3",
                        "primary": "#3525cd",
                        "tertiary-fixed": "#ffddb8",
                        "background": "#f8f9ff",
                        "surface-variant": "#d3e4fe",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#ffd4a4",
                        "error-container": "#ffdad6",
                        "on-surface": "#0b1c30",
                        "surface-container-highest": "#d3e4fe",
                        "on-error-container": "#93000a",
                        "surface-container-high": "#dce9ff",
                        "on-secondary-fixed-variant": "#005236",
                        "tertiary-container": "#885500",
                        "primary-container": "#4f46e5",
                        "surface": "#f8f9ff",
                        "inverse-surface": "#213145",
                        "on-primary-fixed-variant": "#3323cc",
                        "on-tertiary-fixed-variant": "#653e00",
                        "outline": "#777587",
                        "on-background": "#0b1c30",
                        "secondary-container": "#6cf8bb"
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
                        "headline-md": ["Geist"],
                        "label-md": ["Geist"],
                        "label-sm": ["Geist"],
                        "body-md": ["Geist"],
                        "headline-lg": ["Geist"],
                        "headline-lg-mobile": ["Geist"],
                        "body-lg": ["Geist"]
                    },
                    "fontSize": {
                        "headline-md": ["20px", { "lineHeight": "28px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "500" }],
                        "label-sm": ["11px", { "lineHeight": "14px", "letterSpacing": "0.03em", "fontWeight": "500" }],
                        "body-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "letterSpacing": "0", "fontWeight": "400" }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Geist', sans-serif;
            background-color: #f8f9ff;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }

        .task-checkbox:checked+label {
            text-decoration: line-through;
            color: #777587;
        }

        .task-checkbox:checked {
            background-color: #006c49;
            border-color: #006c49;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d3e4fe;
            border-radius: 10px;
        }
    </style>
</head>

<body class="text-on-surface">
    <!-- Side Navigation Shell -->
    <aside
        class="h-screen w-64 fixed left-0 top-0 bg-surface-container-low dark:bg-surface-dim shadow-sm flex flex-col py-stack-lg px-stack-md z-50">
        <div class="mb-10 px-stack-sm">
            <h1 class="text-headline-md font-headline-md font-black text-primary dark:text-primary-fixed-dim">Focus</h1>
            <p class="text-label-md font-label-md text-on-surface-variant">Productivity Workspace</p>
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
            <a class="flex items-center px-4 py-3 text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-all duration-200 rounded-lg group"
                href="#">
                <span class="material-symbols-outlined mr-3">person</span>
                <span class="font-label-md text-label-md">Profile</span>
            </a>
        </nav>
        <a href="{{ route('tasks.create') }}"
            class="mt-4 mx-2 bg-primary text-on-primary py-3 px-4 rounded-lg font-label-md text-label-md flex items-center justify-center gap-2 cursor-pointer active:scale-95 transition-transform">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Create Task
        </a>
        <div class="mt-auto pt-stack-lg border-t border-outline-variant space-y-1">
            <a class="flex items-center px-4 py-3 text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-all duration-200 rounded-lg"
                href="#">
                <span class="material-symbols-outlined mr-3">settings</span>
                <span class="font-label-md text-label-md">Settings</span>
            </a>
            <a class="flex items-center px-4 py-3 text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-all duration-200 rounded-lg"
                href="#">
                <span class="material-symbols-outlined mr-3">help</span>
                <span class="font-label-md text-label-md">Help</span>
            </a>
        </div>
    </aside>
    <!-- Main Content Area -->
    <main class="ml-64 min-h-screen bg-surface">
        <!-- Top Nav Bar -->
        <header
            class="w-full h-16 flex justify-between items-center px-gutter-desktop max-w-container-max mx-auto border-b border-outline-variant dark:border-outline bg-surface sticky top-0 z-40">
            <div class="flex items-center gap-4 flex-1">
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
                <div class="flex items-center gap-2 cursor-pointer group">
                    <img alt="User" class="w-8 h-8 rounded-full border border-outline-variant"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzZXrwBc7Mg_2WZgmUDKBJNVuasxB8-1X1rN3zKq2xHpp3GcMD2v3Np3NGP4ZIt7jRmvhs0XMqwWeOgT_hyAeYUqT6CQyRTn0SpBMJH_e5FeZjArk4qU90xT9Ka_MhiyomQBDwF69gEGTya5Mzod8CerIYQmZBWMnGNM2BuTI_cc3_J4K6iKo0eGcJIE5zKmSvG1zaDTMPXcG7j1yoExMzPXqVA0Fn37s6Tt9jm_F7ZibjHx8TTTxZWFqfT2Yh_6fzTUvOhkLpbdP4">
                    <span
                        class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">account_circle</span>
                </div>
            </div>
        </header>
        <div class="px-gutter-desktop py-stack-lg max-w-container-max mx-auto">
            {{ $slot }}
        </div>
    </main>

    <!-- Micro-interaction Script -->
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
    </script>
</body>

</html>