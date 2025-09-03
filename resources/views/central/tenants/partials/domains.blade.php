<!-- Domains -->
<div
    class="shadow-xs overflow-hidden rounded-xl bg-white ring-1 ring-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)] dark:ring-[color:var(--color-brunswick-green)]">
    <div
        class="border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
        <h3
            class="flex items-center text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
            <i
                class="fas fa-globe mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
            Domains
            <span
                class="ml-2 inline-flex items-center rounded-full bg-[color:var(--color-castleton-green)] px-2 py-1 text-xs font-medium text-white dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)]">
                {{ $tenant->domains->count() }} domain{{ $tenant->domains->count() !== 1 ? 's' : '' }}
            </span>
        </h3>
    </div>
    <div class="px-6 py-6">
        @if ($tenant->domains->isNotEmpty())
            <div class="space-y-4">
                @foreach ($tenant->domains as $domain)
                    <div
                        class="flex items-center justify-between rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-all duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                        <div class="flex items-center space-x-3">
                            <div class="shrink-0">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)]">
                                    <i
                                        class="fas fa-link text-xs text-white dark:text-[color:var(--color-dark-green)]"></i>
                                </div>
                            </div>
                            <div>
                                <a href="http://{{ $domain->domain }}" target="_blank"
                                    class="text-base font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                    {{ $domain->domain }}
                                </a>
                                <p
                                    class="text-sm text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                                    Added {{ $domain->created_at->format('M j, Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="http://{{ $domain->domain }}" target="_blank"
                                class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-3 py-1 text-xs font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                Visit
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-8 text-center">
                <div
                    class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                    <i
                        class="fas fa-globe text-xl text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                </div>
                <h4
                    class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    No domains configured</h4>
                <p
                    class="mt-1 text-sm text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    This tenant doesn't have any custom domains set up
                    yet.</p>
            </div>
        @endif
    </div>
</div>
