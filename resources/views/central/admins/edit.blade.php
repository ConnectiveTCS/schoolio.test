@extends('central.layout')

@section('title', 'Edit Admin - ' . $admin->name)

@section('content')
    <div
        class="mx-auto min-h-screen max-w-4xl bg-[color:var(--color-light-dark-green)] px-4 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center">
                    <a href="{{ route('central.admins.show', $admin) }}"
                        class="mr-4 text-[color:var(--color-dark-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1
                        class="text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Edit {{ $admin->name }}</h1>
                </div>
                <p
                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Update admin user information, role, and permissions.
                </p>
            </div>

            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <form method="POST" action="{{ route('central.admins.update', $admin) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div
                        class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Basic Information</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="name"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Full
                                    Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}"
                                    required
                                    class="shadow-xs mt-1 block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-opacity-50 sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-brunswick-green)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 transition-colors duration-200 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Email
                                    Address</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $admin->email) }}" required
                                    class="shadow-xs mt-1 block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-opacity-50 sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-brunswick-green)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 transition-colors duration-200 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="password"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">New
                                    Password</label>
                                <input type="password" name="password" id="password"
                                    class="shadow-xs mt-1 block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-opacity-50 sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-brunswick-green)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-castleton-green)]"
                                    placeholder="Leave blank to keep current password">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600 transition-colors duration-200 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Confirm
                                    New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="shadow-xs mt-1 block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-opacity-50 sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-brunswick-green)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-castleton-green)]"
                                    placeholder="Confirm new password">
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-600 transition-colors duration-200 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div
                        class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Role & Permissions</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="role"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Role</label>
                                <select name="role" id="role" required
                                    {{ $admin->role === 'super_admin' && auth('central_admin')->user()->role !== 'super_admin' ? 'disabled' : '' }}
                                    class="shadow-xs mt-1 block w-full cursor-pointer rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-opacity-50 sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-brunswick-green)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            {{ old('role', $admin->role) === $role ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $role)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($admin->role === 'super_admin' && auth('central_admin')->user()->role !== 'super_admin')
                                    <input type="hidden" name="role" value="{{ $admin->role }}">
                                    <p
                                        class="mt-1 text-xs text-yellow-600 transition-colors duration-200 dark:text-yellow-400">
                                        <i class="fas fa-lock mr-1"></i>Only super admins can modify super admin roles.
                                    </p>
                                @endif
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600 transition-colors duration-200 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="is_active"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Status</label>
                                <select name="is_active" id="is_active" required
                                    class="shadow-xs mt-1 block w-full cursor-pointer rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-opacity-50 sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-brunswick-green)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                    <option value="1" {{ old('is_active', $admin->is_active) ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ !old('is_active', $admin->is_active) ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-red-600 transition-colors duration-200 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Permissions</label>

                            {{-- Debug information
                            @if (config('app.debug'))
                                <div class="mb-2 rounded-sm border border-yellow-200 bg-yellow-50 p-2 text-xs">
                                    <strong>Debug:</strong> Admin permissions:
                                    {{ json_encode($admin->permissions ?? []) }}<br>
                                    <strong>Available permissions:</strong> {{ json_encode(array_keys($permissions)) }}<br>
                                    <strong>Old input:</strong> {{ json_encode(old('permissions', [])) }}
                                </div>
                            @endif --}}

                            <div
                                class="mt-2 space-y-3 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                                @foreach ($permissions as $permission => $label)
                                    @php
                                        // Check if this permission should be checked
                                        // Priority: old input (if form was submitted and validation failed) > admin's current permissions
$adminPermissions = $admin->permissions ?? [];
$oldPermissions = old('permissions', null);

