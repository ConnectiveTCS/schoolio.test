<!-- Statistics -->
<div
    class="shadow-xs overflow-hidden rounded-xl bg-white ring-1 ring-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)] dark:ring-[color:var(--color-brunswick-green)]">
    <div
        class="border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
        <h3
            class="flex items-center text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
            <i
                class="fas fa-chart-bar mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
            Statistics
        </h3>
    </div>
    <div class="px-6 py-6">
        @if (isset($stats['error']))
            <div
                class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 transition-colors duration-200 dark:border-yellow-700 dark:bg-yellow-900/20">
                <div class="flex items-start">
                    <div class="shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">
                            Unable to fetch statistics
                        </h4>
                        <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                            {{ $stats['error'] }}
                        </p>
                    </div>
                </div>
            </div>
        @else
            <dl class="space-y-6">
                <div
                    class="flex items-center justify-between rounded-lg border border-[color:var(--color-castleton-green)] bg-gradient-to-r from-[color:var(--color-light-castleton-green)] to-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:from-[color:var(--color-castleton-green)] dark:to-[color:var(--color-brunswick-green)]">
                    <div class="flex items-center">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)]">
                            <i class="fas fa-users text-white dark:text-[color:var(--color-dark-green)]"></i>
                        </div>
                        <div class="ml-3">
                            <dt
                                class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Total Users</dt>
                            <dd
                                class="text-2xl font-bold text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                {{ $stats['users_count'] ?? 0 }}
                            </dd>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between rounded-lg border border-green-200 bg-gradient-to-r from-green-50 to-green-100 p-4 transition-colors duration-200 dark:border-green-700 dark:from-green-900/20 dark:to-green-800/20">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-green-900 dark:text-green-300">Students</dt>
                            <dd class="text-2xl font-bold text-green-600 dark:text-green-400">
                                {{ $stats['students_count'] ?? 0 }}</dd>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between rounded-lg border border-purple-200 bg-gradient-to-r from-purple-50 to-purple-100 p-4 transition-colors duration-200 dark:border-purple-700 dark:from-purple-900/20 dark:to-purple-800/20">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-600">
                            <i class="fas fa-chalkboard-teacher text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-purple-900 dark:text-purple-300">Teachers</dt>
                            <dd class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                {{ $stats['teachers_count'] ?? 0 }}</dd>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between rounded-lg border border-orange-200 bg-gradient-to-r from-orange-50 to-orange-100 p-4 transition-colors duration-200 dark:border-orange-700 dark:from-orange-900/20 dark:to-orange-800/20">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-600">
                            <i class="fas fa-door-open text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-orange-900 dark:text-orange-300">Classes</dt>
                            <dd class="text-2xl font-bold text-orange-600 dark:text-orange-400">
                                {{ $stats['classes_count'] ?? 0 }}</dd>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between rounded-lg border border-red-200 bg-gradient-to-r from-red-50 to-red-100 p-4 transition-colors duration-200 dark:border-red-700 dark:from-red-900/20 dark:to-red-800/20">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-600">
                            <i class="fas fa-bullhorn text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-red-900 dark:text-red-300">Announcements</dt>
                            <dd class="text-2xl font-bold text-red-600 dark:text-red-400">
                                {{ $stats['announcements_count'] ?? 0 }}</dd>
                        </div>
                    </div>
                </div>
            </dl>
        @endif
    </div>
</div>
