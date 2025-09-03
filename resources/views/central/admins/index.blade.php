@extends('central.layout')

@section('title', 'Admin Management')

@section('content')
    <div class="mx-auto max-w-7xl px-4 transition-colors duration-200 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2
                        class="text-2xl font-bold leading-7 text-[color:var(--color-dark-green)] transition-colors duration-200 sm:truncate sm:text-3xl dark:text-[color:var(--color-light-dark-green)]">
                        Admin Management
                    </h2>
                    <p
                        class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Manage central admin users and their permissions.
                    </p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a href="{{ route('central.admins.create') }}"
                        class="shadow-xs ml-3 inline-flex items-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-plus mr-2"></i>Create Admin
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i
                                    class="fas fa-users-cog text-2xl text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt
                                        class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Total Admins</dt>
                                    <dd
                                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admins->total() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i
                                    class="fas fa-check-circle text-2xl text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt
                                        class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Active Admins</dt>
                                    <dd
                                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ \App\Models\CentralAdmin::where('is_active', true)->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i
                                    class="fas fa-crown text-2xl text-[color:var(--color-prussian-blue)] transition-colors duration-200 dark:text-[color:var(--color-light-prussian-blue)]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt
                                        class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Super Admins</dt>
                                    <dd
                                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ \App\Models\CentralAdmin::where('role', 'super_admin')->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admins Table -->
            <div
                class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-md dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)]">
                        <thead
                            class="bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-gunmetal)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Admin</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Role</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Permissions</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Last Login</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Created</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            @forelse($admins as $admin)
                                <tr
                                    class="transition-colors duration-150 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 shrink-0">
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-light-castleton-green)]">
                                                    <span
                                                        class="text-sm font-medium text-white dark:text-[color:var(--color-dark-green)]">
                                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                    {{ $admin->name }}</div>
                                                <div
                                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                    {{ $admin->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="{{ $admin->role === 'super_admin' ? 'bg-[color:var(--color-light-prussian-blue)] text-[color:var(--color-prussian-blue)] dark:bg-[color:var(--color-prussian-blue)] dark:text-[color:var(--color-light-prussian-blue)]' : '' }} {{ $admin->role === 'admin' ? 'bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]' : '' }} {{ $admin->role === 'viewer' ? 'bg-[color:var(--color-light-gunmetal)] text-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]' : '' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold transition-colors duration-200">
                                            {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                            @if (is_array($admin->permissions) && count($admin->permissions) > 0)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach (array_slice($admin->permissions, 0, 2) as $permission)
                                                        <span
                                                            class="inline-flex rounded-full bg-[color:var(--color-light-castleton-green)] px-2 py-1 text-xs font-semibold text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                                            {{ ucfirst(str_replace('_', ' ', $permission)) }}
                                                        </span>
                                                    @endforeach
                                                    @if (count($admin->permissions) > 2)
                                                        <span
                                                            class="inline-flex rounded-full bg-[color:var(--color-light-gunmetal)] px-2 py-1 text-xs font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                            +{{ count($admin->permissions) - 2 }} more
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span
                                                    class="text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">No
                                                    permissions</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="{{ $admin->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold transition-colors duration-200">
                                            {{ $admin->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $admin->last_login_at ? $admin->last_login_at->format('M j, Y g:i A') : 'Never' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $admin->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('central.admins.show', $admin) }}"
                                                class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if (
                                                ($admin->role !== 'super_admin' || auth('central_admin')->user()->role === 'super_admin') &&
                                                    $admin->id !== auth('central_admin')->id())
                                                <a href="{{ route('central.admins.edit', $admin) }}"
                                                    class="text-[color:var(--color-prussian-blue)] transition-colors duration-200 hover:text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-prussian-blue)] dark:hover:text-[color:var(--color-light-gunmetal)]"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form method="POST" action="{{ route('central.admins.destroy', $admin) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this admin? This action cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 transition-colors duration-200 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                        title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="px-6 py-4 text-center text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        No admins found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($admins->hasPages())
                <div class="mt-6">
                    {{ $admins->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
