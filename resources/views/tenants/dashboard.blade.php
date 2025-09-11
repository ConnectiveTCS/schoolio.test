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
        @hasrole('tenant_admin')
            @include('tenants.dashboard_partials.tenant-admin-dash')
        @endhasrole
        @hasrole('teacher')
            @include('tenants.dashboard_partials.tenant-teacher-dash')
        @endhasrole

    </div>
</x-tenant-dash-component>
