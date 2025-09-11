<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                {{ __('Attendance Management') }}
            </h2>
            @can('manage attendance')
                <a href="{{ route('tenant.attendance.create') }}"
                    class="focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                    <i class="fas fa-plus h-4 w-4"></i>
                    Take Attendance
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="p-6">
        <!-- Filters -->
        <div
            class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
            <form method="GET" action="{{ route('tenant.attendance.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label for="class_id"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Class</label>
                        <select name="class_id" id="class_id"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <option value="">All Classes</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="start_date"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Start
                            Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                    </div>
                    <div>
                        <label for="end_date"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">End
                            Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                    </div>
                    <div>
                        <label for="status"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <option value="">All Statuses</option>
                            @foreach ($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-search h-4 w-4"></i>
                        Filter
                    </button>
                    <a href="{{ route('tenant.attendance.index') }}"
                        class="focus:outline-hidden inline-flex items-center gap-2 rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-times h-4 w-4"></i>
                        Clear
                    </a>
                </div>
            </form>
        </div>

        @if (session('status'))
            <div
                class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle h-5 w-5 text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Attendance Records -->
        <div
            class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
            @if ($attendances->count() > 0)
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:divide-[color:var(--color-brunswick-green)]">
                        <thead
                            class="bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Student</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Class</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Marked By</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:divide-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $attendance->date->format('M d, Y') }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $attendance->student->user->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $attendance->tenantClass->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="@if ($attendance->status === 'present') bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-200
                                            @elseif($attendance->status === 'absent') bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-200
                                            @elseif($attendance->status === 'late') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-200
                                            @else bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-200 @endif inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ ucfirst($attendance->status) }}
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $attendance->markedBy->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            @can('manage attendance')
                                                <a href="{{ route('tenant.attendance.edit', $attendance) }}"
                                                    class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                    <i class="fas fa-edit h-4 w-4"></i>
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('tenant.attendance.destroy', $attendance) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this attendance record?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 transition-colors duration-200 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                        <i class="fas fa-trash h-4 w-4"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div
                    class="border-t border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 transition-colors duration-200 dark:border-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)]">
                    {{ $attendances->withQueryString()->links() }}
                </div>
            @else
                <div class="py-12 text-center">
                    <i
                        class="fas fa-clipboard-check mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                    <h3
                        class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        No attendance records found</h3>
                    <p
                        class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Get started by taking attendance for a class.
                    </p>
                    @can('manage attendance')
                        <div class="mt-6">
                            <a href="{{ route('tenant.attendance.create') }}"
                                class="focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                <i class="fas fa-plus h-4 w-4"></i>
                                Take Attendance
                            </a>
                        </div>
                    @endcan
                </div>
            @endif
        </div>
    </div>
</x-tenant-dash-component>
