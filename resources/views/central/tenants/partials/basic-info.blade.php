<!-- Basic Information -->
<div
    class="shadow-xs overflow-hidden rounded-xl bg-white ring-1 ring-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)] dark:ring-[color:var(--color-brunswick-green)]">
    <div
        class="border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
        <h3
            class="flex items-center text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
            <i
                class="fas fa-building mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
            Basic Information
        </h3>
    </div>
    <div class="px-6 py-6">
        <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
            <div class="group">
                <dt
                    class="mb-1 text-sm font-medium text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    Organization Name</dt>
                <dd
                    class="text-base font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ $tenant->name }}</dd>
            </div>
            <div class="group">
                <dt
                    class="mb-1 text-sm font-medium text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    Contact Email</dt>
                <dd
                    class="text-base text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    <a href="mailto:{{ $tenant->email }}"
                        class="flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-envelope mr-1 text-xs"></i>
                        {{ $tenant->email }}
                    </a>
                </dd>
            </div>
            <div class="group">
                <dt
                    class="mb-1 text-sm font-medium text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    Phone Number</dt>
                <dd
                    class="flex items-center text-base text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    @if ($tenant->phone)
                        <i class="fas fa-phone mr-2 text-xs text-green-600"></i>
                        {{ $tenant->phone }}
                    @else
                        <span
                            class="italic text-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-brunswick-green)]">Not
                            provided</span>
                    @endif
                </dd>
            </div>
            <div class="group">
                <dt
                    class="mb-1 text-sm font-medium text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    Alternative Phone</dt>
                <dd
                    class="flex items-center text-base text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    @if ($tenant->alt_phone)
                        <i class="fas fa-phone mr-2 text-xs text-green-600"></i>
                        {{ $tenant->alt_phone }}
                    @else
                        <span
                            class="italic text-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-brunswick-green)]">Not
                            provided</span>
                    @endif
                </dd>
            </div>
            <div class="group">
                <dt
                    class="mb-1 text-sm font-medium text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    Website</dt>
                <dd
                    class="text-base text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    @if ($tenant->website)
                        <a href="{{ $tenant->website }}" target="_blank"
                            class="flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                            <i class="fas fa-globe mr-1 text-xs"></i>
                            {{ $tenant->website }}
                            <i class="fas fa-external-link-alt ml-1 text-xs opacity-60"></i>
                        </a>
                    @else
                        <span
                            class="italic text-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-brunswick-green)]">Not
                            provided</span>
                    @endif
                </dd>
            </div>
            <div class="group">
                <dt
                    class="mb-1 text-sm font-medium text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    Current Status</dt>
                <dd class="text-base">
                    <span
                        class="{{ $tenant->status === 'active' ? 'bg-green-100 text-green-800 border-green-200' : '' }} {{ $tenant->status === 'suspended' ? 'bg-yellow-100 text-yellow-800 border-yellow-200' : '' }} {{ $tenant->status === 'inactive' ? 'bg-red-100 text-red-800 border-red-200' : '' }} inline-flex items-center rounded-full border px-3 py-1 text-sm font-semibold">
                        <span
                            class="{{ $tenant->status === 'active' ? 'bg-green-400' : '' }} {{ $tenant->status === 'suspended' ? 'bg-yellow-400' : '' }} {{ $tenant->status === 'inactive' ? 'bg-red-400' : '' }} mr-2 inline-block h-2 w-2 rounded-full"></span>
                        {{ ucfirst($tenant->status) }}
                    </span>
                </dd>
            </div>
            <div class="group sm:col-span-2">
                <dt
                    class="mb-1 text-sm font-medium text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                    Address</dt>
                <dd
                    class="flex items-start text-base text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    @if ($tenant->address)
                        <i class="fas fa-map-marker-alt mr-2 mt-1 text-xs text-red-500"></i>
                        <span>{{ $tenant->address }}</span>
                    @else
                        <span
                            class="italic text-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-brunswick-green)]">Not
                            provided</span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>
