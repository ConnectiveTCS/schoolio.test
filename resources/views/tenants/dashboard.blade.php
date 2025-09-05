<x-tenant-dash-component :dashboardData="$dashboardData">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                {{ __('Dashboard') }}
            </h2>
            <div
                class="flex items-center gap-x-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                <!-- Theme Toggle Button -->
                <button onclick="toggleTheme()"
                    class="focus:outline-hidden rounded-lg p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-brunswick-green)] dark:hover:text-[color:var(--color-light-dark-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]"
                    title="Toggle theme">
                    <!-- Sun icon (visible in dark mode) -->
                    <i class="fas fa-sun hidden h-6 w-6 dark:block"></i>
                    <!-- Moon icon (visible in light mode) -->
                    <i class="fas fa-moon block h-6 w-6 dark:hidden"></i>
                </button>
                Welcome to {{ $tenant->name ?? 'School Management System' }}
            </div>
        </div>
    </x-slot>

    <div
        class="bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="mx-auto max-w-7xl">
            <!-- Dashboard Stats -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div
                    class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-lg bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                <i
                                    class="fas fa-user-graduate h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <div class="ml-4">
                                <p
                                    class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Total Students</p>
                                <p
                                    class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ number_format($dashboardData['total_students']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-lg bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                <i
                                    class="fas fa-chalkboard-teacher h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <div class="ml-4">
                                <p
                                    class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Classes</p>
                                <p
                                    class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $dashboardData['active_courses'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-lg bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                <i
                                    class="fas fa-users h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <div class="ml-4">
                                <p
                                    class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Teachers</p>
                                <p
                                    class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $dashboardData['total_teachers'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-lg bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                <i
                                    class="fas fa-chart-line h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <div class="ml-4">
                                <p
                                    class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Attendance Rate</p>
                                <p
                                    class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $dashboardData['attendance_rate'] }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity and Quick Actions -->
            <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Recent Activity -->
                <div
                    class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg lg:col-span-2 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3
                                class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Recent Activity</h3>
                            <span
                                class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">Last
                                7 days</span>
                        </div>
                        <div class="space-y-4">
                            @forelse ($dashboardData['recent_activities'] as $activity)
                                <div class="flex items-start space-x-3">
                                    <div class="shrink-0">
                                        @if ($activity['type'] === 'enrollment')
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                                <i
                                                    class="fas fa-user-plus h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            </div>
                                        @elseif($activity['type'] === 'staff')
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                                <i
                                                    class="fas fa-user-tie h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            </div>
                                        @elseif($activity['type'] === 'announcement')
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                                <i
                                                    class="fas fa-bullhorn h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            </div>
                                        @elseif($activity['type'] === 'class')
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                                <i
                                                    class="fas fa-chalkboard h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            </div>
                                        @elseif($activity['type'] === 'attendance')
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                                <i
                                                    class="fas fa-clipboard-check h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            </div>
                                        @else
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                                <i
                                                    class="fas fa-info-circle h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p
                                            class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $activity['activity'] }}</p>
                                        <p
                                            class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $activity['time'] }}</p>
                                    </div>
                                    <div class="shrink-0">
                                        @if ($activity['type'] === 'enrollment')
                                            <span
                                                class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] px-2 py-0.5 text-xs font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                                Student
                                            </span>
                                        @elseif($activity['type'] === 'staff')
                                            <span
                                                class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] px-2 py-0.5 text-xs font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                                Staff
                                            </span>
                                        @elseif($activity['type'] === 'announcement')
                                            <span
                                                class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] px-2 py-0.5 text-xs font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                                News
                                            </span>
                                        @elseif($activity['type'] === 'class')
                                            <span
                                                class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] px-2 py-0.5 text-xs font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                                Class
                                            </span>
                                        @elseif($activity['type'] === 'attendance')
                                            <span
                                                class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] px-2 py-0.5 text-xs font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                                Attendance
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <div
                                        class="mb-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-clock mx-auto h-8 w-8"></i>
                                    </div>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        No recent activity</p>
                                    <p
                                        class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        System activity will
                                        appear here</p>
                                </div>
                            @endforelse
                        </div>
                        @if (count($dashboardData['recent_activities']) > 0)
                            <div class="mt-6 text-center">
                                <button
                                    class="text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                    View all activity →
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div
                    class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <h3
                            class="mb-4 text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Quick Actions</h3>
                        <div class="space-y-3">
                            <button
                                class="focus:outline-hidden flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                <i class="fas fa-user-plus mr-2 h-4 w-4"></i>
                                Add Student
                            </button>
                            <button
                                class="focus:outline-hidden flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                <i class="fas fa-chalkboard mr-2 h-4 w-4"></i>
                                Create Course
                            </button>
                            <button
                                class="focus:outline-hidden flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                <i class="fas fa-clipboard-check mr-2 h-4 w-4"></i>
                                Take Attendance
                            </button>
                            <button
                                class="focus:outline-hidden flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                <i class="fas fa-chart-bar mr-2 h-4 w-4"></i>
                                Generate Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events and Announcements -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Upcoming Events -->
                <div
                    class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3
                                class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Upcoming Events</h3>
                            @can('view calendar events')
                                <a href="{{ route('tenant.calendar-events.user') }}"
                                    class="text-xs text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">View
                                    All →</a>
                            @endcan
                        </div>
                        <div class="space-y-4">
                            @foreach ($dashboardData['upcoming_events'] as $index => $event)
                                <div
                                    class="@if ($index === 0) border-l-[color:var(--color-castleton-green)] @elseif($index === 1) border-l-[color:var(--color-brunswick-green)] @else border-l-[color:var(--color-gunmetal)] @endif border-l-4 pl-4 transition-colors duration-200">
                                    <p
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $event['title'] }}
                                    </p>
                                    <p
                                        class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $event['date'] }}@if ($event['time'])
                                            • {{ $event['time'] }}
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Announcements -->
                <div
                    class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3
                                class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Recent Announcements</h3>
                            <div class="flex items-center gap-2">
                                @can('create announcements')
                                    <a href="{{ route('tenant.announcements.create') }}"
                                        class="shadow-xs focus:outline-hidden inline-flex items-center gap-1 rounded-md bg-[color:var(--color-castleton-green)] px-3 py-1.5 text-xs font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                        <i class="fas fa-plus h-3 w-3"></i>
                                        Create
                                    </a>
                                @endcan
                                @can('manage announcements')
                                    <a href="{{ route('tenant.announcements.index') }}"
                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                        Manage
                                    </a>
                                @endcan
                                @can('view announcements')
                                    <a href="{{ route('tenant.announcements.my') }}"
                                        class="text-sm text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                        View All →
                                    </a>
                                @endcan
                            </div>
                        </div>
                        <div class="space-y-4">
                            @forelse ($dashboardData['announcements'] as $announcement)
                                <div
                                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <p
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                {{ $announcement->title }}
                                            </p>
                                            <p
                                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ Str::limit($announcement->content, 100) }}
                                            </p>
                                            <div
                                                class="mt-2 flex items-center gap-2 text-xs text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]">
                                                <span>By {{ $announcement->creator->name }}</span>
                                                <span>•</span>
                                                <span>{{ $announcement->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('tenant.announcements.show', $announcement) }}"
                                            class="ml-3 text-xs text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                            Read →
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="py-6 text-center">
                                    <div
                                        class="mb-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-bullhorn mx-auto h-8 w-8"></i>
                                    </div>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        No announcements available</p>
                                    @can('create announcements')
                                        <div class="mt-4">
                                            <a href="{{ route('tenant.announcements.create') }}"
                                                class="shadow-xs focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                                <i class="fas fa-plus h-4 w-4"></i>
                                                Create First Announcement
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
