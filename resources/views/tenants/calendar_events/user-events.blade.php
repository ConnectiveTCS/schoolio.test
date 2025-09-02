<x-tenant-dash-component>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('Upcoming Events') }}</h2>
    </x-slot>
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800">
            <div class="p-6">
                @if ($events->count())
                    <div class="space-y-4">
                        @foreach ($events as $event)
                            <div
                                class="{{ $event->type === 'exam' ? 'border-red-500' : ($event->type === 'holiday' ? 'border-green-500' : 'border-blue-500') }} border-l-4 pl-4">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $event->title }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $event->start_at->format('M d, Y') }}
                                    @if (!$event->all_day)
                                        • {{ $event->start_at->format('g:i A') }}
                                    @endif
                                    @if ($event->end_at && $event->end_at->gt($event->start_at))
                                        – {{ $event->end_at->format('M d, Y') }}
                                    @endif
                                </p>
                                @if ($event->description)
                                    <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                                        {{ Str::limit($event->description, 140) }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">No upcoming events.</p>
                @endif
            </div>
        </div>
    </div>
</x-tenant-dash-component>
