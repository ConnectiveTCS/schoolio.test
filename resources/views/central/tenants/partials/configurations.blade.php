<!-- Configuration -->
                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h3 class="flex items-center text-lg font-semibold text-gray-900">
                            <i class="fas fa-cogs mr-2 text-blue-600"></i>
                            Configuration
                        </h3>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Subscription Plan</dt>
                                <dd class="flex items-center text-base font-medium text-gray-900">
                                    <i class="fas fa-star mr-2 text-xs text-yellow-500"></i>
                                    {{ ucfirst($tenant->plan ?: 'Not specified') }}
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">School Type</dt>
                                <dd class="flex items-center text-base text-gray-900">
                                    <i class="fas fa-graduation-cap mr-2 text-xs text-blue-600"></i>
                                    {{ ucfirst($tenant->school_type ?: 'Not specified') }}
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Language</dt>
                                <dd class="flex items-center text-base text-gray-900">
                                    <i class="fas fa-language mr-2 text-xs text-green-600"></i>
                                    {{ strtoupper($tenant->language ?: 'EN') }}
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Timezone</dt>
                                <dd class="flex items-center text-base text-gray-900">
                                    <i class="fas fa-clock mr-2 text-xs text-purple-600"></i>
                                    {{ $tenant->timezone ?: 'UTC' }}
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Trial Status</dt>
                                <dd class="text-base text-gray-900">
                                    @if ($tenant->trial_ends_at)
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-check mr-2 text-xs text-blue-600"></i>
                                            <span>Ends {{ $tenant->trial_ends_at->format('M j, Y') }}</span>
                                            @if ($tenant->trial_ends_at->isPast())
                                                <span
                                                    class="ml-2 inline-flex items-center rounded-full border border-red-200 bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">
                                                    <span
                                                        class="mr-1 inline-block h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                                    Expired
                                                </span>
                                            @else
                                                <span
                                                    class="ml-2 inline-flex items-center rounded-full border border-green-200 bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">
                                                    <span
                                                        class="mr-1 inline-block h-1.5 w-1.5 rounded-full bg-green-400"></span>
                                                    Active
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="flex items-center italic text-gray-400">
                                            <i class="fas fa-times-circle mr-2 text-xs"></i>
                                            No trial period
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div class="group">
                                <dt class="mb-1 text-sm font-medium text-gray-500">Payment Method</dt>
                                <dd class="flex items-center text-base text-gray-900">
                                    @if ($tenant->payment_method)
                                        <i class="fas fa-credit-card mr-2 text-xs text-green-600"></i>
                                        {{ $tenant->payment_method }}
                                    @else
                                        <i class="fas fa-times-circle mr-2 text-xs text-gray-400"></i>
                                        <span class="italic text-gray-400">Not configured</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>