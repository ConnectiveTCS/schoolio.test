<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                {{ __('Class Summary Report') }}
            </h2>
            <div class="flex items-center gap-4">
                <a href="{{ route('tenant.reports.class-summary', array_merge(request()->all(), ['format' => 'csv'])) }}"
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
            <form method="GET" action="{{ route('tenant.reports.class-summary') }}" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div>
                        <label for="academic_year"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Academic
                            Year</label>
                        <select name="academic_year" id="academic_year"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <option value="">All Years</option>
                            @foreach ($academicYears as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="teacher_id"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Teacher</label>
                        <select name="teacher_id" id="teacher_id"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <option value="">All Teachers</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $teacherId == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="status"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <option value="">All Statuses</option>
                            <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
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

        <!-- Overall Statistics -->
        <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-school h-8 w-8 text-blue-500"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Total Classes</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ number_format($stats['total_classes']) }}</p>
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
                            Total Students</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ number_format($stats['total_students']) }}</p>
                    </div>
                </div>
            </div>
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-chalkboard-teacher h-8 w-8 text-purple-500"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Total Teachers</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ number_format($stats['total_teachers']) }}</p>
                    </div>
                </div>
            </div>
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i
                            class="fas fa-chart-line h-8 w-8 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-brunswick-green)]"></i>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Avg. Class Size</p>
                        <p
                            class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $stats['average_class_size'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Class Details -->
        <div
            class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
            <div
                class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                <h3
                    class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    Class Summary Details</h3>
            </div>

            @if ($classes->count() > 0)
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:divide-[color:var(--color-brunswick-green)]">
                        <thead
                            class="bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Class Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Teacher</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Students</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Capacity</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Schedule</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Academic Year</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:divide-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                            @foreach ($classes as $class)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $class->name }}
                                        @if ($class->description)
                                            <br><span
                                                class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">{{ Str::limit($class->description, 30) }}</span>
                                        @endif
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $class->teacher ? $class->teacher->user->name : 'Not Assigned' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $class->students_count }}</span>
                                            @if ($class->capacity)
                                                <div
                                                    class="ml-2 h-2 w-16 rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                                    <div class="{{ $class->students_count >= $class->capacity ? 'bg-red-500' : ($class->students_count >= $class->capacity * 0.8 ? 'bg-yellow-500' : 'bg-green-500') }} h-2 rounded-full"
                                                        style="width: {{ $class->capacity > 0 ? min(($class->students_count / $class->capacity) * 100, 100) : 0 }}%">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $class->capacity ?? 'Unlimited' }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="@if ($class->status === 'active') bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-200
                                            @elseif($class->status === 'inactive') bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-200
                                            @elseif($class->status === 'completed') bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-200
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-200 @endif inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ ucfirst($class->status) }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        @if ($class->schedule)
                                            {{ $class->schedule }}
                                        @else
                                            <span
                                                class="italic text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">Not
                                                set</span>
                                        @endif
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $class->academic_year ?? 'Not set' }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            @can('view classes')
                                                <a href="{{ route('tenant.classes.show', $class) }}"
                                                    class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-brunswick-green)] dark:hover:text-[color:var(--color-gunmetal)]">
                                                    <i class="fas fa-eye h-4 w-4"></i>
                                                </a>
                                            @endcan
                                            @can('manage attendance')
                                                <a href="{{ route('tenant.attendance.create', ['class_id' => $class->id]) }}"
                                                    class="text-blue-600 transition-colors duration-200 hover:text-blue-900">
                                                    <i class="fas fa-clipboard-check h-4 w-4"></i>
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($classes->hasPages())
                    <div
                        class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                        {{ $classes->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="py-12 text-center">
                    <i
                        class="fas fa-school mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                    <h3
                        class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        No classes found</h3>
                    <p
                        class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Try adjusting your filters or create some classes first.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-tenant-dash-component>
