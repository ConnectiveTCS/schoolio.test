<x-tenant-dash-component :dashboardData="$dashboardData">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-tachometer-alt mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Dashboard') }}
            </h2>
            <div
                class="flex items-center gap-x-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                <!-- Theme Toggle Button -->
                <button onclick="toggleTheme()"
                    class="focus:outline-hidden relative h-10 w-10 rounded-lg p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-brunswick-green)] dark:hover:text-[color:var(--color-light-dark-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]"
                    title="Toggle theme">
                    <!-- Sun icon (visible in dark mode) -->
                    <i
                        class="fas fa-sun absolute left-1/2 top-1/2 h-5 w-5 -translate-x-1/2 -translate-y-1/2 transform opacity-0 transition-opacity duration-200 dark:opacity-100"></i>
                    <!-- Moon icon (visible in light mode) -->
                    <i
                        class="fas fa-moon absolute left-1/2 top-1/2 h-5 w-5 -translate-x-1/2 -translate-y-1/2 transform opacity-100 transition-opacity duration-200 dark:opacity-0"></i>
                </button>
                <span class="truncate" title="{{ $tenant->name ?? 'School Management System' }}">
                    Welcome to {{ Str::limit($tenant->name ?? 'School Management System', 25) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div
        class="bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        @hasrole('tenant_admin')
            @include('tenants.dashboard_partials.tenant-admin-dash')
        @endhasrole
        @hasrole('teacher')
            @include('tenants.dashboard_partials.tenant-teacher-dash')
        @endhasrole
        @hasrole('student')
            @include('tenants.dashboard_partials.tenant-student-dash')
        @endhasrole
        @hasrole('parent')
            @include('tenants.dashboard_partials.tenant-parent-dash')
        @endhasrole

    </div>
</x-tenant-dash-component>
