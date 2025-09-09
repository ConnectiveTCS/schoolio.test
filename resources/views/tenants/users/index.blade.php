<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-users mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Users') }}
            </h2>
        </div>
    </x-slot>

    <div
        class="mx-auto max-w-7xl bg-[color:var(--color-light-dark-green)] px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <!-- Header Actions -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h3
                    class="flex items-center text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    <i
                        class="fas fa-list mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    All Users
                </h3>
                <p class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    <i class="fas fa-info-circle mr-1"></i>
                    {{ isset($users) ? $users->count() : 0 }} total users
                </p>
            </div>
            <a href="{{ route('tenant.users.create') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                <i class="fas fa-user-plus"></i>
                {{ __('Add User') }}
            </a>
        </div>

        <!-- Table Container -->
        <div
            class="overflow-hidden rounded-lg bg-[color:var(--color-light-brunswick-green)] shadow-lg ring-1 ring-[color:var(--color-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:ring-[color:var(--color-light-brunswick-green)]">
            <table
                class="min-w-full divide-y divide-[color:var(--color-brunswick-green)] dark:divide-[color:var(--color-light-brunswick-green)]">
                <thead
                    class="bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-user mr-2"></i>
                            Name
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-envelope mr-2"></i>
                            Email
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-user-tag mr-2"></i>
                            Role
                        </th>
                        <th class="relative px-6 py-4">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="divide-y divide-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    @if (isset($users) && $users->count() > 0)
                        @foreach ($users as $user)
                            <tr
                                class="transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-castleton-green)]">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div
                                        class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @php
                                        $role = $user->getRoleNames()->join(', ');
                                    @endphp
                                    <span
                                        class="@if ($role === 'tenant_admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                        @elseif ($role === 'teacher') 
                                            bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                        @elseif ($role === 'student') 
                                            bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @else 
                                            bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] @endif inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                        @if ($role === 'tenant_admin')
                                            <i class="fas fa-crown mr-1"></i>
                                            Tenant Admin
                                        @elseif ($role === 'teacher')
                                            <i class="fas fa-chalkboard-teacher mr-1"></i>
                                            Teacher
                                        @elseif ($role === 'student')
                                            <i class="fas fa-graduation-cap mr-1"></i>
                                            Student
                                        @else
                                            <i class="fas fa-user mr-1"></i>
                                            {{ $role }}
                                        @endif
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('tenant.users.edit', $user) }}"
                                            class="rounded-lg p-2 text-[color:var(--color-dark-green)] transition-all duration-200 hover:bg-[color:var(--color-light-castleton-green)] hover:text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:hover:text-[color:var(--color-light-gunmetal)]"
                                            title="Edit user">
                                            <i class="fas fa-edit h-4 w-4"></i>
                                        </a>
                                        <a href="{{ route('tenant.users.show', $user) }}"
                                            class="rounded-lg p-2 text-[color:var(--color-dark-green)] transition-all duration-200 hover:bg-[color:var(--color-light-castleton-green)] hover:text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:hover:text-[color:var(--color-light-gunmetal)]"
                                            title="View user">
                                            <i class="fas fa-eye h-4 w-4"></i>
                                        </a>
                                        <form action="{{ route('tenant.users.destroy', $user) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg p-2 text-red-600 transition-all duration-200 hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900/20 dark:hover:text-red-400"
                                                title="Delete user"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
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
                                <div class="flex flex-col items-center">
                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                        <i
                                            class="fas fa-users h-6 w-6 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    </div>
                                    <h3
                                        class="mt-4 text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        No users found
                                    </h3>
                                    <p
                                        class="mt-1 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        Get started by adding your first user.
                                    </p>
                                    <div class="mt-4">
                                        <a href="{{ route('tenant.users.create') }}"
                                            class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-3 py-2 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:bg-[color:var(--color-dark-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Add User
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-tenant-dash-component>
