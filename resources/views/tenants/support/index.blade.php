<x-tenant-dash-component>
    <x-slot name="header">
        <div
            class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <div class="flex items-center space-x-3">
                <i
                    class="fas fa-headset text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Support Center') }}
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
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-xl transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div
                    class="p-6 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
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
                                        Support Tickets</h1>
                                    <p
                                        class="mt-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        Submit and track your support requests</p>
                                </div>
                            </div>
                            <a href="{{ route('tenant.support.create') }}"
                                class="focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] px-6 py-3 font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                <i class="fas fa-plus mr-2"></i>
                                New Ticket
                            </a>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div
                        class="mb-6 rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="mb-4 flex items-center">
                            <i
                                class="fas fa-filter mr-3 text-lg text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            <h3
                                class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Filter Tickets</h3>
                        </div>
                        <form method="GET" action="{{ route('tenant.support.index') }}"
                            class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <div>
                                <label for="status"
                                    class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    <i class="fas fa-info-circle mr-1"></i>Status
                                </label>
                                <select name="status" id="status"
                                    class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]">
                                    <option value="">All Statuses</option>
                                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open
                                    </option>
                                    <option value="in_progress"
                                        {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>
                                        Resolved</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label for="priority"
                                    class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Priority
                                </label>
                                <select name="priority" id="priority"
                                    class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]">
                                    <option value="">All Priorities</option>
                                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low
                                    </option>
                                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>
                                        Medium</option>
                                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High
                                    </option>
                                    <option value="critical" {{ request('priority') == 'critical' ? 'selected' : '' }}>
                                        Critical</option>
                                </select>
                            </div>

                            <div>
                                <label for="category"
                                    class="mb-2 block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    <i class="fas fa-tag mr-1"></i>Category
                                </label>
                                <select name="category" id="category"
                                    class="block w-full rounded-lg border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-dark-green)] focus:ring-[color:var(--color-dark-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-dark-green)]">
                                    <option value="">All Categories</option>
                                    <option value="technical"
                                        {{ request('category') == 'technical' ? 'selected' : '' }}>Technical</option>
                                    <option value="billing" {{ request('category') == 'billing' ? 'selected' : '' }}>
                                        Billing</option>
                                    <option value="feature_request"
                                        {{ request('category') == 'feature_request' ? 'selected' : '' }}>Feature
                                        Request</option>
                                    <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>
                                        General</option>
                                </select>
                            </div>

                            <div class="flex items-end space-x-2">
                                <button type="submit"
                                    class="focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] px-4 py-2 font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                    <i class="fas fa-search mr-2"></i>
                                    Filter
                                </button>
                                <a href="{{ route('tenant.support.index') }}"
                                    class="focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                    <i class="fas fa-times mr-2"></i>
                                    Clear
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Tickets List -->
                    @if ($tickets->count() > 0)
                        <div class="space-y-4">
                            @foreach ($tickets as $ticket)
                                <div
                                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-all duration-200 hover:border-[color:var(--color-dark-green)] hover:bg-[color:var(--color-light-brunswick-green)] hover:shadow-lg dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:hover:border-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="mb-3">
                                                <div class="mb-3 flex items-center">
                                                    <i
                                                        class="fas fa-ticket-alt mr-3 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                    <h3
                                                        class="text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                        {{ $ticket->title }}
                                                    </h3>
                                                </div>
                                                <div class="flex flex-wrap items-center gap-3">
                                                    <!-- Priority Badge -->
                                                    @if ($ticket->priority === 'low')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-green-200 bg-green-100 px-3 py-1 text-xs font-medium text-green-800 transition-colors duration-200 dark:border-green-700 dark:bg-green-900/30 dark:text-green-200">
                                                            <i class="fas fa-arrow-down mr-1"></i>
                                                            Low Priority
                                                        </span>
                                                    @elseif ($ticket->priority === 'medium')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-yellow-200 bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800 transition-colors duration-200 dark:border-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-200">
                                                            <i class="fas fa-minus mr-1"></i>
                                                            Medium Priority
                                                        </span>
                                                    @elseif ($ticket->priority === 'high')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-orange-200 bg-orange-100 px-3 py-1 text-xs font-medium text-orange-800 transition-colors duration-200 dark:border-orange-700 dark:bg-orange-900/30 dark:text-orange-200">
                                                            <i class="fas fa-arrow-up mr-1"></i>
                                                            High Priority
                                                        </span>
                                                    @elseif ($ticket->priority === 'critical')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-red-200 bg-red-100 px-3 py-1 text-xs font-medium text-red-800 transition-colors duration-200 dark:border-red-700 dark:bg-red-900/30 dark:text-red-200">
                                                            <i class="fas fa-exclamation-triangle mr-1"></i>
                                                            Critical Priority
                                                        </span>
                                                    @endif

                                                    <!-- Status Badge -->
                                                    @if ($ticket->status === 'open')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-blue-200 bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800 transition-colors duration-200 dark:border-blue-700 dark:bg-blue-900/30 dark:text-blue-200">
                                                            <i class="fas fa-clock mr-1"></i>
                                                            Open
                                                        </span>
                                                    @elseif ($ticket->status === 'in_progress')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-yellow-200 bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800 transition-colors duration-200 dark:border-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-200">
                                                            <i class="fas fa-cogs mr-1"></i>
                                                            In Progress
                                                        </span>
                                                    @elseif ($ticket->status === 'resolved')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-green-200 bg-green-100 px-3 py-1 text-xs font-medium text-green-800 transition-colors duration-200 dark:border-green-700 dark:bg-green-900/30 dark:text-green-200">
                                                            <i class="fas fa-check-circle mr-1"></i>
                                                            Resolved
                                                        </span>
                                                    @elseif ($ticket->status === 'closed')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-gray-200 bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800 transition-colors duration-200 dark:border-gray-700 dark:bg-gray-900/30 dark:text-gray-200">
                                                            <i class="fas fa-lock mr-1"></i>
                                                            Closed
                                                        </span>
                                                    @endif

                                                    <!-- Category Badge -->
                                                    @if ($ticket->category === 'technical')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-purple-200 bg-purple-100 px-3 py-1 text-xs font-medium text-purple-800 transition-colors duration-200 dark:border-purple-700 dark:bg-purple-900/30 dark:text-purple-200">
                                                            <i class="fas fa-wrench mr-1"></i>
                                                            Technical
                                                        </span>
                                                    @elseif ($ticket->category === 'billing')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-green-200 bg-green-100 px-3 py-1 text-xs font-medium text-green-800 transition-colors duration-200 dark:border-green-700 dark:bg-green-900/30 dark:text-green-200">
                                                            <i class="fas fa-dollar-sign mr-1"></i>
                                                            Billing
                                                        </span>
                                                    @elseif ($ticket->category === 'feature_request')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-indigo-200 bg-indigo-100 px-3 py-1 text-xs font-medium text-indigo-800 transition-colors duration-200 dark:border-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-200">
                                                            <i class="fas fa-lightbulb mr-1"></i>
                                                            Feature Request
                                                        </span>
                                                    @elseif ($ticket->category === 'general')
                                                        <span
                                                            class="inline-flex items-center rounded-full border border-gray-200 bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800 transition-colors duration-200 dark:border-gray-700 dark:bg-gray-900/30 dark:text-gray-200">
                                                            <i class="fas fa-question-circle mr-1"></i>
                                                            General
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p
                                                class="mb-3 leading-relaxed text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ Str::limit($ticket->description, 150) }}
                                            </p>
                                            <div
                                                class="flex items-center space-x-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                <span class="flex items-center">
                                                    <i class="fas fa-hashtag mr-1"></i>
                                                    {{ $ticket->ticket_number }}
                                                </span>
                                                <span class="flex items-center">
                                                    <i class="fas fa-calendar-plus mr-1"></i>
                                                    {{ $ticket->created_at->format('M j, Y') }}
                                                </span>
                                                @if ($ticket->resolved_at)
                                                    <span class="flex items-center text-green-600 dark:text-green-400">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Resolved {{ $ticket->resolved_at->format('M j, Y') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ml-6">
                                            <a href="{{ route('tenant.support.show', $ticket) }}"
                                                class="focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] px-4 py-2 font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                                <i class="fas fa-eye mr-2"></i>
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($tickets->hasPages())
                            <div
                                class="mt-8 rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                {{ $tickets->withQueryString()->links() }}
                            </div>
                        @endif
                    @else
                        <div
                            class="rounded-lg border border-[color:var(--color-light-castleton-green)] bg-[color:var(--color-light-brunswick-green)] py-16 text-center transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <div class="mb-6">
                                <i
                                    class="fas fa-ticket-alt text-6xl text-[color:var(--color-gunmetal)] opacity-50 dark:text-[color:var(--color-light-gunmetal)]"></i>
                            </div>
                            <h3
                                class="mb-2 text-xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                No support tickets</h3>
                            <p
                                class="mb-6 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Get started by creating your first support ticket.</p>
                            <div>
                                <a href="{{ route('tenant.support.create') }}"
                                    class="focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-dark-green)] px-6 py-3 font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                    <i class="fas fa-plus mr-2"></i>
                                    Create Support Ticket
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
