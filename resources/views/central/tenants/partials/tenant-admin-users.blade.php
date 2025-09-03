<!-- Create Tenant Admin User -->
@if (auth('central_admin')->user()->canManageTenants())
    <div class="overflow-hidden rounded-xl bg-white shadow-xs ring-1 ring-gray-200">
        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
            <h3 class="flex items-center text-lg font-semibold text-gray-900">
                <i class="fas fa-user-plus mr-2 text-blue-600"></i>
                Create Tenant Admin
            </h3>
        </div>
        <div class="px-6 py-6">
            <form method="POST" action="{{ route('central.tenants.admin-users.create', $tenant) }}"
                class="space-y-4" onsubmit="return confirm('Create new tenant admin user?');">
                @csrf
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="admin_name" class="mb-1 block text-sm font-medium text-gray-700">
                            <i class="fas fa-user mr-1 text-blue-600"></i>
                            Full Name
                        </label>
                        <input type="text" name="name" id="admin_name" required
                            class="block w-full rounded-lg border-gray-300 shadow-xs transition-colors duration-200 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter admin full name">
                    </div>
                    <div>
                        <label for="admin_email" class="mb-1 block text-sm font-medium text-gray-700">
                            <i class="fas fa-envelope mr-1 text-blue-600"></i>
                            Email Address
                        </label>
                        <input type="email" name="email" id="admin_email" required
                            class="block w-full rounded-lg border-gray-300 shadow-xs transition-colors duration-200 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="admin@domain.com">
                    </div>
                </div>
                <div>
                    <label for="admin_password" class="mb-1 block text-sm font-medium text-gray-700">
                        <i class="fas fa-lock mr-1 text-blue-600"></i>
                        Password
                    </label>
                    <input type="password" name="password" id="admin_password" required minlength="8"
                        class="block w-full rounded-lg border-gray-300 shadow-xs transition-colors duration-200 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Minimum 8 characters">
                    <p class="mt-1 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Password should be at least 8 characters long
                    </p>
                </div>
                <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle mr-2 mt-0.5 text-blue-600"></i>
                        <div>
                            <h4 class="text-sm font-medium text-blue-900">What this creates</h4>
                            <p class="mt-1 text-sm text-blue-700">
                                This will create a new user with 'tenant_admin' role and full permissions
                                within this tenant.
                                The user will be able to manage all aspects of the tenant system.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-medium text-white shadow-xs transition-all duration-200 hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create Admin User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif