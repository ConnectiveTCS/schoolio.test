@extends('central.layout')

@section('title', 'Create Admin')

@section('content')
    <div
        class="mx-auto min-h-screen max-w-4xl bg-[color:var(--color-light-dark-green)] px-4 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center">
                    <a href="{{ route('central.admins.index') }}"
                        class="mr-4 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-castleton-green)]">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1
                        class="text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Create New Admin</h1>
                </div>
                <p
                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Create a new central admin user with specific roles and permissions.
                </p>
            </div>

            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <form method="POST" action="{{ route('central.admins.store') }}" class="space-y-6">
                    @csrf

                    <div
                        class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Basic Information</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="name"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Full Name
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-[color:var(--color-light-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]"
                                        placeholder="Enter full name">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-user text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="email"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Email Address
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-[color:var(--color-light-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]"
                                        placeholder="admin@example.com">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-envelope text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
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
                                <label for="password"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Password
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-[color:var(--color-light-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]"
                                        placeholder="Enter secure password"
                                        onchange="document.getElementById('generated_password').innerText = document.getElementById('password').value;">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-lock text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="password_confirmation"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Confirm Password
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-[color:var(--color-light-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]"
                                        placeholder="Confirm password">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-check-circle text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
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
                            <label for="generate_password"
                                class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Generate Password
                            </label>
                            <div class="relative">
                                <input type="checkbox" name="generate_password" id="generate_password"
                                    class="mr-2 h-4 w-4 rounded border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                <label for="generate_password"
                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">Automatically
                                    generate a secure
                                    password</label>
                            </div>
                            <div class="relative">
                                <input type="text" id="generated_password" readonly
                                    class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 pr-12 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-colors duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-[color:var(--color-light-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]"
                                    placeholder="Generated password will appear here">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <button type="button" id="copy_password"
                                        class="focus:outline-hidden mr-2 rounded-md p-1 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] disabled:opacity-50 dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                        disabled title="Copy to clipboard">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                    <div class="pointer-events-none flex items-center pr-3">
                                        <i
                                            class="fas fa-key text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="copy_success" class="mt-1 hidden text-xs text-green-600">
                                <i class="fas fa-check mr-1"></i>Password copied to clipboard!
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
                        <div class="space-y-1">
                            <label for="role"
                                class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Role
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="role" id="role" required
                                    class="shadow-xs block w-full cursor-pointer appearance-none rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-[color:var(--color-light-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                    <option value="">Select a role...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $role)) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i
                                        class="fas fa-chevron-down text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                </div>
                            </div>
                            @error('role')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                            <p
                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <strong>Super Admin:</strong> Full system access including admin management.<br>
                                <strong>Admin:</strong> Can manage tenants and view data.<br>
                                <strong>Viewer:</strong> Read-only access to tenant data.
                            </p>
                        </div>

                        <div class="space-y-1">
                            <label
                                class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Permissions</label>
                            <div
                                class="mt-2 space-y-3 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                @foreach ($permissions as $permission => $label)
                                    @php
                                        $safeId = 'permission_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $permission);
                                    @endphp
                                    <div class="flex items-center">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                                            id="{{ $safeId }}"
                                            {{ in_array($permission, old('permissions', [])) ? 'checked' : '' }}
                                            class="h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                        <label for="{{ $safeId }}"
                                            class="ml-3 cursor-pointer text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
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
                            <p
                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Select specific permissions for this admin. Note: Super admins automatically have all
                                permissions.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex justify-end space-x-3 rounded-b-lg bg-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <a href="{{ route('central.admins.index') }}"
                            class="shadow-xs focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-3 text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-dark-green)] hover:text-[color:var(--color-light-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-dark-green)] dark:hover:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit"
                            class="focus:outline-hidden inline-flex transform items-center rounded-lg border border-transparent bg-gradient-to-r from-[color:var(--color-castleton-green)] to-[color:var(--color-brunswick-green)] px-6 py-3 text-sm font-semibold text-[color:var(--color-light-dark-green)] shadow-lg transition-all duration-200 hover:scale-105 hover:from-[color:var(--color-brunswick-green)] hover:to-[color:var(--color-dark-green)] focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:from-[color:var(--color-light-castleton-green)] dark:to-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-dark-green)] dark:hover:from-[color:var(--color-light-brunswick-green)] dark:hover:to-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                            <i class="fas fa-plus mr-2"></i>Create Admin
                        </button>
                    </div>
                </form>
            </div>

            <!-- Role Description Cards -->
            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div
                    class="shadow-xs rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="flex items-center">
                        <i
                            class="fas fa-crown text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h4
                            class="ml-2 text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Super Admin</h4>
                    </div>
                    <p
                        class="mt-3 text-sm leading-relaxed text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Complete system control including the ability to create, edit, and delete other admins.
                        Has access to all system settings and tenant management features.
                    </p>
                </div>

                <div
                    class="shadow-xs rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="flex items-center">
                        <i
                            class="fas fa-user-cog text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h4
                            class="ml-2 text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Admin</h4>
                    </div>
                    <p
                        class="mt-3 text-sm leading-relaxed text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Can manage tenants, create new organizations, and access tenant data.
                        Cannot manage other admin accounts or system-wide settings.
                    </p>
                </div>

                <div
                    class="shadow-xs rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="flex items-center">
                        <i
                            class="fas fa-eye text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h4
                            class="ml-2 text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Viewer</h4>
                    </div>
                    <p
                        class="mt-3 text-sm leading-relaxed text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
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
