<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Support') }}
            </h2>
            <div class="flex items-center gap-x-4 text-sm text-gray-600 dark:text-gray-400">
                <!-- Theme Toggle Button -->
                <button onclick="toggleTheme()"
                    class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800"
                    title="Toggle theme">
                    <!-- Sun icon (visible in dark mode) -->
                    <svg class="hidden h-6 w-6 dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Moon icon (visible in light mode) -->
                    <svg class="block h-6 w-6 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create Support Ticket</h1>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Submit a new support request to our team</p>
                    </div>

                    <form action="{{ route('tenant.support.store') }}" method="POST" class="space-y-6"
                        enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" required value="{{ old('title') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400 sm:text-sm"
                                placeholder="Brief description of your issue">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="category"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category <span
                                        class="text-red-500">*</span></label>
                                <select name="category" id="category" required
                                    class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400 sm:text-sm">
                                    <option value="">Select Category</option>
                                    <option value="technical" {{ old('category') == 'technical' ? 'selected' : '' }}>
                                        Technical Issue</option>
                                    <option value="billing" {{ old('category') == 'billing' ? 'selected' : '' }}>Billing
                                        Question</option>
                                    <option value="feature_request"
                                        {{ old('category') == 'feature_request' ? 'selected' : '' }}>Feature Request
                                    </option>
                                    <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General
                                        Inquiry</option>
                                </select>
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="priority"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority <span
                                        class="text-red-500">*</span></label>
                                <select name="priority" id="priority" required
                                    class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400 sm:text-sm">
                                    <option value="">Select Priority</option>
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low -
                                        General question or minor issue</option>
                                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium -
                                        Normal business impact</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High -
                                        Significant business impact</option>
                                    <option value="critical" {{ old('priority') == 'critical' ? 'selected' : '' }}>
                                        Critical - System down or major functionality broken</option>
                                </select>
                                @error('priority')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description <span
                                    class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="6" required
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400 sm:text-sm"
                                placeholder="Please provide detailed information about your issue or request. Include any error messages, steps to reproduce the problem, and any other relevant information.">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                The more details you provide, the faster we can help resolve your issue.
                            </p>
                        </div>

                        <div>
                            <label for="attachments"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Attachments</label>
                            <input type="file" name="attachments[]" id="attachments" multiple
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400 sm:text-sm"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar"
                                onchange="displaySelectedFiles(this)">
                            @error('attachments')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('attachments.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                You can attach up to 5 files (max 10MB each). Supported formats: PDF, DOC, DOCX, XLS,
                                XLSX, PPT, PPTX, TXT, JPG, JPEG, PNG, GIF, ZIP, RAR.
                            </p>
                            <div id="selected-files" class="mt-2 hidden">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Selected files:</p>
                                <ul id="file-list" class="mt-1 space-y-1 text-sm text-gray-600 dark:text-gray-400"></ul>
                            </div>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                            <h3 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">What happens next?</h3>
                            <ul class="space-y-1 text-sm text-gray-600 dark:text-gray-400">
                                <li>• Your ticket will be assigned to our support team</li>
                                <li>• You'll receive updates as we work on your request</li>
                                <li>• You can reply to add more information or ask questions</li>
                                <li>• We'll notify you when your ticket is resolved</li>
                            </ul>
                        </div>

                        <div
                            class="flex items-center justify-between border-t border-gray-200 pt-6 dark:border-gray-600">
                            <a href="{{ route('tenant.support.index') }}"
                                class="rounded-md bg-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
                                Cancel
                            </a>
                            <button type="submit"
                                class="rounded-md bg-blue-600 px-6 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                                Submit Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>

<script>
    function displaySelectedFiles(input) {
        const selectedFilesDiv = document.getElementById('selected-files');
        const fileList = document.getElementById('file-list');

        if (input.files.length > 0) {
            selectedFilesDiv.classList.remove('hidden');
            fileList.innerHTML = '';

            Array.from(input.files).forEach(file => {
                const li = document.createElement('li');
                const size = (file.size / 1024 / 1024).toFixed(2);
                li.innerHTML = `• ${file.name} (${size} MB)`;

                // Add warning for large files
                if (file.size > 10 * 1024 * 1024) {
                    li.classList.add('text-red-600');
                    li.innerHTML += ' - File too large (max 10MB)';
                }

                fileList.appendChild(li);
            });

            // Warn if too many files
            if (input.files.length > 5) {
                const warning = document.createElement('li');
                warning.className = 'text-red-600 font-medium';
                warning.innerHTML = '⚠️ Too many files selected (max 5 files)';
                fileList.appendChild(warning);
            }
        } else {
            selectedFilesDiv.classList.add('hidden');
        }
    }
</script>
