@extends('central.layout')

@section('title', 'Admin Management')

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl">
                        Admin Management
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage central admin users and their permissions.
                    </p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a href="{{ route('central.admins.create') }}"
                        class="ml-3 inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-xs hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Create Admin
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i class="fas fa-users-cog text-2xl text-blue-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-500">Total Admins</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $admins->total() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i class="fas fa-check-circle text-2xl text-green-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-500">Active Admins</dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ \App\Models\CentralAdmin::where('is_active', true)->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i class="fas fa-crown text-2xl text-purple-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-500">Super Admins</dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ \App\Models\CentralAdmin::where('role', 'super_admin')->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admins Table -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-md">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Admin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Permissions</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Last Login</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Created</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($admins as $admin)
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 shrink-0">
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-500">
                                                    <span class="text-sm font-medium text-white">
                                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $admin->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $admin->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="{{ $admin->role === 'super_admin' ? 'bg-purple-100 text-purple-800' : '' }} {{ $admin->role === 'admin' ? 'bg-blue-100 text-blue-800' : '' }} {{ $admin->role === 'viewer' ? 'bg-gray-100 text-gray-800' : '' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            @if (is_array($admin->permissions) && count($admin->permissions) > 0)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach (array_slice($admin->permissions, 0, 2) as $permission)
                                                        <span
                                                            class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">
                                                            {{ ucfirst(str_replace('_', ' ', $permission)) }}
                                                        </span>
                                                    @endforeach
                                                    @if (count($admin->permissions) > 2)
                                                        <span
                                                            class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-800">
                                                            +{{ count($admin->permissions) - 2 }} more
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-500">No permissions</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="{{ $admin->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ $admin->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $admin->last_login_at ? $admin->last_login_at->format('M j, Y g:i A') : 'Never' }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $admin->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('central.admins.show', $admin) }}"
                                                class="text-blue-600 hover:text-blue-900" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if (
                                                ($admin->role !== 'super_admin' || auth('central_admin')->user()->role === 'super_admin') &&
                                                    $admin->id !== auth('central_admin')->id())
                                                <a href="{{ route('central.admins.edit', $admin) }}"
                                                    class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form method="POST" action="{{ route('central.admins.destroy', $admin) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this admin? This action cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
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
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
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
