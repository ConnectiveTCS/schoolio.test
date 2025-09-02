<x-tenant-dash-component :dashboardData="[]">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Messages') }}
            </h2>
            <a href="{{ route('tenant.messages.create') }}"
                class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-blue-900">
                <i class="fas fa-plus mr-2"></i>
                {{ __('Compose Message') }}
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="mx-auto max-w-7xl">
            <!-- Message Tabs -->
            <div class="mb-6">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8">
                        <a href="{{ route('tenant.messages.index', ['tab' => 'inbox']) }}"
                            class="{{ $activeTab === 'inbox' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }} border-b-2 border-transparent px-1 py-2 text-sm font-medium">
                            <i class="fas fa-inbox mr-2"></i>
                            Inbox
                            @if ($activeTab === 'inbox' && $unreadCount > 0)
                                <span
                                    class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('tenant.messages.index', ['tab' => 'sent']) }}"
                            class="{{ $activeTab === 'sent' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }} border-b-2 border-transparent px-1 py-2 text-sm font-medium">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Sent
                        </a>
                        <a href="{{ route('tenant.messages.index', ['tab' => 'unread']) }}"
                            class="{{ $activeTab === 'unread' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }} border-b-2 border-transparent px-1 py-2 text-sm font-medium">
                            <i class="fas fa-envelope mr-2"></i>
                            Unread
                            @if ($unreadCount > 0)
                                <span
                                    class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Messages List -->
            <div class="overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-md">
                @if ($messages->count() > 0)
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($messages as $message)
                            <li class="transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <a href="{{ route('tenant.messages.show', $message) }}"
                                    class="block px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex min-w-0 flex-1 items-center">
                                            <div class="flex-shrink-0">
                                                @if ($activeTab === 'sent')
                                                    <div
                                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-300 dark:bg-gray-600">
                                                        <i class="fas fa-user text-gray-600 dark:text-gray-300"></i>
                                                    </div>
                                                @else
                                                    <div
                                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-300 dark:bg-blue-600">
                                                        <i class="fas fa-user text-blue-600 dark:text-blue-300"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4 min-w-0 flex-1">
                                                <div class="flex items-center justify-between">
                                                    <div class="min-w-0 flex-1">
                                                        <p
                                                            class="truncate text-sm font-medium text-gray-900 dark:text-gray-100">
                                                            @if ($activeTab === 'sent')
                                                                To: {{ $message->recipient->name }}
                                                            @else
                                                                From: {{ $message->sender->name }}
                                                            @endif
                                                        </p>
                                                        <p class="truncate text-sm text-gray-600 dark:text-gray-400">
                                                            {{ $message->subject }}
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        @if ($message->priority !== 'normal')
                                                            <span
                                                                class="{{ $message->priority === 'urgent'
                                                                    ? 'bg-red-100 text-red-800'
                                                                    : ($message->priority === 'high'
                                                                        ? 'bg-orange-100 text-orange-800'
                                                                        : 'bg-yellow-100 text-yellow-800') }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                                                                {{ ucfirst($message->priority) }}
                                                            </span>
                                                        @endif
                                                        @if ($message->attachments->count() > 0)
                                                            <i class="fas fa-paperclip text-gray-400"></i>
                                                        @endif
                                                        @if ($activeTab !== 'sent' && $message->isUnread())
                                                            <span
                                                                class="inline-block h-2 w-2 rounded-full bg-blue-600"></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mt-1 flex items-center justify-between">
                                                    <p class="truncate text-xs text-gray-500 dark:text-gray-400">
                                                        {{ Str::limit(strip_tags($message->content), 60) }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $message->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="py-12 text-center">
                        <i class="fas fa-inbox mb-4 text-4xl text-gray-400"></i>
                        <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-gray-100">
                            @if ($activeTab === 'sent')
                                No sent messages
                            @elseif($activeTab === 'unread')
                                No unread messages
                            @else
                                No messages in inbox
                            @endif
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">
                            @if ($activeTab === 'inbox')
                                You don't have any messages yet.
                            @elseif($activeTab === 'sent')
                                You haven't sent any messages yet.
                            @else
                                All caught up! No unread messages.
                            @endif
                        </p>
                        @if ($activeTab === 'inbox')
                            <div class="mt-6">
                                <a href="{{ route('tenant.messages.create') }}"
                                    class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-blue-900">
                                    <i class="fas fa-plus mr-2"></i>
                                    Compose Your First Message
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($messages->hasPages())
                <div class="mt-6">
                    {{ $messages->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-tenant-dash-component>
