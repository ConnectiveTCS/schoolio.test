<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Central Admin - SchoolIO')</title>
        {{-- Removed Tailwind CDN to ensure local Tailwind v4 build (with custom colors + dark variant) is used --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <!-- Early theme loader to avoid flash of incorrect theme -->
        <script>
            (function() {
                try {
                    const stored = localStorage.getItem('theme');
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const theme = stored || (prefersDark ? 'dark' : 'light');
                    if (theme === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } catch (e) {
                    /* ignore */
                }
            })();
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="dark:bg-gunmeta bg-gray-50 text-gray-900 transition-colors dark:text-gray-100">
        @auth('central_admin')
            <div class="flex h-screen overflow-hidden">
                <!-- Sidebar -->
                <div id="sidebar" class="bg-light-dark-green dark:bg-dark-green flex w-64 flex-col">
                    <!-- Sidebar Header -->
                    <div class="bg-castleton-green flex h-16 items-center justify-between gap-2 px-4">
                        <div class="flex items-center space-x-2">
                            <h1 class="text-light-brunswick-green text-lg font-bold">SchoolIO</h1>
                            <!-- Theme Toggle (small on larger screens, always visible) -->
                            <button id="theme-toggle" type="button" aria-label="Toggle theme"
                                class="hover:bg-castleton-green text-light-brunswick-green rounded p-2 transition-colors hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40">
                                <i id="theme-toggle-icon" class="fas fa-moon"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2">
                            <!-- Mobile Close Button -->
                            <button type="button" onclick="toggleSidebar()" class="text-white md:hidden">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex-1 space-y-1 p-4">
                        <a href="{{ route('central.dashboard') }}"
                            class="{{ request()->routeIs('central.dashboard') ? 'bg-light-castleton-green text-dark-green dark:bg-castleton-green dark:text-light-castleton-green' : 'text-castleton-green dark:text-light-castleton-green hover:bg-light-castleton-green hover:text-castleton-green dark:hover:bg-castleton-green' }} group flex items-center rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-tachometer-alt mr-3 h-5 w-5"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('central.tenants.index') }}"
                            class="{{ request()->routeIs('central.tenants.*') ? 'bg-light-castleton-green text-dark-green dark:bg-castleton-green dark:text-light-castleton-green' : 'text-castleton-green dark:text-light-castleton-green hover:bg-light-castleton-green hover:text-castleton-green dark:hover:bg-castleton-green' }} group flex items-center rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-building mr-3 h-5 w-5"></i>
                            Tenants
                        </a>
                        <a href="{{ route('central.support.index') }}"
                            class="{{ request()->routeIs('central.support.*') ? 'bg-light-castleton-green text-dark-green dark:bg-castleton-green dark:text-light-castleton-green' : 'text-castleton-green dark:text-light-castleton-green hover:bg-light-castleton-green hover:text-castleton-green dark:hover:bg-castleton-green' }} group flex items-center rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-headset mr-3 h-5 w-5"></i>
                            Support
                        </a>
                        @if (auth('central_admin')->user()->hasPermission('manage_admins'))
                            <a href="{{ route('central.admins.index') }}"
                                class="{{ request()->routeIs('central.admins.*') ? 'bg-light-castleton-green text-dark-green dark:bg-castleton-green dark:text-light-castleton-green' : 'text-castleton-green dark:text-light-castleton-green hover:bg-light-castleton-green hover:text-castleton-green dark:hover:bg-castleton-green' }} group flex items-center rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-users-cog mr-3 h-5 w-5"></i>
                                Admins
                            </a>
                        @endif
                        @if (auth('central_admin')->user()->hasPermission('system_settings'))
                            <a href="{{ route('central.settings') }}"
                                class="{{ request()->routeIs('central.settings') ? 'bg-light-castleton-green text-dark-green dark:bg-castleton-green dark:text-light-castleton-green' : 'text-castleton-green dark:text-light-castleton-green hover:bg-light-castleton-green hover:text-castleton-green dark:hover:bg-castleton-green' }} group flex items-center rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-cogs mr-3 h-5 w-5"></i>
                                Settings
                            </a>
                        @endif
                        @if (auth('central_admin')->user()->hasPermission('view_permissions'))
                            <a href="{{ route('central.permissions.index') }}"
                                class="{{ request()->routeIs('central.permissions.*') ? 'bg-light-castleton-green text-dark-green dark:bg-castleton-green dark:text-light-castleton-green' : 'text-castleton-green dark:text-light-castleton-green hover:bg-light-castleton-green hover:text-castleton-green dark:hover:bg-castleton-green' }} group flex items-center rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-shield-alt mr-3 h-5 w-5"></i>
                                Permissions
                            </a>
                        @endif
                    </nav>

                    <!-- User Section -->
                    <div class="border-t border-light-brunswick-green p-4">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-brunswick-green">
                                    <i class="fas fa-user text-sm text-light-brunswick-green"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-light-brunswick-green">{{ auth('central_admin')->user()->name }}</p>
                                <p class="text-xs text-light-brunswick-green">{{ auth('central_admin')->user()->role }}</p>
                            </div>
                            <form method="POST" action="{{ route('central.logout') }}" class="ml-2">
                                @csrf
                                <button type="submit" class="text-light-brunswick-green transition-colors hover:text-white cursor-pointer"
                                    title="Logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex flex-1 flex-col overflow-hidden">
                    <!-- Top Bar -->
                    <header
                        class="shadow-xs dark:bg-green border-b border-light-brunswick-green bg-castleton-green transition-colors dark:border-light-brunswick-green">
                        <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                            <div class="flex items-center">
                                <!-- Mobile menu button -->
                                <button type="button" onclick="toggleSidebar()"
                                    class="mr-4 text-gray-600 hover:text-gray-900 md:hidden">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <!-- Page Title -->
                                <h1 class="text-xl font-semibold text-light-brunswick-green">@yield('page_title', 'Dashboard')</h1>
                            </div>
                            <!-- Page Actions -->
                            <div class="flex items-center space-x-3">
                                @yield('page_actions')
                            </div>
                        </div>
                    </header>

                    <!-- Main Content Area -->
                    <main class="dark:bg-brunswick-green flex-1 overflow-auto bg-light-brunswick-green transition-colors">
                        <!-- Flash Messages -->
                        @if (session('success'))
                            <div class="mx-4 mt-4 transition-colors sm:mx-6 lg:mx-8">
                                <div
                                    class="rounded-md border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/40">
                                    <div class="flex">
                                        <div class="shrink-0">
                                            <i class="fas fa-check-circle text-green-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mx-4 mt-4 transition-colors sm:mx-6 lg:mx-8">
                                <div
                                    class="rounded-md border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/40">
                                    <div class="flex">
                                        <div class="shrink-0">
                                            <i class="fas fa-exclamation-circle text-red-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Page Content -->
                        <div class="p-4 sm:p-6 lg:p-8">
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>

            <!-- Mobile Sidebar Overlay -->
            <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-gray-600 bg-opacity-75 md:hidden"
                onclick="toggleSidebar()"></div>
        @else
            <!-- Unauthenticated Layout -->
            <main class="dark:bg-gunmetal min-h-screen bg-gray-50 text-gray-900 transition-colors dark:text-gray-100">
                @if (session('success'))
                    <div class="mx-auto max-w-7xl px-4 pt-4 transition-colors">
                        <div
                            class="rounded-md border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/40">
                            <div class="flex">
                                <div class="shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mx-auto max-w-7xl px-4 pt-4 transition-colors">
                        <div class="rounded-md border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/40">
                            <div class="flex">
                                <div class="shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        @endauth

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');

                // Toggle sidebar visibility on mobile
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            // Initialize sidebar position for mobile
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.getElementById('sidebar');
                const isMobile = window.innerWidth < 768;

                if (isMobile) {
                    sidebar.classList.add('fixed', 'inset-y-0', 'left-0', 'z-50', '-translate-x-full',
                        'transition-transform', 'duration-300', 'ease-in-out');
                }

                // Handle resize events
                window.addEventListener('resize', function() {
                    const newIsMobile = window.innerWidth < 768;
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebar-overlay');

                    if (!newIsMobile) {
                        // Desktop view
                        sidebar.classList.remove('fixed', 'inset-y-0', 'left-0', 'z-50', '-translate-x-full',
                            'transition-transform', 'duration-300', 'ease-in-out');
                        overlay.classList.add('hidden');
                    } else {
                        // Mobile view
                        sidebar.classList.add('fixed', 'inset-y-0', 'left-0', 'z-50', '-translate-x-full',
                            'transition-transform', 'duration-300', 'ease-in-out');
                    }
                });
            });

            // Theme toggle logic (after DOM ready to wire button events)
            (function() {
                function applyTheme(theme) {
                    if (theme === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }

                function currentTheme() {
                    return document.documentElement.classList.contains('dark') ? 'dark' : 'light';
                }

                function syncIcon() {
                    const icon = document.getElementById('theme-toggle-icon');
                    if (!icon) return;
                    icon.classList.remove('fa-sun', 'fa-moon');
                    if (document.documentElement.classList.contains('dark')) {
                        icon.classList.add('fa-sun'); // show sun in dark mode (meaning clicking goes to light)
                    } else {
                        icon.classList.add('fa-moon');
                    }
                }
                document.addEventListener('DOMContentLoaded', function() {
                    syncIcon();
                    const btn = document.getElementById('theme-toggle');
                    if (btn) {
                        btn.addEventListener('click', function() {
                            const next = currentTheme() === 'dark' ? 'light' : 'dark';
                            applyTheme(next);
                            try {
                                localStorage.setItem('theme', next);
                            } catch (e) {}
                            syncIcon();
                        });
                    }
                });
            })();
        </script>
    </body>

</html>
