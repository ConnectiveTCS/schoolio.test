<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Create Announcement') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div
            class="overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-black ring-opacity-5 dark:bg-gray-800 dark:ring-gray-700">
            <div class="px-6 py-8">
                <form method="POST" action="{{ route('tenant.announcements.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="mt-1 block w-full" type="text" name="title"
                            :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Content -->
                    <div class="mb-6">
                        <x-input-label for="content" :value="__('Content')" />
                        <textarea id="content" name="content" rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            required>{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <!-- Target Roles -->
                    <div class="mb-6">
                        <x-input-label for="target_roles" :value="__('Target Roles')" />
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Select which roles should see this
                            announcement.</p>
                        <div class="mt-3 space-y-2">
                            @foreach ($availableRoles as $roleKey => $roleLabel)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="target_roles[]" value="{{ $roleKey }}"
                                        class="rounded-sm border-gray-300 text-indigo-600 shadow-xs focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                        {{ in_array($roleKey, old('target_roles', [])) ? 'checked' : '' }}>
                                    <span
                                        class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $roleLabel }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('target_roles')" class="mt-2" />
                    </div>

                    <!-- Expiration Date -->
                    <div class="mb-6">
                        <x-input-label for="expires_at" :value="__('Expiration Date (Optional)')" />
                        <x-text-input id="expires_at" class="mt-1 block w-full" type="datetime-local" name="expires_at"
                            :value="old('expires_at')" />
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Leave empty if the announcement should
                            not expire.</p>
                        <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                    </div>

                    <!-- File Attachments -->
                    <div class="mb-6">
                        <x-input-label for="attachments" :value="__('Attachments (Optional)')" />
                        <div class="mt-1">
                            <input type="file" id="attachments" name="attachments[]" multiple
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-200 dark:hover:file:bg-blue-800">
                        </div>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Supported formats: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, JPG, PNG, GIF, ZIP, RAR. Max
                            size: 10MB per file.
                        </p>
                        <x-input-error :messages="$errors->get('attachments.*')" class="mt-2" />
                    </div>

                    <!-- Active Status -->
                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                class="rounded-sm border-gray-300 text-indigo-600 shadow-xs focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                {{ old('is_active', true) ? 'checked' : '' }}>
                            <span
                                class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Active (announcement will be visible immediately)') }}</span>
                        </label>
                        <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('tenant.announcements.index') }}"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-xs transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                            Cancel
                        </a>
                        <x-primary-button>
                            {{ __('Create Announcement') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
