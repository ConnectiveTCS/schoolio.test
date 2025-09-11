<div class="mx-auto max-w-7xl">
    <!-- Welcome Section -->
    <div class="mb-8">
        <div
            class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
            <div class="flex items-center justify-between p-6">
                <div class="flex-1">
                    <h2
                        class="text-xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Welcome back, {{ Auth::user()->name }}!
                    </h2>
                    <p
                        class="mt-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Student Dashboard - View your classes, attendance, and school announcements
                    </p>
                </div>
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                    <i class="fas fa-user-graduate h-8 w-8 text-[color:var(--color-light-dark-green)]"></i>
                </div>
            </div>
        </div>
    </div>

    @php
        $user = Auth::user();
        $student = $user->student ?? null;
        $myClasses = $student ? $student->activeClasses()->with('teacher.user')->get() : collect();
        $recentAttendance = $student
            ? $student->attendances()->with('tenantClass')->orderBy('date', 'desc')->limit(5)->get()
            : collect();
        $attendanceRate = 0;

        // Calculate attendance rate for the current month
        if ($student) {
            $monthlyAttendances = $student
                ->attendances()
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->get();

            if ($monthlyAttendances->count() > 0) {
                $presentCount = $monthlyAttendances->whereIn('status', ['present', 'late'])->count();
                $attendanceRate = round(($presentCount / $monthlyAttendances->count()) * 100, 1);
            }
        }
    @endphp

    <!-- Student Statistics -->
    <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <div
            class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
            <div class="p-6">
                <div class="flex items-center">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-lg bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <i
                            class="fas fa-chalkboard h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            My Classes</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $myClasses->count() }}</p>
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
                            class="fas fa-clipboard-check h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Attendance Rate</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $attendanceRate }}%</p>
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
                            class="fas fa-calendar-day h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Days This Month</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $student ? $student->attendances()->whereMonth('date', now()->month)->whereYear('date', now()->year)->count() : 0 }}
                        </p>
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
                            class="fas fa-bullhorn h-6 w-6 text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            New Announcements</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $dashboardData['announcements']->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- My Classes and Recent Activity -->
    <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- My Classes -->
        <div
            class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg lg:col-span-2 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
            <div class="p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h3
                        class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        My Classes</h3>
                    @can('view classes')
                        <a href="{{ route('tenant.classes') }}"
                            class="text-sm text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                            View All →
                        </a>
                    @endcan
                </div>
                @if ($myClasses->count() > 0)
                    <div class="grid gap-4 md:grid-cols-2">
                        @foreach ($myClasses as $class)
                            <div
                                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4
                                            class="font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $class->name }}
                                        </h4>
                                        @if ($class->teacher && $class->teacher->user)
                                            <p
                                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                Teacher: {{ $class->teacher->user->name }}
                                            </p>
                                        @endif
                                        @if ($class->room)
                                            <p
                                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                Room: {{ $class->room }}
                                            </p>
                                        @endif
                                        @if ($class->schedule)
                                            <p
                                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ $class->schedule }}
                                            </p>
                                        @endif
                                    </div>
                                    <span
                                        class="inline-flex items-center rounded-full bg-[color:var(--color-castleton-green)] px-2 py-1 text-xs font-medium text-white dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)]">
                                        Active
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-8 text-center">
                        <div
                            class="mb-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-chalkboard mx-auto h-8 w-8"></i>
                        </div>
                        <p
                            class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            You are not enrolled in any classes yet</p>
                        <p
                            class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Contact your administrator for enrollment
                        </p>
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
                    @can('view announcements')
                        <a href="{{ route('tenant.announcements.my') }}"
                            class="focus:outline-hidden flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                            <i class="fas fa-bullhorn mr-2 h-4 w-4"></i>
                            View Announcements
                        </a>
                    @endcan

                    @can('view calendar events')
                        <a href="{{ route('tenant.calendar-events.user') }}"
                            class="focus:outline-hidden flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                            <i class="fas fa-calendar mr-2 h-4 w-4"></i>
                            School Calendar
                        </a>
                    @endcan

                    @can('view attendance')
                        <a href="{{ route('tenant.attendance.index') }}"
                            class="focus:outline-hidden flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                            <i class="fas fa-clipboard-check mr-2 h-4 w-4"></i>
                            My Attendance
                        </a>
                    @endcan

                    <a href="{{ route('tenant.support.index') }}"
                        class="focus:outline-hidden flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-life-ring mr-2 h-4 w-4"></i>
                        Get Support
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Attendance and Upcoming Events -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent Attendance -->
        <div
            class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
            <div class="p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h3
                        class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Recent Attendance</h3>
                    @can('view attendance')
                        <a href="{{ route('tenant.attendance.index') }}"
                            class="text-xs text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">View
                            All →</a>
                    @endcan
                </div>
                <div class="space-y-4">
                    @forelse ($recentAttendance as $attendance)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="@if ($attendance->status === 'present') bg-green-100 dark:bg-green-900/20
                                        @elseif($attendance->status === 'late') bg-yellow-100 dark:bg-yellow-900/20
                                        @elseif($attendance->status === 'absent') bg-red-100 dark:bg-red-900/20
                                        @else bg-blue-100 dark:bg-blue-900/20 @endif flex h-8 w-8 items-center justify-center rounded-full">
                                    <i
                                        class="@if ($attendance->status === 'present') fas fa-check text-green-600 dark:text-green-300
                                        @elseif($attendance->status === 'late') fas fa-clock text-yellow-600 dark:text-yellow-300
                                        @elseif($attendance->status === 'absent') fas fa-times text-red-600 dark:text-red-300
                                        @else fas fa-exclamation text-blue-600 dark:text-blue-300 @endif h-4 w-4"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $attendance->tenantClass->name }}
                                    </p>
                                    <p
                                        class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $attendance->date->format('M j, Y') }}
                                    </p>
                                </div>
                            </div>
                            <span
                                class="@if ($attendance->status === 'present') bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300
                                @elseif($attendance->status === 'late') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300
                                @elseif($attendance->status === 'absent') bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300
                                @else bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-300 @endif inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </div>
                    @empty
                        <div class="py-6 text-center">
                            <div
                                class="mb-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-clipboard-check mx-auto h-8 w-8"></i>
                            </div>
                            <p
                                class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                No attendance records yet</p>
                            <p
                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Your attendance will appear here once classes begin
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

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
                                {{ $event['title'] }}</p>
                            <p
                                class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                {{ \Carbon\Carbon::parse($event['start_date'])->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Announcements -->
    @if ($dashboardData['announcements']->count() > 0)
        <div class="mt-8">
            <div
                class="shadow-xs overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="p-6">
                    <div class="mb-4 flex items-center justify-between">
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Recent Announcements</h3>
                        @can('view announcements')
                            <a href="{{ route('tenant.announcements.my') }}"
                                class="text-xs text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">View
                                All →</a>
                        @endcan
                    </div>
                    <div class="space-y-4">
                        @foreach ($dashboardData['announcements'] as $announcement)
                            <div
                                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4
                                            class="font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $announcement->title }}
                                        </h4>
                                        <p
                                            class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ Str::limit($announcement->content, 150) }}
                                        </p>
                                        <p
                                            class="mt-2 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $announcement->created_at->format('M j, Y \a\t g:i A') }}
                                        </p>
                                    </div>
                                    @if ($announcement->priority === 'high')
                                        <span
                                            class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-800 dark:bg-red-900/20 dark:text-red-300">
                                            Important
                                        </span>
                                    @elseif($announcement->priority === 'medium')
                                        <span
                                            class="ml-2 inline-flex items-center rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300">
                                            Notice
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
