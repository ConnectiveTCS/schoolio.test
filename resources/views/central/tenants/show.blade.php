@extends('central.layout')

@section('title', 'Tenant Details - ' . $tenant->name)

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="overflow-x-auto">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('central.tenants.index') }}" class="mr-4 text-blue-600 hover:text-blue-900">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <th class="px-2 py-1 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Roles</th>
                        @if (auth('central_admin')->user()->canManageTenants())
                            <th class="px-2 py-1 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Change
                                Role</th>
                        @endif
                        <h1 class="text-2xl font-bold text-gray-900">{{ $tenant->name }}</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Tenant ID: {{ $tenant->id }} • Created {{ $tenant->created_at->format('M j, Y') }}
                        </p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    @if (auth('central_admin')->user()->canManageTenants())
                        <a href="{{ route('central.tenants.edit', $tenant) }}"
                            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                            <i class="fas fa-edit mr-2"></i>Edit Tenant
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Information -->
            <div class="lg:col-span-2">
                <!-- Basic Information -->
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Organization Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tenant->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Contact Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="mailto:{{ $tenant->email }}" class="text-blue-600 hover:text-blue-900">
                                        {{ $tenant->email }}
                                    </a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tenant->phone ?: 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Alternative Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tenant->alt_phone ?: 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Website</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if ($tenant->website)
                                        <a href="{{ $tenant->website }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-900">
                                            {{ $tenant->website }}
                                            <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    <span
                                        class="{{ $tenant->status === 'active' ? 'bg-green-100 text-green-800' : '' }} {{ $tenant->status === 'suspended' ? 'bg-yellow-100 text-yellow-800' : '' }} {{ $tenant->status === 'inactive' ? 'bg-red-100 text-red-800' : '' }} inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ ucfirst($tenant->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tenant->address ?: 'N/A' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Configuration -->
                <div class="mt-6 overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Configuration</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Subscription Plan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($tenant->plan ?: 'N/A') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">School Type</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($tenant->school_type ?: 'N/A') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Language</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ strtoupper($tenant->language ?: 'EN') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Timezone</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tenant->timezone ?: 'UTC' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Trial Ends</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if ($tenant->trial_ends_at)
                                        {{ $tenant->trial_ends_at->format('M j, Y') }}
                                        @if ($tenant->trial_ends_at->isPast())
                                            <span
                                                class="ml-2 inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">
                                                Expired
                                            </span>
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tenant->payment_method ?: 'N/A' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Domains -->
                <div class="mt-6 overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Domains</h3>
                    </div>
                    <div class="px-6 py-4">
                        @if ($tenant->domains->isNotEmpty())
                            <ul class="divide-y divide-gray-200">
                                @foreach ($tenant->domains as $domain)
                                    <li class="py-3 first:pt-0 last:pb-0">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <a href="http://{{ $domain->domain }}" target="_blank"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    {{ $domain->domain }}
                                                    <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                                </a>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Added {{ $domain->created_at->format('M j, Y') }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">No domains configured.</p>
                        @endif
                    </div>
                </div>
                
                <div class="mt-6 overflow-hidden bg-white shadow sm:rounded-lg">
                @if (isset($roleSnapshot))
                    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">User Roles & Permissions</h3>
                            <span class="text-xs text-gray-500">Preview</span>
                        </div>
                        <div class="space-y-4 px-6 py-4">
                            @if (isset($roleSnapshot['error']))
                                <div class="rounded-md bg-yellow-50 p-3 text-sm text-yellow-800">
                                    {{ $roleSnapshot['error'] }}
                                </div>
                            @else
                                <div>
                                    <h4 class="mb-2 text-sm font-semibold text-gray-700">Role Distribution</h4>
                                    <ul class="divide-y divide-gray-100 rounded-md border border-gray-200"
                                        x-data="{ openRole: null }">
                                        @forelse($roleSnapshot['roles'] as $r)
                                            @php $perms = $roleSnapshot['roles_permissions'][$r->name] ?? []; @endphp
                                            <li class="px-3 py-2 text-sm">
                                                <div class="flex items-start justify-between">
                                                    <button type="button" class="group w-full flex-1 text-left"
                                                        @click="openRole === '{{ $r->name }}' ? openRole = null : openRole='{{ $r->name }}'">
                                                        <div class="flex items-center justify-between">
                                                            <span
                                                                class="font-medium text-gray-800 group-hover:text-blue-700">{{ ucfirst($r->name) }}</span>
                                                            <span
                                                                class="ml-2 inline-flex items-center rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700">{{ $r->users_count }}</span>
                                                        </div>
                                                        <div class="mt-1 text-[10px] text-gray-500"
                                                            x-show="openRole === '{{ $r->name }}'" x-cloak>
                                                            Permissions ({{ count($perms) }}):
                                                            <div class="mt-1 flex flex-wrap gap-1">
                                                                @forelse($perms as $p)
                                                                    <span
                                                                        class="rounded bg-gray-100 px-1.5 py-0.5 text-[10px] font-medium text-gray-700">{{ $p }}</span>
                                                                @empty
                                                                    <span class="text-gray-400">None</span>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="px-3 py-2 text-sm text-gray-500">No roles found.</li>
                                        @endforelse
                                    </ul>
                                    <p class="mt-2 text-xs text-gray-500">Total Users:
                                        {{ $roleSnapshot['total_users'] ?? 0 }}
                                    </p>
                                </div>
                                <div>
                                    <h4 class="mb-2 text-sm font-semibold text-gray-700">Sample Users (First 15)</h4>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="px-2 py-1 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                        ID</th>
                                                    <th
                                                        class="px-2 py-1 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                        Name</th>
                                                    <th
                                                        class="px-2 py-1 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                        Email</th>
                                                    <th
                                                        class="px-2 py-1 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                        Roles</th>
                                                    @if (auth('central_admin')->user()->canManageTenants())
                                                        <th
                                                            class="px-2 py-1 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                            Change Role</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100 bg-white">
                                                @forelse(($roleSnapshot['users'] ?? []) as $u)
                                                    <tr class="text-xs">
                                                        <td class="px-2 py-1 text-gray-700">{{ $u['id'] }}</td>
                                                        <td class="px-2 py-1 text-gray-700">{{ $u['name'] }}</td>
                                                        <td class="max-w-[140px] truncate px-2 py-1 text-gray-500"
                                                            title="{{ $u['email'] }}">{{ $u['email'] }}</td>
                                                        <td class="px-2 py-1 text-gray-700">
                                                            @if (count($u['roles']))
                                                                <span class="inline-flex flex-wrap gap-1">
                                                                    @foreach ($u['roles'] as $ur)
                                                                        <span
                                                                            class="rounded bg-gray-100 px-1.5 py-0.5 text-[10px] font-medium text-gray-700">{{ $ur }}</span>
                                                                    @endforeach
                                                                </span>
                                                            @else
                                                                <span class="text-gray-400">—</span>
                                                            @endif
                                                        </td>
                                                        @if (auth('central_admin')->user()->canManageTenants())
                                                            <td class="px-2 py-1 text-gray-700">
                                                                <form method="POST"
                                                                    action="{{ route('central.tenants.users.update-role', [$tenant, $u['id']]) }}"
                                                                    class="flex items-center space-x-1"
                                                                    onsubmit="return confirm('Update role for this user?');">
                                                                    @csrf
                                                                    <select name="role"
                                                                        class="rounded border-gray-300 bg-white py-0.5 pr-5 text-[11px] focus:border-blue-500 focus:ring-blue-500">
                                                                        @foreach ($roleSnapshot['roles'] ?? [] as $r)
                                                                            <option value="{{ $r->name }}"
                                                                                @if (in_array($r->name, $u['roles'])) selected @endif>
                                                                                {{ $r->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <button type="submit"
                                                                        class="inline-flex items-center rounded bg-blue-600 px-2 py-0.5 text-[10px] font-medium text-white hover:bg-blue-700">Save</button>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="{{ auth('central_admin')->user()->canManageTenants() ? '5' : '4' }}"
                                                            class="px-2 py-2 text-center text-xs text-gray-500">No
                                                            users found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="mt-2 text-[10px] text-gray-400">You can adjust an individual's primary role
                                        here. More granular permission tools will arrive in a later phase.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Roles & Permissions Snapshot (Phase 1 Read-only) -->
                
                <!-- Statistics -->
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Statistics</h3>
                    </div>
                    <div class="px-6 py-4">
                        @if (isset($stats['error']))
                            <div class="rounded-md bg-yellow-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">
                                            Unable to fetch statistics
                                        </h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            {{ $stats['error'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Total Users</dt>
                                    <dd class="mt-1 text-2xl font-semibold text-gray-900">
                                        {{ $stats['users_count'] ?? 0 }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Students</dt>
                                    <dd class="mt-1 text-2xl font-semibold text-gray-900">
                                        {{ $stats['students_count'] ?? 0 }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Teachers</dt>
                                    <dd class="mt-1 text-2xl font-semibold text-gray-900">
                                        {{ $stats['teachers_count'] ?? 0 }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Classes</dt>
                                    <dd class="mt-1 text-2xl font-semibold text-gray-900">
                                        {{ $stats['classes_count'] ?? 0 }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Announcements</dt>
                                    <dd class="mt-1 text-2xl font-semibold text-gray-900">
                                        {{ $stats['announcements_count'] ?? 0 }}</dd>
                                </div>
                            </dl>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                @if (auth('central_admin')->user()->canManageTenants())
                    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Actions</h3>
                        </div>
                        <div class="space-y-3 px-6 py-4">
                            @if ($tenant->status === 'active')
                                <form method="POST" action="{{ route('central.tenants.suspend', $tenant) }}"
                                    onsubmit="return confirm('Are you sure you want to suspend this tenant? This will prevent access to their system.');">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-700">
                                        <i class="fas fa-pause mr-2"></i>Suspend Tenant
                                    </button>
                                </form>
                            @elseif($tenant->status === 'suspended')
                                <form method="POST" action="{{ route('central.tenants.activate', $tenant) }}"
                                    onsubmit="return confirm('Are you sure you want to activate this tenant?');">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">
                                        <i class="fas fa-play mr-2"></i>Activate Tenant
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('central.tenants.impersonate', $tenant) }}"
                                onsubmit="return confirm('This will take you to the tenant\'s domain as an admin. Continue?');">
                                @csrf
                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-user-secret mr-2"></i>Impersonate
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
