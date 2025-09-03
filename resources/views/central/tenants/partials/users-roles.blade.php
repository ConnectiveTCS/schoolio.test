<!-- User Roles & Permissions -->
                @if (isset($roleSnapshot))
                    <div class="overflow-hidden rounded-xl bg-white shadow-xs ring-1 ring-gray-200">
                        <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-6 py-4">
                            <h3 class="flex items-center text-lg font-semibold text-gray-900">
                                <i class="fas fa-users-cog mr-2 text-blue-600"></i>
                                User Roles & Permissions
                            </h3>
                            <span
                                class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700">
                                <i class="fas fa-eye mr-1"></i>
                                Preview Mode
                            </span>
                        </div>
                        <div class="px-6 py-6">
                            @if (isset($roleSnapshot['error']))
                                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                                    <div class="flex items-start">
                                        <div class="shrink-0">
                                            <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-yellow-800">Unable to load roles data</h4>
                                            <p class="mt-1 text-sm text-yellow-700">{{ $roleSnapshot['error'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="space-y-6">
                                    <!-- Role Distribution -->
                                    <div>
                                        <h4 class="mb-4 flex items-center text-base font-semibold text-gray-900">
                                            <i class="fas fa-chart-pie mr-2 text-purple-600"></i>
                                            Role Distribution
                                        </h4>
                                        <div class="grid gap-3" x-data="{ openRole: null }">
                                            @forelse($roleSnapshot['roles'] as $r)
                                                @php $perms = $roleSnapshot['roles_permissions'][$r->name] ?? []; @endphp
                                                <div
                                                    class="overflow-hidden rounded-lg border border-gray-200 transition-shadow duration-200 hover:shadow-md">
                                                    <button type="button"
                                                        class="w-full bg-white px-4 py-3 text-left transition-colors duration-200 hover:bg-gray-50"
                                                        @click="openRole === '{{ $r->name }}' ? openRole = null : openRole='{{ $r->name }}'">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center space-x-3">
                                                                <div
                                                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">
                                                                    <i class="fas fa-user-tag text-xs text-blue-600"></i>
                                                                </div>
                                                                <span
                                                                    class="font-medium text-gray-900">{{ ucfirst($r->name) }}</span>
                                                            </div>
                                                            <div class="flex items-center space-x-2">
                                                                <span
                                                                    class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">
                                                                    {{ $r->users_count }}
                                                                    user{{ $r->users_count !== 1 ? 's' : '' }}
                                                                </span>
                                                                <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"
                                                                    :class="{ 'rotate-180': openRole === '{{ $r->name }}' }"></i>
                                                            </div>
                                                        </div>
                                                    </button>

                                                    <div class="border-t border-gray-200 bg-gray-50 px-4 py-3"
                                                        x-show="openRole === '{{ $r->name }}'" x-cloak
                                                        x-transition:enter="transition ease-out duration-200"
                                                        x-transition:enter-start="opacity-0 transform scale-95"
                                                        x-transition:enter-end="opacity-100 transform scale-100">
                                                        <div class="space-y-3">
                                                            <div>
                                                                <h5 class="mb-2 text-xs font-medium text-gray-700">
                                                                    Permissions ({{ count($perms) }})
                                                                </h5>
                                                                <div class="flex flex-wrap gap-1">
                                                                    @forelse($perms as $p)
                                                                        <span
                                                                            class="inline-flex items-center rounded-md border border-gray-200 bg-white px-2 py-1 text-xs font-medium text-gray-700">
                                                                            {{ $p }}
                                                                        </span>
                                                                    @empty
                                                                        <span class="text-xs italic text-gray-500">No
                                                                            permissions assigned</span>
                                                                    @endforelse
                                                                </div>
                                                            </div>

                                                            @if (auth('central_admin')->user()->canManageTenants())
                                                                <form method="POST"
                                                                    action="{{ route('central.tenants.roles.update-permissions', [$tenant, $r->name]) }}"
                                                                    class="mt-3 rounded-md border border-gray-200 bg-white p-3"
                                                                    onsubmit="return confirm('Update permissions for this role?');">
                                                                    @csrf
                                                                    <h6 class="mb-2 text-xs font-medium text-gray-700">
                                                                        Update Permissions:</h6>
                                                                    <div class="mb-3 max-h-24 space-y-1 overflow-y-auto">
                                                                        @foreach ($roleSnapshot['all_permissions'] ?? [] as $perm)
                                                                            <label class="flex items-center text-xs">
                                                                                <input type="checkbox"
                                                                                    name="permissions[]"
                                                                                    value="{{ $perm }}"
                                                                                    class="mr-2 rounded-sm border-gray-300 text-blue-600 focus:ring-blue-500"
                                                                                    @if (in_array($perm, $perms)) checked @endif>
                                                                                <span
                                                                                    class="text-gray-700">{{ $perm }}</span>
                                                                            </label>
                                                                        @endforeach
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="inline-flex items-center rounded-md bg-green-600 px-3 py-1 text-xs font-medium text-white transition-colors duration-200 hover:bg-green-700">
                                                                        <i class="fas fa-save mr-1"></i>
                                                                        Update Permissions
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="py-6 text-center">
                                                    <div
                                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                                                        <i class="fas fa-user-slash text-xl text-gray-400"></i>
                                                    </div>
                                                    <h4 class="mt-2 text-sm font-medium text-gray-900">No roles found</h4>
                                                    <p class="mt-1 text-sm text-gray-500">This tenant doesn't have any
                                                        roles configured.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <p class="mt-4 flex items-center text-xs text-gray-500">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Total Users: {{ $roleSnapshot['total_users'] ?? 0 }}
                                        </p>
                                    </div>

                                    <!-- Sample Users -->
                                    <div>
                                        <h4 class="mb-4 flex items-center text-base font-semibold text-gray-900">
                                            <i class="fas fa-users mr-2 text-green-600"></i>
                                            Sample Users
                                            <span class="ml-2 text-sm font-normal text-gray-500">(First 15)</span>
                                        </h4>
                                        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
                                            <div class="overflow-x-auto">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th
                                                                class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                                <i class="fas fa-hashtag mr-1"></i>ID
                                                            </th>
                                                            <th
                                                                class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                                <i class="fas fa-user mr-1"></i>Name
                                                            </th>
                                                            <th
                                                                class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                                <i class="fas fa-envelope mr-1"></i>Email
                                                            </th>
                                                            <th
                                                                class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                                <i class="fas fa-user-tag mr-1"></i>Roles
                                                            </th>
                                                            @if (auth('central_admin')->user()->canManageTenants())
                                                                <th
                                                                    class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                                    <i class="fas fa-edit mr-1"></i>Change Role
                                                                </th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200 bg-white">
                                                        @forelse(($roleSnapshot['users'] ?? []) as $u)
                                                            <tr class="transition-colors duration-200 hover:bg-gray-50">
                                                                <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                                                    #{{ $u['id'] }}
                                                                </td>
                                                                <td class="px-4 py-3 text-sm text-gray-900">
                                                                    <div class="flex items-center">
                                                                        <div
                                                                            class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">
                                                                            <span
                                                                                class="text-xs font-medium text-blue-600">
                                                                                {{ strtoupper(substr($u['name'], 0, 1)) }}
                                                                            </span>
                                                                        </div>
                                                                        <span
                                                                            class="font-medium">{{ $u['name'] }}</span>
                                                                    </div>
                                                                </td>
                                                                <td class="px-4 py-3 text-sm text-gray-500">
                                                                    <div class="max-w-[200px] truncate"
                                                                        title="{{ $u['email'] }}">
                                                                        {{ $u['email'] }}
                                                                    </div>
                                                                </td>
                                                                <td class="px-4 py-3 text-sm">
                                                                    @if (count($u['roles']))
                                                                        <div class="flex flex-wrap gap-1">
                                                                            @foreach ($u['roles'] as $ur)
                                                                                <span
                                                                                    class="inline-flex items-center rounded-full border border-blue-200 bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">
                                                                                    {{ $ur }}
                                                                                </span>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <span
                                                                            class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-xs font-medium text-gray-500">
                                                                            No roles
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                @if (auth('central_admin')->user()->canManageTenants())
                                                                    <td class="px-4 py-3 text-sm">
                                                                        <form method="POST"
                                                                            action="{{ route('central.tenants.users.update-role', [$tenant, $u['id']]) }}"
                                                                            class="flex items-center space-x-2"
                                                                            onsubmit="return confirm('Update role for this user?');">
                                                                            @csrf
                                                                            <select name="role"
                                                                                class="rounded-md border-gray-300 bg-white py-1.5 pr-8 text-xs focus:border-blue-500 focus:ring-blue-500">
                                                                                @foreach ($roleSnapshot['roles'] ?? [] as $r)
                                                                                    <option value="{{ $r->name }}"
                                                                                        @if (in_array($r->name, $u['roles'])) selected @endif>
                                                                                        {{ $r->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <button type="submit"
                                                                                class="inline-flex items-center rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white transition-colors duration-200 hover:bg-blue-700">
                                                                                <i class="fas fa-save mr-1"></i>
                                                                                Save
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="{{ auth('central_admin')->user()->canManageTenants() ? '5' : '4' }}"
                                                                    class="px-4 py-8 text-center">
                                                                    <div class="flex flex-col items-center">
                                                                        <div
                                                                            class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                                                                            <i
                                                                                class="fas fa-users text-xl text-gray-400"></i>
                                                                        </div>
                                                                        <h4 class="text-sm font-medium text-gray-900">No
                                                                            users found</h4>
                                                                        <p class="mt-1 text-xs text-gray-500">This tenant
                                                                            doesn't have any users yet.</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <p class="mt-3 flex items-center text-xs text-gray-500">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            You can adjust an individual's primary role here. More granular permission tools
                                            will arrive in a later phase.
                                        </p>
                                    </div>
                            @endif
                        </div>
                    </div>
                @endif