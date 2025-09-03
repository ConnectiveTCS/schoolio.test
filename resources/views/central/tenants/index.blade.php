@extends('central.layout')

@section('title', 'Tenant Management')

@section('content')
    <style>
        /* Custom styles for sticky column */
        .sticky-actions {
            position: sticky;
            right: 0;
            z-index: 10;
        }

        .sticky-actions::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 0;
            width: 10px;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(0, 0, 0, 0.05));
            pointer-events: none;
        }

        /* Dark mode gradient for sticky column */
        @media (prefers-color-scheme: dark) {
            .sticky-actions::before {
                background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.05));
            }
        }
    </style>

    <div class="mx-auto min-h-screen max-w-7xl px-4 transition-colors duration-200 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2
                        class="text-2xl font-bold leading-7 text-[color:var(--color-dark-green)] transition-colors duration-200 sm:truncate sm:text-3xl dark:text-[color:var(--color-light-dark-green)]">
                        Tenant Management
                    </h2>
                    <p
                        class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Manage all tenant organizations and their settings.
                    </p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    @if (auth('central_admin')->user()->canManageTenants())
                        <a href="{{ route('central.tenants.create') }}"
                            class="shadow-xs ml-3 inline-flex items-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                            <i class="fas fa-plus mr-2"></i>Create Tenant
                        </a>
                    @endif
                </div>
            </div>

            <!-- Statistics Dashboard -->
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-md bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)]">
                                <i class="fas fa-building text-white dark:text-[color:var(--color-dark-green)]"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt
                                    class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Total Tenants</dt>
                                <dd
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $stats['total'] ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-md bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)]">
                                <i class="fas fa-check-circle text-white dark:text-[color:var(--color-dark-green)]"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt
                                    class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Active</dt>
                                <dd
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $stats['active'] ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-md bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-pause-circle text-white dark:text-[color:var(--color-dark-green)]"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt
                                    class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Suspended</dt>
                                <dd
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $stats['suspended'] ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-md bg-[color:var(--color-prussian-blue)] dark:bg-[color:var(--color-light-prussian-blue)]">
                                <i class="fas fa-calendar-day text-white dark:text-[color:var(--color-dark-green)]"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt
                                    class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    This Month</dt>
                                <dd
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $stats['this_month'] ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div
                class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="px-6 py-4">
                    <form method="GET" action="{{ route('central.tenants.index') }}">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6">
                            <div>
                                <label for="search"
                                    class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                    placeholder="Name, email, or ID...">
                            </div>
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Status</label>
                                <select name="status" id="status"
                                    class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                    <option value="">All Statuses</option>
                                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>
                                        Suspended</option>
                                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                            <div>
                                <label for="plan"
                                    class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Plan</label>
                                <select name="plan" id="plan"
                                    class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                    <option value="">All Plans</option>
                                    <option value="basic" {{ request('plan') === 'basic' ? 'selected' : '' }}>Basic
                                    </option>
                                    <option value="premium" {{ request('plan') === 'premium' ? 'selected' : '' }}>Premium
                                    </option>
                                    <option value="enterprise" {{ request('plan') === 'enterprise' ? 'selected' : '' }}>
                                        Enterprise</option>
                                </select>
                            </div>
                            <div>
                                <label for="date_from"
                                    class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Created
                                    From</label>
                                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                    class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            </div>
                            <div>
                                <label for="date_to"
                                    class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Created
                                    To</label>
                                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                    class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            </div>
                            <div class="flex items-end space-x-2">
                                <button type="submit"
                                    class="shadow-xs inline-flex flex-1 items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                    <i class="fas fa-search mr-2"></i>Filter
                                </button>
                                <a href="{{ route('central.tenants.index') }}"
                                    class="shadow-xs inline-flex items-center justify-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Quick Actions Row -->
                        <div
                            class="mt-4 flex items-center justify-between border-t border-[color:var(--color-light-brunswick-green)] pt-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                            <div class="flex items-center space-x-3">
                                <button type="button" onclick="exportAll()"
                                    class="shadow-xs inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-3 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                    <i class="fas fa-download mr-2"></i>Export All
                                </button>
                                @if (auth('central_admin')->user()->canManageTenants())
                                    <button type="button" onclick="showBulkCommunication()"
                                        class="shadow-xs inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-3 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                        <i class="fas fa-envelope mr-2"></i>Send Notice
                                    </button>
                                    <button type="button" onclick="showHealthReport()"
                                        class="shadow-xs inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-3 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                        <i class="fas fa-chart-line mr-2"></i>Health Report
                                    </button>
                                @endif
                            </div>
                            <div
                                class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Showing {{ $tenants->firstItem() ?? 0 }} to {{ $tenants->lastItem() ?? 0 }} of
                                {{ $tenants->total() ?? 0 }} results
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tenants Table -->
            <div
                class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-md dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                @if ($tenants->count() > 0)
                    <!-- Bulk Actions Bar -->
                    <div class="hidden border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-6 py-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]"
                        id="bulk-actions">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span
                                    class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    <span id="selected-count">0</span> tenant(s) selected
                                </span>
                            </div>
                            <div class="flex items-center space-x-3">
                                @if (auth('central_admin')->user()->canManageTenants())
                                    <button type="button" onclick="bulkAction('suspend')"
                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                        <i class="fas fa-pause mr-1"></i>Suspend
                                    </button>
                                    <button type="button" onclick="bulkAction('activate')"
                                        class="text-sm text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                        <i class="fas fa-play mr-1"></i>Activate
                                    </button>
                                    <button type="button" onclick="bulkAction('delete')"
                                        class="text-sm text-red-600 transition-colors duration-200 hover:text-red-900">
                                        <i class="fas fa-trash mr-1"></i>Delete
                                    </button>
                                    <button type="button" onclick="exportSelected()"
                                        class="text-sm text-[color:var(--color-prussian-blue)] transition-colors duration-200 hover:text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-prussian-blue)] dark:hover:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-download mr-1"></i>Export
                                    </button>
                                    <button type="button" onclick="communicateWithSelected()"
                                        class="text-sm text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                        <i class="fas fa-envelope mr-1"></i>Send Notice
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)]">
                        <thead
                            class="bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                            <tr>
                                @if ($tenants->count() > 0 && auth('central_admin')->user()->canManageTenants())
                                    <th class="px-6 py-3 text-left">
                                        <input type="checkbox" id="select-all"
                                            class="h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                    </th>
                                @endif
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Tenant</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Contact</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Plan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Domain</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Health</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Storage</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Last Activity</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Created</th>
                                <th
                                    class="sticky-actions sticky right-0 bg-[color:var(--color-light-brunswick-green)] px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                            @forelse($tenants as $tenant)
                                <tr
                                    class="group transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                    @if (auth('central_admin')->user()->canManageTenants())
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <input type="checkbox" name="selected_tenants[]" value="{{ $tenant->id }}"
                                                class="tenant-checkbox h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                        </td>
                                    @endif
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div>
                                                <div
                                                    class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                    {{ $tenant->name }}</div>
                                                <div
                                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                    ID: {{ $tenant->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $tenant->email }}</div>
                                        @if ($tenant->phone)
                                            <div
                                                class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ $tenant->phone }}</div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="{{ $tenant->status === 'active' ? 'bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]' : '' }} {{ $tenant->status === 'suspended' ? 'bg-[color:var(--color-light-gunmetal)] dark:bg-[color:var(--color-gunmetal)] text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]' : '' }} {{ $tenant->status === 'inactive' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold transition-colors duration-200">
                                            {{ ucfirst($tenant->status) }}
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ ucfirst($tenant->plan ?? 'N/A') }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        @if ($tenant->domains->isNotEmpty())
                                            <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank"
                                                class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                {{ $tenant->domains->first()->domain }}
                                                <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                            </a>
                                        @else
                                            No domain
                                        @endif
                                    </td>

                                    <!-- Health Status -->
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @php
                                            $healthScore = $tenant->health_score ?? 100;
                                            $healthColor =
                                                $healthScore >= 90
                                                    ? 'castleton-green'
                                                    : ($healthScore >= 70
                                                        ? 'gunmetal'
                                                        : 'red');
                                        @endphp
                                        <div class="flex items-center">
                                            <div
                                                class="mr-2 h-2 w-16 rounded-full bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                                <div class="h-2 rounded-full bg-[color:var(--color-{{ $healthColor === 'castleton-green' ? 'castleton-green' : ($healthColor === 'gunmetal' ? 'gunmetal' : 'red-500') }})] transition-colors duration-200 dark:bg-[color:var(--color-{{ $healthColor === 'castleton-green' ? 'light-castleton-green' : ($healthColor === 'gunmetal' ? 'light-gunmetal' : 'red-400') }})]"
                                                    style="width: {{ $healthScore }}%"></div>
                                            </div>
                                            <span
                                                class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">{{ $healthScore }}%</span>
                                        </div>
                                    </td>

                                    <!-- Storage Usage -->
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        @php
                                            $storageUsed = $tenant->storage_used ?? 0;
                                            $storageLimit = $tenant->storage_limit ?? 1000;
                                            $storagePercent =
                                                $storageLimit > 0 ? ($storageUsed / $storageLimit) * 100 : 0;
                                        @endphp
                                        <div class="text-sm">{{ number_format($storageUsed / 1024, 1) }} GB</div>
                                        <div
                                            class="mt-1 h-1 w-16 rounded-full bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                            <div class="h-1 rounded-full bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-light-castleton-green)]"
                                                style="width: {{ min($storagePercent, 100) }}%"></div>
                                        </div>
                                    </td>

                                    <!-- Last Activity -->
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        @if ($tenant->last_activity_at)
                                            {{ $tenant->last_activity_at->diffForHumans() }}
                                        @else
                                            Never
                                        @endif
                                    </td>

                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $tenant->created_at->format('M j, Y') }}
                                    </td>
                                    <td
                                        class="sticky-actions sticky right-0 whitespace-nowrap bg-[color:var(--color-light-dark-green)] px-6 py-4 text-right text-sm font-medium transition-colors duration-200 group-hover:bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:group-hover:bg-[color:var(--color-brunswick-green)]">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('central.tenants.show', $tenant) }}"
                                                class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if (auth('central_admin')->user()->canManageTenants())
                                                <a href="{{ route('central.tenants.edit', $tenant) }}"
                                                    class="text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-prussian-blue)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-prussian-blue)]">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                @if ($tenant->status === 'active')
                                                    <form method="POST"
                                                        action="{{ route('central.tenants.suspend', $tenant) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('Are you sure you want to suspend this tenant?');">
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-prussian-blue)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-prussian-blue)]">
                                                            <i class="fas fa-pause"></i>
                                                        </button>
                                                    </form>
                                                @elseif($tenant->status === 'suspended')
                                                    <form method="POST"
                                                        action="{{ route('central.tenants.activate', $tenant) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('Are you sure you want to activate this tenant?');">
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <form method="POST"
                                                    action="{{ route('central.tenants.impersonate', $tenant) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('This will take you to the tenant\'s domain. Continue?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-[color:var(--color-prussian-blue)] transition-colors duration-200 hover:text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-prussian-blue)] dark:hover:text-[color:var(--color-light-gunmetal)]">
                                                        <i class="fas fa-user-secret"></i>
                                                    </button>
                                                </form>
                                                <form method="POST"
                                                    action="{{ route('central.tenants.destroy', $tenant) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this tenant? This action cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 transition-colors duration-200 hover:text-red-900">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth('central_admin')->user()->canManageTenants() ? '11' : '10' }}"
                                        class="px-6 py-4 text-center text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        No tenants found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($tenants->hasPages())
                <div class="mt-6">
                    <div class="pagination-wrapper">
                        {{ $tenants->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Communication Modal -->
    <div id="communication-modal"
        class="fixed inset-0 hidden h-full w-full overflow-y-auto bg-black bg-opacity-50 transition-colors duration-200">
        <div
            class="relative top-20 mx-auto w-96 rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-5 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <div class="mt-3">
                <h3
                    class="mb-4 text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    Send Notice to Tenants</h3>
                <form id="communication-form">
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Subject</label>
                        <input type="text" id="notice-subject"
                            class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                    </div>
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Message</label>
                        <textarea id="notice-message" rows="4"
                            class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" id="urgent-notice"
                                class="shadow-xs focus:ring-3 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-50 dark:border-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <span
                                class="ml-2 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">Mark
                                as urgent</span>
                        </label>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeCommunicationModal()"
                            class="rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)]">Cancel</button>
                        <button type="button" onclick="sendNotice()"
                            class="rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">Send
                            Notice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Health Report Modal -->
    <div id="health-modal"
        class="fixed inset-0 hidden h-full w-full overflow-y-auto bg-black bg-opacity-50 transition-colors duration-200">
        <div
            class="relative top-10 mx-auto w-4/5 max-w-4xl rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-5 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <div class="mt-3">
                <div class="mb-4 flex items-center justify-between">
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        System Health Report</h3>
                    <button onclick="closeHealthModal()"
                        class="text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="health-report-content"
                    class="text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    <!-- Health report content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bulk selection functionality
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const tenantCheckboxes = document.querySelectorAll('.tenant-checkbox');
            const bulkActionsBar = document.getElementById('bulk-actions');
            const selectedCountSpan = document.getElementById('selected-count');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    tenantCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateBulkActionsVisibility();
                });

                tenantCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        updateSelectAllState();
                        updateBulkActionsVisibility();
                    });
                });
            }

            function updateSelectAllState() {
                const checkedCount = document.querySelectorAll('.tenant-checkbox:checked').length;
                const totalCount = tenantCheckboxes.length;

                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = checkedCount === totalCount;
                    selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < totalCount;
                }
            }

            function updateBulkActionsVisibility() {
                const checkedCount = document.querySelectorAll('.tenant-checkbox:checked').length;

                if (selectedCountSpan) {
                    selectedCountSpan.textContent = checkedCount;
                }

                if (bulkActionsBar) {
                    if (checkedCount > 0) {
                        bulkActionsBar.classList.remove('hidden');
                    } else {
                        bulkActionsBar.classList.add('hidden');
                    }
                }
            }
        });

        // Enhanced bulk actions
        function bulkAction(action) {
            const selectedTenants = Array.from(document.querySelectorAll('.tenant-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selectedTenants.length === 0) {
                alert('Please select at least one tenant.');
                return;
            }

            const actionText = action === 'suspend' ? 'suspend' : (action === 'activate' ? 'activate' : 'delete');
            const confirmMessage = `Are you sure you want to ${actionText} ${selectedTenants.length} tenant(s)?`;

            if (confirm(confirmMessage)) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('central.tenants.bulk') }}`;

                // Add CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Add action
                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = action;
                form.appendChild(actionInput);

                // Add selected tenants
                selectedTenants.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'tenants[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        }

        // Export functions
        function exportSelected() {
            const selectedTenants = Array.from(document.querySelectorAll('.tenant-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selectedTenants.length === 0) {
                alert('Please select at least one tenant to export.');
                return;
            }

            // Create export form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('central.tenants.export') }}';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            // Add format (default to CSV)
            const formatInput = document.createElement('input');
            formatInput.type = 'hidden';
            formatInput.name = 'format';
            formatInput.value = 'csv';
            form.appendChild(formatInput);

            selectedTenants.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'tenants[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }

        function exportAll() {
            window.location.href = '{{ route('central.tenants.export') }}?all=1';
        }

        // Communication functions
        function showBulkCommunication() {
            document.getElementById('communication-modal').classList.remove('hidden');
        }

        function communicateWithSelected() {
            const selectedTenants = Array.from(document.querySelectorAll('.tenant-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selectedTenants.length === 0) {
                alert('Please select at least one tenant.');
                return;
            }

            showBulkCommunication();
        }

        function closeCommunicationModal() {
            document.getElementById('communication-modal').classList.add('hidden');
        }

        function sendNotice() {
            const subject = document.getElementById('notice-subject').value;
            const message = document.getElementById('notice-message').value;
            const urgent = document.getElementById('urgent-notice').checked;

            if (!subject || !message) {
                alert('Please fill in both subject and message.');
                return;
            }

            // Implement notice sending logic
            console.log('Sending notice:', {
                subject,
                message,
                urgent
            });
            alert('Notice sent successfully!');
            closeCommunicationModal();
        }

        // Health report functions
        function showHealthReport() {
            document.getElementById('health-modal').classList.remove('hidden');
            loadHealthReport();
        }

        function closeHealthModal() {
            document.getElementById('health-modal').classList.add('hidden');
        }

        function loadHealthReport() {
            // Load health report via AJAX
            fetch('{{ route('central.tenants.health-report') }}')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('health-report-content').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('health-report-content').innerHTML =
                        '<p class="text-red-600">Error loading health report.</p>';
                });
        }

        // Search functionality
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm) || searchTerm === '') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
