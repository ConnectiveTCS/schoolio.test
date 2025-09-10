<x-tenant-dash-component :dashboardData="[]">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                    <i
                        class="fas fa-edit text-xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                </div>
                <div>
                    <h2
                        class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        {{ __('Compose Message') }}
                    </h2>
                    <p
                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Create and send a new message
                    </p>
                </div>
            </div>
            <a href="{{ route('tenant.messages.index') }}"
                class="focus:outline-hidden inline-flex transform items-center space-x-2 rounded-md border border-transparent bg-[color:var(--color-gunmetal)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[color:var(--color-brunswick-green)] hover:shadow-lg focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-gunmetal)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] dark:active:bg-[color:var(--color-light-castleton-green)]">
                <i class="fas fa-arrow-left"></i>
                <span>{{ __('Back to Messages') }}</span>
            </a>
        </div>
    </x-slot>

    <div
        class="min-h-screen bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="mx-auto max-w-4xl">
            <div
                class="border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-xl transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <form action="{{ route('tenant.messages.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8 p-8">
                    @csrf

                    <!-- Recipient Selection -->
                    <div
                        class="rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="mb-4 flex items-center space-x-3">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                                <i
                                    class="fas fa-user text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <label for="recipient_id"
                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Recipient *
                            </label>
                        </div>
                        <select name="recipient_id" id="recipient_id" required
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-brunswick-green)]">
                            <option value="">Select a recipient</option>
                            @if ($recipient)
                                <option value="{{ $recipient->id }}" selected>{{ $recipient->name }}
                                    ({{ $recipient->getRoleNames()->first() }})</option>
                            @endif
                            @foreach ($recipients as $user)
                                @if (!$recipient || $recipient->id !== $user->id)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->getRoleNames()->first() }})
                                        @if ($user->department)
                                            - {{ $user->department }}
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('recipient_id')
                            <p class="mt-2 flex items-center space-x-1 text-sm text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div
                        class="rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="mb-4 flex items-center space-x-3">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                                <i
                                    class="fas fa-envelope text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <label for="subject"
                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Subject *
                            </label>
                        </div>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 placeholder:text-[color:var(--color-gunmetal)] focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-brunswick-green)]"
                            placeholder="Enter message subject">
                        @error('subject')
                            <p class="mt-2 flex items-center space-x-1 text-sm text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div
                        class="rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="mb-4 flex items-center space-x-3">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                                <i
                                    class="fas fa-flag text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <label for="priority"
                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Priority
                            </label>
                        </div>
                        <select name="priority" id="priority"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-brunswick-green)]">
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>🟢 Low</option>
                            <option value="normal" {{ old('priority', 'normal') === 'normal' ? 'selected' : '' }}>
                                ⚪ Normal</option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>🟡 High</option>
                            <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>🔴 Urgent
                            </option>
                        </select>
                        @error('priority')
                            <p class="mt-2 flex items-center space-x-1 text-sm text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Message Content -->
                    <div
                        class="rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="mb-4 flex items-center space-x-3">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                                <i
                                    class="fas fa-comment text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <label for="content"
                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Message *
                            </label>
                        </div>
                        <textarea name="content" id="content" rows="8" required
                            class="mt-1 block w-full resize-y rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 placeholder:text-[color:var(--color-gunmetal)] focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-brunswick-green)]"
                            placeholder="Type your message here...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-2 flex items-center space-x-1 text-sm text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Attachments -->
                    <div
                        class="rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="mb-4 flex items-center space-x-3">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                                <i
                                    class="fas fa-paperclip text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            </div>
                            <label for="attachments"
                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Attachments
                            </label>
                        </div>
                        <div
                            class="group mt-1 flex justify-center rounded-lg border-2 border-dashed border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-6 pb-6 pt-5 transition-colors duration-200 hover:border-[color:var(--color-dark-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:hover:border-[color:var(--color-light-dark-green)]">
                            <div class="space-y-1 text-center">
                                <div class="mb-3 flex justify-center">
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--color-brunswick-green)] transition-colors duration-200 group-hover:bg-[color:var(--color-dark-green)] dark:bg-[color:var(--color-light-brunswick-green)] dark:group-hover:bg-[color:var(--color-light-dark-green)]">
                                        <i
                                            class="fas fa-cloud-upload-alt text-2xl text-[color:var(--color-light-dark-green)] group-hover:text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:group-hover:text-[color:var(--color-dark-green)]"></i>
                                    </div>
                                </div>
                                <div
                                    class="flex text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    <label for="attachments"
                                        class="focus-within:outline-hidden relative cursor-pointer rounded-md bg-[color:var(--color-light-castleton-green)] px-3 py-1 font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 focus-within:ring-2 focus-within:ring-[color:var(--color-brunswick-green)] focus-within:ring-offset-2 hover:text-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:focus-within:ring-[color:var(--color-light-brunswick-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                        <span>Upload files</span>
                                        <input id="attachments" name="attachments[]" type="file" multiple
                                            class="sr-only"
                                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p
                                    class="flex items-center justify-center space-x-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-info-circle"></i>
                                    <span>PDF, DOC, XLS, PPT, TXT, JPG, PNG, GIF, ZIP up to 10MB (max 5 files)</span>
                                </p>
                            </div>
                        </div>
                        @error('attachments')
                            <p class="mt-2 flex items-center space-x-1 text-sm text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                        @error('attachments.*')
                            <p class="mt-2 flex items-center space-x-1 text-sm text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror

                        <!-- File Preview -->
                        <div id="file-preview" class="mt-4 hidden">
                            <div
                                class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-dark-green)]">
                                <h4
                                    class="mb-3 flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Selected Files:</span>
                                </h4>
                                <div id="file-list" class="space-y-2"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="flex items-center justify-end space-x-4 border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                        <a href="{{ route('tenant.messages.index') }}"
                            class="focus:outline-hidden inline-flex transform items-center space-x-2 rounded-md border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-6 py-3 text-sm font-medium text-[color:var(--color-gunmetal)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] hover:shadow-lg focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-brunswick-green)] dark:hover:text-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] dark:active:bg-[color:var(--color-light-brunswick-green)]">
                            <i class="fas fa-times"></i>
                            <span>Cancel</span>
                        </a>
                        <button type="submit"
                            class="focus:outline-hidden inline-flex transform items-center space-x-2 rounded-md border border-transparent bg-[color:var(--color-dark-green)] px-6 py-3 text-sm font-medium text-[color:var(--color-light-dark-green)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[color:var(--color-brunswick-green)] hover:shadow-lg focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] dark:active:bg-[color:var(--color-light-castleton-green)]">
                            <i class="fas fa-paper-plane"></i>
                            <span>Send Message</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('attachments');
                const filePreview = document.getElementById('file-preview');
                const fileList = document.getElementById('file-list');

                fileInput.addEventListener('change', function() {
                    const files = Array.from(this.files);

                    if (files.length > 0) {
                        filePreview.classList.remove('hidden');
                        fileList.innerHTML = '';

                        files.forEach((file, index) => {
                            const fileExtension = file.name.split('.').pop().toLowerCase();
                            const fileIcon = getFileIcon(fileExtension);

                            const fileItem = document.createElement('div');
                            fileItem.className =
                                'flex items-center justify-between py-3 px-4 bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] rounded-lg text-sm border border-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-brunswick-green)]';
                            fileItem.innerHTML = `
                            <div class="flex items-center space-x-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] dark:bg-[color:var(--color-dark-green)] transition-colors duration-200">
                                    <i class="${fileIcon} text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] transition-colors duration-200">${file.name}</p>
                                    <p class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] transition-colors duration-200">${formatFileSize(file.size)}</p>
                                </div>
                            </div>
                            <button type="button" onclick="removeFile(${index})" class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-800 transition-colors duration-200">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                            fileList.appendChild(fileItem);
                        });
                    } else {
                        filePreview.classList.add('hidden');
                    }
                });
            });

            function getFileIcon(extension) {
                const iconMap = {
                    // Documents
                    'pdf': 'fas fa-file-pdf',
                    'doc': 'fas fa-file-word',
                    'docx': 'fas fa-file-word',
                    'txt': 'fas fa-file-alt',

                    // Spreadsheets
                    'xls': 'fas fa-file-excel',
                    'xlsx': 'fas fa-file-excel',
                    'csv': 'fas fa-file-csv',

                    // Presentations
                    'ppt': 'fas fa-file-powerpoint',
                    'pptx': 'fas fa-file-powerpoint',

                    // Images
                    'jpg': 'fas fa-file-image',
                    'jpeg': 'fas fa-file-image',
                    'png': 'fas fa-file-image',
                    'gif': 'fas fa-file-image',
                    'svg': 'fas fa-file-image',

                    // Archives
                    'zip': 'fas fa-file-archive',
                    'rar': 'fas fa-file-archive',
                    '7z': 'fas fa-file-archive',

                    // Default
                    'default': 'fas fa-file'
                };

                return iconMap[extension] || iconMap['default'];
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function removeFile(index) {
                const fileInput = document.getElementById('attachments');
                const dt = new DataTransfer();
                const files = Array.from(fileInput.files);

                files.forEach((file, i) => {
                    if (i !== index) {
                        dt.items.add(file);
                    }
                });

                fileInput.files = dt.files;
                fileInput.dispatchEvent(new Event('change'));
            }
        </script>
    @endpush
</x-tenant-dash-component>
