<!-- Create Tenant Admin User -->
@if (auth('central_admin')->user()->canManageTenants())
    <div
        class="shadow-xs overflow-hidden rounded-xl bg-white ring-1 ring-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)] dark:ring-[color:var(--color-brunswick-green)]">
        <div
            class="border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
            <h3
                class="flex items-center text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-user-plus mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                Create Tenant Admin
            </h3>
        </div>
        <div class="px-6 py-6">
            <form method="POST" action="{{ route('central.tenants.admin-users.create', $tenant) }}" class="space-y-4"
                onsubmit="return confirm('Create new tenant admin user?');">
                @csrf
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="admin_name"
                            class="mb-1 block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <i
                                class="fas fa-user mr-1 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Full Name
                        </label>
                        <input type="text" name="name" id="admin_name" required
                            class="shadow-xs block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-white text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            placeholder="Enter admin full name">
                    </div>
                    <div>
                        <label for="admin_email"
                            class="mb-1 block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <i
                                class="fas fa-envelope mr-1 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Email Address
                        </label>
                        <input type="email" name="email" id="admin_email" required
                            class="shadow-xs block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-white text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            placeholder="admin@domain.com">
                    </div>
                </div>
                <div>
                    <label for="admin_password"
                        class="mb-1 block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-lock mr-1 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Password
                    </label>
                    <input type="password" name="password" id="admin_password" required minlength="8"
                        class="shadow-xs block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-white text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                        placeholder="Minimum 8 characters">
                    <p
                        class="mt-1 text-xs text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-info-circle mr-1"></i>
                        Password should be at least 8 characters long
                    </p>
                </div>
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="flex items-start">
                        <i
                            class="fas fa-info-circle mr-2 mt-0.5 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <div>
                            <h4
                                class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                What this creates</h4>
                            <p
                                class="mt-1 text-sm text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                                This will create a new user with 'tenant_admin' role and full permissions
                                within this tenant.
                                The user will be able to manage all aspects of the tenant system.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="shadow-xs focus:outline-hidden inline-flex items-center rounded-lg bg-[color:var(--color-castleton-green)] px-6 py-2.5 text-sm font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create Admin User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
