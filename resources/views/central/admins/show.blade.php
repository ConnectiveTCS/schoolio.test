@extends('central.layout')

@section('title', 'Admin Details - ' . $admin->name)

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('central.admins.index') }}" class="mr-4 text-blue-600 hover:text-blue-900">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $admin->name }}</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                Admin ID: {{ $admin->id }} • Joined {{ $admin->created_at->format('M j, Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        @if (
                            ($admin->role !== 'super_admin' || auth('central_admin')->user()->role === 'super_admin') &&
                                $admin->id !== auth('central_admin')->id())
                            <a href="{{ route('central.admins.edit', $admin) }}"
                                class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                                <i class="fas fa-edit mr-2"></i>Edit Admin
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Main Information -->
                <div class="lg:col-span-2">
                    <!-- Basic Information -->
                    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                        </div>
                        <div class="px-6 py-4">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $admin->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="mailto:{{ $admin->email }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $admin->email }}
                                        </a>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Role</dt>
                                    <dd class="mt-1">
                                        <span
                                            class="{{ $admin->role === 'super_admin' ? 'bg-purple-100 text-purple-800' : '' }} {{ $admin->role === 'admin' ? 'bg-blue-100 text-blue-800' : '' }} {{ $admin->role === 'viewer' ? 'bg-gray-100 text-gray-800' : '' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        <span
                                            class="{{ $admin->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ $admin->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Last Login</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $admin->last_login_at ? $admin->last_login_at->format('M j, Y g:i A') : 'Never' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Created</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $admin->created_at->format('M j, Y g:i A') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Permissions -->
                    <div class="mt-6 overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Permissions</h3>
                        </div>
                        <div class="px-6 py-4">
                            @if (is_array($admin->permissions) && count($admin->permissions) > 0)
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    @foreach ($admin->permissions as $permission)
                                        <div class="flex items-center rounded-lg bg-green-50 p-3">
                                            <i class="fas fa-check-circle mr-3 text-green-600"></i>
                                            <div>
                                                <div class="text-sm font-medium text-green-900">
                                                    {{ ucfirst(str_replace('_', ' ', $permission)) }}
                                                </div>
                                                <div class="text-xs text-green-600">
                                                    @switch($permission)
                                                        @case('manage_tenants')
                                                            Can create, edit, and manage tenant organizations
                                                        @break

                                                        @case('view_tenant_data')
                                                            Can view tenant information and statistics
                                                        @break

                                                        @case('manage_admins')
                                                            Can create, edit, and delete admin accounts
                                                        @break

                                                        @case('system_settings')
                                                            Can modify system-wide configuration settings
                                                        @break

                                                        @default
                                                            Permission: {{ $permission }}
                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-6 text-center">
                                    <i class="fas fa-exclamation-circle mb-2 text-3xl text-gray-400"></i>
                                    <p class="text-sm text-gray-500">No specific permissions assigned.</p>
                                    @if ($admin->role === 'super_admin')
                                        <p class="mt-1 text-xs text-gray-400">Super admins have all permissions by default.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Activity Log (Placeholder) -->
                    <div class="mt-6 overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
                        </div>
                        <div class="px-6 py-4">
                            <div class="py-6 text-center">
                                <i class="fas fa-clock mb-2 text-3xl text-gray-400"></i>
                                <p class="text-sm text-gray-500">Activity logging is not yet implemented.</p>
                                <p class="mt-1 text-xs text-gray-400">Future updates will show admin actions and login
                                    history.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Profile Card -->
                    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="px-6 py-4 text-center">
                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-500">
                                <span class="text-2xl font-medium text-white">
                                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                                </span>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $admin->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $admin->email }}</p>
                            <div class="mt-3">
                                <span
                                    class="{{ $admin->role === 'super_admin' ? 'bg-purple-100 text-purple-800' : '' }} {{ $admin->role === 'admin' ? 'bg-blue-100 text-blue-800' : '' }} {{ $admin->role === 'viewer' ? 'bg-gray-100 text-gray-800' : '' }} inline-flex rounded-full px-3 py-1 text-sm font-semibold">
                                    {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Account Stats</h3>
                        </div>
                        <div class="px-6 py-4">
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Member Since</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $admin->created_at->format('F j, Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Days Active</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $admin->created_at->diffInDays(now()) }} days
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Permission Count</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ is_array($admin->permissions) ? count($admin->permissions) : 0 }} permissions
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Actions -->
                    @if (
                        ($admin->role !== 'super_admin' || auth('central_admin')->user()->role === 'super_admin') &&
                            $admin->id !== auth('central_admin')->id())
                        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                            <div class="border-b border-gray-200 px-6 py-4">
                                <h3 class="text-lg font-medium text-gray-900">Actions</h3>
                            </div>
                            <div class="space-y-3 px-6 py-4">
                                <a href="{{ route('central.admins.edit', $admin) }}"
                                    class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                    <i class="fas fa-edit mr-2"></i>Edit Admin
                                </a>

                                @if (!$admin->is_active)
                                    <button type="button" onclick="toggleAdminStatus({{ $admin->id }}, true)"
                                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">
                                        <i class="fas fa-play mr-2"></i>Activate Admin
                                    </button>
                                @else
                                    <button type="button" onclick="toggleAdminStatus({{ $admin->id }}, false)"
                                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-700">
                                        <i class="fas fa-pause mr-2"></i>Deactivate Admin
                                    </button>
                                @endif

                                <form method="POST" action="{{ route('central.admins.destroy', $admin) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this admin? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                                        <i class="fas fa-trash mr-2"></i>Delete Admin
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAdminStatus(adminId, activate) {
            const action = activate ? 'activate' : 'deactivate';
            const message = activate ?
                'Are you sure you want to activate this admin?' :
                'Are you sure you want to deactivate this admin? They will lose access to the system.';

            if (confirm(message)) {
                // This would require implementing the toggle endpoint
                console.log(`${action} admin ${adminId}`);
                // For now, just reload the page
                location.reload();
            }
        }
    </script>
@endsection
