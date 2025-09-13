<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-calendar-alt mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Event Details
                </h2>
            </div>
            <a href="{{ route('tenant.calendar-events.index') }}"
                class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                <i class="fas fa-arrow-left mr-2"></i>Back to Events
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen transition-colors duration-200">
        <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Event Details Card -->
            <div
                class="mb-6 overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="p-6">
                    <!-- Event Title -->
                    <h1
                        class="mb-4 flex items-center text-2xl font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-calendar-day mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        {{ $event->title }}
                    </h1>

                    <!-- Event Meta Information -->
                    <div class="mb-6 space-y-4">
                        <div class="flex flex-wrap items-center gap-3">
                            <span
                                class="inline-flex items-center rounded-full bg-[color:var(--color-castleton-green)] px-3 py-1 text-xs font-medium capitalize text-white dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)]">
                                <i class="fas fa-tag mr-1"></i>
                                {{ $event->type }}
                            </span>

                            <span
                                class="{{ $event->is_published ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold">
                                <i
                                    class="{{ $event->is_published ? 'fas fa-check-circle' : 'fas fa-times-circle' }} mr-1"></i>
                                {{ $event->is_published ? 'Published' : 'Draft' }}
                            </span>

                            @if ($event->all_day)
                                <span
                                    class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    <i class="fas fa-sun mr-1"></i>
                                    All Day
                                </span>
                            @endif
                        </div>

                        <!-- Schedule Information -->
                        <div
                            class="grid gap-4 rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 md:grid-cols-2 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <div>
                                <div class="flex items-center">
                                    <i
                                        class="fas fa-play mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    <span
                                        class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        Starts:
                                    </span>
                                </div>
                                <p
                                    class="ml-6 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $event->start_at->format('M d, Y' . ($event->all_day ? '' : ' g:i A')) }}
                                </p>
                            </div>
                            @if ($event->end_at)
                                <div>
                                    <div class="flex items-center">
                                        <i
                                            class="fas fa-stop mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                        <span
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            Ends:
                                        </span>
                                    </div>
                                    <p
                                        class="ml-6 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $event->end_at->format('M d, Y' . ($event->all_day ? '' : ' g:i A')) }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Event Description -->
                    @if ($event->description)
                        <div class="mb-6">
                            <h3
                                class="mb-3 flex items-center text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                <i
                                    class="fas fa-align-left mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                Description
                            </h3>
                            <div
                                class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                <p
                                    class="whitespace-pre-line text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    {{ $event->description }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Created Information -->
                    <div
                        class="border-t border-[color:var(--color-brunswick-green)] pt-4 dark:border-[color:var(--color-light-brunswick-green)]">
                        <div
                            class="flex items-center text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-clock mr-2"></i>
                            Created {{ $event->created_at->diffForHumans() }} by
                            <span class="ml-1 font-medium">{{ optional($event->creator)->name ?? 'Unknown' }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex flex-wrap gap-3">
                        @can('edit calendar events')
                            <a href="{{ route('tenant.calendar-events.edit', $event) }}"
                                class="inline-flex items-center rounded-lg bg-yellow-600 px-4 py-2 text-sm font-semibold text-white transition-colors duration-200 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:bg-yellow-500 dark:hover:bg-yellow-600">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Event
                            </a>
                        @endcan

                        @can('delete calendar events')
                            <form action="{{ route('tenant.calendar-events.destroy', $event) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this event?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-500 dark:hover:bg-red-600">
                                    <i class="fas fa-trash mr-2"></i>
                                    Delete Event
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
