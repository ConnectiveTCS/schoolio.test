@extends('central.layout')

@section('title', 'Support Tickets')

@section('content')
    <div class="container mx-auto px-4 py-8 transition-colors duration-200">
        <div class="mb-8">
            <h1
                class="text-3xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                Support Tickets</h1>
            <p class="mt-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Manage support
                requests from all tenants</p>
        </div>

        <!-- Filters -->
        <div
            class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <form method="GET" action="{{ route('central.support.index') }}"
                class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-6">
                <div>
                    <label for="search"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Ticket number, title..."
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                </div>

                <div>
                    <label for="status"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Status</label>
                    <select name="status" id="status"
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <option value="">All Statuses</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div>
                    <label for="priority"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Priority</label>
                    <select name="priority" id="priority"
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <option value="">All Priorities</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="critical" {{ request('priority') == 'critical' ? 'selected' : '' }}>Critical</option>
                    </select>
                </div>

                <div>
                    <label for="category"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Category</label>
                    <select name="category" id="category"
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <option value="">All Categories</option>
                        <option value="technical" {{ request('category') == 'technical' ? 'selected' : '' }}>Technical
                        </option>
                        <option value="billing" {{ request('category') == 'billing' ? 'selected' : '' }}>Billing</option>
                        <option value="feature_request" {{ request('category') == 'feature_request' ? 'selected' : '' }}>
                            Feature Request</option>
                        <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>General</option>
                    </select>
                </div>

                <div>
                    <label for="assigned_admin"
                        class="block text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Assigned
                        Admin</label>
                    <select name="assigned_admin" id="assigned_admin"
                        class="shadow-xs mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] sm:text-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <option value="">All Admins</option>
                        @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}"
                                {{ request('assigned_admin') == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end space-x-2">
                    <button type="submit"
                        class="focus:outline-hidden rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        Filter
                    </button>
                    <a href="{{ route('central.support.index') }}"
                        class="focus:outline-hidden rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)] dark:focus:ring-[color:var(--color-castleton-green)]">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Tickets List -->
        <div
            class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-md transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <div
                class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 dark:border-[color:var(--color-castleton-green)]">
                <h2
                    class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Support Tickets ({{ $tickets->total() }})</h2>
            </div>
            <div class="overflow-x-auto">
                @if ($tickets->count() > 0)
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                        <thead class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Ticket</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Tenant</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Priority</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Assigned</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Created</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            @foreach ($tickets as $ticket)
                                <tr
                                    class="transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div>
                                            <div
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                {{ $ticket->ticket_number }}
                                            </div>
                                            <div
                                                class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                {{ Str::limit($ticket->title, 40) }}</div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $ticket->tenant->name ?? 'Unknown' }}</div>
                                        <div
                                            class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $ticket->tenant_user_details['name'] ?? 'Unknown User' }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="bg-{{ $ticket->priority_color }}-100 text-{{ $ticket->priority_color }}-800 dark:bg-{{ $ticket->priority_color }}-900 dark:text-{{ $ticket->priority_color }}-200 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors duration-200">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="bg-{{ $ticket->status_color }}-100 text-{{ $ticket->status_color }}-800 dark:bg-{{ $ticket->status_color }}-900 dark:text-{{ $ticket->status_color }}-200 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors duration-200">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $ticket->assignedAdmin->name ?? 'Unassigned' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $ticket->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <a href="{{ route('central.support.show', $ticket) }}"
                                            class="text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m0 0V6a2 2 0 012-2h2a2 2 0 012 2v2">
                            </path>
                        </svg>
                        <h3
                            class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            No tickets found</h3>
                        <p
                            class="mt-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            No support tickets match your current filters.</p>
                    </div>
                @endif
            </div>

            @if ($tickets->hasPages())
                <div
                    class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                    {{ $tickets->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
