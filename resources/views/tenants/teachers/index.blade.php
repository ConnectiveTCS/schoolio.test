<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-chalkboard-teacher mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Teachers') }}
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
                <h3
                    class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    All Teachers</h3>
                <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    {{ isset($users) ? $users->count() : 0 }} total teachers
                </p>
            </div>
            <a href="{{ route('tenant.teachers.create') }}"
                class="shadow-xs focus-visible:outline-solid focus:outline-hidden inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                <i class="fas fa-plus h-4 w-4"></i>
                {{ __('Add Teacher') }}
            </a>
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
                            <i class="fas fa-user-tag mr-2"></i>Role
                        </th>
                        <th class="relative px-6 py-4">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    @if (isset($users) && $users->count() > 0)
                        @foreach ($users as $user)
                            <tr
                                class="transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @php
                                        $role = $user->getRoleNames()->join(', ');
                                    @endphp
                                    <span
                                        class="@if ($role === 'tenant_admin') bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]
                                        @elseif ($role === 'teacher') bg-[color:var(--color-light-prussian-blue)] text-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-prussian-blue)] dark:text-[color:var(--color-light-gunmetal)]
                                        @elseif ($role === 'student') bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]
                                        @else bg-[color:var(--color-light-gunmetal)] text-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] @endif inline-flex rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                        @if ($role === 'tenant_admin')
                                            <i class="fas fa-crown mr-1"></i>Tenant Admin
                                        @elseif ($role === 'teacher')
                                            <i class="fas fa-chalkboard-teacher mr-1"></i>Teacher
                                        @elseif ($role === 'student')
                                            <i class="fas fa-user-graduate mr-1"></i>Student
                                        @else
                                            <i class="fas fa-user mr-1"></i>{{ $role }}
                                        @endif
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('tenant.teachers.edit', $user->teacher) }}"
                                            class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
                                            title="Edit teacher">
                                            <i class="fas fa-edit h-4 w-4"></i>
                                        </a>
                                        <a href="{{ route('tenant.teachers.show', $user->teacher) }}"
                                            class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
                                            title="View teacher">
                                            <i class="fas fa-eye h-4 w-4"></i>
                                        </a>
                                        <form action="{{ route('tenant.teachers.destroy', $user->teacher) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-md p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-red-50 hover:text-red-600 dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-red-900/20 dark:hover:text-red-400"
                                                title="Delete teacher"
                                                onclick="return confirm('Are you sure you want to delete this teacher?')">
                                                <i class="fas fa-trash h-4 w-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div
                                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-gunmetal)]">
                                    <i
                                        class="fas fa-users text-2xl text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                </div>
                                <h3
                                    class="mt-4 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    No teachers found
                                </h3>
                                <p
                                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Get started by adding your
                                    first teacher.</p>
                                <div class="mt-6">
                                    <a href="{{ route('tenant.teachers.create') }}"
                                        class="shadow-xs focus-visible:outline-solid inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                        <i class="fas fa-plus mr-2"></i>Add Teacher
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-tenant-dash-component>
