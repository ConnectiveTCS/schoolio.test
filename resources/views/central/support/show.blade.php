@extends('central.layout')

@section('title', 'Support Ticket - ' . $ticket->ticket_number)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $ticket->ticket_number }}</h1>
                    <p class="mt-2 text-gray-600">{{ $ticket->title }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span
                        class="bg-{{ $ticket->priority_color }}-100 text-{{ $ticket->priority_color }}-800 inline-flex items-center rounded-full px-3 py-1 text-sm font-medium">
                        {{ ucfirst($ticket->priority) }} Priority
                    </span>
                    <span
                        class="bg-{{ $ticket->status_color }}-100 text-{{ $ticket->status_color }}-800 inline-flex items-center rounded-full px-3 py-1 text-sm font-medium">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Ticket Description -->
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h2 class="mb-4 text-lg font-semibold text-gray-900">Description</h2>
                    <div class="prose max-w-none">
                        <p class="whitespace-pre-wrap text-gray-700">{{ $ticket->description }}</p>
                    </div>

                    @if ($ticket->attachments && count($ticket->attachments) > 0)
                        <div class="mt-4">
                            <h3 class="mb-2 text-sm font-medium text-gray-900">Attachments:</h3>
                            <div class="space-y-2">
                                @foreach ($ticket->attachments as $attachment)
                                    <div class="flex items-center space-x-2 rounded-md bg-gray-50 p-2">
                                        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                        <a href="{{ route('central.support.download', [$ticket, $attachment['filename']]) }}"
                                            class="text-sm text-blue-600 hover:text-blue-800">
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
                                                class="preview-attachment text-xs text-indigo-600 hover:text-indigo-800"
                                                data-type="{{ $isImage ? 'image' : 'pdf' }}"
                                                data-src="{{ route('central.support.download', [$ticket, $attachment['filename']]) }}"
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
                <div class="rounded-lg bg-white shadow-md">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-lg font-semibold text-gray-900">Conversation</h2>
                    </div>
                    <div class="max-h-96 space-y-4 overflow-y-auto px-6 py-4">
                        @forelse($ticket->replies as $reply)
                            <div class="{{ $reply->sender_type === 'central_admin' ? 'justify-end' : '' }} flex space-x-3">
                                <div class="shrink-0">
                                    <div
                                        class="bg-{{ $reply->sender_type === 'central_admin' ? 'blue' : 'gray' }}-100 flex h-8 w-8 items-center justify-center rounded-full">
                                        @if ($reply->sender_type === 'central_admin')
                                            <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div
                                        class="bg-{{ $reply->sender_type === 'central_admin' ? 'blue' : 'gray' }}-50 rounded-lg p-3">
                                        <div class="mb-2 flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $reply->sender_details['name'] }}
                                                @if ($reply->sender_type === 'central_admin')
                                                    <span class="text-blue-600">(Admin)</span>
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $reply->created_at->format('M j, Y g:i A') }}</p>
                                        </div>
                                        <p class="whitespace-pre-wrap text-sm text-gray-700">{{ $reply->message }}</p>

                                        @if ($reply->attachments && count($reply->attachments) > 0)
                                            <div class="mt-3">
                                                <div class="space-y-1">
                                                    @foreach ($reply->attachments as $attachment)
                                                        <div class="flex items-center space-x-2 text-xs">
                                                            <svg class="h-3 w-3 text-gray-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                </path>
                                                            </svg>
                                                            <a href="{{ route('central.support.download', [$ticket, $attachment['filename']]) }}"
                                                                class="text-blue-600 hover:text-blue-800">
                                                                {{ $attachment['original_name'] }}
                                                            </a>
                                                            <span
                                                                class="text-gray-500">({{ number_format($attachment['size'] / 1024, 1) }}
                                                                KB)</span>
                                                            @php
                                                                $orig = strtolower($attachment['original_name']);
                                                                $isImage = preg_match(
                                                                    '/\.(jpg|jpeg|png|gif)$/i',
                                                                    $orig,
                                                                );
                                                                $isPdf = preg_match('/\.(pdf)$/i', $orig);
                                                            @endphp
                                                            @if ($isImage || $isPdf)
                                                                <button type="button"
                                                                    class="preview-attachment text-indigo-600 hover:text-indigo-800"
                                                                    data-type="{{ $isImage ? 'image' : 'pdf' }}"
                                                                    data-src="{{ route('central.support.download', [$ticket, $attachment['filename']]) }}"
                                                                    data-name="{{ $attachment['original_name'] }}">
                                                                    Preview
                                                                </button>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        @if ($reply->is_internal)
                                            <span
                                                class="mt-2 inline-flex items-center rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">
                                                Internal Note
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="py-8 text-center text-gray-500">No replies yet.</p>
                        @endforelse
                    </div>

                    <!-- Reply Form -->
                    <div class="rounded-b-lg bg-gray-50 px-6 py-4">
                        <form action="{{ route('central.support.reply', $ticket) }}" method="POST"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <div class="space-y-1">
                                <label for="message" class="block text-sm font-semibold text-gray-800">
                                    Add Reply
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <textarea name="message" id="message" rows="4" required
                                        class="block w-full resize-y rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-xs transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="Type your reply message here..."></textarea>
                                    <div class="pointer-events-none absolute right-0 top-3 flex items-start pr-3">
                                        <i class="fas fa-comment text-gray-400"></i>
                                    </div>
                                </div>
                                @error('message')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="central_reply_attachments" class="block text-sm font-semibold text-gray-800">
                                    Attachments
                                </label>
                                <div class="relative">
                                    <input type="file" name="attachments[]" id="central_reply_attachments" multiple
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-xs transition-all duration-200 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:border-gray-400 hover:file:bg-blue-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-paperclip text-gray-400"></i>
                                    </div>
                                </div>
                                <p class="mt-1 flex items-center text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Max 5 files, 10MB each. Supported: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, JPG, JPEG,
                                    PNG, GIF, ZIP, RAR.
                                </p>
                                @error('attachments')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between pt-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_internal" id="is_internal" value="1"
                                        class="h-4 w-4 rounded-sm border-gray-300 text-blue-600 transition-all duration-200 focus:ring-blue-500">
                                    <label for="is_internal" class="ml-2 block text-sm font-medium text-gray-700">
                                        <i class="fas fa-eye-slash mr-1 text-gray-400"></i>
                                        Internal note (not visible to tenant)
                                    </label>
                                </div>
                                <button type="submit"
                                    class="inline-flex transform items-center rounded-lg border border-transparent bg-linear-to-r from-blue-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-blue-600 hover:to-blue-700 focus:outline-hidden focus:ring-4 focus:ring-blue-200">
                                    <i class="fas fa-paper-plane mr-2"></i>Send Reply
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Ticket Info -->
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Ticket Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tenant</dt>
                            <dd class="text-sm text-gray-900">{{ $ticket->tenant->name ?? 'Unknown' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Submitted by</dt>
                            <dd class="text-sm text-gray-900">
                                {{ $ticket->tenant_user_details['name'] ?? 'Unknown' }}
                                <br>
                                <span class="text-gray-500">{{ $ticket->tenant_user_details['email'] ?? '' }}</span>
                                @if (!empty($ticket->tenant_user_details['role']))
                                    <br>
                                    <span
                                        class="inline-flex items-center rounded-sm bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-700">{{ ucfirst($ticket->tenant_user_details['role']) }}</span>
                                @endif
                                @if (!empty($ticket->tenant_user_details['phone']))
                                    <br>
                                    <span class="text-gray-500">{{ $ticket->tenant_user_details['phone'] }}</span>
                                @endif
                                @php
                                    $email = $ticket->tenant_user_details['email'] ?? null;
                                    $name = $ticket->tenant_user_details['name'] ?? 'User';
                                @endphp
                                @if ($email)
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        <a href="mailto:{{ $email }}?subject=Re:%20Support%20Ticket%20{{ urlencode($ticket->ticket_number) }}"
                                            class="inline-flex items-center rounded-md border border-blue-200 bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700 hover:bg-blue-100">
                                            Email
                                        </a>
                                        <form method="POST"
                                            action="{{ route('central.tenants.impersonate', $ticket->tenant_user_details['id'] ?? '') }}"
                                            class="inline-flex items-center"
                                            onsubmit="return confirm('This will take you to the tenant\'s domain. Continue?');">
                                            @csrf
                                            <button type="submit" class="rounded-md border border-purple-200 bg-purple-100 px-2.5 py-1 text-xs font-medium text-purple-700 hover:bg-purple-300">
                                                Impersonate <i class="fas fa-user-secret"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Category</dt>
                            <dd class="text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $ticket->category)) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created</dt>
                            <dd class="text-sm text-gray-900">{{ $ticket->created_at->format('M j, Y g:i A') }}</dd>
                        </div>
                        @if ($ticket->resolved_at)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Resolved</dt>
                                <dd class="text-sm text-gray-900">{{ $ticket->resolved_at->format('M j, Y g:i A') }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <!-- Assignment -->
                <div class="overflow-hidden rounded-lg bg-white shadow-md">
                    <div class="bg-gray-50 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Assignment</h3>
                    </div>
                    <div class="px-6 py-4">
                        <form action="{{ route('central.support.assign', $ticket) }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="space-y-1">
                                <label for="assigned_admin_id" class="block text-sm font-semibold text-gray-800">
                                    Assign to Admin
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="assigned_admin_id" id="assigned_admin_id" required
                                        class="block w-full cursor-pointer appearance-none rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-xs transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                                        <option value="">Select admin...</option>
                                        @foreach ($admins as $admin)
                                            <option value="{{ $admin->id }}"
                                                {{ $ticket->assigned_admin_id == $admin->id ? 'selected' : '' }}>
                                                {{ $admin->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                                @error('assigned_admin_id')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="inline-flex w-full transform items-center justify-center rounded-lg border border-transparent bg-linear-to-r from-blue-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-blue-600 hover:to-blue-700 focus:outline-hidden focus:ring-4 focus:ring-blue-200">
                                <i class="fas fa-user-plus mr-2"></i>Assign Ticket
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Status Management -->
                <div class="overflow-hidden rounded-lg bg-white shadow-md">
                    <div class="bg-gray-50 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Status Management</h3>
                    </div>
                    <div class="px-6 py-4">
                        <form action="{{ route('central.support.update-status', $ticket) }}" method="POST"
                            class="space-y-6">
                            @csrf
                            @method('PATCH')
                            <div class="space-y-1">
                                <label for="status" class="block text-sm font-semibold text-gray-800">
                                    Status
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="status" id="status" required
                                        class="block w-full cursor-pointer appearance-none rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-xs transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open
                                        </option>
                                        <option value="in_progress"
                                            {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>
                                            Resolved</option>
                                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed
                                        </option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                                @error('status')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label for="resolution_notes" class="block text-sm font-semibold text-gray-800">
                                    Resolution Notes
                                </label>
                                <div class="relative">
                                    <textarea name="resolution_notes" id="resolution_notes" rows="3"
                                        class="block w-full resize-y rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-xs transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="Add resolution notes (required for resolved/closed status)">{{ $ticket->resolution_notes }}</textarea>
                                    <div class="pointer-events-none absolute right-0 top-3 flex items-start pr-3">
                                        <i class="fas fa-clipboard-check text-gray-400"></i>
                                    </div>
                                </div>
                                @error('resolution_notes')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="inline-flex w-full transform items-center justify-center rounded-lg border border-transparent bg-linear-to-r from-green-500 to-green-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-green-600 hover:to-green-700 focus:outline-hidden focus:ring-4 focus:ring-green-200">
                                <i class="fas fa-save mr-2"></i>Update Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Preview Modal -->
    <div id="attachmentPreviewModal" class="fixed inset-0 z-50 hidden items-center justify-center">
        <div class="absolute inset-0 bg-black/50" data-preview-close></div>
        <div class="relative max-h-[90vh] w-11/12 max-w-3xl overflow-hidden rounded-lg bg-white shadow-xl">
            <div class="flex items-center justify-between border-b px-4 py-2">
                <h3 id="previewTitle" class="text-sm font-semibold text-gray-800">Attachment Preview</h3>
                <button class="text-gray-500 hover:text-gray-700" data-preview-close>&times;</button>
            </div>
            <div class="preview-body relative max-h-[80vh] overflow-auto bg-gray-50">
                <div id="previewImageWrapper" class="hidden">
                    <img id="previewImage" src="" alt="Preview" class="mx-auto block max-h-[78vh] w-auto">
                </div>
                <div id="previewPdfWrapper" class="hidden h-[78vh]">
                    <iframe id="previewPdf" src="" class="h-full w-full" frameborder="0"></iframe>
                </div>
                <div id="previewUnsupported" class="hidden p-6 text-center text-sm text-gray-600">
                    Preview not available. Please download the file to view it.
                </div>
            </div>
            <div class="flex justify-end gap-2 border-t px-4 py-2">
                <a id="downloadOriginal" href="#"
                    class="rounded-sm bg-blue-600 px-3 py-1.5 text-sm text-white hover:bg-blue-700" target="_blank"
                    rel="noopener">Download</a>
                <button class="rounded-sm bg-gray-200 px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-300"
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
@endsection
