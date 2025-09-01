@extends('central.layout')

@section('title', 'Tenant Management')

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl">
                        Tenant Management
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage all tenant organizations and their settings.
                    </p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    @if (auth('central_admin')->user()->canManageTenants())
                        <a href="{{ route('central.tenants.create') }}"
                            class="ml-3 inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Create Tenant
                        </a>
                    @endif
                </div>
            </div>

            <!-- Filters -->
            <div class="mb-6 rounded-lg bg-white shadow">
                <div class="px-6 py-4">
                    <form method="GET" action="{{ route('central.tenants.index') }}">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="Name, email, or ID...">
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="">All Statuses</option>
                                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>
                                        Suspended</option>
                                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                            <div>
                                <label for="plan" class="block text-sm font-medium text-gray-700">Plan</label>
                                <select name="plan" id="plan"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="">All Plans</option>
                                    <option value="basic" {{ request('plan') === 'basic' ? 'selected' : '' }}>Basic
                                    </option>
                                    <option value="premium" {{ request('plan') === 'premium' ? 'selected' : '' }}>Premium
                                    </option>
                                    <option value="enterprise" {{ request('plan') === 'enterprise' ? 'selected' : '' }}>
                                        Enterprise</option>
                                </select>
                            </div>
                            <div class="flex items-end space-x-2">
                                <button type="submit"
                                    class="inline-flex flex-1 items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                                    <i class="fas fa-search mr-2"></i>Filter
                                </button>
                                <a href="{{ route('central.tenants.index') }}"
                                    class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tenants Table -->
            <div class="overflow-hidden bg-white shadow sm:rounded-md">
                @if ($tenants->count() > 0)
                    <!-- Bulk Actions Bar -->
                    <div class="hidden border-b border-gray-200 bg-gray-50 px-6 py-3" id="bulk-actions">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-sm text-gray-700">
                                    <span id="selected-count">0</span> tenant(s) selected
                                </span>
                            </div>
                            <div class="flex items-center space-x-3">
                                @if (auth('central_admin')->user()->canManageTenants())
                                    <button type="button" onclick="bulkAction('suspend')"
                                        class="text-sm text-yellow-600 hover:text-yellow-900">
                                        <i class="fas fa-pause mr-1"></i>Suspend Selected
                                    </button>
                                    <button type="button" onclick="bulkAction('activate')"
                                        class="text-sm text-green-600 hover:text-green-900">
                                        <i class="fas fa-play mr-1"></i>Activate Selected
                                    </button>
                                    <button type="button" onclick="exportSelected()"
                                        class="text-sm text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-download mr-1"></i>Export Selected
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                @if ($tenants->count() > 0 && auth('central_admin')->user()->canManageTenants())
                                    <th class="px-6 py-3 text-left">
                                        <input type="checkbox" id="select-all"
                                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </th>
                                @endif
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Tenant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Plan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Domain</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Created</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($tenants as $tenant)
                                <tr class="hover:bg-gray-50">
                                    @if (auth('central_admin')->user()->canManageTenants())
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <input type="checkbox" name="selected_tenants[]" value="{{ $tenant->id }}"
                                                class="tenant-checkbox h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        </td>
                                    @endif
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $tenant->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $tenant->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $tenant->email }}</div>
                                        @if ($tenant->phone)
                                            <div class="text-sm text-gray-500">{{ $tenant->phone }}</div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="{{ $tenant->status === 'active' ? 'bg-green-100 text-green-800' : '' }} {{ $tenant->status === 'suspended' ? 'bg-yellow-100 text-yellow-800' : '' }} {{ $tenant->status === 'inactive' ? 'bg-red-100 text-red-800' : '' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ ucfirst($tenant->status) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ ucfirst($tenant->plan ?? 'N/A') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        @if ($tenant->domains->isNotEmpty())
                                            <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-900">
                                                {{ $tenant->domains->first()->domain }}
                                                <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                            </a>
                                        @else
                                            No domain
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $tenant->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('central.tenants.show', $tenant) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if (auth('central_admin')->user()->canManageTenants())
                                                <a href="{{ route('central.tenants.edit', $tenant) }}"
                                                    class="text-yellow-600 hover:text-yellow-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                @if ($tenant->status === 'active')
                                                    <form method="POST"
                                                        action="{{ route('central.tenants.suspend', $tenant) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('Are you sure you want to suspend this tenant?');">
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-yellow-600 hover:text-yellow-900">
                                                            <i class="fas fa-pause"></i>
                                                        </button>
                                                    </form>
                                                @elseif($tenant->status === 'suspended')
                                                    <form method="POST"
                                                        action="{{ route('central.tenants.activate', $tenant) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('Are you sure you want to activate this tenant?');">
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-green-600 hover:text-green-900">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <form method="POST"
                                                    action="{{ route('central.tenants.impersonate', $tenant) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('This will take you to the tenant\'s domain. Continue?');">
                                                    @csrf
                                                    <button type="submit" class="text-purple-600 hover:text-purple-900">
                                                        <i class="fas fa-user-secret"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth('central_admin')->user()->canManageTenants() ? '8' : '7' }}"
                                        class="px-6 py-4 text-center text-sm text-gray-500">
                                        No tenants found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($tenants->hasPages())
                <div class="mt-6">
                    {{ $tenants->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Bulk selection functionality
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const tenantCheckboxes = document.querySelectorAll('.tenant-checkbox');
            const bulkActionsBar = document.getElementById('bulk-actions');
            const selectedCountSpan = document.getElementById('selected-count');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    tenantCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateBulkActionsVisibility();
                });

                tenantCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        updateSelectAllState();
                        updateBulkActionsVisibility();
                    });
                });
            }

            function updateSelectAllState() {
                const checkedCount = document.querySelectorAll('.tenant-checkbox:checked').length;
                const totalCount = tenantCheckboxes.length;

                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = checkedCount === totalCount;
                    selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < totalCount;
                }
            }

            function updateBulkActionsVisibility() {
                const checkedCount = document.querySelectorAll('.tenant-checkbox:checked').length;

                if (selectedCountSpan) {
                    selectedCountSpan.textContent = checkedCount;
                }

                if (bulkActionsBar) {
                    if (checkedCount > 0) {
                        bulkActionsBar.classList.remove('hidden');
                    } else {
                        bulkActionsBar.classList.add('hidden');
                    }
                }
            }
        });

        function bulkAction(action) {
            const selectedTenants = Array.from(document.querySelectorAll('.tenant-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selectedTenants.length === 0) {
                alert('Please select at least one tenant.');
                return;
            }

            const actionText = action === 'suspend' ? 'suspend' : 'activate';
            const confirmMessage = `Are you sure you want to ${actionText} ${selectedTenants.length} tenant(s)?`;

            if (confirm(confirmMessage)) {
                // This would require implementing bulk action endpoints
                console.log(`${action} tenants:`, selectedTenants);
                alert(`Bulk ${actionText} functionality will be implemented in a future update.`);
            }
        }

        function exportSelected() {
            const selectedTenants = Array.from(document.querySelectorAll('.tenant-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selectedTenants.length === 0) {
                alert('Please select at least one tenant to export.');
                return;
            }

            // This would require implementing export functionality
            console.log('Export tenants:', selectedTenants);
            alert('Export functionality will be implemented in a future update.');
        }

        // Search functionality
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm) || searchTerm === '') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
