<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-plus-circle mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Create Announcement') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div
            class="overflow-hidden rounded-lg bg-[color:var(--color-light-castleton-green)] shadow-sm ring-1 ring-[color:var(--color-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)] dark:ring-[color:var(--color-light-brunswick-green)]">
            <div class="px-6 py-8">
                <form method="POST" action="{{ route('tenant.announcements.store') }}" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <!-- Basic Information Section -->
                    <div
                        class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <h3
                            class="mb-6 flex items-center text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            <i
                                class="fas fa-info-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Basic Information
                        </h3>

                        <!-- Title -->
                        <div class="mb-6">
                            <x-input-label for="title"
                                class="flex items-center text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-heading mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                {{ __('Title') }}
                            </x-input-label>
                            <x-text-input id="title"
                                class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <x-input-label for="content"
                                class="flex items-center text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-align-left mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                {{ __('Content') }}
                            </x-input-label>
                            <textarea id="content" name="content" rows="6"
                                class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                required>{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Target Audience Section -->
                    <div
                        class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <h3
                            class="mb-6 flex items-center text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            <i
                                class="fas fa-users mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Target Audience
                        </h3>

                        <!-- Target Roles -->
                        <div class="mb-6">
                            <x-input-label for="target_roles"
                                class="flex items-center text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-user-tag mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                {{ __('Target Roles') }}
                            </x-input-label>
                            <p
                                class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-info-circle mr-1"></i>
                                Select which roles should see this announcement.
                            </p>
                            <div class="mt-3 space-y-3">
                                @foreach ($availableRoles as $roleKey => $roleLabel)
                                    @php
                                        $roleIcons = [
                                            'tenant_admin' => 'fa-crown',
                                            'teacher' => 'fa-chalkboard-teacher',
                                            'student' => 'fa-graduation-cap',
                                            'parent' => 'fa-users',
                                            'admin' => 'fa-user-shield',
                                            'multi_admin' => 'fa-user-cog',
                                        ];
                                        $roleIcon = $roleIcons[$roleKey] ?? 'fa-user';
                                    @endphp
                                    <label
                                        class="inline-flex cursor-pointer items-center rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-3 transition-all duration-200 hover:bg-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:hover:bg-[color:var(--color-light-castleton-green)]">
                                        <input type="checkbox" name="target_roles[]" value="{{ $roleKey }}"
                                            class="shadow-xs rounded-sm border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                            {{ in_array($roleKey, old('target_roles', [])) ? 'checked' : '' }}>
                                        <span
                                            class="ml-3 flex items-center text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                            <i class="fas {{ $roleIcon }} mr-2"></i>
                                            {{ $roleLabel }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('target_roles')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Settings Section -->
                    <div
                        class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <h3
                            class="mb-6 flex items-center text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            <i
                                class="fas fa-cog mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Settings
                        </h3>

                        <!-- Expiration Date -->
                        <div class="mb-6">
                            <x-input-label for="expires_at"
                                class="flex items-center text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-calendar-times mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                {{ __('Expiration Date (Optional)') }}
                            </x-input-label>
                            <x-text-input id="expires_at"
                                class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                type="datetime-local" name="expires_at" :value="old('expires_at')" />
                            <p
                                class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-info-circle mr-1"></i>
                                Leave empty if the announcement should not expire.
                            </p>
                            <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                        </div>

                        <!-- File Attachments -->
                        <div class="mb-6">
                            <x-input-label for="attachments"
                                class="flex items-center text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-paperclip mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                {{ __('Attachments (Optional)') }}
                            </x-input-label>
                            <div class="mt-1">
                                <input type="file" id="attachments" name="attachments[]" multiple
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar"
                                    class="block w-full text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 file:mr-4 file:rounded-md file:border-0 file:bg-[color:var(--color-light-castleton-green)] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-[color:var(--color-dark-green)] hover:file:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:file:bg-[color:var(--color-castleton-green)] dark:file:text-[color:var(--color-light-dark-green)] dark:hover:file:bg-[color:var(--color-light-castleton-green)]">
                            </div>
                            <p
                                class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-info-circle mr-1"></i>
                                Supported formats: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, JPG, PNG, GIF, ZIP, RAR.
                                Max size: 10MB per file.
                            </p>
                            <x-input-error :messages="$errors->get('attachments.*')" class="mt-2" />
                        </div>

                        <!-- Active Status -->
                        <div class="mb-6">
                            <label
                                class="inline-flex cursor-pointer items-center rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-3 transition-all duration-200 hover:bg-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:hover:bg-[color:var(--color-light-castleton-green)]">
                                <input type="checkbox" name="is_active" value="1"
                                    class="shadow-xs rounded-sm border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                    {{ old('is_active', true) ? 'checked' : '' }}>
                                <span
                                    class="ml-3 flex items-center text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    <i class="fas fa-toggle-on mr-2"></i>
                                    {{ __('Active (announcement will be visible immediately)') }}
                                </span>
                            </label>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="flex items-center justify-end gap-4 border-t border-[color:var(--color-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)]">
                        <a href="{{ route('tenant.announcements.index') }}"
                            class="shadow-xs inline-flex items-center rounded-md border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-gunmetal)] transition-all duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Create Announcement') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
