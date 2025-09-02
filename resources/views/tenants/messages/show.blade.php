<x-tenant-dash-component :dashboardData="[]">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Message Details') }}
            </h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('tenant.messages.reply', $message) }}"
                    class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-blue-900">
                    <i class="fas fa-reply mr-2"></i>
                    Reply
                </a>
                <a href="{{ route('tenant.messages.index') }}"
                    class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 active:bg-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Messages
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="mx-auto max-w-4xl">
            <div class="overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
                <!-- Message Header -->
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div class="min-w-0 flex-1">
                            <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $message->subject }}
                            </h1>
                            <div class="mt-2 flex items-center space-x-4">
                                @if ($message->priority !== 'normal')
                                    <span
                                        class="{{ $message->priority === 'urgent'
                                            ? 'bg-red-100 text-red-800'
                                            : ($message->priority === 'high'
                                                ? 'bg-orange-100 text-orange-800'
                                                : 'bg-yellow-100 text-yellow-800') }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                                        <i class="fas fa-flag mr-1"></i>
                                        {{ ucfirst($message->priority) }} Priority
                                    </span>
                                @endif
                                @if ($message->message_type === 'school_general')
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                        <i class="fas fa-school mr-1"></i>
                                        School Message
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <!-- Delete Message -->
                            <form action="{{ route('tenant.messages.destroy', $message) }}" method="POST"
                                class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center rounded-md border border-red-300 bg-white px-3 py-2 text-sm text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    <i class="fas fa-trash mr-1"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sender/Recipient Information -->
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- From -->
                        <div>
                            <h3 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-user mr-2"></i>From
                            </h3>
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-3 dark:border-gray-600 dark:bg-gray-800">
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $message->sender->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $message->sender->email }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $message->sender->getRoleNames()->first() }}
                                    @if ($message->sender->department)
                                        - {{ $message->sender->department }}
                                    @endif
                                </p>

                                <!-- Sender Contact Information -->
                                @if ($message->sender->phone || $message->sender->address || $message->sender->position)
                                    <div class="mt-2 border-t border-gray-200 pt-2 dark:border-gray-600">
                                        <h4 class="mb-1 text-xs font-medium text-gray-700 dark:text-gray-300">Contact
                                            Information:</h4>
                                        @if ($message->sender->phone)
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                <i class="fas fa-phone mr-1"></i>{{ $message->sender->phone }}
                                            </p>
                                        @endif
                                        @if ($message->sender->position)
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                <i class="fas fa-briefcase mr-1"></i>{{ $message->sender->position }}
                                            </p>
                                        @endif
                                        @if ($message->sender->address)
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                <i
                                                    class="fas fa-map-marker-alt mr-1"></i>{{ $message->sender->address }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- To -->
                        <div>
                            <h3 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-user-tag mr-2"></i>To
                            </h3>
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-3 dark:border-gray-600 dark:bg-gray-800">
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $message->recipient->name }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $message->recipient->email }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $message->recipient->getRoleNames()->first() }}
                                    @if ($message->recipient->department)
                                        - {{ $message->recipient->department }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Message Metadata -->
                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center space-x-4">
                            <span>
                                <i class="fas fa-calendar mr-1"></i>
                                Sent: {{ $message->created_at->format('M j, Y \a\t g:i A') }}
                            </span>
                            @if ($message->read_at)
                                <span>
                                    <i class="fas fa-eye mr-1"></i>
                                    Read: {{ $message->read_at->format('M j, Y \a\t g:i A') }}
                                </span>
                            @else
                                <span class="text-blue-600 dark:text-blue-400">
                                    <i class="fas fa-envelope mr-1"></i>
                                    Unread
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Attachments (if any) -->
                @if ($message->attachments->count() > 0)
                    <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                        <h3 class="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="fas fa-paperclip mr-2"></i>
                            Attachments ({{ $message->attachments->count() }})
                        </h3>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($message->attachments as $attachment)
                                <div
                                    class="flex items-center rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-600 dark:bg-gray-700">
                                    <div class="flex-shrink-0">
                                        @if ($attachment->isImage())
                                            <i class="fas fa-image text-xl text-green-500"></i>
                                        @elseif($attachment->isDocument())
                                            <i class="fas fa-file-alt text-xl text-blue-500"></i>
                                        @else
                                            <i class="fas fa-file text-xl text-gray-500"></i>
                                        @endif
                                    </div>
                                    <div class="ml-3 min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $attachment->original_name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $attachment->human_readable_size }}
                                        </p>
                                    </div>
                                    <div class="ml-3">
                                        <a href="{{ route('tenant.messages.attachment.download', [$message, $attachment]) }}"
                                            class="inline-flex items-center rounded border border-transparent bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            <i class="fas fa-download mr-1"></i>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Message Content -->
                <div class="px-6 py-6">
                    <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300">
                        {!! nl2br(e($message->content)) !!}
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('tenant.messages.reply', $message) }}"
                                class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-blue-900">
                                <i class="fas fa-reply mr-2"></i>
                                Reply
                            </a>
                            <a href="{{ route('tenant.messages.create', ['recipient_id' => $message->getOtherParticipant(auth()->id())->id]) }}"
                                class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-green-700 focus:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 active:bg-green-900">
                                <i class="fas fa-plus mr-2"></i>
                                New Message
                            </a>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Message ID: {{ $message->id }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
