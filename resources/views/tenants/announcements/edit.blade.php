<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Edit Announcement') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div
            class="overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-black ring-opacity-5 dark:bg-gray-800 dark:ring-gray-700">
            <div class="px-6 py-8">
                <form method="POST" action="{{ route('tenant.announcements.update', $announcement) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-6">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="mt-1 block w-full" type="text" name="title"
                            :value="old('title', $announcement->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Content -->
                    <div class="mb-6">
                        <x-input-label for="content" :value="__('Content')" />
                        <textarea id="content" name="content" rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                            required>{{ old('content', $announcement->content) }}</textarea>
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
                                        {{ in_array($roleKey, old('target_roles', $announcement->target_roles)) ? 'checked' : '' }}>
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
                            :value="old(
                                'expires_at',
                                $announcement->expires_at ? $announcement->expires_at->format('Y-m-d\TH:i') : '',
                            )" />
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Leave empty if the announcement should
                            not expire.</p>
                        <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                    </div>

                    <!-- Current Attachments -->
                    @if ($announcement->hasAttachments())
                        <div class="mb-6">
                            <x-input-label :value="__('Current Attachments')" />
                            <div class="mt-2 space-y-2">
                                @foreach ($announcement->attachments as $attachment)
                                    <div
                                        class="flex items-center justify-between rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
                                        <div class="flex items-center space-x-3">
                                            <div class="shrink-0">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $attachment['original_name'] }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $announcement->formatFileSize($attachment['size']) }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('tenant.announcements.download', [$announcement, $attachment['filename']]) }}"
                                                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                Download
                                            </a>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="remove_attachments[]"
                                                    value="{{ $attachment['filename'] }}"
                                                    class="rounded-sm border-gray-300 text-red-600 shadow-xs focus:border-red-300 focus:ring-3 focus:ring-red-200 focus:ring-opacity-50">
                                                <span class="ml-1 text-xs text-red-600">Remove</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- New File Attachments -->
                    <div class="mb-6">
                        <x-input-label for="attachments" :value="__('Add New Attachments (Optional)')" />
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
                                {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}>
                            <span
                                class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Active (announcement will be visible)') }}</span>
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
                            {{ __('Update Announcement') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
