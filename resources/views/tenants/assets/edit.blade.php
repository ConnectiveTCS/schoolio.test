<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-edit mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                Edit Asset: {{ $asset->asset_name }}
            </h2>
        </div>
    </x-slot>

    <div
        class="min-w-full bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div
            class="mx-auto max-w-3xl rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
            <h3
                class="mb-6 flex items-center text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-chalkboard mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                Update Asset Information
            </h3>
            <form method="POST" action="{{ route('tenant.assets.update', $asset) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div
                    class="mb-8 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <h4
                        class="text-md mb-6 flex items-center font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i
                            class="fas fa-info-circle mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                        Asset Information
                    </h4>

                    <div class="mb-4">
                        <x-input-label for="asset_name"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-tag mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Asset Name') }}
                        </x-input-label>
                        <x-text-input id="asset_name"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            type="text" name="asset_name" :value="old('asset_name', $asset->asset_name)" required autofocus maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('asset_name')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="asset_model"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-info-circle mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Asset Model') }}
                        </x-input-label>
                        <x-text-input id="asset_model"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            type="text" name="asset_model" :value="old('asset_model', $asset->asset_model)" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('asset_model')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="manufacturer"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-cog mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Manufacturer') }}
                        </x-input-label>
                        <x-text-input id="manufacturer"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            type="text" name="manufacturer" :value="old('manufacturer', $asset->manufacturer)" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('manufacturer')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="vendor"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-store mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Vendor') }}
                        </x-input-label>
                        <x-text-input id="vendor"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            type="text" name="vendor" :value="old('vendor', $asset->vendor)" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('vendor')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="asset_type"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-layer-group mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Asset Type') }}
                        </x-input-label>
                        <select id="asset_type" name="asset_type"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <option value="">{{ __('Select Asset Type') }}</option>
                            <option value="computer"
                                {{ old('asset_type', $asset->asset_type) == 'computer' ? 'selected' : '' }}>Computer
                            </option>
                            <option value="printer"
                                {{ old('asset_type', $asset->asset_type) == 'printer' ? 'selected' : '' }}>Printer
                            </option>
                            <option value="projector"
                                {{ old('asset_type', $asset->asset_type) == 'projector' ? 'selected' : '' }}>Projector
                            </option>
                            <option value="furniture"
                                {{ old('asset_type', $asset->asset_type) == 'furniture' ? 'selected' : '' }}>Furniture
                            </option>
                            <option value="vehicle"
                                {{ old('asset_type', $asset->asset_type) == 'vehicle' ? 'selected' : '' }}>Vehicle
                            </option>
                            <option value="other"
                                {{ old('asset_type', $asset->asset_type) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('asset_type')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="serial_number"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-barcode mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Serial Number') }}
                        </x-input-label>
                        <x-text-input id="serial_number"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            type="text" name="serial_number" :value="old('serial_number', $asset->serial_number)" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('serial_number')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="notes"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-sticky-note mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Notes') }}
                        </x-input-label>
                        <textarea id="notes" name="notes" rows="4"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">{{ old('notes', $asset->notes) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                    </div>
                </div>

                <!-- Asset Details -->
                <div
                    class="mb-8 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <h4
                        class="text-md mb-6 flex items-center font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i
                            class="fas fa-cogs mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                        Asset Details
                    </h4>

                    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="purchase_date"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-calendar mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Purchase Date') }}
                            </x-input-label>
                            <x-text-input id="purchase_date"
                                class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                type="date" name="purchase_date" :value="old('purchase_date', $asset->purchase_date?->format('Y-m-d'))" />
                            <x-input-error class="mt-2" :messages="$errors->get('purchase_date')" />
                        </div>

                        <div>
                            <x-input-label for="purchase_price"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-dollar-sign mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Purchase Price') }}
                            </x-input-label>
                            <x-text-input id="purchase_price"
                                class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                type="number" name="purchase_price" :value="old('purchase_price', $asset->purchase_price)" step="0.01"
                                min="0" />
                            <x-input-error class="mt-2" :messages="$errors->get('purchase_price')" />
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="warranty_period"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-shield-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Warranty Period (months)') }}
                            </x-input-label>
                            <x-text-input id="warranty_period"
                                class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                type="number" name="warranty_period" :value="old('warranty_period', $asset->warranty_period)" min="0" />
                            <x-input-error class="mt-2" :messages="$errors->get('warranty_period')" />
                        </div>

                        <div>
                            <x-input-label for="warranty_expiry_date"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-calendar-times mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Warranty Expiry Date') }}
                            </x-input-label>
                            <x-text-input id="warranty_expiry_date"
                                class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                type="date" name="warranty_expiry_date" :value="old('warranty_expiry_date', $asset->warranty_expiry_date?->format('Y-m-d'))" />
                            <x-input-error class="mt-2" :messages="$errors->get('warranty_expiry_date')" />
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="condition"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-heart mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Condition') }}
                            </x-input-label>
                            <select id="condition" name="condition"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                <option value="excellent"
                                    {{ old('condition', $asset->condition) == 'excellent' ? 'selected' : '' }}>
                                    Excellent</option>
                                <option value="good"
                                    {{ old('condition', $asset->condition) == 'good' ? 'selected' : '' }}>Good</option>
                                <option value="fair"
                                    {{ old('condition', $asset->condition) == 'fair' ? 'selected' : '' }}>Fair</option>
                                <option value="poor"
                                    {{ old('condition', $asset->condition) == 'poor' ? 'selected' : '' }}>Poor</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('condition')" />
                        </div>

                        <div>
                            <x-input-label for="location"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-map-marker-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Location') }}
                            </x-input-label>
                            <x-text-input id="location"
                                class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                type="text" name="location" :value="old('location', $asset->location)" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="asset_image"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-camera mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Asset Image') }}
                        </x-input-label>
                        <input id="asset_image" name="asset_image" type="file" accept="image/*"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <x-input-error class="mt-2" :messages="$errors->get('asset_image')" />
                        <p
                            class="mt-1 text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            {{ __('Upload an image of the asset (optional). Accepted formats: JPG, PNG, GIF.') }}
                        </p>
                        @if ($asset->asset_image)
                            <div class="mt-2">
                                <p
                                    class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Current image:
                                </p>
                                <img src="{{ asset('storage/' . $asset->asset_image) }}" alt="Current asset image"
                                    class="mt-1 h-20 w-20 rounded-md border border-[color:var(--color-brunswick-green)] object-cover dark:border-[color:var(--color-light-brunswick-green)]">
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <x-input-label for="additional_images"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-images mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Additional Images') }}
                        </x-input-label>
                        <input id="additional_images" name="additional_images[]" type="file" accept="image/*"
                            multiple
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <x-input-error class="mt-2" :messages="$errors->get('additional_images')" />
                        <p
                            class="mt-1 text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            {{ __('Upload additional images of the asset (optional). You can select multiple files.') }}
                        </p>
                        @if ($asset->additional_images && count($asset->additional_images) > 0)
                            <div class="mt-2">
                                <p
                                    class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Current additional images:
                                </p>
                                <div class="mt-1 flex flex-wrap gap-2">
                                    @foreach ($asset->additional_images as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="Additional asset image"
                                            class="h-16 w-16 rounded-md border border-[color:var(--color-brunswick-green)] object-cover dark:border-[color:var(--color-light-brunswick-green)]">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div
                    class="flex items-center justify-end space-x-4 border-t border-[color:var(--color-brunswick-green)] pt-6 dark:border-[color:var(--color-light-brunswick-green)]">
                    <a href="{{ route('tenant.assets.index') }}"
                        class="inline-flex items-center rounded-md border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-all duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-castleton-green)]">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                        <i class="fas fa-save mr-2"></i>
                        Update Asset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Asset form enhancement script
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-calculate warranty expiry date based on purchase date and warranty period
            const purchaseDateInput = document.getElementById('purchase_date');
            const warrantyPeriodInput = document.getElementById('warranty_period');
            const warrantyExpiryInput = document.getElementById('warranty_expiry_date');

            function calculateWarrantyExpiry() {
                const purchaseDate = purchaseDateInput.value;
                const warrantyPeriod = parseInt(warrantyPeriodInput.value);

                if (purchaseDate && warrantyPeriod > 0) {
                    const date = new Date(purchaseDate);
                    date.setMonth(date.getMonth() + warrantyPeriod);

                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');

                    warrantyExpiryInput.value = `${year}-${month}-${day}`;
                }
            }

            // Only calculate if warranty expiry is not already set
            if (!warrantyExpiryInput.value) {
                purchaseDateInput.addEventListener('change', calculateWarrantyExpiry);
                warrantyPeriodInput.addEventListener('change', calculateWarrantyExpiry);
            }
        });
    </script>
</x-tenant-dash-component>