if ($oldPermissions !== null) {
    // Form was submitted, use old input
    $isChecked = in_array($permission, $oldPermissions);
} else {
    // Initial load, use admin's current permissions
                                            $isChecked = in_array($permission, $adminPermissions);
                                        }

                                        // Create a safe ID by removing spaces and special characters
                                        $safeId = 'permission_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $permission);
                                    @endphp
                                    <div class="flex items-center">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                                            id="{{ $safeId }}" {{ $isChecked ? 'checked' : '' }}
                                            class="h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-brunswick-green)] transition-colors duration-200 focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-opacity-50 dark:border-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                        <label for="{{ $safeId }}"
                                            class="ml-3 cursor-pointer text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $label }}
                                            @if (config('app.debug'))
                                                <span
                                                    class="text-xs text-[color:var(--color-gunmetal)] opacity-60 dark:text-[color:var(--color-light-gunmetal)]">({{ $permission }}:
                                                    {{ $isChecked ? 'checked' : 'unchecked' }})</span>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <p class="mt-1 text-sm text-red-600 transition-colors duration-200 dark:text-red-400">
                                    {{ $message }}</p>
                            @enderror
                            <p
                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Select specific permissions for this admin. Note: Super admins automatically have all
                                permissions.
                            </p>
                        </div>
                    </div>

                    <div
                        class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Account Information</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div
                            class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-2 sm:grid-cols-2">
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Account Created</dt>
                                    <dd
                                        class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->created_at->format('M j, Y g:i A') }}</dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Last Updated</dt>
                                    <dd
                                        class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->updated_at->format('M j, Y g:i A') }}</dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Last Login</dt>
                                    <dd
                                        class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->last_login_at ? $admin->last_login_at->format('M j, Y g:i A') : 'Never' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Admin ID</dt>
                                    <dd
                                        class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $admin->id }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div
                        class="flex justify-end space-x-3 rounded-b-lg bg-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <a href="{{ route('central.admins.show', $admin) }}"
                            class="shadow-xs focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-3 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-all duration-200 hover:bg-[color:var(--color-light-dark-green)] focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit"
                            class="focus:outline-hidden inline-flex transform items-center rounded-lg border border-transparent bg-[color:var(--color-brunswick-green)] px-6 py-3 text-sm font-semibold text-[color:var(--color-light-dark-green)] shadow-lg transition-all duration-200 hover:scale-105 hover:bg-[color:var(--color-dark-green)] focus:ring-4 focus:ring-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                            <i class="fas fa-save mr-2"></i>Update Admin
                        </button>
                    </div>
                </form>
            </div>

            @if (
                $admin->id !== auth('central_admin')->id() &&
                    ($admin->role !== 'super_admin' || auth('central_admin')->user()->role === 'super_admin'))
                <!-- Danger Zone -->
                <div
                    class="mt-8 rounded-lg border border-red-300 bg-red-50 transition-colors duration-200 dark:border-red-600 dark:bg-red-900/20">
                    <div class="border-b border-red-300 px-6 py-4 transition-colors duration-200 dark:border-red-600">
                        <h3 class="text-lg font-medium text-red-900 transition-colors duration-200 dark:text-red-400">
                            Danger Zone</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4
                                    class="text-sm font-medium text-red-900 transition-colors duration-200 dark:text-red-400">
                                    Delete Admin Account</h4>
                                <p class="text-sm text-red-700 transition-colors duration-200 dark:text-red-300">
                                    Permanently delete this admin account. This action cannot be undone.
                                </p>
                            </div>
                            <form method="POST" action="{{ route('central.admins.destroy', $admin) }}"
                                onsubmit="return confirm('Are you sure you want to delete {{ $admin->name }}? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="shadow-xs focus:outline-hidden inline-flex items-center rounded-lg border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-red-700 focus:ring-4 focus:ring-red-200 dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-800">
                                    <i class="fas fa-trash mr-2"></i>Delete Admin
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Only auto-select permissions when role changes AND user confirms they want to reset permissions
        document.getElementById('role').addEventListener('change', function() {
            const role = this.value;
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');

            // Ask user if they want to reset permissions to default for this role
            if (confirm(
                    'Do you want to reset permissions to the default for this role? This will override current permission selections.'
                )) {
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
                            value.includes('view') && (value.includes('tenant') || value.includes('data'))
                        ) {
                            checkbox.checked = true;
                        }
                    });
                }
            }
        });
    </script>
@endsection
