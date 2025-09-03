<!-- Basic Information -->
                <div class="overflow-hidden rounded-xl bg-white shadow-xs ring-1 ring-gray-200">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h3 class="flex items-center text-lg font-semibold text-gray-900">
                            <i class="fas fa-building mr-2 text-blue-600"></i>
                            Basic Information
                        </h3>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Organization Name</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $tenant->name }}</dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Contact Email</dt>
                                <dd class="text-base text-gray-900">
                                    <a href="mailto:{{ $tenant->email }}"
                                        class="flex items-center text-blue-600 transition-colors duration-200 hover:text-blue-800">
                                        <i class="fas fa-envelope mr-1 text-xs"></i>
                                        {{ $tenant->email }}
                                    </a>
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Phone Number</dt>
                                <dd class="flex items-center text-base text-gray-900">
                                    @if ($tenant->phone)
                                        <i class="fas fa-phone mr-2 text-xs text-green-600"></i>
                                        {{ $tenant->phone }}
                                    @else
                                        <span class="italic text-gray-400">Not provided</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Alternative Phone</dt>
                                <dd class="flex items-center text-base text-gray-900">
                                    @if ($tenant->alt_phone)
                                        <i class="fas fa-phone mr-2 text-xs text-green-600"></i>
                                        {{ $tenant->alt_phone }}
                                    @else
                                        <span class="italic text-gray-400">Not provided</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Website</dt>
                                <dd class="text-base text-gray-900">
                                    @if ($tenant->website)
                                        <a href="{{ $tenant->website }}" target="_blank"
                                            class="flex items-center text-blue-600 transition-colors duration-200 hover:text-blue-800">
                                            <i class="fas fa-globe mr-1 text-xs"></i>
                                            {{ $tenant->website }}
                                            <i class="fas fa-external-link-alt ml-1 text-xs opacity-60"></i>
                                        </a>
                                    @else
                                        <span class="italic text-gray-400">Not provided</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Current Status</dt>
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
                                <dt class="mb-1 text-sm font-medium text-gray-500">Address</dt>
                                <dd class="flex items-start text-base text-gray-900">
                                    @if ($tenant->address)
                                        <i class="fas fa-map-marker-alt mr-2 mt-1 text-xs text-red-500"></i>
                                        <span>{{ $tenant->address }}</span>
                                    @else
                                        <span class="italic text-gray-400">Not provided</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>