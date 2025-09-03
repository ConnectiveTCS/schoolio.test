@extends('central.layout')

@section('title', 'Central Admin Dashboard')

@section('page_title', 'Dashboard')

@section('page_actions')
    <a href="{{ route('central.tenants.create') }}"
        class="shadow-xs focus-visible:outline-solid inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-3 py-2 text-sm font-semibold text-white hover:bg-[color:var(--color-brunswick-green)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
        <i class="fas fa-plus mr-2"></i>New Tenant
    </a>
    <a href="{{ route('central.support.index') }}"
        class="shadow-xs focus-visible:outline-solid inline-flex items-center rounded-md bg-[color:var(--color-gunmetal)] px-3 py-2 text-sm font-semibold text-white hover:bg-[color:var(--color-prussian-blue)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-light-gunmetal)] dark:text-[color:var(--color-gunmetal)] dark:hover:bg-[color:var(--color-light-prussian-blue)]">
        <i class="fas fa-chart-line mr-2"></i>Support Dashboard
    </a>
@endsection

@section('content')
    <div class="min-h-screen transition-colors duration-200">
        <!-- Welcome Section -->
        <div class="mb-8">
            <p class="text-lg text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                Welcome back, {{ $user->name }}! You have {{ $user->role }} permissions.
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div
                class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm dark:border-dark-green dark:bg-dark-green">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i
                                class="fas fa-building text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt
                                    class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Total Tenants</dt>
                                <dd
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    {{ \App\Models\Tenant::count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm dark:border-dark-green dark:bg-dark-green">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-check-circle text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt
                                    class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Active Tenants</dt>
                                <dd
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    {{ \App\Models\Tenant::where('status', 'active')->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm dark:border-dark-green dark:bg-dark-green">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-pause-circle text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt
                                    class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Suspended Tenants</dt>
                                <dd
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    {{ \App\Models\Tenant::where('status', 'suspended')->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm dark:border-dark-green dark:bg-dark-green">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i
                                class="fas fa-users-cog text-2xl text-[color:var(--color-prussian-blue)] dark:text-[color:var(--color-light-prussian-blue)]"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt
                                    class="truncate text-sm font-medium  text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                    Central Admins</dt>
                                <dd
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    {{ \App\Models\CentralAdmin::count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div
            class="mb-8 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm dark:border-dark-green dark:bg-dark-green">
            <div
                class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                <h3
                    class="text-lg font-medium leading-6 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Quick Actions</h3>
            </div>
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    @if ($user->canManageTenants())
                        <a href="{{ route('central.tenants.create') }}"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                            <i class="fas fa-plus mr-2"></i>Create New Tenant
                        </a>
                    @endif

                    <a href="{{ route('central.tenants.index') }}"
                        class="inline-flex items-center justify-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-list mr-2"></i>View All Tenants
                    </a>

                    @if ($user->hasPermission('manage_admins'))
                        <a href="{{ route('central.admins.index') }}"
                            class="inline-flex items-center justify-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                            <i class="fas fa-users-cog mr-2"></i>Manage Admins
                        </a>
                    @endif

                    <button type="button" onclick="exportData()"
                        class="inline-flex items-center justify-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-download mr-2"></i>Export Data
                    </button>
                </div>
            </div>
        </div>

        <!-- System Health & Metrics -->
        <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent Activities -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm dark:border-dark-green dark:bg-dark-green">
                <div
                    class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                    <h3
                        class="text-lg font-medium leading-6 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        Recent System Activities</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="flow-root">
                        <ul class="-mb-8">
                            @forelse(\App\Models\Tenant::latest()->take(5)->get() as $tenant)
                                <li>
                                    <div class="relative pb-8">
                                        @if (!$loop->last)
                                            <span
                                                class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]"
                                                aria-hidden="true"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span
                                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] ring-8 ring-[color:var(--color-light-dark-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:ring-[color:var(--color-brunswick-green)]">
                                                    <i
                                                        class="fas fa-plus text-xs text-white dark:text-[color:var(--color-dark-green)]"></i>
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p
                                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                        New tenant <strong
                                                            class="font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $tenant->name }}</strong>
                                                        created
                                                    </p>
                                                </div>
                                                <div
                                                    class="whitespace-nowrap text-right text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                    {{ $tenant->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li
                                    class="py-6 text-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-inbox mb-2 text-2xl"></i>
                                    <p>No recent activities</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm dark:border-dark-green dark:bg-dark-green">
                <div
                    class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                    <h3
                        class="text-lg font-medium leading-6 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        System Status</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="shrink-0">
                                    <div class="h-2 w-2 rounded-full bg-green-400"></div>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        Database</p>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Operational</p>
                                </div>
                            </div>
                            <div class="text-green-600 dark:text-green-400">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="shrink-0">
                                    <div class="h-2 w-2 rounded-full bg-green-400"></div>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        Tenant Services</p>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ \App\Models\Tenant::where('status', 'active')->count() }} active</p>
                                </div>
                            </div>
                            <div class="text-green-600 dark:text-green-400">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="shrink-0">
                                    <div class="h-2 w-2 rounded-full bg-green-400"></div>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        Admin Panel</p>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Online</p>
                                </div>
                            </div>
                            <div class="text-green-600 dark:text-green-400">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="shrink-0">
                                    <div class="h-2 w-2 rounded-full bg-yellow-400"></div>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        Background Jobs</p>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Monitoring</p>
                                </div>
                            </div>
                            <div class="text-yellow-600 dark:text-yellow-400">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tenants -->
        <div
            class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm dark:border-dark-green dark:bg-dark-green">
            <div
                class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                <h3
                    class="text-lg font-medium leading-6 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Recent Tenants</h3>
            </div>
            <div class="px-6 py-4">
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                        <thead class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Plan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Created</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            @forelse(\App\Models\Tenant::latest()->take(5)->get() as $tenant)
                                <tr
                                    class="transition-colors duration-150 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $tenant->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $tenant->email }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="@if ($tenant->status === 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @elseif($tenant->status === 'suspended') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                        @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ ucfirst($tenant->status) }}
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ ucfirst($tenant->plan ?? 'N/A') }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $tenant->created_at->format('M j, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-4 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        No tenants found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function exportData() {
            // Placeholder for data export functionality
            alert('Data export functionality will be implemented in a future update.');
        }

        // Auto-refresh stats every 30 seconds
        setInterval(function() {
            // Refresh only the stats sections without full page reload
            // This would require AJAX implementation
        }, 30000);

        // Add some interactivity to the dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Animate the stat cards on load
            const statCards = document.querySelectorAll('.overflow-hidden.rounded-lg.shadow-sm');
            statCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endsection
