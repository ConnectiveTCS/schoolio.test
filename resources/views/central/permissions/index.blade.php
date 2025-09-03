@extends('central.layout')

@section('title', 'Permission Management')

@section('content')
    <div class="mx-auto max-w-7xl px-4 transition-colors duration-200 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2
                        class="text-2xl font-bold leading-7 text-[color:var(--color-dark-green)] sm:truncate sm:text-3xl dark:text-[color:var(--color-light-dark-green)]">
                        Permission Management
                    </h2>
                    <p class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        Manage Permissions.
                    </p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <button onclick="document.getElementById('create-permission-form').classList.remove('hidden')"
                        class="shadow-xs ml-3 inline-flex items-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-plus mr-2"></i>Create Permission
                    </button>
                </div>
            </div>

            @if (session('success'))
                <div
                    class="mb-4 rounded-md border border-green-200 bg-green-50 p-4 transition-colors duration-200 dark:border-green-800 dark:bg-green-900">
                    <div class="flex">
                        <div class="shrink-0">
                            <svg class="h-5 w-5 text-green-400 dark:text-green-300" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div id="create-permission-form"
                class="mb-8 hidden overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="p-5">
                    <form action="{{ route('central.permissions.create') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Permission Name')" />
                            <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                                :value="old('name')" required autofocus maxlength="255" placeholder="Enter permission name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="shadow-xs inline-flex items-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                Create Permission
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i
                                    class="fas fa-users-cog text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt
                                        class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Total Permissions</dt>
                                    <dd
                                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $permissionsCount }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i
                                    class="fas fa-check-circle text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt
                                        class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Active Admins</dt>
                                    <dd
                                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ \App\Models\CentralAdmin::where('is_active', true)->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <i
                                    class="fas fa-crown text-2xl text-[color:var(--color-prussian-blue)] dark:text-[color:var(--color-light-prussian-blue)]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt
                                        class="truncate text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Super Admins</dt>
                                    <dd
                                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ \App\Models\CentralAdmin::where('role', 'super_admin')->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permissions Table -->
            <div
                class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 sm:rounded-md dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                        <thead class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Permission</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Roles Associated</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            @forelse($permissionsWithRoles as $permission)
                                <tr
                                    class="transition-colors duration-150 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $permission->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ implode(', ', $permission->roles->pluck('name')->toArray()) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2"
                                        class="px-6 py-4 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        No permissions found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            {{-- @if ($permissions->hasPages())
                <div class="mt-6">
                    {{ $permissions->links() }}
                </div>
            @endif --}}
        </div>
    </div>
@endsection
