<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                {{ __('Students') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8">
        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <!-- Header Actions -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                @if (auth()->user()->hasRole('teacher') && auth()->user()->teacher)
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        My Students</h3>
                    <p
                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        {{ isset($students) ? $students->count() : 0 }} total students in your classes
                    </p>
                @elseif (auth()->user()->hasRole('tenant_admin'))
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        All Students</h3>
                @elseif (auth()->user()->hasRole('student'))
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        My Classmates</h3>
                @endif
                <p
                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    {{ isset($students) ? $students->count() : 0 }} total students
                </p>
            </div>

            @hasrole('tenant_admin|teacher')
                <a href="{{ route('tenant.students.create') }}"
                    class="shadow-xs focus:outline-hidden inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                    <i class="fas fa-user-plus h-4 w-4"></i>
                    {{ __('Add Student') }}
                </a>
            @endhasrole
        </div>

        <!-- Table Container -->
        <div
            class="overflow-hidden rounded-lg bg-[color:var(--color-light-dark-green)] shadow-sm ring-1 ring-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)] dark:ring-[color:var(--color-castleton-green)]">
            <table
                class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)]">
                <thead
                    class="bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-gunmetal)]">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-user mr-2"></i>Name
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-chalkboard-teacher mr-2"></i>Class
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-calendar-alt mr-2"></i>Enrollment Date
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
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
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $student->name }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $student->email }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
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
                                                class="text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">Not
                                                enrolled</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $student->enrollment_date ? \Carbon\Carbon::parse($student->enrollment_date)->format('M j, Y') : 'Not set' }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="{{ $student->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold transition-colors duration-200">
                                        <i
                                            class="fas {{ $student->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                        {{ $student->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                @can('manage students')
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('tenant.students.show', $student) }}"
                                                class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </a>
                                            <a href="{{ route('tenant.students.edit', $student) }}"
                                                class="inline-flex items-center text-[color:var(--color-prussian-blue)] transition-colors duration-200 hover:text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-prussian-blue)] dark:hover:text-[color:var(--color-light-gunmetal)]">
                                                <i class="fas fa-edit mr-1"></i>Edit
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
                                                        class="inline-flex items-center text-yellow-600 transition-colors duration-200 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                        <i class="fas fa-key mr-1"></i>Reset Password
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
                                <div
                                    class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-gunmetal)]">
                                    <i
                                        class="fas fa-users text-xl text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                </div>
                                <h3
                                    class="mt-4 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    No students found
                                </h3>
                                @hasrole('tenant_admin|teacher')
                                    <p
                                        class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Get started by adding your
                                        first student.</p>
                                    <div class="mt-4">
                                        <a href="{{ route('tenant.students.create') }}"
                                            class="shadow-xs focus-visible:outline-solid inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-3 py-2 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                            <i class="fas fa-user-plus -ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true"></i>
                                            New Student
                                        </a>
                                    </div>
                                @endhasrole
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-tenant-dash-component>
