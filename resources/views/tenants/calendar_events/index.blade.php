<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Manage Calendar Events') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 p-4 text-green-800 dark:bg-green-900 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">All Events</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $events->total() }} total events</p>
            </div>
            @can('create calendar events')
                <a href="{{ route('tenant.calendar-events.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('Create Event') }}
                </a>
            @endcan
        </div>

        <div
            class="overflow-hidden rounded-lg bg-white shadow ring-1 ring-black ring-opacity-5 dark:bg-gray-800 dark:ring-gray-700">
            @if ($events->count() > 0)
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Title</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Type</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Starts</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Ends</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Status</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Created By</th>
                            <th class="relative px-6 py-4"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($events as $event)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $event->title }}</td>
                                <td class="px-6 py-4 text-sm capitalize text-gray-900 dark:text-white">
                                    {{ $event->type }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $event->start_at->format('M d, Y' . ($event->all_day ? '' : ' g:i A')) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $event->end_at ? $event->end_at->format('M d, Y' . ($event->all_day ? '' : ' g:i A')) : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('tenant.calendar-events.toggle', $event) }}"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="{{ $event->is_published ? 'bg-green-100 text-green-800 hover:bg-green-200 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-medium transition-colors">
                                            <span
                                                class="{{ $event->is_published ? 'bg-green-500' : 'bg-red-500' }} h-1.5 w-1.5 rounded-full"></span>
                                            {{ $event->is_published ? 'Published' : 'Draft' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    {{ optional($event->creator)->name }}</td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('edit calendar events')
                                            <a href="{{ route('tenant.calendar-events.edit', $event) }}"
                                                class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">Edit</a>
                                        @endcan
                                        @can('delete calendar events')
                                            <form action="{{ route('tenant.calendar-events.destroy', $event) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Delete this event?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-8 text-center">
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No events</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new event.</p>
                </div>
            @endif
        </div>
        @if ($events->hasPages())
            <div class="mt-6">{{ $events->links() }}</div>
        @endif
    </div>
</x-tenant-dash-component>
