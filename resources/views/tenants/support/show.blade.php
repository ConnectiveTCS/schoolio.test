<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Support') }}
            </h2>
            <div class="flex items-center gap-x-4 text-sm text-gray-600 dark:text-gray-400">
                <!-- Theme Toggle Button -->
                <button onclick="toggleTheme()"
                    class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800"
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
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xs dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $ticket->ticket_number }}</h1>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $ticket->title }}</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span
                                    class="bg-{{ $ticket->priority_color }}-100 dark:bg-{{ $ticket->priority_color }}-900/30 text-{{ $ticket->priority_color }}-800 dark:text-{{ $ticket->priority_color }}-200 inline-flex items-center rounded-full px-3 py-1 text-sm font-medium">
                                    {{ ucfirst($ticket->priority) }} Priority
                                </span>
                                <span
                                    class="bg-{{ $ticket->status_color }}-100 dark:bg-{{ $ticket->status_color }}-900/30 text-{{ $ticket->status_color }}-800 dark:text-{{ $ticket->status_color }}-200 inline-flex items-center rounded-full px-3 py-1 text-sm font-medium">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('tenant.support.index') }}"
                                class="flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back to Support Tickets
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                        <!-- Main Content -->
                        <div class="space-y-6 lg:col-span-2">
                            <!-- Original Description -->
                            <div class="rounded-lg bg-gray-50 p-6 dark:bg-gray-700">
                                <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Original Request
                                </h2>
                                <div class="prose max-w-none">
                                    <p class="whitespace-pre-wrap text-gray-700 dark:text-gray-300">
                                        {{ $ticket->description }}</p>
                                </div>

                                @if ($ticket->attachments && count($ticket->attachments) > 0)
                                    <div class="mt-4">
                                        <h3 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Attachments:
                                        </h3>
                                        <div class="space-y-2">
                                            @foreach ($ticket->attachments as $attachment)
                                                <div
                                                    class="flex items-center space-x-2 rounded-md bg-white p-2 dark:bg-gray-800">
                                                    <svg class="h-4 w-4 text-gray-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                        </path>
                                                    </svg>
                                                    <a href="{{ route('tenant.support.download', [$ticket, $attachment['filename']]) }}"
                                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                        {{ $attachment['original_name'] }}
                                                    </a>
                                                    <span
                                                        class="text-xs text-gray-500">({{ number_format($attachment['size'] / 1024, 1) }}
                                                        KB)</span>
                                                    @php
                                                        $orig = strtolower($attachment['original_name']);
                                                        $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $orig);
                                                        $isPdf = preg_match('/\.(pdf)$/i', $orig);
                                                    @endphp
                                                    @if ($isImage || $isPdf)
                                                        <button type="button"
                                                            class="preview-attachment text-xs text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                            data-type="{{ $isImage ? 'image' : 'pdf' }}"
                                                            data-src="{{ route('tenant.support.download', [$ticket, $attachment['filename']]) }}"
                                                            data-name="{{ $attachment['original_name'] }}">
                                                            Preview
                                                        </button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Conversation -->
                            <div
                                class="rounded-lg border border-gray-200 bg-white dark:border-gray-600 dark:bg-gray-800">
                                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-600">
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Conversation</h2>
                                </div>
                                <div class="max-h-96 space-y-4 overflow-y-auto px-6 py-4">
                                    @forelse($replies as $reply)
                                        <div
                                            class="{{ $reply->sender_type === 'central_admin' ? 'justify-start' : 'justify-end' }} flex space-x-3">
                                            @if ($reply->sender_type === 'central_admin')
                                                <div class="shrink-0">
                                                    <div
                                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                                        <svg class="h-4 w-4 text-blue-600 dark:text-blue-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="min-w-0 max-w-xs flex-1">
                                                <div
                                                    class="bg-{{ $reply->sender_type === 'central_admin' ? 'blue' : 'gray' }}-50 dark:bg-{{ $reply->sender_type === 'central_admin' ? 'blue' : 'gray' }}-900/30 rounded-lg p-3">
                                                    <div class="mb-2 flex items-center justify-between">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $reply->sender_details['name'] }}
                                                            @if ($reply->sender_type === 'central_admin')
                                                                <span
                                                                    class="text-blue-600 dark:text-blue-400">(Support)</span>
                                                            @endif
                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $reply->created_at->format('M j, g:i A') }}</p>
                                                    </div>
                                                    <p
                                                        class="whitespace-pre-wrap text-sm text-gray-700 dark:text-gray-300">
                                                        {{ $reply->message }}</p>

                                                    @if ($reply->attachments && count($reply->attachments) > 0)
                                                        <div class="mt-3">
                                                            <div class="space-y-1">
                                                                @foreach ($reply->attachments as $attachment)
                                                                    <div class="flex items-center space-x-2 text-xs">
                                                                        <svg class="h-3 w-3 text-gray-500"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                            </path>
                                                                        </svg>
                                                                        <a href="{{ route('tenant.support.download', [$ticket, $attachment['filename']]) }}"
                                                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                                            {{ $attachment['original_name'] }}
                                                                        </a>
                                                                        <span
                                                                            class="text-gray-500">({{ number_format($attachment['size'] / 1024, 1) }}
                                                                            KB)</span>
                                                                        @php
                                                                            $orig = strtolower(
                                                                                $attachment['original_name'],
                                                                            );
                                                                            $isImage = preg_match(
                                                                                '/\.(jpg|jpeg|png|gif)$/i',
                                                                                $orig,
                                                                            );
                                                                            $isPdf = preg_match('/\.(pdf)$/i', $orig);
                                                                        @endphp
                                                                        @if ($isImage || $isPdf)
                                                                            <button type="button"
                                                                                class="preview-attachment text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                                                data-type="{{ $isImage ? 'image' : 'pdf' }}"
                                                                                data-src="{{ route('tenant.support.download', [$ticket, $attachment['filename']]) }}"
                                                                                data-name="{{ $attachment['original_name'] }}">
                                                                                Preview
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @if ($reply->sender_type === 'tenant_user')
                                                <div class="shrink-0">
                                                    <div
                                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-600">
                                                        <svg class="h-4 w-4 text-gray-600 dark:text-gray-300"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="py-8 text-center text-gray-500 dark:text-gray-400">No replies yet.
                                            Our
                                            support team will
                                            respond soon.</p>
                                    @endforelse
                                </div>

                                <!-- Reply Form -->
                                @if (!in_array($ticket->status, ['resolved', 'closed']))
                                    <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-600">
                                        <form action="{{ route('tenant.support.reply', $ticket) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-4">
                                                <label for="message"
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Add
                                                    Reply</label>
                                                <textarea name="message" id="message" rows="3" required
                                                    class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-xs focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400 sm:text-sm"
                                                    placeholder="Type your message..."></textarea>
                                            </div>

                                            <div class="mb-4">
                                                <label for="reply_attachments"
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Attachments</label>
                                                <input type="file" name="attachments[]" id="reply_attachments"
                                                    multiple
                                                    class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-xs focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400 sm:text-sm"
                                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    Max 5 files, 10MB each. Supported: PDF, DOC, DOCX, XLS, XLSX, PPT,
                                                    PPTX, TXT, JPG, JPEG, PNG, GIF, ZIP, RAR.
                                                </p>
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                                                    Send Reply
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-600">
                                        <p class="text-center text-gray-500 dark:text-gray-400">This ticket has been
                                            {{ $ticket->status }}. If you need further assistance, please create a new
                                            ticket.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Ticket Info -->
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-600 dark:bg-gray-800">
                                <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Ticket Details
                                </h3>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                                        <dd class="text-sm text-gray-900 dark:text-white">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->category)) }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Priority</dt>
                                        <dd class="text-sm text-gray-900 dark:text-white">
                                            {{ ucfirst($ticket->priority) }}</dd>
                                    </div>
                                    @if ($centralTicket && $centralTicket->assignedAdmin)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Assigned
                                                to</dt>
                                            <dd class="text-sm text-gray-900 dark:text-white">
                                                {{ $centralTicket->assignedAdmin->name }}
                                            </dd>
                                        </div>
                                    @endif
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created by
                                        </dt>
                                        <dd class="text-sm text-gray-900 dark:text-white">
                                            {{ $ticket->createdBy->name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</dt>
                                        <dd class="text-sm text-gray-900 dark:text-white">
                                            {{ $ticket->created_at->format('M j, Y g:i A') }}</dd>
                                    </div>
                                    @if ($ticket->resolved_at)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Resolved
                                            </dt>
                                            <dd class="text-sm text-gray-900 dark:text-white">
                                                {{ $ticket->resolved_at->format('M j, Y g:i A') }}</dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>

                            <!-- Status Info -->
                            <div
                                class="rounded-lg border border-blue-200 bg-blue-50 p-6 dark:border-blue-600 dark:bg-blue-900/30">
                                <h3 class="mb-2 text-lg font-semibold text-blue-900 dark:text-blue-200">What's Next?
                                </h3>

                                @if ($centralTicket && $centralTicket->assignedAdmin)
                                    <div class="mb-3 rounded-md bg-white/50 p-3 dark:bg-gray-800/50">
                                        <p class="text-sm font-medium text-blue-900 dark:text-blue-200">Assigned to:
                                        </p>
                                        <p class="text-sm text-blue-800 dark:text-blue-300">
                                            {{ $centralTicket->assignedAdmin->name }}
                                        </p>
                                        @if ($centralTicket->assignedAdmin->email)
                                            <p class="text-xs text-blue-700 dark:text-blue-400">
                                                {{ $centralTicket->assignedAdmin->email }}
                                            </p>
                                        @endif
                                    </div>
                                @endif

                                @switch($ticket->status)
                                    @case('open')
                                        <p class="text-sm text-blue-800 dark:text-blue-300">
                                            @if ($centralTicket && $centralTicket->assignedAdmin)
                                                Your ticket has been assigned to {{ $centralTicket->assignedAdmin->name }} and
                                                they will respond soon.
                                            @else
                                                Your ticket has been submitted and is waiting to be assigned to a support agent.
                                            @endif
                                        </p>
                                    @break

                                    @case('in_progress')
                                        <p class="text-sm text-blue-800 dark:text-blue-300">
                                            @if ($centralTicket && $centralTicket->assignedAdmin)
                                                {{ $centralTicket->assignedAdmin->name }} is actively working on your request.
                                            @else
                                                Our support team is actively working on your request.
                                            @endif
                                            You'll receive updates as we progress.
                                        </p>
                                    @break

                                    @case('resolved')
                                        <p class="text-sm text-blue-800 dark:text-blue-300">Your ticket has been resolved. If
                                            the issue persists,
                                            you can reply to reopen it or create a new ticket.</p>
                                    @break

                                    @case('closed')
                                        <p class="text-sm text-blue-800 dark:text-blue-300">This ticket has been closed. If you
                                            need further
                                            assistance, please create a new support ticket.</p>
                                    @break

                                    @default
                                        <p class="text-sm text-blue-800 dark:text-blue-300">We'll keep you updated on the
                                            progress of your support
                                            request.</p>
                                @endswitch
                            </div> <!-- Actions -->
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-600 dark:bg-gray-800">
                                <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Actions</h3>
                                <div class="space-y-3">
                                    <a href="{{ route('tenant.support.create') }}"
                                        class="block w-full rounded-md bg-blue-600 px-4 py-2 text-center text-white hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                                        Create New Ticket
                                    </a>
                                    <a href="{{ route('tenant.support.index') }}"
                                        class="block w-full rounded-md bg-gray-200 px-4 py-2 text-center text-gray-800 hover:bg-gray-300 focus:outline-hidden focus:ring-2 focus:ring-gray-500 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500 dark:focus:ring-gray-400">
                                        View All Tickets
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>

<!-- Attachment Preview Modal (Tenant) -->
<div id="attachmentPreviewModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/50" data-preview-close></div>
    <div
        class="relative max-h-[90vh] w-11/12 max-w-3xl overflow-hidden rounded-lg bg-white shadow-xl dark:bg-gray-800">
        <div class="flex items-center justify-between border-b px-4 py-2 dark:border-gray-700">
            <h3 id="previewTitle" class="text-sm font-semibold text-gray-800 dark:text-gray-100">Attachment Preview
            </h3>
            <button class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100"
                data-preview-close>&times;</button>
        </div>
        <div class="preview-body relative max-h-[80vh] overflow-auto bg-gray-50 dark:bg-gray-900/40">
            <div id="previewImageWrapper" class="hidden">
                <img id="previewImage" src="" alt="Preview" class="mx-auto block max-h-[78vh] w-auto">
            </div>
            <div id="previewPdfWrapper" class="hidden h-[78vh]">
                <iframe id="previewPdf" src="" class="h-full w-full" frameborder="0"></iframe>
            </div>
            <div id="previewUnsupported" class="hidden p-6 text-center text-sm text-gray-600 dark:text-gray-300">
                Preview not available. Please download the file to view it.
            </div>
        </div>
        <div class="flex justify-end gap-2 border-t px-4 py-2 dark:border-gray-700">
            <a id="downloadOriginal" href="#"
                class="rounded-sm bg-blue-600 px-3 py-1.5 text-sm text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600"
                target="_blank" rel="noopener">Download</a>
            <button
                class="rounded-sm bg-gray-200 px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500"
                data-preview-close>Close</button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('attachmentPreviewModal');
        if (!modal) return;
        const imgWrapper = document.getElementById('previewImageWrapper');
        const pdfWrapper = document.getElementById('previewPdfWrapper');
        const unsupported = document.getElementById('previewUnsupported');
        const imgEl = document.getElementById('previewImage');
        const pdfEl = document.getElementById('previewPdf');
        const titleEl = document.getElementById('previewTitle');
        const downloadBtn = document.getElementById('downloadOriginal');

        function openModal(type, src, name) {
            imgWrapper.classList.add('hidden');
            pdfWrapper.classList.add('hidden');
            unsupported.classList.add('hidden');
            if (type === 'image') {
                imgEl.src = src;
                imgWrapper.classList.remove('hidden');
            } else if (type === 'pdf') {
                pdfEl.src = src + '#toolbar=0';
                pdfWrapper.classList.remove('hidden');
            } else {
                unsupported.classList.remove('hidden');
            }
            titleEl.textContent = name;
            downloadBtn.href = src;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            imgEl.src = '';
            pdfEl.src = '';
        }
        modal.querySelectorAll('[data-preview-close]').forEach(btn => btn.addEventListener('click',
        closeModal));
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });
        document.querySelectorAll('.preview-attachment').forEach(btn => {
            btn.addEventListener('click', () => {
                openModal(btn.dataset.type, btn.dataset.src, btn.dataset.name);
            });
        });
    });
</script>
