<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - {{ tenant('name') ?? 'School Management' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            // Check for saved theme preference or default to 'light'
            const theme = localStorage.getItem('theme') || 'light';

            // Apply theme immediately to prevent flash
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            // Theme toggle function
            function toggleTheme() {
                const html = document.documentElement;
                const isDark = html.classList.contains('dark');

                if (isDark) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }

            // Set initial theme after DOM loads
            document.addEventListener('DOMContentLoaded', function() {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            });
        </script>

        <script>
            // Define the notification system function before Alpine.js loads
            function notificationSystem() {
                const dashboardData = {!! json_encode($dashboardData ?? []) !!};
                const activities = dashboardData.recent_activities || [];

                return {
                    notificationOpen: false,
                    modalOpen: false,
                    activities: activities,
                    loading: false,
                    init() {
                        console.log('Activities data:', this.activities);
                        console.log('Dashboard data:', dashboardData);
                    },
                    async clearActivity(index) {
                        try {
                            this.loading = true;
                            const response = await fetch('/api/activities/' + index, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute(
                                        'content'),
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
                            if (response.ok) {
                                this.activities.splice(index, 1);
                            } else {
                                console.error('Failed to clear activity');
                            }
                        } catch (error) {
                            console.error('Error clearing activity:', error);
                        } finally {
                            this.loading = false;
                        }
                    },
                    async clearAllActivities() {
                        try {
                            this.loading = true;
                            const response = await fetch('/api/activities/clear-all', {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute(
                                        'content'),
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
                            if (response.ok) {
                                this.activities = [];
                                this.modalOpen = false;
                                this.notificationOpen = false;
                            } else {
                                console.error('Failed to clear all activities');
                            }
                        } catch (error) {
                            console.error('Error clearing all activities:', error);
                        } finally {
                            this.loading = false;
                        }
                    }
                }
            }
        </script>

        <!-- Tenant-specific styling -->
        @if (tenant('color_scheme'))
            <style>
                :root {
                    --tenant-primary-color: {{ tenant('color_scheme') ?? '#3B82F6' }};
                }
            </style>
        @endif

        <!-- Notification styles -->
        <style>
            /* Hide Alpine-managed elements until it initializes */
            [x-cloak] {
                display: none !important;
            }

            .notification-dropdown {
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }

            .notification-item:hover {
                transform: translateX(2px);
                transition: transform 0.2s ease;
            }

            .activity-badge {
                animation: slideInRight 0.3s ease-out;
            }

            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(10px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .modal-backdrop {
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
            }

            .scrollbar-thin::-webkit-scrollbar {
                width: 4px;
            }

            .scrollbar-thin::-webkit-scrollbar-track {
                background: transparent;
            }

            .scrollbar-thin::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 2px;
            }

            .dark .scrollbar-thin::-webkit-scrollbar-thumb {
                background: #64748b;
            }

            /* Font Awesome icon sizing with Tailwind classes */
            .fas.h-3, .far.h-3, .fab.h-3 { font-size: 0.75rem; }
            .fas.h-4, .far.h-4, .fab.h-4 { font-size: 1rem; }
            .fas.h-5, .far.h-5, .fab.h-5 { font-size: 1.25rem; }
            .fas.h-6, .far.h-6, .fab.h-6 { font-size: 1.5rem; }
            .fas.h-8, .far.h-8, .fab.h-8 { font-size: 2rem; }
            .fas.h-12, .far.h-12, .fab.h-12 { font-size: 3rem; }
        </style>
    </head>

    <body class="font-sans antialiased transition-colors duration-200">
        <!-- Impersonation Banner -->
        @if (session('central_admin_impersonating'))
            <div class="relative z-50 bg-red-500 px-4 py-2 text-center text-white transition-colors duration-200">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center">
                        <i class="fas fa-user-secret mr-2"></i>
                        <span class="font-medium">You are impersonating this tenant as a central admin</span>
                    </div>
                    <form method="POST" action="{{ route('end-impersonation') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="rounded-sm bg-red-600 px-3 py-1 text-sm font-medium text-white transition-colors duration-200 hover:bg-red-700"
                            onclick="return confirm('Are you sure you want to end impersonation?')">
                            End Impersonation
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <div
            class="h-screen bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
            <!-- Sidebar Layout -->
            <div class="flex h-full">
                <!-- Sidebar -->
                <aside x-data="{ sidebarOpen: false }" class="relative">
                    <!-- Mobile sidebar overlay -->
                    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-linear duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden" @click="sidebarOpen = false">
                    </div>

                    <!-- Sidebar panel -->
                    <div x-show="sidebarOpen || window.innerWidth >= 1024"
                        x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        class="sidebar-transition fixed inset-y-0 left-0 z-30 flex h-full w-64 flex-col bg-[color:var(--color-light-castleton-green)] shadow-lg transition-colors duration-200 lg:static lg:translate-x-0 dark:bg-[color:var(--color-castleton-green)]">

                        <div
                            class="flex h-16 shrink-0 items-center justify-center border-b border-[color:var(--color-light-brunswick-green)] px-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                            <div class="flex items-center justify-center">
                                @if (tenant('logo'))
                                    <img src="{{ route('tenant.file', tenant('logo')) }}"
                                        alt="{{ tenant('name') ?? 'School' }}" class="h-12 w-12 object-cover"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                @endif
                                <!-- Fallback logo -->
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] text-lg font-bold text-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]"
                                    style="{{ tenant('logo') ? 'display: none;' : 'display: flex;' }}">
                                    {{ strtoupper(substr(tenant('name') ?? 'S', 0, 1)) }}
                                </div>
                            </div>
                            <button @click="sidebarOpen = false"
                                class="text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] lg:hidden dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-times h-6 w-6"></i>
                            </button>
                        </div>

                        <!-- Navigation -->
                        <nav class="sidebar-scrollbar mt-6 min-h-0 flex-1 overflow-y-auto px-3 pb-6">
                            <div class="space-y-1">
                                <!-- Dashboard -->
                                <a href="{{ route('dashboard') }}"
                                    class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }}">
                                    <i class="fas fa-tachometer-alt mr-3 h-5 w-5"></i>
                                    Dashboard
                                </a>

                                <!-- Students Section -->
                                <div x-data="{ open: {{ request()->routeIs('tenant.students*') ? 'true' : 'false' }} }" class="space-y-1">
                                    <button @click="open = !open"
                                        class="sidebar-nav-item {{ request()->routeIs('tenant.students*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }} w-full justify-between">
                                        <div class="flex items-center">
                                            <i class="fas fa-user-graduate mr-3 h-5 w-5"></i>
                                            Students
                                        </div>
                                        <i class="fas fa-chevron-right h-4 w-4 transition-transform duration-150" :class="{ 'rotate-90': open }"></i>
                                    </button>
                                    <div x-show="open" x-transition class="ml-6 space-y-1">
                                        <a href="{{ route('tenant.students') }}"
                                            class="sidebar-submenu-item {{ request()->routeIs('tenant.students.index') || request()->routeIs('tenant.students') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">All
                                            Students</a>
                                        <a href="{{ route('tenant.students.create') }}"
                                            class="sidebar-submenu-item {{ request()->routeIs('tenant.students.create') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">Add
                                            Student</a>
                                    </div>
                                </div>

                                <!-- Teachers Section -->
                                <div x-data="{ open: {{ request()->routeIs('tenant.teachers*') ? 'true' : 'false' }} }" class="space-y-1">
                                    <button @click="open = !open"
                                        class="sidebar-nav-item {{ request()->routeIs('tenant.teachers*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }} w-full justify-between">
                                        <div class="flex items-center">
                                            <i class="fas fa-chalkboard-teacher mr-3 h-5 w-5"></i>
                                            Teachers
                                        </div>
                                        <i class="fas fa-chevron-right h-4 w-4 transition-transform duration-150" :class="{ 'rotate-90': open }"></i>
                                    </button>
                                    <div x-show="open" x-transition class="ml-6 space-y-1">
                                        <a href="{{ route('tenant.teachers') }}"
                                            class="sidebar-submenu-item {{ request()->routeIs('tenant.teachers.index') || request()->routeIs('tenant.teachers') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">All
                                            Teachers</a>
                                        <a href="{{ route('tenant.teachers.create') }}"
                                            class="sidebar-submenu-item {{ request()->routeIs('tenant.teachers.create') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">Add
                                            Teacher</a>
                                    </div>
                                </div>

                                <!-- Classes Section -->
                                <div x-data="{ open: {{ request()->routeIs('tenant.classes*') ? 'true' : 'false' }} }" class="space-y-1">
                                    <button @click="open = !open"
                                        class="sidebar-nav-item {{ request()->routeIs('tenant.classes*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }} w-full justify-between">
                                        <div class="flex items-center">
                                            <i class="fas fa-school mr-3 h-5 w-5"></i>
                                            Classes
                                        </div>
                                        <i class="fas fa-chevron-right h-4 w-4 transition-transform duration-150" :class="{ 'rotate-90': open }"></i>
                                    </button>
                                    <div x-show="open" x-transition class="ml-6 space-y-1">
                                        <a href="{{ route('tenant.classes') }}"
                                            class="sidebar-submenu-item {{ request()->routeIs('tenant.classes.index') || request()->routeIs('tenant.classes') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">All
                                            Classes</a>
                                        <a href="{{ route('tenant.classes.create') }}"
                                            class="sidebar-submenu-item {{ request()->routeIs('tenant.classes.create') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">Create
                                            Class</a>
                                        <a href="#" class="sidebar-submenu-item">Schedules</a>
                                    </div>
                                </div>

                                <!-- Users -->
                                <a href="{{ route('tenant.users') }}"
                                    class="sidebar-nav-item {{ request()->routeIs('tenant.users*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }}">
                                    <i class="fas fa-users mr-3 h-5 w-5"></i>
                                    Users
                                </a>

                                <!-- Announcements Section -->
                                @can('view announcements')
                                    <div x-data="{ open: {{ request()->routeIs('tenant.announcements*') ? 'true' : 'false' }} }" class="space-y-1">
                                        <button @click="open = !open"
                                            class="sidebar-nav-item {{ request()->routeIs('tenant.announcements*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }} w-full justify-between">
                                            <div class="flex items-center">
                                                <i class="fas fa-bullhorn mr-3 h-5 w-5"></i>
                                                Announcements
                                            </div>
                                            <i class="fas fa-chevron-right h-4 w-4 transition-transform duration-200" :class="{ 'rotate-90': open }"></i>
                                        </button>
                                        <div x-show="open" x-transition class="ml-6 space-y-1">
                                            <a href="{{ route('tenant.announcements.my') }}"
                                                class="sidebar-submenu-item {{ request()->routeIs('tenant.announcements.my') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">My
                                                Announcements</a>
                                            @can('manage announcements')
                                                <a href="{{ route('tenant.announcements.index') }}"
                                                    class="sidebar-submenu-item {{ request()->routeIs('tenant.announcements.index') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">Manage
                                                    Announcements</a>
                                            @endcan
                                            @can('create announcements')
                                                <a href="{{ route('tenant.announcements.create') }}"
                                                    class="sidebar-submenu-item {{ request()->routeIs('tenant.announcements.create') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">Create
                                                    Announcement</a>
                                            @endcan
                                        </div>
                                    </div>
                                @endcan

                                <!-- Calendar Events Section -->
                                @can('view calendar events')
                                    <div x-data="{ open: {{ request()->routeIs('tenant.calendar-events*') ? 'true' : 'false' }} }" class="space-y-1">
                                        <button @click="open = !open"
                                            class="sidebar-nav-item {{ request()->routeIs('tenant.calendar-events*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }} w-full justify-between">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-alt mr-3 h-5 w-5"></i>
                                                Calendar
                                            </div>
                                            <i class="fas fa-chevron-right h-4 w-4 transition-transform duration-200" :class="{ 'rotate-90': open }"></i>
                                        </button>
                                        <div x-show="open" x-transition class="ml-6 space-y-1">
                                            <a href="{{ route('tenant.calendar-events.user') }}"
                                                class="sidebar-submenu-item {{ request()->routeIs('tenant.calendar-events.user') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">My
                                                Calendar</a>
                                            @can('manage calendar events')
                                                <a href="{{ route('tenant.calendar-events.index') }}"
                                                    class="sidebar-submenu-item {{ request()->routeIs('tenant.calendar-events.index') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">Manage
                                                    Events</a>
                                            @endcan
                                            @can('create calendar events')
                                                <a href="{{ route('tenant.calendar-events.create') }}"
                                                    class="sidebar-submenu-item {{ request()->routeIs('tenant.calendar-events.create') ? 'bg-[var(--color-dark-green)] text-[var(--color-light-dark-green)]' : '' }}">Create
                                                    Event</a>
                                            @endcan
                                        </div>
                                    </div>
                                @endcan

                                <!-- Reports -->
                                <a href="#" class="sidebar-nav-item sidebar-nav-item-inactive">
                                    <i class="fas fa-chart-bar mr-3 h-5 w-5"></i>
                                    Reports
                                </a>

                                <!-- Messages -->
                                <a href="{{ route('tenant.messages.index') }}"
                                    class="sidebar-nav-item {{ request()->routeIs('tenant.messages.*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }}">
                                    <i class="fas fa-comments mr-3 h-5 w-5"></i>
                                    Messages
                                    @if (auth()->user() && auth()->user()->unread_messages_count > 0)
                                        <span
                                            class="ml-auto inline-flex items-center rounded-full bg-red-500 px-2.5 py-0.5 text-xs font-medium text-white">
                                            {{ auth()->user()->unread_messages_count }}
                                        </span>
                                    @endif
                                </a>

                                <!-- Support -->
                                <a href="{{ route('tenant.support.index') }}"
                                    class="sidebar-nav-item {{ request()->routeIs('tenant.support.*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }}">
                                    <i class="fas fa-life-ring mr-3 h-5 w-5"></i>
                                    Support
                                </a>

                                <!-- Settings -->
                                <a href="{{ route('settings') }}"
                                    class="sidebar-nav-item {{ request()->routeIs('settings*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }}">
                                    <i class="fas fa-cog mr-3 h-5 w-5"></i>
                                    Settings
                                </a>
                            </div>

                            <!-- User menu at bottom -->
                            <div
                                class="shrink-0 border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                                <div x-data="{ userMenuOpen: false }" class="relative">
                                    <button @click="userMenuOpen = !userMenuOpen"
                                        class="flex w-full items-center rounded-md px-3 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                        <div
                                            class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] text-xs font-semibold text-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                            @auth
                                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                            @else
                                                U
                                            @endauth
                                        </div>
                                        <div class="flex-1 text-left">
                                            <div class="text-sm font-medium">
                                                @auth
                                                    {{ Auth::user()->name ?? 'User' }}
                                                @else
                                                    User
                                                @endauth
                                            </div>
                                            <div
                                                class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                @auth
                                                    {{ Auth::user()->email ?? '' }}
                                                @else
                                                    guest@example.com
                                                @endauth
                                            </div>
                                        </div>
                                        <i class="fas fa-chevron-down h-4 w-4"></i>
                                    </button>

                                    <!-- User dropdown -->
                                    <div x-show="userMenuOpen" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        @click.away="userMenuOpen = false"
                                        class="absolute bottom-full left-0 right-0 mb-2 rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] py-1 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                        <a href="{{ route('profile.edit') }}"
                                            class="block px-4 py-2 text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">Profile</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="block w-full px-4 py-2 text-left text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </aside>

                <!-- Main content area -->
                <div class="flex h-full flex-1 flex-col overflow-hidden lg:ml-0">
                    <!-- Top navigation bar -->
                    <header
                        class="shadow-xs shrink-0 border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                        <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                            <!-- Mobile menu button -->
                            <button @click="sidebarOpen = true"
                                class="text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] lg:hidden dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-bars h-6 w-6"></i>
                            </button>

                            <!-- Page heading -->
                            @isset($header)
                                <div class="flex-1">
                                    {{ $header }}
                                </div>
                            @endisset

                            <!-- Right side content (notifications, etc.) -->
                            <div class="flex items-center space-x-4">
                                <!-- Notification bell with dropdown -->
                                <div x-data="notificationSystem()" class="relative">
                                    <!-- Notification button -->
                                    <button @mouseenter="notificationOpen = true"
                                        @mouseleave="setTimeout(() => { if (!$refs.dropdown.matches(':hover') && !$el.matches(':hover')) notificationOpen = false }, 100)"
                                        @click="modalOpen = true" title="View recent activities"
                                        class="focus:outline-hidden relative rounded-md p-1 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-brunswick-green)] dark:focus:ring-offset-[color:var(--color-castleton-green)]">
                                        <i class="fas fa-bell h-6 w-6 ml-2 hover:text-red-500"></i>
                                        <!-- Notification dot -->
                                        <span x-show="activities.length > 0"
                                            class="absolute -right-1 -top-1 h-3 w-3 animate-pulse rounded-full bg-red-500"></span>
                                        <!-- Count badge -->
                                        <span x-show="activities.length > 0" x-text="activities.length"
                                            class="absolute -right-2 -top-2 inline-flex min-w-[18px] -translate-y-1/2 translate-x-1/2 transform items-center justify-center rounded-full bg-red-600 px-1.5 py-0.5 text-xs font-bold leading-none text-white"></span>
                                    </button>

                                    <!-- Hover dropdown -->
                                    <div x-show="notificationOpen && activities.length > 0" x-ref="dropdown" x-cloak
                                        @mouseenter="notificationOpen = true" @mouseleave="notificationOpen = false"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="z-9999 absolute right-0 top-full mt-2 w-80 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">

                                        <!-- Dropdown header -->
                                        <div
                                            class="border-b border-[color:var(--color-light-brunswick-green)] px-4 py-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                                            <div class="flex items-center justify-between">
                                                <h3
                                                    class="text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                    Recent
                                                    Activity</h3>
                                                <span x-text="activities.length"
                                                    class="inline-flex items-center rounded-full bg-[color:var(--color-castleton-green)] px-2 py-1 text-xs font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]"></span>
                                            </div>
                                        </div>

                                        <!-- Activity list (preview) -->
                                        <div class="scrollbar-thin max-h-64 overflow-y-auto">
                                            <template x-for="(activity, index) in activities.slice(0, 5)"
                                                :key="index">
                                                <div
                                                    class="dark:border-[color:var(--color-castleton-green)]/50 dark:hover:bg-[color:var(--color-brunswick-green)]/50 border-b border-[color:var(--color-light-brunswick-green)] px-4 py-3 transition-colors duration-200 last:border-b-0 hover:bg-[color:var(--color-light-brunswick-green)]">
                                                    <div class="flex items-start space-x-3">
                                                        <!-- Activity icon -->
                                                        <div class="shrink-0">
                                                            <div :class="{
                                                                'bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]/30': activity
                                                                    .type === 'enrollment',
                                                                'bg-[color:var(--color-prussian-blue)] dark:bg-[color:var(--color-prussian-blue)]/30': activity
                                                                    .type === 'staff',
                                                                'bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]/30': activity
                                                                    .type === 'announcement',
                                                                'bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-gunmetal)]/30': activity
                                                                    .type === 'class',
                                                                'bg-[color:var(--color-dark-green)] dark:bg-[color:var(--color-dark-green)]/30': activity
                                                                    .type === 'attendance'
                                                            }"
                                                                class="flex h-6 w-6 items-center justify-center rounded-full transition-colors duration-200">
                                                                <!-- Icon based on type -->
                                                                <i class="h-3 w-3"
                                                                    :class="{
                                                                        'fas fa-user-graduate text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'enrollment',
                                                                        'fas fa-chalkboard-teacher text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'staff',
                                                                        'fas fa-bullhorn text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'announcement',
                                                                        'fas fa-school text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'class',
                                                                        'fas fa-clipboard-check text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'attendance'
                                                                    }"></i>
                                                            </div>
                                                        </div>
                                                        <!-- Activity content -->
                                                        <div class="min-w-0 flex-1">
                                                            <p x-text="activity.activity"
                                                                class="truncate text-xs font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                            </p>
                                                            <p x-text="activity.time"
                                                                class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Dropdown footer -->
                                        <div
                                            class="border-t border-[color:var(--color-light-brunswick-green)] px-4 py-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                                            <button @click="modalOpen = true; notificationOpen = false"
                                                class="w-full text-center text-xs font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-brunswick-green)] dark:hover:text-[color:var(--color-castleton-green)]">
                                                View all activities →
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Empty state for dropdown -->
                                    <div x-show="notificationOpen && activities.length === 0" x-ref="dropdown" x-cloak
                                        @mouseenter="notificationOpen = true" @mouseleave="notificationOpen = false"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="z-9999 absolute right-0 top-full mt-2 w-80 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                        <div class="px-4 py-8 text-center">
                                            <div
                                                class="mb-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                <i class="fas fa-clipboard-list mx-auto h-8 w-8"></i>
                                            </div>
                                            <p
                                                class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                No new activities</p>
                                        </div>
                                    </div>

                                    <!-- Full activities modal -->
                                    <div x-show="modalOpen" x-cloak
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        @keydown.escape.window="modalOpen = false"
                                        class="z-9999 fixed inset-0 flex items-center justify-center overflow-y-auto p-4">
                                        <!-- Backdrop -->
                                        <div @click="modalOpen = false"
                                            class="z-9998 modal-backdrop fixed inset-0 bg-black bg-opacity-50"></div>

                                        <!-- Modal -->
                                        <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            class="z-10000 relative max-h-[80vh] w-full max-w-2xl overflow-hidden rounded-lg bg-[color:var(--color-light-castleton-green)] shadow-xl transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)]">

                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between border-b border-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                                                <div>
                                                    <h2
                                                        class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                        Recent Activities</h2>
                                                    <p
                                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                        Manage your
                                                        system activities</p>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <button @click="clearAllActivities()"
                                                        x-show="activities.length > 0" :disabled="loading"
                                                        :class="loading ? 'opacity-50 cursor-not-allowed' : ''"
                                                        class="rounded-md border border-red-300 px-3 py-1.5 text-xs font-medium text-red-600 transition-colors duration-200 hover:border-red-400 hover:bg-red-50 hover:text-red-800 disabled:hover:border-red-300 disabled:hover:bg-transparent dark:border-red-600 dark:text-red-400 dark:hover:border-red-500 dark:hover:bg-red-900/20 dark:hover:text-red-300 dark:disabled:hover:border-red-600 dark:disabled:hover:bg-transparent">
                                                        <span x-show="!loading">Clear All</span>
                                                        <span x-show="loading" class="flex items-center">
                                                            <i class="fas fa-spinner fa-spin -ml-1 mr-1 h-3 w-3"></i>
                                                            Clearing...
                                                        </span>
                                                    </button>
                                                    <button @click="modalOpen = false"
                                                        class="text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                                        <i class="fas fa-times h-6 w-6"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="scrollbar-thin max-h-96 overflow-y-auto p-6">
                                                <div x-show="activities.length > 0" class="space-y-4">
                                                    <template x-for="(activity, index) in activities"
                                                        :key="index">
                                                        <div
                                                            class="dark:hover:bg-[color:var(--color-brunswick-green)]/50 group flex items-start space-x-4 rounded-lg border border-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)]">
                                                            <!-- Activity icon -->
                                                            <div class="shrink-0">
                                                                <div :class="{
                                                                    'bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]/30': activity
                                                                        .type === 'enrollment',
                                                                    'bg-[color:var(--color-prussian-blue)] dark:bg-[color:var(--color-prussian-blue)]/30': activity
                                                                        .type === 'staff',
                                                                    'bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]/30': activity
                                                                        .type === 'announcement',
                                                                    'bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-gunmetal)]/30': activity
                                                                        .type === 'class',
                                                                    'bg-[color:var(--color-dark-green)] dark:bg-[color:var(--color-dark-green)]/30': activity
                                                                        .type === 'attendance'
                                                                }"
                                                                    class="flex h-10 w-10 items-center justify-center rounded-full transition-colors duration-200">
                                                                    <i class="h-5 w-5"
                                                                        :class="{
                                                                            'fas fa-user-graduate text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'enrollment',
                                                                            'fas fa-chalkboard-teacher text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'staff',
                                                                            'fas fa-bullhorn text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'announcement',
                                                                            'fas fa-school text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'class',
                                                                            'fas fa-clipboard-check text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-castleton-green)]': activity.type === 'attendance'
                                                                        }"></i>
                                                                </div>
                                                            </div>

                                                            <!-- Activity content -->
                                                            <div class="min-w-0 flex-1">
                                                                <p x-text="activity.activity"
                                                                    class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                                </p>
                                                                <div class="mt-1 flex items-center space-x-2">
                                                                    <p x-text="activity.time"
                                                                        class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                                    </p>
                                                                    <span
                                                                        :class="{
                                                                            'bg-[color:var(--color-castleton-green)] text-[color:var(--color-light-dark-green)] dark:bg-[color:var(--color-brunswick-green)]/30 dark:text-[color:var(--color-light-castleton-green)]': activity
                                                                                .type === 'enrollment',
                                                                            'bg-[color:var(--color-prussian-blue)] text-[color:var(--color-light-dark-green)] dark:bg-[color:var(--color-prussian-blue)]/30 dark:text-[color:var(--color-light-prussian-blue)]': activity
                                                                                .type === 'staff',
                                                                            'bg-[color:var(--color-brunswick-green)] text-[color:var(--color-light-dark-green)] dark:bg-[color:var(--color-brunswick-green)]/30 dark:text-[color:var(--color-light-brunswick-green)]': activity
                                                                                .type === 'announcement',
                                                                            'bg-[color:var(--color-gunmetal)] text-[color:var(--color-light-dark-green)] dark:bg-[color:var(--color-gunmetal)]/30 dark:text-[color:var(--color-light-gunmetal)]': activity
                                                                                .type === 'class',
                                                                            'bg-[color:var(--color-dark-green)] text-[color:var(--color-light-dark-green)] dark:bg-[color:var(--color-dark-green)]/30 dark:text-[color:var(--color-light-dark-green)]': activity
                                                                                .type === 'attendance'
                                                                        }"
                                                                        class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium capitalize transition-colors duration-200"
                                                                        x-text="activity.type"></span>
                                                                </div>
                                                            </div>

                                                            <!-- Clear button -->
                                                            <button @click="clearActivity(index)"
                                                                :disabled="loading" title="Clear this activity"
                                                                :class="loading ? 'opacity-50 cursor-not-allowed' :
                                                                    'opacity-0 group-hover:opacity-100'"
                                                                class="rounded-xs focus:outline-hidden p-1 text-[color:var(--color-gunmetal)] transition-all duration-200 hover:text-red-600 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-red-400 dark:focus:ring-offset-[color:var(--color-castleton-green)]">
                                                                <i class="fas fa-times h-4 w-4"></i>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>

                                                <!-- Empty state -->
                                                <div x-show="activities.length === 0" class="py-12 text-center">
                                                    <div
                                                        class="mb-4 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                        <i class="fas fa-file-alt mx-auto h-12 w-12"></i>
                                                    </div>
                                                    <h3
                                                        class="mb-1 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                        No activities</h3>
                                                    <p
                                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                        All activities
                                                        have been cleared or there are no recent activities to show.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- Page Content -->
                    <main
                        class="flex-1 overflow-y-auto bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                        {{ $slot }}
                    </main>

                    <!-- Footer -->
                    <footer
                        class="shrink-0 border-t border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                            <div class="flex items-center justify-between">
                                <div
                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    © {{ date('Y') }} {{ tenant('name') ?? config('app.name') }}. All rights
                                    reserved.
                                </div>
                                <div
                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    @if (tenant('website'))
                                        <a href="{{ tenant('website') }}" target="_blank"
                                            class="transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                            {{ tenant('website') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </body>

</html>
