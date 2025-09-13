<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-desktop mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Asset Details
                </h2>
            </div>
            <a href="{{ route('tenant.assets.index') }}"
                class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                <i class="fas fa-arrow-left mr-2"></i>Back to Assets
            </a>
        </div>
    </x-slot>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="mx-auto max-w-6xl px-4 py-2 sm:px-6 lg:px-8">
            <div
                class="rounded-md border border-green-200 bg-green-100 p-4 transition-colors duration-200 dark:border-green-800 dark:bg-green-900">
                <div class="flex">
                    <div class="shrink-0">
                        <i class="fas fa-check-circle h-5 w-5 text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mx-auto max-w-6xl px-4 py-2 sm:px-6 lg:px-8">
            <div
                class="rounded-md border border-red-200 bg-red-100 p-4 transition-colors duration-200 dark:border-red-800 dark:bg-red-900">
                <div class="flex">
                    <div class="shrink-0">
                        <i class="fas fa-exclamation-circle h-5 w-5 text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen transition-colors duration-200">
        <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Asset Header Card -->
            <div
                class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="mb-2 flex items-center">
                            @if ($asset->asset_type)
                                @switch($asset->asset_type)
                                    @case('laptop')
                                    @case('computer')
                                        <i
                                            class="fas fa-laptop mr-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    @break

                                    @case('printer')
                                        <i
                                            class="fas fa-print mr-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    @break

                                    @case('phone')
                                    @case('mobile')
                                        <i
                                            class="fas fa-mobile-alt mr-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    @break

                                    @case('monitor')
                                    @case('screen')
                                        <i
                                            class="fas fa-desktop mr-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    @break

                                    @default
                                        <i
                                            class="fas fa-cube mr-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                @endswitch
                            @else
                                <i
                                    class="fas fa-cube mr-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            @endif
                            <h1
                                class="text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $asset->asset_name }}
                            </h1>
                        </div>
                        @if ($asset->asset_model)
                            <p
                                class="text-lg text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Model: {{ $asset->asset_model }}
                            </p>
                        @endif
                        @if ($asset->manufacturer)
                            <p
                                class="text-sm text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                                {{ $asset->manufacturer }}
                            </p>
                        @endif
                    </div>

                    <!-- Condition Badge -->
                    <div class="ml-4">
                        @if ($asset->condition)
                            @php
                                $conditionColors = [
                                    'excellent' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                    'good' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                    'fair' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                    'poor' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                ];
                                $conditionClass =
                                    $conditionColors[strtolower($asset->condition)] ??
                                    'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
                            @endphp
                            <span
                                class="{{ $conditionClass }} inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold transition-colors duration-200">
                                <i class="fas fa-circle mr-1 text-xs"></i>
                                {{ ucfirst($asset->condition) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Asset Image Section -->
                <div class="lg:col-span-1">
                    <div
                        class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <div class="mb-4 flex items-center">
                            <i
                                class="fas fa-image mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            <h3
                                class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Asset Images
                            </h3>
                        </div>

                        <!-- Main Asset Image -->
                        @if ($asset->asset_image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $asset->asset_image) }}" alt="{{ $asset->asset_name }}"
                                    class="h-64 w-full rounded-lg border border-[color:var(--color-brunswick-green)] object-cover dark:border-[color:var(--color-light-brunswick-green)]"
                                    onclick="openImageModal('{{ asset('storage/' . $asset->asset_image) }}', '{{ $asset->asset_name }}')">
                            </div>
                        @else
                            <div
                                class="mb-4 flex h-64 items-center justify-center rounded-lg border-2 border-dashed border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                <div class="text-center">
                                    <i
                                        class="fas fa-image mb-2 text-4xl text-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        No image available
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Additional Images -->
                        @if ($asset->additional_images && count($asset->additional_images) > 0)
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($asset->additional_images as $index => $image)
                                    @if ($index < 4)
                                        {{-- Show only first 4 additional images --}}
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $image) }}"
                                                alt="{{ $asset->asset_name }} - Additional Image {{ $index + 1 }}"
                                                class="h-20 w-full cursor-pointer rounded border border-[color:var(--color-brunswick-green)] object-cover transition-opacity hover:opacity-75 dark:border-[color:var(--color-light-brunswick-green)]"
                                                onclick="openImageModal('{{ asset('storage/' . $image) }}', '{{ $asset->asset_name }} - Additional Image {{ $index + 1 }}')">
                                            @if ($index == 3 && count($asset->additional_images) > 4)
                                                <div
                                                    class="absolute inset-0 flex items-center justify-center rounded bg-black bg-opacity-50">
                                                    <span
                                                        class="font-semibold text-white">+{{ count($asset->additional_images) - 4 }}
                                                        more</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Asset Information Section -->
                <div class="lg:col-span-2">
                    <div
                        class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                        <div class="mb-6 flex items-center">
                            <i
                                class="fas fa-info-circle mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            <h3
                                class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Asset Information
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Basic Information -->
                            <div>
                                <h4
                                    class="text-md mb-3 font-semibold text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Basic Details
                                </h4>
                                <dl class="space-y-3">
                                    <div class="flex justify-between">
                                        <dt
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i
                                                class="fas fa-tag mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            Asset Type
                                        </dt>
                                        <dd
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $asset->asset_type ? ucfirst($asset->asset_type) : 'Not specified' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i
                                                class="fas fa-barcode mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            Serial Number
                                        </dt>
                                        <dd
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $asset->serial_number ?? 'Not specified' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i
                                                class="fas fa-map-marker-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            Location
                                        </dt>
                                        <dd
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $asset->location ?? 'Not specified' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i
                                                class="fas fa-store mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            Vendor
                                        </dt>
                                        <dd
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $asset->vendor ?? 'Not specified' }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Financial Information -->
                            <div>
                                <h4
                                    class="text-md mb-3 font-semibold text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Financial Details
                                </h4>
                                <dl class="space-y-3">
                                    <div class="flex justify-between">
                                        <dt
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i
                                                class="fas fa-calendar mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            Purchase Date
                                        </dt>
                                        <dd
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $asset->purchase_date ? $asset->purchase_date->format('F j, Y') : 'Not specified' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i
                                                class="fas fa-dollar-sign mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            Purchase Price
                                        </dt>
                                        <dd
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $asset->purchase_price ? '$' . number_format($asset->purchase_price, 2) : 'Not specified' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i
                                                class="fas fa-shield-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            Warranty Period
                                        </dt>
                                        <dd
                                            class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $asset->warranty_period ?? 'Not specified' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt
                                            class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i
                                                class="fas fa-calendar-times mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            Warranty Expiry
                                        </dt>
                                        <dd class="text-sm">
                                            @if ($asset->warranty_expiry_date)
                                                @php
                                                    $isExpired = $asset->warranty_expiry_date->isPast();
                                                    $isExpiringSoon =
                                                        $asset->warranty_expiry_date->diffInDays() <= 30 && !$isExpired;
                                                @endphp
                                                <span
                                                    class="{{ $isExpired ? 'text-red-600 dark:text-red-400' : ($isExpiringSoon ? 'text-yellow-600 dark:text-yellow-400' : 'text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]') }}">
                                                    {{ $asset->warranty_expiry_date->format('F j, Y') }}
                                                    @if ($isExpired)
                                                        <i class="fas fa-exclamation-triangle ml-1"></i>
                                                    @elseif($isExpiringSoon)
                                                        <i class="fas fa-exclamation-circle ml-1"></i>
                                                    @endif
                                                </span>
                                            @else
                                                <span
                                                    class="text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Not
                                                    specified</span>
                                            @endif
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        @if ($asset->notes)
                            <div
                                class="mt-6 border-t border-[color:var(--color-light-brunswick-green)] pt-6 dark:border-[color:var(--color-castleton-green)]">
                                <h4
                                    class="text-md mb-3 font-semibold text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i
                                        class="fas fa-sticky-note mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    Notes
                                </h4>
                                <div
                                    class="rounded-lg bg-[color:var(--color-brunswick-green)] p-4 dark:bg-[color:var(--color-castleton-green)]">
                                    <p
                                        class="whitespace-pre-wrap text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $asset->notes }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Timestamps -->
                        <div
                            class="mt-6 border-t border-[color:var(--color-light-brunswick-green)] pt-6 dark:border-[color:var(--color-castleton-green)]">
                            <div
                                class="grid grid-cols-1 gap-4 text-sm text-[color:var(--color-gunmetal)] md:grid-cols-2 dark:text-[color:var(--color-light-gunmetal)]">
                                <div class="flex items-center">
                                    <i
                                        class="fas fa-calendar-plus mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    <span class="mr-2 font-medium">Created:</span>
                                    {{ $asset->created_at->format('F j, Y \a\t g:i A') }}
                                </div>
                                <div class="flex items-center">
                                    <i
                                        class="fas fa-edit mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    <span class="mr-2 font-medium">Updated:</span>
                                    {{ $asset->updated_at->format('F j, Y \a\t g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-row justify-end space-x-4">
                <a href="{{ route('tenant.assets.index') }}"
                    class="inline-flex items-center rounded-md border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-all duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-castleton-green)]">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Assets
                </a>
                <a href="{{ route('tenant.assets.edit', $asset) }}"
                    class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Asset
                </a>
                <form action="{{ route('tenant.assets.destroy', $asset) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Are you sure you want to delete this asset? This action cannot be undone.')"
                        class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-700 dark:hover:bg-red-800">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Asset
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-75 p-4">
        <div class="relative max-h-full max-w-4xl">
            <button onclick="closeImageModal()" class="absolute right-4 top-4 z-10 text-white hover:text-gray-300">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <img id="modalImage" src="" alt=""
                class="max-h-full max-w-full rounded-lg object-contain">
            <div class="absolute bottom-4 left-4 rounded bg-black bg-opacity-50 p-2 text-white">
                <span id="modalImageTitle"></span>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(src, title) {
            const modal = document.getElementById('imageModal');
            document.getElementById('modalImage').src = src;
            document.getElementById('modalImageTitle').textContent = title;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</x-tenant-dash-component>
