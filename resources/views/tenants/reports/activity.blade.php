<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                {{ __('Activity Report') }}
            </h2>
            <div class="flex items-center gap-4">
                <a href="{{ route('tenant.reports.activity', array_merge(request()->all(), ['format' => 'csv'])) }}"
                    class="focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <i class="fas fa-download h-4 w-4"></i>
                    Export CSV
                </a>
                <a href="{{ route('tenant.reports.index') }}"
                    class="focus:outline-hidden inline-flex items-center gap-2 rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                    <i class="fas fa-arrow-left h-4 w-4"></i>
                    Back to Reports
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-6">
        <!-- Filters -->
        <div
            class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
            <form method="GET" action="{{ route('tenant.reports.activity') }}" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label for="activity_type"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Activity
                            Type</label>
                        <select name="activity_type" id="activity_type"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <option value="">All Activities</option>
                            <option value="login" {{ $activityType === 'login' ? 'selected' : '' }}>Login</option>
                            <option value="attendance" {{ $activityType === 'attendance' ? 'selected' : '' }}>Attendance
                            </option>
                            <option value="student_created" {{ $activityType === 'student_created' ? 'selected' : '' }}>
                                Student Created</option>
                            <option value="class_created" {{ $activityType === 'class_created' ? 'selected' : '' }}>
                                Class Created</option>
                            <option value="report_generated"
                                {{ $activityType === 'report_generated' ? 'selected' : '' }}>Report Generated</option>
                            <option value="user_action" {{ $activityType === 'user_action' ? 'selected' : '' }}>User
                                Action</option>
                        </select>
                    </div>
                    <div>
                        <label for="user_id"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">User</label>
                        <select name="user_id" id="user_id"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <option value="">All Users</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $userId == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ ucfirst($user->role) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="start_date"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Start
                            Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                    </div>
                    <div>
                        <label for="end_date"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">End
                            Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-search h-4 w-4"></i>
                        Generate Report
                    </button>
                </div>
            </form>
        </div>

        <!-- Statistics -->
        <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-chart-line h-8 w-8 text-blue-500"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Total Activities</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ number_format($stats['total_activities']) }}</p>
                    </div>
                </div>
            </div>
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-users h-8 w-8 text-green-500"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Active Users</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ number_format($stats['active_users']) }}</p>
                    </div>
                </div>
            </div>
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-calendar-day h-8 w-8 text-purple-500"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Today's Activities</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ number_format($stats['today_activities']) }}</p>
                    </div>
                </div>
            </div>
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i
                            class="fas fa-clock h-8 w-8 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-brunswick-green)]"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Avg. Daily</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $stats['avg_daily_activities'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Charts -->
        <div class="mb-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Activity Types Chart -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div
                    class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Activity Types</h3>
                </div>
                <div class="p-6">
                    @if ($activityTypes->count() > 0)
                        <div class="space-y-4">
                            @foreach ($activityTypes as $type)
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="mb-1 flex items-center justify-between">
                                            <span
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">{{ ucfirst(str_replace('_', ' ', $type->activity_type)) }}</span>
                                            <span
                                                class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">{{ $type->count }}
                                                activities</span>
                                        </div>
                                        <div
                                            class="h-2 w-full rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                            <div class="h-2 rounded-full bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]"
                                                style="width: {{ $stats['total_activities'] > 0 ? ($type->count / $stats['total_activities']) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p
                            class="text-center text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            No activity data available.</p>
                    @endif
                </div>
            </div>

            <!-- Daily Activity Trend -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div
                    class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Daily Activity Trend (Last 7 Days)</h3>
                </div>
                <div class="p-6">
                    @if ($dailyActivities->count() > 0)
                        <div class="space-y-4">
                            @foreach ($dailyActivities as $day)
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="mb-1 flex items-center justify-between">
                                            <span
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">{{ \Carbon\Carbon::parse($day->date)->format('M d, Y') }}</span>
                                            <span
                                                class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">{{ $day->count }}
                                                activities</span>
                                        </div>
                                        <div
                                            class="h-2 w-full rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                            @php $maxDaily = $dailyActivities->max('count'); @endphp
                                            <div class="h-2 rounded-full bg-blue-500"
                                                style="width: {{ $maxDaily > 0 ? ($day->count / $maxDaily) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p
                            class="text-center text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            No recent activity data available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Activity Log -->
        <div
            class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
            <div
                class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                <h3
                    class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    Recent Activities</h3>
            </div>

            @if ($activities->count() > 0)
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:divide-[color:var(--color-brunswick-green)]">
                        <thead
                            class="bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Time</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    User</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Activity Type</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Description</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    IP Address</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    User Agent</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:divide-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                            @foreach ($activities as $activity)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $activity->created_at->format('M d, Y H:i:s') }}
                                        <br><span
                                            class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">{{ $activity->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $activity->user->name }}
                                        <br><span
                                            class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">{{ ucfirst($activity->user->role ?? 'user') }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="@if ($activity->activity_type === 'login') bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-200
                                            @elseif($activity->activity_type === 'attendance') bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-200
                                            @elseif(str_contains($activity->activity_type, 'created')) bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-200
                                            @elseif($activity->activity_type === 'report_generated') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-200
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-200 @endif inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ ucfirst(str_replace('_', ' ', $activity->activity_type)) }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $activity->description ?: '-' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $activity->ip_address ?: '-' }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $activity->user_agent ? Str::limit($activity->user_agent, 50) : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($activities->hasPages())
                    <div
                        class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                        {{ $activities->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="py-12 text-center">
                    <i
                        class="fas fa-chart-line mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                    <h3
                        class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        No activities found</h3>
                    <p
                        class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Try adjusting your filters or wait for some user activity.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-tenant-dash-component>
