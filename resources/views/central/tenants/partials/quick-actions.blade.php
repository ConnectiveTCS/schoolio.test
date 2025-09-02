@if (auth('central_admin')->user()->canManageTenants())
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
            <h3 class="flex items-center text-lg font-semibold text-gray-900">
                <i class="fas fa-cogs mr-2 text-blue-600"></i>
                Quick Actions
            </h3>
        </div>
        <div class="space-y-4 px-6 py-6">
            @if ($tenant->status === 'active')
                <form method="POST" action="{{ route('central.tenants.suspend', $tenant) }}"
                    onsubmit="return confirm('Are you sure you want to suspend this tenant? This will prevent access to their system.');">
                    @csrf
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-lg border-2 border-yellow-300 bg-yellow-50 px-4 py-3 text-sm font-medium text-yellow-800 transition-all duration-200 hover:border-yellow-400 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                        <i class="fas fa-pause mr-2"></i>
                        Suspend Tenant
                    </button>
                </form>
            @elseif($tenant->status === 'suspended')
                <form method="POST" action="{{ route('central.tenants.activate', $tenant) }}"
                    onsubmit="return confirm('Are you sure you want to activate this tenant?');">
                    @csrf
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-lg border-2 border-green-300 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 transition-all duration-200 hover:border-green-400 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        <i class="fas fa-play mr-2"></i>
                        Activate Tenant
                    </button>
                </form>
            @endif

            <div class="border-t border-gray-200 pt-4">
                <form method="POST" action="{{ route('central.tenants.impersonate', $tenant) }}"
                    onsubmit="return confirm('This will take you to the tenant\'s domain as an admin. Continue?');">
                    @csrf
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-lg border-2 border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 transition-all duration-200 hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-user-secret mr-2"></i>
                        Impersonate Tenant
                    </button>
                </form>
                <p class="mt-2 text-center text-xs text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    You'll be logged in as an admin on their domain
                </p>
            </div>
        </div>
    </div>
@endif
