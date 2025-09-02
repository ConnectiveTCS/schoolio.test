<!-- Statistics -->
<div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
        <h3 class="flex items-center text-lg font-semibold text-gray-900">
            <i class="fas fa-chart-bar mr-2 text-blue-600"></i>
            Statistics
        </h3>
    </div>
    <div class="px-6 py-6">
        @if (isset($stats['error']))
            <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-yellow-800">
                            Unable to fetch statistics
                        </h4>
                        <p class="mt-1 text-sm text-yellow-700">
                            {{ $stats['error'] }}
                        </p>
                    </div>
                </div>
            </div>
        @else
            <dl class="space-y-6">
                <div
                    class="flex items-center justify-between rounded-lg border border-blue-200 bg-gradient-to-r from-blue-50 to-blue-100 p-4">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600">
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-blue-900">Total Users</dt>
                            <dd class="text-2xl font-bold text-blue-600">{{ $stats['users_count'] ?? 0 }}
                            </dd>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between rounded-lg border border-green-200 bg-gradient-to-r from-green-50 to-green-100 p-4">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-green-900">Students</dt>
                            <dd class="text-2xl font-bold text-green-600">
                                {{ $stats['students_count'] ?? 0 }}</dd>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between rounded-lg border border-purple-200 bg-gradient-to-r from-purple-50 to-purple-100 p-4">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-600">
                            <i class="fas fa-chalkboard-teacher text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-purple-900">Teachers</dt>
                            <dd class="text-2xl font-bold text-purple-600">
                                {{ $stats['teachers_count'] ?? 0 }}</dd>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between rounded-lg border border-orange-200 bg-gradient-to-r from-orange-50 to-orange-100 p-4">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-600">
                            <i class="fas fa-door-open text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-orange-900">Classes</dt>
                            <dd class="text-2xl font-bold text-orange-600">
                                {{ $stats['classes_count'] ?? 0 }}</dd>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between rounded-lg border border-red-200 bg-gradient-to-r from-red-50 to-red-100 p-4">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-600">
                            <i class="fas fa-bullhorn text-white"></i>
                        </div>
                        <div class="ml-3">
                            <dt class="text-sm font-medium text-red-900">Announcements</dt>
                            <dd class="text-2xl font-bold text-red-600">
                                {{ $stats['announcements_count'] ?? 0 }}</dd>
                        </div>
                    </div>
                </div>
            </dl>
        @endif
    </div>
</div>
