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

            <div class="rounded-lg bg-white shadow-lg">
                <form method="POST" action="{{ route('central.admins.store') }}" class="space-y-6">
                    @csrf

                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="name" class="block text-sm font-semibold text-gray-800">
                                    Full Name
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="Enter full name">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="email" class="block text-sm font-semibold text-gray-800">
                                    Email Address
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="admin@example.com">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-semibold text-gray-800">
                                    Password
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="Enter secure password"
                                        onchange="document.getElementById('generated_password').innerText = document.getElementById('password').value;">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-800">
                                    Confirm Password
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="Confirm password">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-check-circle text-gray-400"></i>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        {{-- Generate Password --}}
                        <div class="space-y-1">
                            <label for="generate_password" class="block text-sm font-semibold text-gray-800">
                                Generate Password
                            </label>
                            <div class="relative">
                                <input type="checkbox" name="generate_password" id="generate_password" class="mr-2">
                                <label for="generate_password" class="text-sm text-gray-600">Automatically generate a secure
                                    password</label>
                            </div>
                            <div class="relative">
                                <input type="text" id="generated_password" readonly
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 pr-12 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                    placeholder="Generated password will appear here">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <button type="button" id="copy_password"
                                        class="mr-2 rounded-md p-1 text-gray-400 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                                        disabled title="Copy to clipboard">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                    <div class="pointer-events-none flex items-center pr-3">
                                        <i class="fas fa-key text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="copy_success" class="mt-1 hidden text-xs text-green-600">
                                <i class="fas fa-check mr-1"></i>Password copied to clipboard!
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Role & Permissions</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="space-y-1">
                            <label for="role" class="block text-sm font-semibold text-gray-800">
                                Role
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="role" id="role" required
                                    class="block w-full cursor-pointer appearance-none rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                                    <option value="">Select a role...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $role)) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            @error('role')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                <strong>Super Admin:</strong> Full system access including admin management.<br>
                                <strong>Admin:</strong> Can manage tenants and view data.<br>
                                <strong>Viewer:</strong> Read-only access to tenant data.
                            </p>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-800">Permissions</label>
                            <div class="mt-2 space-y-3 rounded-lg border border-gray-200 bg-gray-50 p-4">
                                @foreach ($permissions as $permission => $label)
                                    @php
                                        $safeId = 'permission_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $permission);
                                    @endphp
                                    <div class="flex items-center">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                                            id="{{ $safeId }}"
                                            {{ in_array($permission, old('permissions', [])) ? 'checked' : '' }}
                                            class="h-4 w-4 rounded border-gray-300 text-blue-600 transition-all duration-200 focus:ring-4 focus:ring-blue-100 focus:ring-blue-500">
                                        <label for="{{ $safeId }}"
                                            class="ml-3 cursor-pointer text-sm font-medium text-gray-700">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                Select specific permissions for this admin. Note: Super admins automatically have all
                                permissions.
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 rounded-b-lg bg-gray-50 px-6 py-4">
                        <a href="{{ route('central.admins.index') }}"
                            class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 shadow-sm transition-all duration-200 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex transform items-center rounded-lg border border-transparent bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">
                            <i class="fas fa-plus mr-2"></i>Create Admin
                        </button>
                    </div>
                </form>
            </div>

            <!-- Role Description Cards -->
            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="rounded-lg border border-purple-100 bg-purple-50 p-6 shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-crown text-purple-600"></i>
                        <h4 class="ml-2 text-lg font-semibold text-purple-900">Super Admin</h4>
                    </div>
                    <p class="mt-3 text-sm leading-relaxed text-purple-700">
                        Complete system control including the ability to create, edit, and delete other admins.
                        Has access to all system settings and tenant management features.
                    </p>
                </div>

                <div class="rounded-lg border border-blue-100 bg-blue-50 p-6 shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-user-cog text-blue-600"></i>
                        <h4 class="ml-2 text-lg font-semibold text-blue-900">Admin</h4>
                    </div>
                    <p class="mt-3 text-sm leading-relaxed text-blue-700">
                        Can manage tenants, create new organizations, and access tenant data.
                        Cannot manage other admin accounts or system-wide settings.
                    </p>
                </div>

                <div class="rounded-lg border border-gray-100 bg-gray-50 p-6 shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-eye text-gray-600"></i>
                        <h4 class="ml-2 text-lg font-semibold text-gray-900">Viewer</h4>
                    </div>
                    <p class="mt-3 text-sm leading-relaxed text-gray-700">
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

        // Generate random string for password
        function randomString(length) {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return result;
        }

        // Handle password generation checkbox
        document.getElementById('generate_password').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');
            const generatedPasswordField = document.getElementById('generated_password');
            const copyButton = document.getElementById('copy_password');

            if (this.checked) {
                const generatedPassword = randomString(12);
                passwordField.value = generatedPassword;
                confirmPasswordField.value = generatedPassword;
                generatedPasswordField.value = generatedPassword;
                copyButton.disabled = false;
                passwordField.type = 'text'; // Show generated password
                setTimeout(() => {
                    passwordField.type = 'password'; // Hide after 2 seconds
                }, 2000);
            } else {
                passwordField.value = '';
                confirmPasswordField.value = '';
                generatedPasswordField.value = '';
                copyButton.disabled = true;
                document.getElementById('copy_success').classList.add('hidden');
            }
        });

        // Handle copy to clipboard
        document.getElementById('copy_password').addEventListener('click', function() {
            const generatedPasswordField = document.getElementById('generated_password');
            const copySuccess = document.getElementById('copy_success');

            if (generatedPasswordField.value) {
                navigator.clipboard.writeText(generatedPasswordField.value).then(function() {
                    copySuccess.classList.remove('hidden');
                    setTimeout(() => {
                        copySuccess.classList.add('hidden');
                    }, 3000);
                }).catch(function() {
                    // Fallback for older browsers
                    generatedPasswordField.select();
                    document.execCommand('copy');
                    copySuccess.classList.remove('hidden');
                    setTimeout(() => {
                        copySuccess.classList.add('hidden');
                    }, 3000);
                });
            }
        });

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
