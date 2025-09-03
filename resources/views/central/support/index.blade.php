@extends('central.layout')

@section('title', 'Support Tickets')

@section('content')
    <div class="container mx-auto px-4 py-8 transition-colors duration-200">
        <div class="mb-8">
            <h1
                class="text-3xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                Support Tickets</h1>
            <p class="mt-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Manage support
                requests from all tenants</p>
        </div>

        <!-- Analytics Dashboard -->
        <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Tickets -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Total Tickets</dt>
                            <dd
                                class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ number_format($analytics['total_tickets']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Unassigned Tickets -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 18.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Unassigned</dt>
                            <dd class="text-lg font-medium text-orange-600 dark:text-orange-400">
                                {{ number_format($analytics['unassigned_count']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Average Response Time -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Avg Response</dt>
                            <dd class="text-lg font-medium text-blue-600 dark:text-blue-400">
                                {{ $analytics['avg_response_time'] }}h</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Last 7 Days</dt>
                            <dd class="text-lg font-medium text-green-600 dark:text-green-400">
                                {{ number_format($analytics['recent_activity']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workflow Automation Analytics -->
        <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- SLA Status Breakdown -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                SLA On Track</dt>
                            <dd class="text-lg font-medium text-green-600 dark:text-green-400">
                                {{ $analytics['sla_stats']['on_track'] ?? 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- SLA Warnings -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 18.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                SLA Warning</dt>
                            <dd class="text-lg font-medium text-yellow-600 dark:text-yellow-400">
                                {{ $analytics['sla_stats']['warning'] ?? 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- SLA Breached -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 6h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                SLA Breached</dt>
                            <dd class="text-lg font-medium text-red-600 dark:text-red-400">
                                {{ $analytics['sla_stats']['breached'] ?? 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Escalated Tickets -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt
                                class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Escalated</dt>
                            <dd class="text-lg font-medium text-purple-600 dark:text-purple-400">
                                {{ $analytics['escalation_stats']['escalated_tickets'] ?? 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status and Priority Breakdown -->
        <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Status Breakdown -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <h3
                    class="mb-4 text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Status Breakdown</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-3 h-3 w-3 rounded-full bg-red-500"></div>
                            <span
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Open</span>
                        </div>
                        <span
                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $analytics['status_stats']['open'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-3 h-3 w-3 rounded-full bg-yellow-500"></div>
                            <span
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">In
                                Progress</span>
                        </div>
                        <span
                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $analytics['status_stats']['in_progress'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-3 h-3 w-3 rounded-full bg-green-500"></div>
                            <span
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Resolved</span>
                        </div>
                        <span
                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $analytics['status_stats']['resolved'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-3 h-3 w-3 rounded-full bg-gray-500"></div>
                            <span
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Closed</span>
                        </div>
                        <span
                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $analytics['status_stats']['closed'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Priority Breakdown -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <h3
                    class="mb-4 text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Priority Breakdown</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-3 h-3 w-3 rounded-full bg-red-600"></div>
                            <span
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Critical</span>
                        </div>
                        <span
                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $analytics['priority_stats']['critical'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-3 h-3 w-3 rounded-full bg-orange-500"></div>
                            <span
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">High</span>
                        </div>
                        <span
                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $analytics['priority_stats']['high'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-3 h-3 w-3 rounded-full bg-yellow-500"></div>
                            <span
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Medium</span>
                        </div>
                        <span
                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $analytics['priority_stats']['medium'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-3 h-3 w-3 rounded-full bg-green-500"></div>
                            <span
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Low</span>
                        </div>
                        <span
                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $analytics['priority_stats']['low'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Analytics: Top Tenants and Admin Workload -->
        <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Top Active Tenants -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <h3
                    class="mb-4 text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Most Active Tenants</h3>
                @if ($analytics['top_tenants']->count() > 0)
                    <div class="space-y-3">
                        @foreach ($analytics['top_tenants'] as $tenant)
                            <div class="flex items-center justify-between">
                                <span
                                    class="truncate text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">{{ Str::limit($tenant->name, 20) }}</span>
                                <div class="flex items-center">
                                    <div
                                        class="mr-3 h-2 w-16 rounded-full bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                                        <div class="h-2 rounded-full bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)]"
                                            style="width: {{ min(100, ($tenant->ticket_count / max($analytics['top_tenants']->max('ticket_count'), 1)) * 100) }}%">
                                        </div>
                                    </div>
                                    <span
                                        class="w-8 text-right text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $tenant->ticket_count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">No
                        data available</p>
                @endif
            </div>

            <!-- Admin Workload -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <h3
                    class="mb-4 text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Admin Workload</h3>
                @if ($analytics['admin_workload']->count() > 0)
                    <div class="space-y-3">
                        @foreach ($analytics['admin_workload'] as $admin)
                            <div class="flex items-center justify-between">
                                <span
                                    class="truncate text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">{{ Str::limit($admin->name, 20) }}</span>
                                <div class="flex items-center">
                                    <div
                                        class="mr-3 h-2 w-16 rounded-full bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                                        <div class="h-2 rounded-full bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)]"
                                            style="width: {{ min(100, ($admin->ticket_count / max($analytics['admin_workload']->max('ticket_count'), 1)) * 100) }}%">
                                        </div>
                                    </div>
                                    <span
                                        class="w-8 text-right text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $admin->ticket_count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">No
                        assigned tickets</p>
                @endif
            </div>
        </div>

        <!-- Category Breakdown -->
        <div class="mb-8">
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <h3
                    class="mb-4 text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Category Distribution</h3>
                <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                            {{ $analytics['category_stats']['technical'] }}</div>
                        <div
                            class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Technical</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                            {{ $analytics['category_stats']['billing'] }}</div>
                        <div
                            class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Billing</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                            {{ $analytics['category_stats']['feature_request'] }}</div>
                        <div
                            class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Feature Request</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-600 dark:text-gray-400">
                            {{ $analytics['category_stats']['general'] }}</div>
                        <div
                            class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            General</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div
            class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <form method="GET" action="{{ route('central.support.index') }}"
                class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-6">
                <div>
                    <label for="search"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Ticket number, title..."
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                </div>

                <div>
                    <label for="status"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Status</label>
                    <select name="status" id="status"
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <option value="">All Statuses</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div>
                    <label for="priority"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Priority</label>
                    <select name="priority" id="priority"
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <option value="">All Priorities</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="critical" {{ request('priority') == 'critical' ? 'selected' : '' }}>Critical
                        </option>
                    </select>
                </div>

                <div>
                    <label for="category"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Category</label>
                    <select name="category" id="category"
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <option value="">All Categories</option>
                        <option value="technical" {{ request('category') == 'technical' ? 'selected' : '' }}>Technical
                        </option>
                        <option value="billing" {{ request('category') == 'billing' ? 'selected' : '' }}>Billing</option>
                        <option value="feature_request" {{ request('category') == 'feature_request' ? 'selected' : '' }}>
                            Feature Request</option>
                        <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>General</option>
                    </select>
                </div>

                <div>
                    <label for="assigned_admin"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Assigned
                        Admin</label>
                    <select name="assigned_admin" id="assigned_admin"
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <option value="">All Admins</option>
                        @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}"
                                {{ request('assigned_admin') == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end space-x-2">
                    <button type="submit"
                        class="focus:outline-hidden rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        Filter
                    </button>
                    <a href="{{ route('central.support.index') }}"
                        class="focus:outline-hidden rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)] dark:focus:ring-[color:var(--color-castleton-green)]">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Tickets List -->
        <div
            class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <div
                class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                <h2
                    class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Support Tickets ({{ $tickets->total() }})</h2>
            </div>
            <div class="overflow-x-auto">
                @if ($tickets->count() > 0)
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                        <thead class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Ticket</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Tenant</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Priority</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Assigned</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Created</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    SLA Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            @foreach ($tickets as $ticket)
                                <tr
                                    class="transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div>
                                            <div
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                {{ $ticket->ticket_number }}
                                            </div>
                                            <div
                                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ Str::limit($ticket->title, 40) }}</div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $ticket->tenant->name ?? 'Unknown' }}</div>
                                        <div
                                            class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $ticket->tenant_user_details['name'] ?? 'Unknown User' }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="bg-{{ $ticket->priority_color }}-100 text-{{ $ticket->priority_color }}-800 dark:bg-{{ $ticket->priority_color }}-900 dark:text-{{ $ticket->priority_color }}-200 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors duration-200">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="bg-{{ $ticket->status_color }}-100 text-{{ $ticket->status_color }}-800 dark:bg-{{ $ticket->status_color }}-900 dark:text-{{ $ticket->status_color }}-200 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors duration-200">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $ticket->assignedAdmin->name ?? 'Unassigned' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $ticket->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($ticket->sla_due_at)
                                            <div class="flex flex-col space-y-1">
                                                <span
                                                    class="bg-{{ $ticket->sla_status_color }}-100 text-{{ $ticket->sla_status_color }}-800 dark:bg-{{ $ticket->sla_status_color }}-900 dark:text-{{ $ticket->sla_status_color }}-200 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors duration-200">
                                                    {{ $ticket->sla_status_text }}
                                                </span>
                                                @if ($ticket->sla_due_at)
                                                    <span
                                                        class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                        Due: {{ $ticket->sla_due_at->format('M j, H:i') }}
                                                    </span>
                                                @endif
                                                @if ($ticket->escalation_level > 0)
                                                    <span class="text-xs font-medium text-purple-600 dark:text-purple-400">
                                                        ⬆️ Level {{ $ticket->escalation_level }}
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span
                                                class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                No SLA
                                            </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('central.support.show', $ticket) }}"
                                                class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                View
                                            </a>

                                            @if (!$ticket->assigned_admin_id)
                                                <button onclick="triggerAutoAssignment({{ $ticket->id }})"
                                                    class="text-xs text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    Auto-Assign
                                                </button>
                                            @endif

                                            @if (!$ticket->sla_policy_id)
                                                <button onclick="applySlaPolicy({{ $ticket->id }})"
                                                    class="text-xs text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300">
                                                    Apply SLA
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m0 0V6a2 2 0 012-2h2a2 2 0 012 2v2">
                            </path>
                        </svg>
                        <h3
                            class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            No tickets found</h3>
                        <p
                            class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            No support tickets match your current filters.</p>
                    </div>
                @endif
            </div>

            @if ($tickets->hasPages())
                <div
                    class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                    {{ $tickets->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function triggerAutoAssignment(ticketId) {
            if (!confirm('Are you sure you want to trigger auto-assignment for this ticket?')) {
                return;
            }

            fetch(`/central/support/tickets/${ticketId}/auto-assign`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Failed to auto-assign ticket');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while auto-assigning the ticket');
                });
        }

        function applySlaPolicy(ticketId) {
            if (!confirm('Are you sure you want to apply SLA policy to this ticket?')) {
                return;
            }

            fetch(`/central/support/tickets/${ticketId}/apply-sla`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Failed to apply SLA policy');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while applying SLA policy');
                });
        }

        function escalateTicket(ticketId) {
            if (!confirm('Are you sure you want to escalate this ticket?')) {
                return;
            }

            fetch(`/central/support/tickets/${ticketId}/escalate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Failed to escalate ticket');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while escalating the ticket');
                });
        }
    </script>
@endsection
