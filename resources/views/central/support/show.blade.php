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
                                <div class="flex-shrink-0">
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
                    <div class="border-t border-gray-200 px-6 py-4">
                        <form action="{{ route('central.support.reply', $ticket) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="message" class="block text-sm font-medium text-gray-700">Add Reply</label>
                                <textarea name="message" id="message" rows="3" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="Type your reply..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="central_reply_attachments"
                                    class="block text-sm font-medium text-gray-700">Attachments</label>
                                <input type="file" name="attachments[]" id="central_reply_attachments" multiple
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                <p class="mt-1 text-xs text-gray-500">
                                    Max 5 files, 10MB each. Supported: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, JPG, JPEG,
                                    PNG, GIF, ZIP, RAR.
                                </p>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_internal" id="is_internal" value="1"
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <label for="is_internal" class="ml-2 block text-sm text-gray-700">
                                        Internal note (not visible to tenant)
                                    </label>
                                </div>
                                <button type="submit"
                                    class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Send Reply
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
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Assignment</h3>
                    <form action="{{ route('central.support.assign', $ticket) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="assigned_admin_id" class="block text-sm font-medium text-gray-700">Assign to
                                Admin</label>
                            <select name="assigned_admin_id" id="assigned_admin_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Select Admin</option>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}"
                                        {{ $ticket->assigned_admin_id == $admin->id ? 'selected' : '' }}>
                                        {{ $admin->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Assign Ticket
                        </button>
                    </form>
                </div>

                <!-- Status Management -->
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Status Management</h3>
                    <form action="{{ route('central.support.update-status', $ticket) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved
                                </option>
                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="resolution_notes" class="block text-sm font-medium text-gray-700">Resolution
                                Notes</label>
                            <textarea name="resolution_notes" id="resolution_notes" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="Add resolution notes (required for resolved/closed status)">{{ $ticket->resolution_notes }}</textarea>
                        </div>
                        <button type="submit"
                            class="w-full rounded-md bg-green-600 px-4 py-2 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
