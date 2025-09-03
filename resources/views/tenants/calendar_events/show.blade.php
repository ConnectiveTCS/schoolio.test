<x-tenant-dash-component>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ $event->title }}</h2>
    </x-slot>
    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-lg bg-white shadow-xs dark:bg-gray-800">
            <div class="space-y-4 p-6">
                <div class="flex flex-wrap items-center gap-3">
                    <span
                        class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-medium capitalize text-blue-800 dark:bg-blue-900 dark:text-blue-200">{{ $event->type }}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Starts:
                        {{ $event->start_at->format('M d, Y' . ($event->all_day ? '' : ' g:i A')) }}</span>
                    @if ($event->end_at)
                        <span class="text-xs text-gray-500 dark:text-gray-400">Ends:
                            {{ $event->end_at->format('M d, Y' . ($event->all_day ? '' : ' g:i A')) }}</span>
                    @endif
                </div>
                @if ($event->description)
                    <div class="prose dark:prose-invert max-w-none">
                        <p class="whitespace-pre-line text-sm text-gray-700 dark:text-gray-300">
                            {{ $event->description }}</p>
                    </div>
                @endif
                <div class="text-xs text-gray-500 dark:text-gray-400">Created {{ $event->created_at->diffForHumans() }}
                    by {{ optional($event->creator)->name }}</div>
                <div class="pt-4">
                    <a href="{{ route('tenant.calendar-events.user') }}"
                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Back
                        to Events</a>
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
