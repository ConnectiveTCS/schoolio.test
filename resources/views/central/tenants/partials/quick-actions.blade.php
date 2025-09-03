@if (auth('central_admin')->user()->canManageTenants())
    <div
        class="shadow-xs overflow-hidden rounded-xl bg-white ring-1 ring-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)] dark:ring-[color:var(--color-brunswick-green)]">
        <div
            class="border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
            <h3
                class="flex items-center text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-cogs mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                Quick Actions
            </h3>
        </div>
        <div class="space-y-4 px-6 py-6">
            @if ($tenant->status === 'active')
                <form method="POST" action="{{ route('central.tenants.suspend', $tenant) }}"
                    onsubmit="return confirm('Are you sure you want to suspend this tenant? This will prevent access to their system.');">
                    @csrf
                    <button type="submit"
                        class="focus:outline-hidden inline-flex w-full items-center justify-center rounded-lg border-2 border-yellow-300 bg-yellow-50 px-4 py-3 text-sm font-medium text-yellow-800 transition-all duration-200 hover:border-yellow-400 hover:bg-yellow-100 focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:border-yellow-600 dark:bg-yellow-900/20 dark:text-yellow-300 dark:hover:border-yellow-500 dark:hover:bg-yellow-800/30">
                        <i class="fas fa-pause mr-2"></i>
                        Suspend Tenant
                    </button>
                </form>
            @elseif($tenant->status === 'suspended')
                <form method="POST" action="{{ route('central.tenants.activate', $tenant) }}"
                    onsubmit="return confirm('Are you sure you want to activate this tenant?');">
                    @csrf
                    <button type="submit"
                        class="focus:outline-hidden inline-flex w-full items-center justify-center rounded-lg border-2 border-green-300 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 transition-all duration-200 hover:border-green-400 hover:bg-green-100 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:border-green-600 dark:bg-green-900/20 dark:text-green-300 dark:hover:border-green-500 dark:hover:bg-green-800/30">
                        <i class="fas fa-play mr-2"></i>
                        Activate Tenant
                    </button>
                </form>
            @endif

            <div
                class="border-t border-[color:var(--color-light-brunswick-green)] pt-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                <form method="POST" action="{{ route('central.tenants.impersonate', $tenant) }}"
                    onsubmit="return confirm('This will take you to the tenant\'s domain as an admin. Continue?');">
                    @csrf
                    <button type="submit"
                        class="focus:outline-hidden inline-flex w-full items-center justify-center rounded-lg border-2 border-[color:var(--color-light-brunswick-green)] bg-white px-4 py-3 text-sm font-medium text-[color:var(--color-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] hover:bg-[color:var(--color-light-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <i class="fas fa-user-secret mr-2"></i>
                        Impersonate Tenant
                    </button>
                </form>
                <p
                    class="mt-2 text-center text-xs text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    <i class="fas fa-info-circle mr-1"></i>
                    You'll be logged in as an admin on their domain
                </p>
            </div>
        </div>
    </div>
@endif
