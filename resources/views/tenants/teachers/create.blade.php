<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-user-plus mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Create Teacher') }}
                </h2>
            </div>
            <a href="{{ route('tenant.teachers') }}"
                class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                <i class="fas fa-arrow-left mr-2"></i>Back to Teachers
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen transition-colors duration-200">
        <div class="min-w-full p-6">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div
                class="mx-auto max-w-3xl rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="mb-6 flex items-center">
                    <i
                        class="fas fa-user-plus mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        Add New Teacher</h3>
                </div>
                <form method="POST" action="{{ route('tenant.teachers.store') }}" class="space-y-6">
                    @csrf <!-- Personal Information -->
                    <div
                        class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                        <div class="mb-3 flex items-center">
                            <i
                                class="fas fa-user mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            <h4
                                class="text-md font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Personal Information</h4>
                        </div>

                        <div class="mb-4">
                            <div class="mb-1 flex items-center">
                                <i
                                    class="fas fa-user mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <x-input-label for="name" :value="__('Name')"
                                    class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]" />
                            </div>
                            <x-text-input id="name" class="mt-1 block w-full transition-colors duration-200"
                                type="text" name="name" :value="old('name')" required autofocus maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-4">
                            <div class="mb-1 flex items-center">
                                <i
                                    class="fas fa-envelope mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <x-input-label for="email" :value="__('Email')"
                                    class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]" />
                            </div>
                            <x-text-input id="email" class="mt-1 block w-full transition-colors duration-200"
                                type="email" name="email" :value="old('email')" required maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="mb-4">
                            <div class="mb-1 flex items-center">
                                <i
                                    class="fas fa-phone mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <x-input-label for="phone" :value="__('Phone')"
                                    class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]" />
                            </div>
                            <x-text-input id="phone" class="mt-1 block w-full transition-colors duration-200"
                                type="tel" name="phone" :value="old('phone')" maxlength="20" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div class="mb-4">
                            <div class="mb-1 flex items-center">
                                <i
                                    class="fas fa-map-marker-alt mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <x-input-label for="address" :value="__('Address')"
                                    class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]" />
                            </div>
                            <x-text-input id="address" class="mt-1 block w-full transition-colors duration-200"
                                type="text" name="address" :value="old('address')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div
                        class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                        <div class="mb-3 flex items-center">
                            <i
                                class="fas fa-chalkboard-teacher mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            <h4
                                class="text-md font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Professional Information</h4>
                        </div>

                        <div class="mb-4">
                            <div class="mb-1 flex items-center">
                                <i
                                    class="fas fa-book mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <x-input-label for="subject" :value="__('Subject')"
                                    class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]" />
                            </div>
                            <x-text-input id="subject" class="mt-1 block w-full transition-colors duration-200"
                                type="text" name="subject" :value="old('subject')" required maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                        </div>

                        <div class="mb-4">
                            <div class="mb-1 flex items-center">
                                <i
                                    class="fas fa-file-alt mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <x-input-label for="bio" :value="__('Bio')"
                                    class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]" />
                            </div>
                            <textarea id="bio" name="bio" rows="4" maxlength="1000"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                placeholder="Brief biography or description...">{{ old('bio') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <div class="mb-4">
                            <div class="mb-1 flex items-center">
                                <i
                                    class="fas fa-calendar-plus mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <x-input-label for="hire_date" :value="__('Hire Date')"
                                    class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]" />
                            </div>
                            <x-text-input id="hire_date" class="mt-1 block w-full transition-colors duration-200"
                                type="date" name="hire_date" :value="old('hire_date')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('hire_date')" />
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input id="is_active" type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                    class="mr-3 h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                                <i
                                    class="fas fa-toggle-on mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                <x-input-label for="is_active" :value="__('Active Teacher')"
                                    class="cursor-pointer text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end space-x-4 border-t border-[color:var(--color-light-brunswick-green)] pt-6 dark:border-[color:var(--color-castleton-green)]">
                        <a href="{{ route('tenant.teachers') }}"
                            class="inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                            <i class="fas fa-plus mr-2"></i>
                            Create Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
