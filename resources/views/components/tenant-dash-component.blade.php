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
        </style>
    </head>

    <body class="font-sans antialiased">
        <!-- Impersonation Banner -->
        @if (session('central_admin_impersonating'))
            <div class="relative z-50 bg-red-500 px-4 py-2 text-center text-white">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center">
                        <i class="fas fa-user-secret mr-2"></i>
                        <span class="font-medium">You are impersonating this tenant as a central admin</span>
                    </div>
                    <form method="POST" action="{{ route('end-impersonation') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="rounded-sm bg-red-600 px-3 py-1 text-sm font-medium text-white transition-colors hover:bg-red-700"
                            onclick="return confirm('Are you sure you want to end impersonation?')">
                            End Impersonation
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <div class="h-screen bg-gray-100 dark:bg-gray-900">
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
                        class="sidebar-transition fixed inset-y-0 left-0 z-30 flex h-full w-64 flex-col bg-white shadow-lg dark:bg-gray-800 lg:static lg:translate-x-0">

                        <div
                            class="flex h-16 shrink-0 items-center justify-center border-b border-gray-200 px-6 dark:border-gray-700">
                            <div class="flex items-center justify-center">
                                @if (tenant('logo'))
                                    <img src="{{ route('tenant.file', tenant('logo')) }}"
                                        alt="{{ tenant('name') ?? 'School' }}"
                                        class="h-12 w-12 rounded-full object-cover"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                @endif
                                <!-- Fallback logo -->
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-500 text-lg font-bold text-white"
                                    style="{{ tenant('logo') ? 'display: none;' : 'display: flex;' }}">
                                    {{ strtoupper(substr(tenant('name') ?? 'S', 0, 1)) }}
                                </div>
                            </div>
                            <button @click="sidebarOpen = false"
                                class="text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 lg:hidden">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Navigation -->
                        <nav class="sidebar-scrollbar mt-6 min-h-0 flex-1 overflow-y-auto px-3 pb-6">
                            <div class="space-y-1">
                                <!-- Dashboard -->
                                <a href="{{ route('dashboard') }}"
                                    class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }}">
                                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path>
                                    </svg>
                                    Dashboard
                                </a>

                                <!-- Students Section -->
                                <div x-data="{ open: false }" class="space-y-1">
                                    <button @click="open = !open"
                                        class="sidebar-nav-item sidebar-nav-item-inactive w-full justify-between">
                                        <div class="flex items-center">
                                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                                </path>
                                            </svg>
                                            Students
                                        </div>
                                        <svg class="h-4 w-4 transition-transform duration-150"
                                            :class="{ 'rotate-90': open }" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" x-transition class="ml-6 space-y-1">
                                        <a href="{{ route('tenant.students') }}" class="sidebar-submenu-item">All
                                            Students</a>
                                        <a href="{{ route('tenant.students.create') }}"
                                            class="sidebar-submenu-item">Add Student</a>
                                    </div>
                                </div>

                                <!-- Teachers Section -->
                                <div x-data="{ open: false }" class="space-y-1">
                                    <button @click="open = !open"
                                        class="sidebar-nav-item sidebar-nav-item-inactive w-full justify-between">
                                        <div class="flex items-center">
                                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            Teachers
                                        </div>
                                        <svg class="h-4 w-4 transition-transform duration-150"
                                            :class="{ 'rotate-90': open }" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" x-transition class="ml-6 space-y-1">
                                        <a href="{{ route('tenant.teachers') }}" class="sidebar-submenu-item">All
                                            Teachers</a>
                                        <a href="{{ route('tenant.teachers.create') }}"
                                            class="sidebar-submenu-item">Add Teacher</a>
                                    </div>
                                </div>

                                <!-- Courses Section -->
                                <div x-data="{ open: false }" class="space-y-1">
                                    <button @click="open = !open"
                                        class="sidebar-nav-item sidebar-nav-item-inactive w-full justify-between">
                                        <div class="flex items-center">
                                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                </path>
                                            </svg>
                                            Classes
                                        </div>
                                        <svg class="h-4 w-4 transition-transform duration-150"
                                            :class="{ 'rotate-90': open }" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" x-transition class="ml-6 space-y-1">
                                        <a href="{{ route('tenant.classes') }}" class="sidebar-submenu-item">All
                                            Classes</a>
                                        <a href="{{ route('tenant.classes.create') }}"
                                            class="sidebar-submenu-item">Create Class</a>
                                        <a href="#" class="sidebar-submenu-item">Schedules</a>
                                    </div>
                                </div>

                                <!-- Attendance -->
                                <a href="{{ route('tenant.users') }}"
                                    class="sidebar-nav-item sidebar-nav-item-inactive">
                                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    Users
                                </a>

                                <!-- Announcements Section -->
                                @can('view announcements')
                                    <div x-data="{ open: false }" class="space-y-1">
                                        <button @click="open = !open"
                                            class="sidebar-nav-item sidebar-nav-item-inactive w-full justify-between">
                                            <div class="flex items-center">
                                                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                                    </path>
                                                </svg>
                                                Announcements
                                            </div>
                                            <svg class="h-4 w-4 transition-transform duration-200"
                                                :class="{ 'rotate-90': open }" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="open" x-transition class="ml-6 space-y-1">
                                            <a href="{{ route('tenant.announcements.my') }}"
                                                class="sidebar-submenu-item">My Announcements</a>
                                            @can('manage announcements')
                                                <a href="{{ route('tenant.announcements.index') }}"
                                                    class="sidebar-submenu-item">Manage Announcements</a>
                                            @endcan
                                            @can('create announcements')
                                                <a href="{{ route('tenant.announcements.create') }}"
                                                    class="sidebar-submenu-item">Create Announcement</a>
                                            @endcan
                                        </div>
                                    </div>
                                @endcan

                                <!-- Calendar Events Section -->
                                @can('view calendar events')
                                    <div x-data="{ open: false }" class="space-y-1">
                                        <button @click="open = !open"
                                            class="sidebar-nav-item sidebar-nav-item-inactive w-full justify-between">
                                            <div class="flex items-center">
                                                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Calendar
                                            </div>
                                            <svg class="h-4 w-4 transition-transform duration-200"
                                                :class="{ 'rotate-90': open }" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                        <div x-show="open" x-transition class="ml-6 space-y-1">
                                            <a href="{{ route('tenant.calendar-events.user') }}"
                                                class="sidebar-submenu-item">My Calendar</a>
                                            @can('manage calendar events')
                                                <a href="{{ route('tenant.calendar-events.index') }}"
                                                    class="sidebar-submenu-item">Manage Events</a>
                                            @endcan
                                            @can('create calendar events')
                                                <a href="{{ route('tenant.calendar-events.create') }}"
                                                    class="sidebar-submenu-item">Create Event</a>
                                            @endcan
                                        </div>
                                    </div>
                                @endcan

                                <!-- Reports -->
                                <a href="#" class="sidebar-nav-item sidebar-nav-item-inactive">
                                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                    Reports
                                </a>

                                <!-- Messages -->
                                <a href="{{ route('tenant.messages.index') }}"
                                    class="sidebar-nav-item {{ request()->routeIs('tenant.messages.*') ? 'sidebar-nav-item-active' : 'sidebar-nav-item-inactive' }}">
                                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
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
                                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                    Support
                                </a>

                                <!-- Settings -->
                                <a href="{{ route('settings') }}" class="sidebar-nav-item sidebar-nav-item-inactive">
                                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Settings
                                </a>
                            </div>

                            <!-- User menu at bottom -->
                            <div class="shrink-0 border-t border-gray-200 pt-6 dark:border-gray-700">
                                <div x-data="{ userMenuOpen: false }" class="relative">
                                    <button @click="userMenuOpen = !userMenuOpen"
                                        class="flex w-full items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 transition-colors duration-150 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                        <div
                                            class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-blue-500 text-xs font-semibold text-white">
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
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                @auth
                                                    {{ Auth::user()->email ?? '' }}
                                                @else
                                                    guest@example.com
                                                @endauth
                                            </div>
                                        </div>
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <!-- User dropdown -->
                                    <div x-show="userMenuOpen" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        @click.away="userMenuOpen = false"
                                        class="absolute bottom-full left-0 right-0 mb-2 rounded-md border border-gray-200 bg-white py-1 shadow-lg dark:border-gray-600 dark:bg-gray-700">
                                        <a href="{{ route('profile.edit') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">Profile</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
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
                        class="shrink-0 border-b border-gray-200 bg-white shadow-xs dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                            <!-- Mobile menu button -->
                            <button @click="sidebarOpen = true"
                                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 lg:hidden">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
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
                                        class="relative rounded-md p-1 text-gray-500 transition-colors duration-200 hover:text-gray-700 focus:outline-hidden focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800">
                                        {{ svg('ri-notification-fill', ['class' => 'h-6 w-6 ml-2 hover:text-red-500']) }}
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
                                        class="absolute right-0 top-full z-9999 mt-2 w-80 rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800">

                                        <!-- Dropdown header -->
                                        <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                                            <div class="flex items-center justify-between">
                                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Recent
                                                    Activity</h3>
                                                <span x-text="activities.length"
                                                    class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300"></span>
                                            </div>
                                        </div>

                                        <!-- Activity list (preview) -->
                                        <div class="max-h-64 overflow-y-auto">
                                            <template x-for="(activity, index) in activities.slice(0, 5)"
                                                :key="index">
                                                <div
                                                    class="border-b border-gray-100 px-4 py-3 last:border-b-0 hover:bg-gray-50 dark:border-gray-700/50 dark:hover:bg-gray-700/50">
                                                    <div class="flex items-start space-x-3">
                                                        <!-- Activity icon -->
                                                        <div class="shrink-0">
                                                            <div :class="{
                                                                'bg-blue-100 dark:bg-blue-900/30': activity
                                                                    .type === 'enrollment',
                                                                'bg-purple-100 dark:bg-purple-900/30': activity
                                                                    .type === 'staff',
                                                                'bg-green-100 dark:bg-green-900/30': activity
                                                                    .type === 'announcement',
                                                                'bg-yellow-100 dark:bg-yellow-900/30': activity
                                                                    .type === 'class',
                                                                'bg-indigo-100 dark:bg-indigo-900/30': activity
                                                                    .type === 'attendance'
                                                            }"
                                                                class="flex h-6 w-6 items-center justify-center rounded-full">
                                                                <!-- Icon based on type -->
                                                                <svg class="h-3 w-3"
                                                                    :class="{
                                                                        'text-blue-600 dark:text-blue-400': activity
                                                                            .type === 'enrollment',
                                                                        'text-purple-600 dark:text-purple-400': activity
                                                                            .type === 'staff',
                                                                        'text-green-600 dark:text-green-400': activity
                                                                            .type === 'announcement',
                                                                        'text-yellow-600 dark:text-yellow-400': activity
                                                                            .type === 'class',
                                                                        'text-indigo-600 dark:text-indigo-400': activity
                                                                            .type === 'attendance'
                                                                    }"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <!-- Enrollment icon -->
                                                                    <path x-show="activity.type === 'enrollment'"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                                                    </path>
                                                                    <!-- Staff icon -->
                                                                    <path x-show="activity.type === 'staff'"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                    </path>
                                                                    <!-- Announcement icon -->
                                                                    <path x-show="activity.type === 'announcement'"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                                                    </path>
                                                                    <!-- Class icon -->
                                                                    <path x-show="activity.type === 'class'"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                                    </path>
                                                                    <!-- Attendance icon -->
                                                                    <path x-show="activity.type === 'attendance'"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <!-- Activity content -->
                                                        <div class="min-w-0 flex-1">
                                                            <p x-text="activity.activity"
                                                                class="truncate text-xs font-medium text-gray-900 dark:text-white">
                                                            </p>
                                                            <p x-text="activity.time"
                                                                class="text-xs text-gray-500 dark:text-gray-400"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Dropdown footer -->
                                        <div class="border-t border-gray-200 px-4 py-3 dark:border-gray-700">
                                            <button @click="modalOpen = true; notificationOpen = false"
                                                class="w-full text-center text-xs font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
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
                                        class="absolute right-0 top-full z-9999 mt-2 w-80 rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800">
                                        <div class="px-4 py-8 text-center">
                                            <div class="mb-2 text-gray-400">
                                                <svg class="mx-auto h-8 w-8" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 17h5l-5 5v-5zM9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2">
                                                    </path>
                                                </svg>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">No new activities</p>
                                        </div>
                                    </div>

                                    <!-- Full activities modal -->
                                    <div x-show="modalOpen" x-cloak
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        @keydown.escape.window="modalOpen = false"
                                        class="fixed inset-0 z-9999 flex items-center justify-center overflow-y-auto p-4">
                                        <!-- Backdrop -->
                                        <div @click="modalOpen = false"
                                            class="fixed inset-0 z-9998 bg-black bg-opacity-50"></div>

                                        <!-- Modal -->
                                        <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            class="relative z-10000 max-h-[80vh] w-full max-w-2xl overflow-hidden rounded-lg bg-white shadow-xl dark:bg-gray-800">

                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between border-b border-gray-200 p-6 dark:border-gray-700">
                                                <div>
                                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Recent Activities</h2>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage your
                                                        system activities</p>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <button @click="clearAllActivities()"
                                                        x-show="activities.length > 0" :disabled="loading"
                                                        :class="loading ? 'opacity-50 cursor-not-allowed' : ''"
                                                        class="rounded-md border border-red-300 px-3 py-1.5 text-xs font-medium text-red-600 transition-colors hover:border-red-400 hover:bg-red-50 hover:text-red-800 disabled:hover:border-red-300 disabled:hover:bg-transparent dark:border-red-600 dark:text-red-400 dark:hover:border-red-500 dark:hover:bg-red-900/20 dark:hover:text-red-300">
                                                        <span x-show="!loading">Clear All</span>
                                                        <span x-show="loading" class="flex items-center">
                                                            <svg class="-ml-1 mr-1 h-3 w-3 animate-spin"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12"
                                                                    cy="12" r="10" stroke="currentColor"
                                                                    stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor"
                                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                                </path>
                                                            </svg>
                                                            Clearing...
                                                        </span>
                                                    </button>
                                                    <button @click="modalOpen = false"
                                                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                        <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="scrollbar-thin max-h-96 overflow-y-auto p-6">
                                                <div x-show="activities.length > 0" class="space-y-4">
                                                    <template x-for="(activity, index) in activities"
                                                        :key="index">
                                                        <div
                                                            class="group flex items-start space-x-4 rounded-lg border border-gray-200 p-4 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-700/50">
                                                            <!-- Activity icon -->
                                                            <div class="shrink-0">
                                                                <div :class="{
                                                                    'bg-blue-100 dark:bg-blue-900/30': activity
                                                                        .type === 'enrollment',
                                                                    'bg-purple-100 dark:bg-purple-900/30': activity
                                                                        .type === 'staff',
                                                                    'bg-green-100 dark:bg-green-900/30': activity
                                                                        .type === 'announcement',
                                                                    'bg-yellow-100 dark:bg-yellow-900/30': activity
                                                                        .type === 'class',
                                                                    'bg-indigo-100 dark:bg-indigo-900/30': activity
                                                                        .type === 'attendance'
                                                                }"
                                                                    class="flex h-10 w-10 items-center justify-center rounded-full">
                                                                    <svg class="h-5 w-5"
                                                                        :class="{
                                                                            'text-blue-600 dark:text-blue-400': activity
                                                                                .type === 'enrollment',
                                                                            'text-purple-600 dark:text-purple-400': activity
                                                                                .type === 'staff',
                                                                            'text-green-600 dark:text-green-400': activity
                                                                                .type === 'announcement',
                                                                            'text-yellow-600 dark:text-yellow-400': activity
                                                                                .type === 'class',
                                                                            'text-indigo-600 dark:text-indigo-400': activity
                                                                                .type === 'attendance'
                                                                        }"
                                                                        fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <!-- Enrollment icon -->
                                                                        <path x-show="activity.type === 'enrollment'"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                                                        </path>
                                                                        <!-- Staff icon -->
                                                                        <path x-show="activity.type === 'staff'"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                        </path>
                                                                        <!-- Announcement icon -->
                                                                        <path x-show="activity.type === 'announcement'"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                                                        </path>
                                                                        <!-- Class icon -->
                                                                        <path x-show="activity.type === 'class'"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                                        </path>
                                                                        <!-- Attendance icon -->
                                                                        <path x-show="activity.type === 'attendance'"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                            </div>

                                                            <!-- Activity content -->
                                                            <div class="min-w-0 flex-1">
                                                                <p x-text="activity.activity"
                                                                    class="text-sm font-medium text-gray-900 dark:text-white">
                                                                </p>
                                                                <div class="mt-1 flex items-center space-x-2">
                                                                    <p x-text="activity.time"
                                                                        class="text-xs text-gray-500 dark:text-gray-400">
                                                                    </p>
                                                                    <span
                                                                        :class="{
                                                                            'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300': activity
                                                                                .type === 'enrollment',
                                                                            'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300': activity
                                                                                .type === 'staff',
                                                                            'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300': activity
                                                                                .type === 'announcement',
                                                                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300': activity
                                                                                .type === 'class',
                                                                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300': activity
                                                                                .type === 'attendance'
                                                                        }"
                                                                        class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium capitalize"
                                                                        x-text="activity.type"></span>
                                                                </div>
                                                            </div>

                                                            <!-- Clear button -->
                                                            <button @click="clearActivity(index)"
                                                                :disabled="loading" title="Clear this activity"
                                                                :class="loading ? 'opacity-50 cursor-not-allowed' :
                                                                    'opacity-0 group-hover:opacity-100'"
                                                                class="rounded-xs p-1 text-gray-400 transition-all hover:text-red-600 focus:outline-hidden focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:hover:text-red-400 dark:focus:ring-offset-gray-800">
                                                                <svg class="h-4 w-4" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>

                                                <!-- Empty state -->
                                                <div x-show="activities.length === 0" class="py-12 text-center">
                                                    <div class="mb-4 text-gray-400">
                                                        <svg class="mx-auto h-12 w-12" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <h3 class="mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                                        No activities</h3>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">All activities
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
                    <main class="flex-1 overflow-y-auto bg-gray-100 dark:bg-gray-900">
                        {{ $slot }}
                    </main>

                    <!-- Footer -->
                    <footer
                        class="shrink-0 border-t border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    © {{ date('Y') }} {{ tenant('name') ?? config('app.name') }}. All rights
                                    reserved.
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    @if (tenant('website'))
                                        <a href="{{ tenant('website') }}" target="_blank"
                                            class="hover:text-gray-900 dark:hover:text-gray-100">
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
