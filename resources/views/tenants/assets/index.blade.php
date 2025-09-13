<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-chalkboard mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Assets') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen transition-colors duration-200">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <!-- Header Actions -->
            <div
                class="mb-8 flex items-center justify-between rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div>
                    <div class="flex items-center">
                        <i
                            class="fas fa-list mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            All Assets</h3>
                    </div>
                    <p
                        class="mt-1 flex items-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-chart-bar mr-1"></i>
                        {{ isset($assets) ? $assets->count() : 0 }} total assets
                    </p>
                </div>
                @can('create assets')
                    <a href="{{ route('tenant.assets.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-plus h-4 w-4"></i>
                        {{ __('Add Asset') }}
                    </a>
                @endcan
            </div>

            <!-- Table Container -->
            <div
                class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <table
                    class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                    <thead
                        class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-chalkboard mr-2"></i>
                                    Asset Name
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-barcode mr-2"></i>
                                    Asset Tag
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-list mr-2"></i>
                                    Category
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Purchase Date
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-dollar-sign mr-2"></i>
                                    Purchase Price
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i class="fas fa-cogs mr-2"></i>
                                    Actions
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        @forelse ($assets as $asset)
                            <tr>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $asset->asset_name }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    {{ $asset->serial_number ?? 'N/A' }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    {{ $asset->category?->name ?? 'Uncategorized' }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    {{ $asset->purchase_date ? $asset->purchase_date->format('M d, Y') : 'N/A' }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    {{ $asset->purchase_price ? '$' . number_format($asset->purchase_price, 2) : 'N/A' }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    @can('delete assets')
                                        <form action="{{ route('tenant.assets.destroy', $asset) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:underline dark:text-red-400"
                                                onclick="return confirm('Are you sure you want to delete this asset?');">
                                                Delete
                                            </button>
                                        </form>
                                        |
                                        
                                    @endcan
                                    @can('view assets')
                                        <a href="{{ route('tenant.assets.show', $asset) }}"
                                            class="text-[color:var(--color-castleton-green)] hover:underline dark:text-[color:var(--color-light-castleton-green)]">Download</a>
                                        |
                                        
                                    @endcan
                                    @can('edit assets')
                                        <a href="{{ route('tenant.assets.edit', $asset) }}"
                                            class="text-[color:var(--color-castleton-green)] hover:underline dark:text-[color:var(--color-light-castleton-green)]">|</a>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="whitespace-nowrap px-6 py-4 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    No assets found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
