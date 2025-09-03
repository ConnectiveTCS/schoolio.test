@extends('central.layout')

@section('title', 'System Settings')

@section('content')
    <div
        class="mx-auto min-h-screen max-w-7xl bg-[color:var(--color-light-dark-green)] px-4 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
        <div class="py-6">
            <div class="mb-8">
                <h1
                    class="text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    System Settings</h1>
                <p
                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Configure system-wide settings and preferences.
                </p>
            </div>

            <!-- Placeholder for future system settings -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-sm transition-colors duration-200 hover:shadow-md dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div
                    class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Configuration</h3>
                </div>
                <div class="px-6 py-4">
                    @include('central.settings.partials.email-configuration', [
                        'emailSettings' => $emailSettings ?? [],
                    ])

                    <!-- Backup & Maintenance Schedule -->
                    <div
                        class="mt-8 border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                        @include('central.settings.partials.backup-maintenance-schedule', [
                            'backupSettings' => $backupSettings ?? [],
                        ])
                    </div>
                </div>
            </div>

            <!-- Current Environment Information -->
            <div
                class="mt-8 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-sm transition-colors duration-200 hover:shadow-md dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div
                    class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Environment Information</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt
                                class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Environment</dt>
                            <dd
                                class="mt-1 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                {{ app()->environment() }}</dd>
                        </div>
                        <div>
                            <dt
                                class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Laravel Version</dt>
                            <dd
                                class="mt-1 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                {{ app()->version() }}</dd>
                        </div>
                        <div>
                            <dt
                                class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                PHP Version</dt>
                            <dd
                                class="mt-1 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                {{ PHP_VERSION }}</dd>
                        </div>
                        <div>
                            <dt
                                class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Database</dt>
                            <dd
                                class="mt-1 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                {{ config('database.default') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
