<x-tenant-dash-component :dashboardData="[]">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Reply to Message') }}
            </h2>
            <a href="{{ route('tenant.messages.show', $originalMessage) }}"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 active:bg-gray-900">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Back to Message') }}
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="mx-auto max-w-4xl">
            <!-- Original Message Context -->
            <div class="mb-6 rounded-lg border-l-4 border-blue-500 bg-gray-50 p-4 dark:bg-gray-700">
                <h3 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    <i class="fas fa-reply mr-2"></i>
                    Replying to:
                </h3>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-medium">{{ $originalMessage->subject }}</p>
                    <p>From: {{ $originalMessage->sender->name }} • {{ $originalMessage->created_at->format('M j, Y') }}
                    </p>
                    <div class="mt-2 rounded border bg-white p-2 text-xs dark:bg-gray-800">
                        {{ Str::limit(strip_tags($originalMessage->content), 150) }}
                    </div>
                </div>
            </div>

            <!-- Reply Form -->
            <div class="bg-white shadow dark:bg-gray-800 sm:rounded-lg">
                <form action="{{ route('tenant.messages.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6">
                    @csrf
                    <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">

                    <!-- Recipient Display -->
                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="fas fa-user mr-2"></i>
                            To:
                        </label>
                        <div
                            class="rounded-md border border-gray-200 bg-gray-50 p-3 dark:border-gray-600 dark:bg-gray-700">
                            <div class="flex items-center">
                                <div
                                    class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-blue-300 dark:bg-blue-600">
                                    <i class="fas fa-user text-sm text-blue-600 dark:text-blue-300"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $recipient->name }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ $recipient->getRoleNames()->first() }}
                                        @if ($recipient->department)
                                            - {{ $recipient->department }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="mb-6">
                        <label for="subject" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="fas fa-envelope mr-2"></i>
                            Subject *
                        </label>
                        <input type="text" name="subject" id="subject"
                            value="{{ old('subject', 'Re: ' . $originalMessage->subject) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div class="mb-6">
                        <label for="priority" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="fas fa-flag mr-2"></i>
                            Priority
                        </label>
                        <select name="priority" id="priority"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                            <option value="normal" {{ old('priority', 'normal') === 'normal' ? 'selected' : '' }}>
                                Normal</option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message Content -->
                    <div class="mb-6">
                        <label for="content" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="fas fa-comment mr-2"></i>
                            Your Reply *
                        </label>
                        <textarea name="content" id="content" rows="8" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                            placeholder="Type your reply here...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Attachments -->
                    <div class="mb-6">
                        <label for="attachments"
                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="fas fa-paperclip mr-2"></i>
                            Attachments
                        </label>
                        <div
                            class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pb-6 pt-5 dark:border-gray-600">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-cloud-upload-alt mb-3 text-3xl text-gray-400"></i>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="attachments"
                                        class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500 dark:bg-gray-800 dark:text-indigo-400">
                                        <span>Upload files</span>
                                        <input id="attachments" name="attachments[]" type="file" multiple
                                            class="sr-only"
                                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    PDF, DOC, XLS, PPT, TXT, JPG, PNG, GIF, ZIP up to 10MB (max 5 files)
                                </p>
                            </div>
                        </div>
                        @error('attachments')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @error('attachments.*')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        <!-- File Preview -->
                        <div id="file-preview" class="mt-3 hidden">
                            <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                                <h4 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Selected Files:
                                </h4>
                                <div id="file-list" class="space-y-1"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('tenant.messages.show', $originalMessage) }}"
                            class="inline-flex items-center rounded-md border border-transparent bg-gray-300 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 transition duration-150 ease-in-out hover:bg-gray-400 focus:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 active:bg-gray-500 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500 dark:focus:bg-gray-500 dark:active:bg-gray-400">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-blue-900">
                            <i class="fas fa-reply mr-2"></i>
                            Send Reply
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
                            const fileItem = document.createElement('div');
                            fileItem.className =
                                'flex items-center justify-between py-1 px-2 bg-white dark:bg-gray-600 rounded text-sm';
                            fileItem.innerHTML = `
                            <span class="text-gray-700 dark:text-gray-300">
                                <i class="fas fa-file mr-2"></i>
                                ${file.name} (${formatFileSize(file.size)})
                            </span>
                            <button type="button" onclick="removeFile(${index})" class="text-red-500 hover:text-red-700">
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
