@extends('central.layout')

@section('title', 'Admin Details - ' . $admin->name)

@section('content')
    <div class="mx-auto max-w-7xl px-4 transition-colors duration-200 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('central.admins.index') }}"
                            class="mr-4 text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h1
                                class="text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $admin->name }}</h1>
                            <p
                                class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Admin ID: {{ $admin->id }} • Joined {{ $admin->created_at->format('M j, Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        @if (
                            ($admin->role !== 'super_admin' || auth('central_admin')->user()->role === 'super_admin') &&
                                $admin->id !== auth('central_admin')->id())
                            <a href="{{ route('central.admins.edit', $admin) }}"
                                class="shadow-xs inline-flex items-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
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
                    <div
                        class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <div
                            class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                            <h3
                                class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Basic Information</h3>
                        </div>
                        <div class="px-6 py-4">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Full Name</dt>
                                    <dd
                                        class="mt-1 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->name }}</dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Email Address</dt>
                                    <dd
                                        class="mt-1 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        <a href="mailto:{{ $admin->email }}"
                                            class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                            {{ $admin->email }}
                                        </a>
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Role</dt>
                                    <dd class="mt-1">
                                        <span
                                            class="{{ $admin->role === 'super_admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : '' }} {{ $admin->role === 'admin' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }} {{ $admin->role === 'viewer' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' : '' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold transition-colors duration-200">
                                            {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Status</dt>
                                    <dd class="mt-1">
                                        <span
                                            class="{{ $admin->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold transition-colors duration-200">
                                            {{ $admin->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Last Login</dt>
                                    <dd
                                        class="mt-1 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->last_login_at ? $admin->last_login_at->format('M j, Y g:i A') : 'Never' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Created</dt>
                                    <dd
                                        class="mt-1 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->created_at->format('M j, Y g:i A') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Permissions -->
                    <div
                        class="mt-6 overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <div
                            class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                            <h3
                                class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Permissions</h3>
                        </div>
                        <div class="px-6 py-4">
                            @if (is_array($admin->permissions) && count($admin->permissions) > 0)
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    @foreach ($admin->permissions as $permission)
                                        <div
                                            class="flex items-center rounded-lg border border-green-200 bg-green-50 p-3 transition-colors duration-200 dark:border-green-800 dark:bg-green-900/20">
                                            <i class="fas fa-check-circle mr-3 text-green-600 dark:text-green-400"></i>
                                            <div>
                                                <div class="text-sm font-medium text-green-900 dark:text-green-100">
                                                    {{ ucfirst(str_replace('_', ' ', $permission)) }}
                                                </div>
                                                <div class="text-xs text-green-600 dark:text-green-300">
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
                                    <i
                                        class="fas fa-exclamation-circle mb-2 text-3xl text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        No specific permissions assigned.</p>
                                    @if ($admin->role === 'super_admin')
                                        <p
                                            class="mt-1 text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            Super admins have all permissions by default.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Activity Log (Placeholder) -->
                    <div
                        class="mt-6 overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <div
                            class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                            <h3
                                class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Recent Activity</h3>
                        </div>
                        <div class="px-6 py-4">
                            <div class="py-6 text-center">
                                <i
                                    class="fas fa-clock mb-2 text-3xl text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <p
                                    class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Activity logging is not yet implemented.</p>
                                <p
                                    class="mt-1 text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Future updates will show admin actions and login
                                    history.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Profile Card -->
                    <div
                        class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <div class="px-6 py-4 text-center">
                            <div
                                class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-light-castleton-green)]">
                                <span class="text-2xl font-medium text-white dark:text-[color:var(--color-dark-green)]">
                                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                                </span>
                            </div>
                            <h3
                                class="mt-4 text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $admin->name }}</h3>
                            <p
                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                {{ $admin->email }}</p>
                            <div class="mt-3">
                                <span
                                    class="{{ $admin->role === 'super_admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : '' }} {{ $admin->role === 'admin' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }} {{ $admin->role === 'viewer' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' : '' }} inline-flex rounded-full px-3 py-1 text-sm font-semibold transition-colors duration-200">
                                    {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div
                        class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <div
                            class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                            <h3
                                class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Account Stats</h3>
                        </div>
                        <div class="px-6 py-4">
                            <dl class="space-y-4">
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Member Since</dt>
                                    <dd
                                        class="mt-1 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->created_at->format('F j, Y') }}</dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Days Active</dt>
                                    <dd
                                        class="mt-1 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->created_at->diffInDays(now()) }} days
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Permission Count</dt>
                                    <dd
                                        class="mt-1 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
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
                        <div
                            class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                            <div
                                class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                                <h3
                                    class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    Actions</h3>
                            </div>
                            <div class="space-y-3 px-6 py-4">
                                <a href="{{ route('central.admins.edit', $admin) }}"
                                    class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                    <i class="fas fa-edit mr-2"></i>Edit Admin
                                </a>

                                @if (!$admin->is_active)
                                    <button type="button" onclick="toggleAdminStatus({{ $admin->id }}, true)"
                                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-green-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 dark:bg-green-500 dark:hover:bg-green-600">
                                        <i class="fas fa-play mr-2"></i>Activate Admin
                                    </button>
                                @else
                                    <button type="button" onclick="toggleAdminStatus({{ $admin->id }}, false)"
                                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-yellow-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600 dark:bg-yellow-500 dark:hover:bg-yellow-600">
                                        <i class="fas fa-pause mr-2"></i>Deactivate Admin
                                    </button>
                                @endif

                                <form method="POST" action="{{ route('central.admins.destroy', $admin) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this admin? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 dark:bg-red-500 dark:hover:bg-red-600">
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
