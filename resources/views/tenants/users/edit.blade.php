<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Users') }}
            </h2>
        </div>
    </x-slot>

    <div class="min-w-full p-6">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="mx-auto max-w-3xl rounded-lg bg-white p-6 shadow-xs dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">Edit User</h3>
            <form method="POST" action="{{ route('tenant.users.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                        :value="old('name', $user->name)" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                        :value="old('email', $user->email)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div class="mb-4">
                    <x-input-label for="role" :value="__('Role')" />
                    <select id="role" name="role"
                        class="rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        required>
                        @php
                            $userRole = $user->getRoleNames()->first();
                        @endphp
                        <option value="tenant_admin" {{ $userRole === 'tenant_admin' ? 'selected' : '' }}>
                            {{ __('Tenant Admin') }}</option>
                        <option value="teacher" {{ $userRole === 'teacher' ? 'selected' : '' }}>{{ __('Teacher') }}
                        </option>
                        <option value="student" {{ $userRole === 'student' ? 'selected' : '' }}>{{ __('Student') }}
                        </option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>Update User</x-primary-button>
                    <a href="{{ route('tenant.users') }}"
                        class="inline-flex items-center rounded-md border border-transparent bg-gray-300 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 transition duration-150 ease-in-out hover:bg-gray-400 focus:bg-gray-400 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-500 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500 dark:focus:bg-gray-500 dark:focus:ring-offset-gray-800 dark:active:bg-gray-400">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-tenant-dash-component>
