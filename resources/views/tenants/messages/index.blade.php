<x-tenant-dash-component :dashboardData="[]">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                    <i
                        class="fas fa-comments text-xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                </div>
                <div>
                    <h2
                        class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        {{ __('Messages') }}
                    </h2>
                    <p
                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Manage your communication and messaging
                    </p>
                </div>
            </div>
            <a href="{{ route('tenant.messages.create') }}"
                class="focus:outline-hidden inline-flex transform items-center space-x-2 rounded-md border border-transparent bg-[color:var(--color-dark-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[color:var(--color-brunswick-green)] hover:shadow-lg focus:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 active:bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] dark:active:bg-[color:var(--color-light-castleton-green)]">
                <i class="fas fa-plus"></i>
                <span>{{ __('Compose Message') }}</span>
            </a>
        </div>
    </x-slot>

    <div
        class="min-h-screen bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="mx-auto max-w-7xl">
            <!-- Message Tabs -->
            <div class="mb-6">
                <div
                    class="rounded-t-lg border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 pt-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <nav class="-mb-px flex space-x-8">
                        <a href="{{ route('tenant.messages.index', ['tab' => 'inbox']) }}"
                            class="{{ $activeTab === 'inbox' ? 'border-[color:var(--color-dark-green)] dark:border-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]' : 'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] hover:text-[color:var(--color-dark-green)] dark:hover:text-[color:var(--color-light-dark-green)] hover:border-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)]' }} flex items-center space-x-2 rounded-t-md border-b-2 border-transparent px-4 py-3 text-sm font-medium transition-all duration-200">
                            <i class="fas fa-inbox"></i>
                            <span>Inbox</span>
                            @if ($activeTab === 'inbox' && $unreadCount > 0)
                                <span
                                    class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 transition-colors duration-200 dark:bg-red-900 dark:text-red-200">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('tenant.messages.index', ['tab' => 'sent']) }}"
                            class="{{ $activeTab === 'sent' ? 'border-[color:var(--color-dark-green)] dark:border-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]' : 'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] hover:text-[color:var(--color-dark-green)] dark:hover:text-[color:var(--color-light-dark-green)] hover:border-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)]' }} flex items-center space-x-2 rounded-t-md border-b-2 border-transparent px-4 py-3 text-sm font-medium transition-all duration-200">
                            <i class="fas fa-paper-plane"></i>
                            <span>Sent</span>
                        </a>
                        <a href="{{ route('tenant.messages.index', ['tab' => 'unread']) }}"
                            class="{{ $activeTab === 'unread' ? 'border-[color:var(--color-dark-green)] dark:border-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]' : 'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] hover:text-[color:var(--color-dark-green)] dark:hover:text-[color:var(--color-light-dark-green)] hover:border-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)]' }} flex items-center space-x-2 rounded-t-md border-b-2 border-transparent px-4 py-3 text-sm font-medium transition-all duration-200">
                            <i class="fas fa-envelope"></i>
                            <span>Unread</span>
                            @if ($unreadCount > 0)
                                <span
                                    class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 transition-colors duration-200 dark:bg-red-900 dark:text-red-200">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Messages List -->
            <div
                class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-xl transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                @if ($messages->count() > 0)
                    <ul
                        class="divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                        @foreach ($messages as $message)
                            <li
                                class="group transition-all duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                <a href="{{ route('tenant.messages.show', $message) }}" class="block px-6 py-5">
                                    <div class="flex items-center justify-between">
                                        <div class="flex min-w-0 flex-1 items-center">
                                            <div class="shrink-0">
                                                @if ($activeTab === 'sent')
                                                    <div
                                                        class="flex h-12 w-12 items-center justify-center rounded-full border-2 border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-all duration-200 group-hover:scale-105 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-dark-green)]">
                                                        <i
                                                            class="fas fa-user-graduate text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                    </div>
                                                @else
                                                    <div
                                                        class="flex h-12 w-12 items-center justify-center rounded-full border-2 border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] transition-all duration-200 group-hover:scale-105 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-light-dark-green)]">
                                                        <i
                                                            class="fas fa-user-tie text-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)]"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4 min-w-0 flex-1">
                                                <div class="flex items-center justify-between">
                                                    <div class="min-w-0 flex-1">
                                                        <p
                                                            class="truncate text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                            @if ($activeTab === 'sent')
                                                                <span class="flex items-center space-x-2">
                                                                    <i class="fas fa-arrow-right text-xs"></i>
                                                                    <span>To: {{ $message->recipient->name }}</span>
                                                                </span>
                                                            @else
                                                                <span class="flex items-center space-x-2">
                                                                    <i class="fas fa-arrow-left text-xs"></i>
                                                                    <span>From: {{ $message->sender->name }}</span>
                                                                </span>
                                                            @endif
                                                        </p>
                                                        <p
                                                            class="mt-1 truncate text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                            <i
                                                                class="fas fa-tag mr-2 text-xs"></i>{{ $message->subject }}
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center space-x-3">
                                                        @if ($message->priority !== 'normal')
                                                            <span
                                                                class="{{ $message->priority === 'urgent'
                                                                    ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200'
                                                                    : ($message->priority === 'high'
                                                                        ? 'bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200'
                                                                        : 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200') }} inline-flex items-center space-x-1 rounded-full px-3 py-1 text-xs font-medium transition-colors duration-200">
                                                                @if ($message->priority === 'urgent')
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                @elseif ($message->priority === 'high')
                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                @else
                                                                    <i class="fas fa-info-circle"></i>
                                                                @endif
                                                                <span>{{ ucfirst($message->priority) }}</span>
                                                            </span>
                                                        @endif
                                                        @if ($message->attachments->count() > 0)
                                                            <div
                                                                class="flex items-center space-x-1 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                                <i class="fas fa-paperclip"></i>
                                                                <span
                                                                    class="text-xs">{{ $message->attachments->count() }}</span>
                                                            </div>
                                                        @endif
                                                        @if ($activeTab !== 'sent' && $message->isUnread())
                                                            <span
                                                                class="inline-block h-3 w-3 animate-pulse rounded-full bg-[color:var(--color-dark-green)] dark:bg-[color:var(--color-light-dark-green)]"></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mt-2 flex items-center justify-between">
                                                    <p
                                                        class="flex items-center space-x-2 truncate text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                        <i class="fas fa-align-left"></i>
                                                        <span>{{ Str::limit(strip_tags($message->content), 60) }}</span>
                                                    </p>
                                                    <p
                                                        class="flex items-center space-x-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                        <i class="fas fa-clock"></i>
                                                        <span>{{ $message->created_at->diffForHumans() }}</span>
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
                    <div
                        class="bg-[color:var(--color-light-brunswick-green)] py-16 text-center transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="mb-6 flex justify-center">
                            <div
                                class="flex h-20 w-20 items-center justify-center rounded-full border-4 border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-dark-green)]">
                                @if ($activeTab === 'sent')
                                    <i
                                        class="fas fa-paper-plane text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                @elseif($activeTab === 'unread')
                                    <i
                                        class="fas fa-envelope-open text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                @else
                                    <i
                                        class="fas fa-inbox text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                @endif
                            </div>
                        </div>
                        <h3
                            class="mb-3 text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            @if ($activeTab === 'sent')
                                No sent messages
                            @elseif($activeTab === 'unread')
                                No unread messages
                            @else
                                No messages in inbox
                            @endif
                        </h3>
                        <p
                            class="mb-6 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            @if ($activeTab === 'inbox')
                                You don't have any messages yet. Start a conversation!
                            @elseif($activeTab === 'sent')
                                You haven't sent any messages yet. Compose your first message!
                            @else
                                All caught up! No unread messages. Great job staying organized!
                            @endif
                        </p>
                        @if ($activeTab === 'inbox')
                            <div class="mt-8">
                                <a href="{{ route('tenant.messages.create') }}"
                                    class="inline-flex transform items-center space-x-2 rounded-md border border-transparent bg-[color:var(--color-dark-green)] px-6 py-3 text-sm font-medium text-[color:var(--color-light-dark-green)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[color:var(--color-brunswick-green)] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 focus:ring-offset-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] dark:focus:ring-offset-[color:var(--color-brunswick-green)]">
                                    <i class="fas fa-plus"></i>
                                    <span>Compose Your First Message</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($messages->hasPages())
                <div
                    class="mt-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="flex items-center justify-between">
                        <div
                            class="flex items-center space-x-2 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-list"></i>
                            <span>Page {{ $messages->currentPage() }} of {{ $messages->lastPage() }}</span>
                        </div>
                        <div class="pagination-wrapper">
                            {{ $messages->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-tenant-dash-component>
