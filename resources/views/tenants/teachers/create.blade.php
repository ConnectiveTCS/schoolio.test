<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Teachers') }}
            </h2>
        </div>
    </x-slot>

    <div class="min-w-full p-6">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="mx-auto max-w-3xl rounded-lg bg-white p-6 shadow-xs dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">Add New Teacher</h3>
            <form method="POST" action="{{ route('tenant.teachers.store') }}">
                @csrf

                <!-- Personal Information -->
                <div class="mb-6">
                    <h4 class="text-md mb-3 font-medium text-gray-800 dark:text-gray-200">Personal Information</h4>

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                            :value="old('name')" required autofocus maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                            :value="old('email')" required maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="mt-1 block w-full" type="tel" name="phone"
                            :value="old('phone')" maxlength="20" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="mt-1 block w-full" type="text" name="address"
                            :value="old('address')" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="mb-6">
                    <h4 class="text-md mb-3 font-medium text-gray-800 dark:text-gray-200">Professional Information</h4>

                    <div class="mb-4">
                        <x-input-label for="subject" :value="__('Subject')" />
                        <x-text-input id="subject" class="mt-1 block w-full" type="text" name="subject"
                            :value="old('subject')" required maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="bio" :value="__('Bio')" />
                        <textarea id="bio" name="bio" rows="4" maxlength="1000"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            placeholder="Brief biography or description...">{{ old('bio') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="hire_date" :value="__('Hire Date')" />
                        <x-text-input id="hire_date" class="mt-1 block w-full" type="date" name="hire_date"
                            :value="old('hire_date')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('hire_date')" />
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input id="is_active" type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="mr-2 h-4 w-4 rounded-sm border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <x-input-label for="is_active" :value="__('Active Teacher')" class="cursor-pointer" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('tenant.teachers') }}"
                        class="rounded-md border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-hidden focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500">
                        Cancel
                    </a>
                    <x-primary-button>Create Teacher</x-primary-button>
                </div>
            </form>
        </div>

    </div>
</x-tenant-dash-component>
