<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-plus-circle mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                Create New Asset
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
                Add New Asset
            </h3>
            <form method="POST" action="{{ route('tenant.assets.store') }}" enctype="multipart/form-data">
                @csrf

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
                            type="text" name="asset_name" :value="old('asset_name')" required autofocus maxlength="255" />
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
                            type="text" name="asset_model" :value="old('asset_model')" maxlength="255" />
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
                            type="text" name="manufacturer" :value="old('manufacturer')" maxlength="255" />
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
                            type="text" name="vendor" :value="old('vendor')" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('vendor')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="asset_type"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-list-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Asset Type') }}
                        </x-input-label>
                        <select id="asset_type" name="asset_type"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <option value="" disabled selected>Select Asset Type</option>
                            <option value="Electronics" {{ old('asset_type') == 'Electronics' ? 'selected' : '' }}>
                                Electronics</option>
                            <option value="Furniture" {{ old('asset_type') == 'Furniture' ? 'selected' : '' }}>Furniture
                            </option>
                            <option value="Stationery" {{ old('asset_type') == 'Stationery' ? 'selected' : '' }}>
                                Stationery</option>
                            <option value="Software" {{ old('asset_type') == 'Software' ? 'selected' : '' }}>Software
                            </option>
                            <option value="Other" {{ old('asset_type') == 'Other' ? 'selected' : '' }}>Other</option>
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
                            type="text" name="serial_number" :value="old('serial_number')" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('serial_number')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="notes"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-file-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Notes') }}
                        </x-input-label>
                        <textarea id="notes" name="notes" rows="4"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">{{ old('notes') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                    </div>
                </div>

                <!-- Schedule Information -->
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
                                type="date" name="purchase_date" :value="old('purchase_date')" />
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
                                type="number" name="purchase_price" :value="old('purchase_price')" step="0.01"
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
                                type="number" name="warranty_period" :value="old('warranty_period')" min="0" />
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
                                type="date" name="warranty_expiry_date" :value="old('warranty_expiry_date')" />
                            <x-input-error class="mt-2" :messages="$errors->get('warranty_expiry_date')" />
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="condition"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-tools mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Condition') }}
                            </x-input-label>
                            <select id="condition" name="condition"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                <option value="" disabled selected>Select Condition</option>
                                <option value="Excellent" {{ old('condition') == 'Excellent' ? 'selected' : '' }}>
                                    Excellent</option>
                                <option value="Good" {{ old('condition') == 'Good' ? 'selected' : '' }}>Good
                                </option>
                                <option value="Fair" {{ old('condition') == 'Fair' ? 'selected' : '' }}>Fair
                                </option>
                                <option value="Poor" {{ old('condition') == 'Poor' ? 'selected' : '' }}>Poor
                                </option>
                                <option value="Damaged" {{ old('condition') == 'Damaged' ? 'selected' : '' }}>Damaged
                                </option>
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
                                type="text" name="location" :value="old('location')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="asset_image"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-image mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Asset Image') }}
                        </x-input-label>
                        <input id="asset_image" name="asset_image" type="file" accept="image/*"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                        <x-input-error class="mt-2" :messages="$errors->get('asset_image')" />
                        <p
                            class="mt-2 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <i class="fas fa-info-circle mr-1"></i>
                            Upload an image of the asset (optional)
                        </p>
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
                        <i class="fas fa-plus mr-2"></i>
                        Create Asset
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        // Asset form enhancement script can be added here if needed
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

            purchaseDateInput.addEventListener('change', calculateWarrantyExpiry);
            warrantyPeriodInput.addEventListener('change', calculateWarrantyExpiry);
        });
    </script>
</x-tenant-dash-component>
