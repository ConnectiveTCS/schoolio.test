@extends('central.layout')

@section('title', 'Create Admin')

@section('content')
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center">
                    <a href="{{ route('central.admins.index') }}" class="mr-4 text-blue-600 hover:text-blue-900">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Create New Admin</h1>
                </div>
                <p class="mt-1 text-sm text-gray-600">
                    Create a new central admin user with specific roles and permissions.
                </p>
            </div>

            <div class="rounded-lg bg-white shadow">
                <form method="POST" action="{{ route('central.admins.store') }}" class="space-y-6">
                    @csrf

                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="Enter full name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="admin@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="Enter secure password">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="Confirm password">
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Role & Permissions</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="role" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Select a role...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $role)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                <strong>Super Admin:</strong> Full system access including admin management.<br>
                                <strong>Admin:</strong> Can manage tenants and view data.<br>
                                <strong>Viewer:</strong> Read-only access to tenant data.
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Permissions</label>
                            <div class="mt-2 space-y-2">
                                @foreach ($permissions as $permission => $label)
                                    @php
                                        // Create a safe ID by removing spaces and special characters
                                        $safeId = 'permission_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $permission);
                                    @endphp
                                    <div class="flex items-center">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                                            id="{{ $safeId }}"
                                            {{ in_array($permission, old('permissions', [])) ? 'checked' : '' }}
                                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <label for="{{ $safeId }}" class="ml-2 text-sm text-gray-700">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                Select specific permissions for this admin. Note: Super admins automatically have all
                                permissions.
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 bg-gray-50 px-6 py-4">
                        <a href="{{ route('central.admins.index') }}"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Create Admin
                        </button>
                    </div>
                </form>
            </div>

            <!-- Role Description Cards -->
            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="rounded-lg bg-purple-50 p-4">
                    <div class="flex items-center">
                        <i class="fas fa-crown text-purple-600"></i>
                        <h4 class="ml-2 text-lg font-medium text-purple-900">Super Admin</h4>
                    </div>
                    <p class="mt-2 text-sm text-purple-700">
                        Complete system control including the ability to create, edit, and delete other admins.
                        Has access to all system settings and tenant management features.
                    </p>
                </div>

                <div class="rounded-lg bg-blue-50 p-4">
                    <div class="flex items-center">
                        <i class="fas fa-user-cog text-blue-600"></i>
                        <h4 class="ml-2 text-lg font-medium text-blue-900">Admin</h4>
                    </div>
                    <p class="mt-2 text-sm text-blue-700">
                        Can manage tenants, create new organizations, and access tenant data.
                        Cannot manage other admin accounts or system-wide settings.
                    </p>
                </div>

                <div class="rounded-lg bg-gray-50 p-4">
                    <div class="flex items-center">
                        <i class="fas fa-eye text-gray-600"></i>
                        <h4 class="ml-2 text-lg font-medium text-gray-900">Viewer</h4>
                    </div>
                    <p class="mt-2 text-sm text-gray-700">
                        Read-only access to view tenant information and statistics.
                        Cannot create, edit, or delete any data in the system.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-select permissions based on role
        document.getElementById('role').addEventListener('change', function() {
            const role = this.value;
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');

            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            if (role === 'super_admin') {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
            } else if (role === 'admin') {
                // Check for permissions that contain these key terms
                checkboxes.forEach(checkbox => {
                    const value = checkbox.value.toLowerCase();
                    if (value.includes('manage_tenants') || value.includes('view_tenant_data') ||
                        value.includes('manage tenants') || value.includes('view tenant data')) {
                        checkbox.checked = true;
                    }
                });
            } else if (role === 'viewer') {
                // Check for view permissions
                checkboxes.forEach(checkbox => {
                    const value = checkbox.value.toLowerCase();
                    if (value.includes('view_tenant_data') || value.includes('view tenant data') ||
                        value.includes('view') && (value.includes('tenant') || value.includes('data'))) {
                        checkbox.checked = true;
                    }
                });
            }
        });
    </script>
@endsection
