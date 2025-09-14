<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-user-graduate mr-3 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Students') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8">
        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <!-- Success Message -->
        @if (session('success'))
            <div
                class="mb-6 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-4 text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                <div class="flex items-center">
                    <i
                        class="fas fa-check-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Header Actions -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                @if (auth()->user()->hasRole('teacher') && auth()->user()->teacher)
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        My Students</h3>
                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        @if (isset($students) && method_exists($students, 'total'))
                            {{ $students->total() }} total students in your classes
                        @else
                            {{ isset($students) ? $students->count() : 0 }} total students in your classes
                        @endif
                    </p>
                @elseif (auth()->user()->hasRole('tenant_admin'))
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        All Students</h3>
                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        @if (isset($students) && method_exists($students, 'total'))
                            {{ $students->total() }} total students
                        @else
                            {{ isset($students) ? $students->count() : 0 }} total students
                        @endif
                    </p>
                @elseif (auth()->user()->hasRole('student'))
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        My Classmates</h3>
                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        @if (isset($students) && method_exists($students, 'total'))
                            {{ $students->total() }} classmates
                        @else
                            {{ isset($students) ? $students->count() : 0 }} classmates
                        @endif
                    </p>
                @endif
            </div>

            <div class="flex items-center space-x-4">
                <!-- Search Box -->
                <div class="relative">
                    <form method="GET" action="{{ route('tenant.students') }}" class="flex items-center">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search students..."
                                class="block w-64 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-3 py-2 pl-10 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <i
                                class="fas fa-search absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                        </div>
                        @if (request('search'))
                            <a href="{{ route('tenant.students') }}"
                                class="ml-2 inline-flex items-center rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-3 py-2 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                <i class="fas fa-times mr-1"></i>Clear
                            </a>
                        @endif
                    </form>
                </div>

                @hasrole('tenant_admin|teacher')
                    <a href="{{ route('tenant.students.create') }}"
                        class="shadow-xs focus:outline-hidden inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-user-plus h-4 w-4"></i>
                        {{ __('Add Student') }}
                    </a>
                @endhasrole
            </div>
        </div>

        <!-- Table Container -->
        <div
            class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <table
                class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                <thead class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-user mr-2"></i>Name
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-chalkboard-teacher mr-2"></i>Class
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-calendar-alt mr-2"></i>Enrollment Date
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-check-circle mr-2"></i>Status
                        </th>
                        @can('manage students')
                            <th class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        @endcan
                    </tr>
                </thead>
                <tbody
                    class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    @if (isset($students) && $students->count() > 0)
                        @foreach ($students as $student)
                            <tr
                                class="transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $student->name }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $student->email }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        @if ($student->classes && $student->classes->count() > 0)
                                            <div class="space-y-1">
                                                @foreach ($student->classes as $class)
                                                    <a href="{{ route('tenant.classes.show', $class) }}"
                                                        class="inline-block rounded-full bg-[color:var(--color-castleton-green)] px-2 py-1 text-xs text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                                        {{ $class->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <span
                                                class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Not
                                                enrolled</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $student->enrollment_date ? \Carbon\Carbon::parse($student->enrollment_date)->format('M j, Y') : 'Not set' }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="{{ $student->is_active ? 'bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold transition-colors duration-200">
                                        <i
                                            class="fas {{ $student->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                        {{ $student->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                @can('manage students')
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('tenant.students.edit', $student) }}"
                                                class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
                                                title="Edit student">
                                                <i class="fas fa-edit h-4 w-4"></i>
                                            </a>
                                            <a href="{{ route('tenant.students.show', $student) }}"
                                                class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
                                                title="View student">
                                                <i class="fas fa-eye h-4 w-4"></i>
                                            </a>
                                            @if (
                                                $student->user &&
                                                    (auth()->user()->hasRole('tenant_admin') ||
                                                        (auth()->user()->hasRole('teacher') &&
                                                            auth()->user()->teacher &&
                                                            $student->classes->whereIn('id', auth()->user()->teacher->classes->pluck('id'))->count() > 0)))
                                                <form action="{{ route('tenant.students.resetPassword', $student) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to reset {{ $student->name }}\'s password? A new password will be sent to their email address.')"
                                                        class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
                                                        title="Reset password">
                                                        <i class="fas fa-key h-4 w-4"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div
                                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-gunmetal)]">
                                        <i
                                            class="fas fa-user-graduate text-2xl text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>

                                    @if (request('search'))
                                        <div class="text-center">
                                            <h3
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                No students found for "{{ request('search') }}"
                                            </h3>
                                            <p
                                                class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                Try adjusting your search criteria or clear the search to see all
                                                students.
                                            </p>
                                            <div class="mt-6">
                                                <a href="{{ route('tenant.students') }}"
                                                    class="shadow-xs focus-visible:outline-solid inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                                    <i class="fas fa-times mr-2"></i>Clear Search
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <h3
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                @if (auth()->user()->hasRole('teacher'))
                                                    No students in your classes yet
                                                @elseif (auth()->user()->hasRole('student'))
                                                    No classmates found
                                                @else
                                                    No students found
                                                @endif
                                            </h3>
                                            <p
                                                class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                @if (auth()->user()->hasRole('teacher'))
                                                    Students will appear here once they are enrolled in your classes.
                                                @elseif (auth()->user()->hasRole('student'))
                                                    Other students from your classes will appear here.
                                                @else
                                                    Get started by adding your first student to the system.
                                                @endif
                                            </p>

                                            @hasrole('tenant_admin|teacher')
                                                <div class="mt-6">
                                                    <a href="{{ route('tenant.students.create') }}"
                                                        class="shadow-xs focus-visible:outline-solid inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                                        <i class="fas fa-user-plus mr-2"></i>Add Student
                                                    </a>
                                                </div>
                                            @endhasrole
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if (isset($students) && method_exists($students, 'hasPages') && $students->hasPages())
            <div class="mt-6 flex items-center justify-center gap-4">
                <div class="pagination-wrapper">
                    {{ $students->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
</x-tenant-dash-component>
