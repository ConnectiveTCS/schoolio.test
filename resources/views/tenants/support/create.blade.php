<x-tenant-dash-component>
    <x-slot name="header">
        <div
            class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <div class="flex items-center space-x-3">
                <i
                    class="fas fa-plus-circle text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Create Support Ticket') }}
                </h2>
            </div>
            <div
                class="flex items-center gap-x-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                <!-- Theme Toggle Button -->
                <button onclick="toggleTheme()"
                    class="focus:outline-hidden rounded-lg p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]"
                    title="Toggle theme">
                    <!-- Sun icon (visible in dark mode) -->
                    <i class="fas fa-sun hidden h-6 w-6 dark:block"></i>
                    <!-- Moon icon (visible in light mode) -->
                    <i class="fas fa-moon block h-6 w-6 dark:hidden"></i>
                </button>
            </div>
        </div>
    </x-slot>
    <div
        class="min-h-screen bg-[color:var(--color-light-dark-green)] py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div
                class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-xl transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div
                    class="p-6 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    <div
                        class="mb-8 rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="flex items-center space-x-4">
                            <div
                                class="rounded-full bg-[color:var(--color-light-castleton-green)] p-3 transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)]">
                                <i
                                    class="fas fa-plus-circle text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <div>
                                <h1
                                    class="text-3xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Create Support Ticket</h1>
                                <p
                                    class="mt-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Submit a new support request to our team</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('tenant.support.store') }}" method="POST" class="space-y-6"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Title Section -->
                        <div
                            class="rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <div class="mb-4 flex items-center">
                                <i
                                    class="fas fa-heading mr-3 text-lg text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                <h3
                                    class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Ticket Title</h3>
                            </div>
                            <div>
                                <label for="title"
                                    class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Title
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" required value="{{ old('title') }}"
                                    class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] placeholder-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]"
                                    placeholder="Brief description of your issue">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Category and Priority Section -->
                        <div
                            class="rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <div class="mb-4 flex items-center">
                                <i
                                    class="fas fa-tags mr-3 text-lg text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                <h3
                                    class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Classification</h3>
                            </div>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label for="category"
                                        class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        <i class="fas fa-tag mr-1"></i>Category <span class="text-red-500">*</span>
                                    </label>
                                    <select name="category" id="category" required
                                        class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]">
                                        <option value="">Select Category</option>
                                        <option value="technical"
                                            {{ old('category') == 'technical' ? 'selected' : '' }}>
                                            🔧 Technical Issue</option>
                                        <option value="billing" {{ old('category') == 'billing' ? 'selected' : '' }}>💰
                                            Billing
                                            Question</option>
                                        <option value="feature_request"
                                            {{ old('category') == 'feature_request' ? 'selected' : '' }}>💡 Feature
                                            Request
                                        </option>
                                        <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>❓
                                            General
                                            Inquiry</option>
                                    </select>
                                    @error('category')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="priority"
                                        class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Priority <span
                                            class="text-red-500">*</span>
                                    </label>
                                    <select name="priority" id="priority" required
                                        class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]">
                                        <option value="">Select Priority</option>
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>🟢 Low -
                                            General question or minor issue</option>
                                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>🟡
                                            Medium -
                                            Normal business impact</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>🟠
                                            High -
                                            Significant business impact</option>
                                        <option value="critical" {{ old('priority') == 'critical' ? 'selected' : '' }}>
                                            🔴 Critical - System down or major functionality broken</option>
                                    </select>
                                    @error('priority')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div
                            class="rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <div class="mb-4 flex items-center">
                                <i
                                    class="fas fa-align-left mr-3 text-lg text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                <h3
                                    class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Detailed Description</h3>
                            </div>
                            <div>
                                <label for="description"
                                    class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Description
                                    <span class="text-red-500">*</span></label>
                                <textarea name="description" id="description" rows="6" required
                                    class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] placeholder-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]"
                                    placeholder="Please provide detailed information about your issue or request. Include any error messages, steps to reproduce the problem, and any other relevant information.">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p
                                    class="mt-2 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    The more details you provide, the faster we can help resolve your issue.
                                </p>
                            </div>
                        </div>

                        <!-- Attachments Section -->
                        <div
                            class="rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <div class="mb-4 flex items-center">
                                <i
                                    class="fas fa-paperclip mr-3 text-lg text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                <h3
                                    class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Attachments</h3>
                            </div>
                            <div>
                                <label for="attachments"
                                    class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    <i class="fas fa-upload mr-1"></i>Upload Files
                                </label>
                                <input type="file" name="attachments[]" id="attachments" multiple
                                    class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 file:mr-4 file:rounded-l-lg file:border-0 file:bg-[color:var(--color-dark-green)] file:px-4 file:py-2 file:text-sm file:font-medium file:text-[color:var(--color-light-dark-green)] hover:file:bg-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:file:bg-[color:var(--color-light-dark-green)] dark:file:text-[color:var(--color-dark-green)] dark:hover:file:bg-[color:var(--color-castleton-green)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar"
                                    onchange="displaySelectedFiles(this)">
                                @error('attachments')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                @error('attachments.*')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p
                                    class="mt-2 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    You can attach up to 5 files (max 10MB each). Supported formats: PDF, DOC, DOCX,
                                    XLS, XLSX, PPT, PPTX, TXT, JPG, JPEG, PNG, GIF, ZIP, RAR.
                                </p>
                                <div id="selected-files" class="mt-4 hidden">
                                    <div class="mb-2 flex items-center">
                                        <i
                                            class="fas fa-list mr-2 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                        <p
                                            class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                            Selected files:</p>
                                    </div>
                                    <ul id="file-list"
                                        class="space-y-1 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-3 text-sm text-[color:var(--color-gunmetal)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)]">
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- What Happens Next Section -->
                        <div
                            class="rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <div class="mb-4 flex items-center">
                                <i
                                    class="fas fa-route mr-3 text-lg text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                <h3
                                    class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    What happens next?</h3>
                            </div>
                            <ul
                                class="space-y-3 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <li class="flex items-center">
                                    <i
                                        class="fas fa-user-tie mr-3 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    Your ticket will be assigned to our support team
                                </li>
                                <li class="flex items-center">
                                    <i
                                        class="fas fa-bell mr-3 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    You'll receive updates as we work on your request
                                </li>
                                <li class="flex items-center">
                                    <i
                                        class="fas fa-reply mr-3 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    You can reply to add more information or ask questions
                                </li>
                                <li class="flex items-center">
                                    <i
                                        class="fas fa-check-circle mr-3 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    We'll notify you when your ticket is resolved
                                </li>
                            </ul>
                        </div>

                        <!-- Form Actions -->
                        <div
                            class="flex items-center justify-between border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                            <a href="{{ route('tenant.support.index') }}"
                                class="focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] px-6 py-3 font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Cancel
                            </a>
                            <button type="submit"
                                class="focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] px-6 py-3 font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                <i class="fas fa-paper-plane mr-2"></i>
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

                // Determine file icon based on extension
                const extension = file.name.split('.').pop().toLowerCase();
                let icon = 'fas fa-file';
                if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                    icon = 'fas fa-image text-green-600 dark:text-green-400';
                } else if (extension === 'pdf') {
                    icon = 'fas fa-file-pdf text-red-600 dark:text-red-400';
                } else if (['doc', 'docx'].includes(extension)) {
                    icon = 'fas fa-file-word text-blue-600 dark:text-blue-400';
                } else if (['xls', 'xlsx'].includes(extension)) {
                    icon = 'fas fa-file-excel text-green-600 dark:text-green-400';
                } else if (['zip', 'rar'].includes(extension)) {
                    icon = 'fas fa-file-archive text-yellow-600 dark:text-yellow-400';
                }

                li.innerHTML = `<i class="${icon} mr-2"></i>${file.name} (${size} MB)`;
                li.className = 'flex items-center py-1';

                // Add warning for large files
                if (file.size > 10 * 1024 * 1024) {
                    li.classList.add('text-red-600');
                    li.innerHTML +=
                        ' <i class="fas fa-exclamation-triangle ml-2"></i> File too large (max 10MB)';
                }

                fileList.appendChild(li);
            });

            // Warn if too many files
            if (input.files.length > 5) {
                const warning = document.createElement('li');
                warning.className = 'text-red-600 font-medium flex items-center py-1';
                warning.innerHTML =
                    '<i class="fas fa-exclamation-triangle mr-2"></i>Too many files selected (max 5 files)';
                fileList.appendChild(warning);
            }
        } else {
            selectedFilesDiv.classList.add('hidden');
        }
    }
</script>
