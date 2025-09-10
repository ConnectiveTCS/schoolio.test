<x-tenant-dash-component>
    <x-slot name="header">
        <div
            class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <div class="flex items-center space-x-3">
                <i
                    class="fas fa-headset text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Support Ticket Details') }}
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
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
            <div
                class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-xl transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div
                    class="p-6 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    <!-- Header -->
                    <div
                        class="mb-8 rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="rounded-full bg-[color:var(--color-light-castleton-green)] p-3 transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)]">
                                    <i
                                        class="fas fa-ticket-alt text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                </div>
                                <div>
                                    <h1
                                        class="text-3xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $ticket->ticket_number }}</h1>
                                    <p
                                        class="mt-2 text-lg text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $ticket->title }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span
                                    class="bg-{{ $ticket->priority_color }}-100 dark:bg-{{ $ticket->priority_color }}-900/30 text-{{ $ticket->priority_color }}-800 dark:text-{{ $ticket->priority_color }}-200 border-{{ $ticket->priority_color }}-200 dark:border-{{ $ticket->priority_color }}-700 inline-flex items-center rounded-full border px-4 py-2 text-sm font-medium transition-colors duration-200">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    {{ ucfirst($ticket->priority) }} Priority
                                </span>
                                <span
                                    class="bg-{{ $ticket->status_color }}-100 dark:bg-{{ $ticket->status_color }}-900/30 text-{{ $ticket->status_color }}-800 dark:text-{{ $ticket->status_color }}-200 border-{{ $ticket->status_color }}-200 dark:border-{{ $ticket->status_color }}-700 inline-flex items-center rounded-full border px-4 py-2 text-sm font-medium transition-colors duration-200">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('tenant.support.index') }}"
                                class="inline-flex items-center rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to Support Tickets
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                        <!-- Main Content -->
                        <div class="space-y-6 lg:col-span-2">
                            <!-- Original Description -->
                            <div
                                class="rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                <div class="mb-4 flex items-center">
                                    <i
                                        class="fas fa-file-alt mr-3 text-xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    <h2
                                        class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        Original Request</h2>
                                </div>
                                <div class="prose max-w-none">
                                    <p
                                        class="whitespace-pre-wrap leading-relaxed text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $ticket->description }}</p>
                                </div>

                                @if ($ticket->attachments && count($ticket->attachments) > 0)
                                    <div
                                        class="mt-6 border-t border-[color:var(--color-light-castleton-green)] pt-4 dark:border-[color:var(--color-castleton-green)]">
                                        <div class="mb-3 flex items-center">
                                            <i
                                                class="fas fa-paperclip mr-2 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                            <h3
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                Attachments:</h3>
                                        </div>
                                        <div class="space-y-2">
                                            @foreach ($ticket->attachments as $attachment)
                                                <div
                                                    class="flex items-center space-x-3 rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-3 transition-colors duration-200 hover:bg-[color:var(--color-light-dark-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:hover:bg-[color:var(--color-dark-green)]">
                                                    @php
                                                        $extension = strtolower(
                                                            pathinfo($attachment['original_name'], PATHINFO_EXTENSION),
                                                        );
                                                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                                                        $isPdf = $extension === 'pdf';
                                                        $isDoc = in_array($extension, ['doc', 'docx']);
                                                        $isExcel = in_array($extension, ['xls', 'xlsx']);
                                                        $isArchive = in_array($extension, ['zip', 'rar']);
                                                    @endphp
                                                    @if ($isImage)
                                                        <i class="fas fa-image text-green-600 dark:text-green-400"></i>
                                                    @elseif($isPdf)
                                                        <i class="fas fa-file-pdf text-red-600 dark:text-red-400"></i>
                                                    @elseif($isDoc)
                                                        <i
                                                            class="fas fa-file-word text-blue-600 dark:text-blue-400"></i>
                                                    @elseif($isExcel)
                                                        <i
                                                            class="fas fa-file-excel text-green-600 dark:text-green-400"></i>
                                                    @elseif($isArchive)
                                                        <i
                                                            class="fas fa-file-archive text-yellow-600 dark:text-yellow-400"></i>
                                                    @else
                                                        <i
                                                            class="fas fa-file text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                                    @endif
                                                    <a href="{{ route('tenant.support.download', [$ticket, $attachment['filename']]) }}"
                                                        class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:hover:text-[color:var(--color-light-gunmetal)]">
                                                        {{ $attachment['original_name'] }}
                                                    </a>
                                                    <span
                                                        class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">({{ number_format($attachment['size'] / 1024, 1) }}
                                                        KB)</span>
                                                    @php
                                                        $orig = strtolower($attachment['original_name']);
                                                        $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $orig);
                                                        $isPdf = preg_match('/\.(pdf)$/i', $orig);
                                                    @endphp
                                                    @if ($isImage || $isPdf)
                                                        <button type="button"
                                                            class="preview-attachment rounded bg-[color:var(--color-light-dark-green)] px-2 py-1 text-xs text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]"
                                                            data-type="{{ $isImage ? 'image' : 'pdf' }}"
                                                            data-src="{{ route('tenant.support.download', [$ticket, $attachment['filename']]) }}"
                                                            data-name="{{ $attachment['original_name'] }}">
                                                            <i class="fas fa-eye mr-1"></i>Preview
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
                                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                <div
                                    class="rounded-t-lg border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                    <div class="flex items-center">
                                        <i
                                            class="fas fa-comments mr-3 text-xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                        <h2
                                            class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                            Conversation</h2>
                                    </div>
                                </div>
                                <div class="max-h-96 space-y-4 overflow-y-auto px-6 py-4">
                                    @forelse($replies as $reply)
                                        <div
                                            class="{{ $reply->sender_type === 'central_admin' ? 'justify-start' : 'justify-end' }} flex space-x-3">
                                            @if ($reply->sender_type === 'central_admin')
                                                <div class="shrink-0">
                                                    <div
                                                        class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-dark-green)]">
                                                        <i
                                                            class="fas fa-user-tie text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="min-w-0 max-w-xs flex-1">
                                                <div
                                                    class="bg-{{ $reply->sender_type === 'central_admin' ? '[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]' : '[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]' }} border-{{ $reply->sender_type === 'central_admin' ? '[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-castleton-green)]' : '[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-brunswick-green)]' }} rounded-lg border p-4 shadow-sm transition-colors duration-200">
                                                    <div class="mb-2 flex items-center justify-between">
                                                        <div class="flex items-center">
                                                            @if ($reply->sender_type === 'central_admin')
                                                                <i
                                                                    class="fas fa-user-shield mr-2 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                            @else
                                                                <i
                                                                    class="fas fa-user mr-2 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                            @endif
                                                            <p
                                                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                                {{ $reply->sender_details['name'] }}
                                                                @if ($reply->sender_type === 'central_admin')
                                                                    <span
                                                                        class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">(Support)</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <p
                                                            class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                            {{ $reply->created_at->format('M j, g:i A') }}</p>
                                                    </div>
                                                    <p
                                                        class="whitespace-pre-wrap text-sm leading-relaxed text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                        {{ $reply->message }}</p>

                                                    @if ($reply->attachments && count($reply->attachments) > 0)
                                                        <div
                                                            class="mt-3 border-t border-[color:var(--color-light-castleton-green)] pt-3 dark:border-[color:var(--color-castleton-green)]">
                                                            <div class="space-y-1">
                                                                @foreach ($reply->attachments as $attachment)
                                                                    <div class="flex items-center space-x-2 text-xs">
                                                                        @php
                                                                            $extension = strtolower(
                                                                                pathinfo(
                                                                                    $attachment['original_name'],
                                                                                    PATHINFO_EXTENSION,
                                                                                ),
                                                                            );
                                                                            $isImage = in_array($extension, [
                                                                                'jpg',
                                                                                'jpeg',
                                                                                'png',
                                                                                'gif',
                                                                            ]);
                                                                            $isPdf = $extension === 'pdf';
                                                                            $isDoc = in_array($extension, [
                                                                                'doc',
                                                                                'docx',
                                                                            ]);
                                                                            $isExcel = in_array($extension, [
                                                                                'xls',
                                                                                'xlsx',
                                                                            ]);
                                                                            $isArchive = in_array($extension, [
                                                                                'zip',
                                                                                'rar',
                                                                            ]);
                                                                        @endphp
                                                                        @if ($isImage)
                                                                            <i
                                                                                class="fas fa-image text-green-600 dark:text-green-400"></i>
                                                                        @elseif($isPdf)
                                                                            <i
                                                                                class="fas fa-file-pdf text-red-600 dark:text-red-400"></i>
                                                                        @elseif($isDoc)
                                                                            <i
                                                                                class="fas fa-file-word text-blue-600 dark:text-blue-400"></i>
                                                                        @elseif($isExcel)
                                                                            <i
                                                                                class="fas fa-file-excel text-green-600 dark:text-green-400"></i>
                                                                        @elseif($isArchive)
                                                                            <i
                                                                                class="fas fa-file-archive text-yellow-600 dark:text-yellow-400"></i>
                                                                        @else
                                                                            <i
                                                                                class="fas fa-file text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                                                        @endif
                                                                        <a href="{{ route('tenant.support.download', [$ticket, $attachment['filename']]) }}"
                                                                            class="text-[color:var(--color-dark-green)] transition-colors duration-200 hover:text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:hover:text-[color:var(--color-light-gunmetal)]">
                                                                            {{ $attachment['original_name'] }}
                                                                        </a>
                                                                        <span
                                                                            class="text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">({{ number_format($attachment['size'] / 1024, 1) }}
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
                                                                                class="preview-attachment rounded bg-[color:var(--color-light-dark-green)] px-2 py-1 text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]"
                                                                                data-type="{{ $isImage ? 'image' : 'pdf' }}"
                                                                                data-src="{{ route('tenant.support.download', [$ticket, $attachment['filename']]) }}"
                                                                                data-name="{{ $attachment['original_name'] }}">
                                                                                <i class="fas fa-eye mr-1"></i>Preview
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
                                                        class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                                                        <i
                                                            class="fas fa-user text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="py-12 text-center">
                                            <i
                                                class="fas fa-comments mb-4 text-4xl text-[color:var(--color-gunmetal)] opacity-50 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                            <p
                                                class="text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                No replies yet. Our support team will respond soon.
                                            </p>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Reply Form -->
                                @if (!in_array($ticket->status, ['resolved', 'closed']))
                                    <div
                                        class="rounded-b-lg border-t border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-6 py-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                        <div class="mb-4 flex items-center">
                                            <i
                                                class="fas fa-reply mr-3 text-lg text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                            <h3
                                                class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                Add Reply</h3>
                                        </div>
                                        <form action="{{ route('tenant.support.reply', $ticket) }}" method="POST"
                                            enctype="multipart/form-data" class="space-y-4">
                                            @csrf
                                            <div>
                                                <label for="message"
                                                    class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Message</label>
                                                <textarea name="message" id="message" rows="4" required
                                                    class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] placeholder-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]"
                                                    placeholder="Type your message here..."></textarea>
                                            </div>

                                            <div>
                                                <label for="reply_attachments"
                                                    class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                    <i class="fas fa-paperclip mr-2"></i>Attachments
                                                </label>
                                                <input type="file" name="attachments[]" id="reply_attachments"
                                                    multiple
                                                    class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]"
                                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                                <p
                                                    class="mt-2 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                    <i class="fas fa-info-circle mr-1"></i>
                                                    Max 5 files, 10MB each. Supported formats: PDF, DOC, DOCX, XLS,
                                                    XLSX, PPT, PPTX, TXT, JPG, JPEG, PNG, GIF, ZIP, RAR.
                                                </p>
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] px-6 py-3 font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                                    <i class="fas fa-paper-plane mr-2"></i>
                                                    Send Reply
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div
                                        class="rounded-b-lg border-t border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-6 py-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                        <div class="text-center">
                                            <i
                                                class="fas fa-lock mb-2 text-2xl text-[color:var(--color-gunmetal)] opacity-60 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                            <p
                                                class="text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                This ticket has been {{ $ticket->status }}. If you need further
                                                assistance, please create a new ticket.
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Ticket Info -->
                            <div
                                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                <div class="mb-4 flex items-center">
                                    <i
                                        class="fas fa-info-circle mr-3 text-xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    <h3
                                        class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        Ticket Details</h3>
                                </div>
                                <dl class="space-y-4">
                                    <div
                                        class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                        <dt
                                            class="flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            <i class="fas fa-tag mr-2"></i>Category
                                        </dt>
                                        <dd
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->category)) }}</dd>
                                    </div>
                                    <div
                                        class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                        <dt
                                            class="flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>Priority
                                        </dt>
                                        <dd
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ ucfirst($ticket->priority) }}</dd>
                                    </div>
                                    @if ($centralTicket && $centralTicket->assignedAdmin)
                                        <div
                                            class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                            <dt
                                                class="flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                <i class="fas fa-user-tie mr-2"></i>Assigned to
                                            </dt>
                                            <dd
                                                class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ $centralTicket->assignedAdmin->name }}
                                            </dd>
                                        </div>
                                    @endif
                                    <div
                                        class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                        <dt
                                            class="flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            <i class="fas fa-user mr-2"></i>Created by
                                        </dt>
                                        <dd
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $ticket->createdBy->name }}</dd>
                                    </div>
                                    <div
                                        class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                        <dt
                                            class="flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            <i class="fas fa-calendar-plus mr-2"></i>Created
                                        </dt>
                                        <dd
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $ticket->created_at->format('M j, Y g:i A') }}</dd>
                                    </div>
                                    @if ($ticket->resolved_at)
                                        <div
                                            class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-3 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                            <dt
                                                class="flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                <i class="fas fa-check-circle mr-2"></i>Resolved
                                            </dt>
                                            <dd
                                                class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ $ticket->resolved_at->format('M j, Y g:i A') }}</dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>

                            <!-- Status Info -->
                            <div
                                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                <div class="mb-4 flex items-center">
                                    <i
                                        class="fas fa-route mr-3 text-xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    <h3
                                        class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        What's Next?</h3>
                                </div>

                                @if ($centralTicket && $centralTicket->assignedAdmin)
                                    <div
                                        class="mb-4 rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)]">
                                        <div class="mb-2 flex items-center">
                                            <i
                                                class="fas fa-user-shield mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                            <p
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                Assigned to:</p>
                                        </div>
                                        <p
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $centralTicket->assignedAdmin->name }}
                                        </p>
                                        @if ($centralTicket->assignedAdmin->email)
                                            <p
                                                class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                <i
                                                    class="fas fa-envelope mr-1"></i>{{ $centralTicket->assignedAdmin->email }}
                                            </p>
                                        @endif
                                    </div>
                                @endif

                                <div
                                    class="rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)]">
                                    @switch($ticket->status)
                                        @case('open')
                                            <div class="flex items-start">
                                                <i
                                                    class="fas fa-clock mr-3 mt-1 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                <p
                                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                    @if ($centralTicket && $centralTicket->assignedAdmin)
                                                        Your ticket has been assigned to
                                                        {{ $centralTicket->assignedAdmin->name }} and they will respond soon.
                                                    @else
                                                        Your ticket has been submitted and is waiting to be assigned to a
                                                        support agent.
                                                    @endif
                                                </p>
                                            </div>
                                        @break

                                        @case('in_progress')
                                            <div class="flex items-start">
                                                <i
                                                    class="fas fa-cogs mr-3 mt-1 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                <p
                                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                    @if ($centralTicket && $centralTicket->assignedAdmin)
                                                        {{ $centralTicket->assignedAdmin->name }} is actively working on your
                                                        request.
                                                    @else
                                                        Our support team is actively working on your request.
                                                    @endif
                                                    You'll receive updates as we progress.
                                                </p>
                                            </div>
                                        @break

                                        @case('resolved')
                                            <div class="flex items-start">
                                                <i
                                                    class="fas fa-check-circle mr-3 mt-1 text-green-600 dark:text-green-400"></i>
                                                <p
                                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                    Your ticket has been resolved. If the issue persists, you can reply to
                                                    reopen it or create a new ticket.
                                                </p>
                                            </div>
                                        @break

                                        @case('closed')
                                            <div class="flex items-start">
                                                <i class="fas fa-lock mr-3 mt-1 text-red-600 dark:text-red-400"></i>
                                                <p
                                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                    This ticket has been closed. If you need further assistance, please create a
                                                    new support ticket.
                                                </p>
                                            </div>
                                        @break

                                        @default
                                            <div class="flex items-start">
                                                <i
                                                    class="fas fa-info-circle mr-3 mt-1 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                <p
                                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                    We'll keep you updated on the progress of your support request.
                                                </p>
                                            </div>
                                    @endswitch
                                </div>
                            </div> <!-- Actions -->
                            <div
                                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                <div class="mb-4 flex items-center">
                                    <i
                                        class="fas fa-tools mr-3 text-xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    <h3
                                        class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        Actions</h3>
                                </div>
                                <div class="space-y-3">
                                    <a href="{{ route('tenant.support.create') }}"
                                        class="focus:outline-hidden flex w-full items-center justify-center rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] px-4 py-3 text-center font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                        <i class="fas fa-plus mr-2"></i>
                                        Create New Ticket
                                    </a>
                                    <a href="{{ route('tenant.support.index') }}"
                                        class="focus:outline-hidden flex w-full items-center justify-center rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 text-center font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                        <i class="fas fa-list mr-2"></i>
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
    <div class="absolute inset-0 bg-black/60" data-preview-close></div>
    <div
        class="relative max-h-[90vh] w-11/12 max-w-4xl overflow-hidden rounded-xl border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-2xl transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
        <div
            class="flex items-center justify-between border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
            <div class="flex items-center">
                <i
                    class="fas fa-eye mr-3 text-lg text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                <h3 id="previewTitle"
                    class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    Attachment Preview</h3>
            </div>
            <button
                class="text-2xl text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]"
                data-preview-close>
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div
            class="preview-body relative max-h-[80vh] overflow-auto bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
            <div id="previewImageWrapper" class="hidden p-4">
                <img id="previewImage" src="" alt="Preview"
                    class="mx-auto block max-h-[76vh] w-auto rounded-lg shadow-lg">
            </div>
            <div id="previewPdfWrapper" class="hidden h-[76vh]">
                <iframe id="previewPdf" src="" class="h-full w-full" frameborder="0"></iframe>
            </div>
            <div id="previewUnsupported" class="hidden p-8 text-center">
                <i
                    class="fas fa-file-times mb-4 text-4xl text-[color:var(--color-gunmetal)] opacity-50 dark:text-[color:var(--color-light-gunmetal)]"></i>
                <p
                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Preview not available. Please download the file to view it.
                </p>
            </div>
        </div>
        <div
            class="flex justify-end gap-3 border-t border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
            <a id="downloadOriginal" href="#"
                class="inline-flex items-center rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] px-4 py-2 text-sm text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)]"
                target="_blank" rel="noopener">
                <i class="fas fa-download mr-2"></i>Download
            </a>
            <button
                class="inline-flex items-center rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-2 text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-dark-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-dark-green)]"
                data-preview-close>
                <i class="fas fa-times mr-2"></i>Close
            </button>
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
