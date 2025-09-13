<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-calendar mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Calendar Events') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen transition-colors duration-200">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div
                class="mb-8 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-center">
                    <i
                        class="fas fa-list mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        Upcoming Events</h3>
                </div>
                <p
                    class="mt-1 flex items-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    <i class="fas fa-chart-bar mr-1"></i>
                    {{ $events->count() }} upcoming events
                </p>
            </div>

            @if ($events->count() > 0)
                <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($events as $event)
                        <div
                            class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                            <div class="p-6">
                                <div class="mb-4 flex items-start justify-between">
                                    <h4
                                        class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $event->title }}
                                    </h4>
                                    <span
                                        class="{{ $event->type === 'exam'
                                            ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                            : ($event->type === 'holiday'
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                : 'bg-[color:var(--color-castleton-green)] text-white dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)]') }} inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium capitalize">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ $event->type }}
                                    </span>
                                </div>

                                @if ($event->description)
                                    <p
                                        class="mb-4 line-clamp-3 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $event->description }}
                                    </p>
                                @endif

                                <div class="space-y-2">
                                    <div
                                        class="flex items-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-play mr-2"></i>
                                        <span class="font-medium">Starts:</span>
                                        <span class="ml-1">
                                            {{ $event->start_at->format('M d, Y' . ($event->all_day ? '' : ' g:i A')) }}
                                        </span>
                                    </div>

                                    @if ($event->end_at)
                                        <div
                                            class="flex items-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i class="fas fa-stop mr-2"></i>
                                            <span class="font-medium">Ends:</span>
                                            <span class="ml-1">
                                                {{ $event->end_at->format('M d, Y' . ($event->all_day ? '' : ' g:i A')) }}
                                            </span>
                                        </div>
                                    @endif

                                    @if ($event->all_day)
                                        <div
                                            class="flex items-center text-sm text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                            <i class="fas fa-sun mr-2"></i>
                                            <span class="font-medium">All Day Event</span>
                                        </div>
                                    @endif
                                </div>

                                <div
                                    class="mt-4 border-t border-[color:var(--color-brunswick-green)] pt-4 dark:border-[color:var(--color-light-brunswick-green)]">
                                    <a href="{{ route('tenant.calendar-events.show', $event) }}"
                                        class="inline-flex items-center text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                        <i class="fas fa-eye mr-1"></i>
                                        View Details
                                        <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-12 text-center shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <i
                            class="fas fa-calendar h-8 w-8 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                    </div>
                    <h3
                        class="mt-4 text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        No upcoming events</h3>
                    <p
                        class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        There are no upcoming events scheduled at this time. Check back later for updates.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-tenant-dash-component>
