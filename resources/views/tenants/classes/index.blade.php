<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-chalkboard mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Classes') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen transition-colors duration-200">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <!-- Header Actions -->
            <div
                class="mb-8 flex items-center justify-between rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div>
                    <div class="flex items-center">
                        <i
                            class="fas fa-list mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            All Classes</h3>
                    </div>
                    <p
                        class="mt-1 flex items-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-chart-bar mr-1"></i>
                        {{ isset($classes) ? $classes->count() : 0 }} total classes
                    </p>
                </div>
                @can('create classes')
                    <a href="{{ route('tenant.classes.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-plus h-4 w-4"></i>
                        {{ __('Add Class') }}
                    </a>
                @endcan
            </div>

            <!-- Table Container -->
            <div
                class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <table
                    class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                    <thead
                        class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-chalkboard mr-2"></i>
                                    Class Name
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-book mr-2"></i>
                                    Subject
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                                    Teacher
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-door-open mr-2"></i>
                                    Room
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    Students
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-toggle-on mr-2"></i>
                                    Status
                                </div>
                            </th>
                            <th class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        @if (isset($classes) && $classes->count() > 0)
                            @foreach ($classes as $class)
                                <tr
                                    class="transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-castleton-green)]">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <i
                                                class="fas fa-chalkboard mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            <div
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                {{ $class->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <i
                                                class="fas fa-book mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                            <div
                                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ $class->subject ?? 'No subject' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <i
                                                class="fas fa-user-tie mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                            <form action="{{ route('tenant.classes.updateTeacher', $class) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <select name="teacher_id" id="teacher_id"
                                                class="rounded border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-2 py-1 text-sm text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 hover:border-[color:var(--color-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)]"
                                                onchange="this.form.submit()">
                                                    <option value="">Select Teacher</option>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}" {{ $class->teacher_id === $teacher->id ? 'selected' : '' }}>
                                                            {{ $teacher->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <i
                                                class="fas fa-door-open mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                            <div
                                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ $class->room ?? 'Not assigned' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <i
                                                class="fas fa-users mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                            <div
                                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ $class->students_count ?? 0 }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="{{ $class->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                            <i
                                                class="{{ $class->is_active ? 'fas fa-check-circle' : 'fas fa-times-circle' }} mr-1"></i>
                                            {{ $class->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                        <div class="flex items-center justify-end space-x-3">
                                            <a href="{{ route('tenant.classes.show', $class) }}"
                                                class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                <i class="fas fa-eye mr-1"></i>
                                                View
                                            </a>
                                            <a href="{{ route('tenant.classes.edit', $class) }}"
                                                class="inline-flex items-center text-yellow-600 transition-colors duration-200 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('tenant.classes.destroy', $class) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this class?')"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center text-red-600 transition-colors duration-200 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                    <i class="fas fa-trash mr-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                                        <i
                                            class="fas fa-chalkboard h-8 w-8 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                    <h3
                                        class="mt-4 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        No classes found</h3>
                                    @can('create classes')
                                        <p
                                            class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            Get started by adding your first class.</p>
                                        <div class="mt-6">
                                            <a href="{{ route('tenant.classes.create') }}"
                                                class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-semibold text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                                <i class="fas fa-plus mr-2 h-5 w-5"></i>
                                                New Class
                                            </a>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
