<!-- Domains -->
                <div class="overflow-hidden rounded-xl bg-white shadow-xs ring-1 ring-gray-200">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h3 class="flex items-center text-lg font-semibold text-gray-900">
                            <i class="fas fa-globe mr-2 text-blue-600"></i>
                            Domains
                            <span
                                class="ml-2 inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">
                                {{ $tenant->domains->count() }} domain{{ $tenant->domains->count() !== 1 ? 's' : '' }}
                            </span>
                        </h3>
                    </div>
                    <div class="px-6 py-6">
                        @if ($tenant->domains->isNotEmpty())
                            <div class="space-y-4">
                                @foreach ($tenant->domains as $domain)
                                    <div
                                        class="flex items-center justify-between rounded-lg border border-gray-200 bg-gray-50 p-4 transition-colors duration-200 hover:bg-gray-100">
                                        <div class="flex items-center space-x-3">
                                            <div class="shrink-0">
                                                <div
                                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">
                                                    <i class="fas fa-link text-xs text-blue-600"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="http://{{ $domain->domain }}" target="_blank"
                                                    class="text-base font-medium text-blue-600 transition-colors duration-200 hover:text-blue-800">
                                                    {{ $domain->domain }}
                                                </a>
                                                <p class="text-sm text-gray-500">
                                                    Added {{ $domain->created_at->format('M j, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="http://{{ $domain->domain }}" target="_blank"
                                                class="inline-flex items-center rounded-md bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800 transition-colors duration-200 hover:bg-blue-200">
                                                <i class="fas fa-external-link-alt mr-1"></i>
                                                Visit
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-8 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                                    <i class="fas fa-globe text-xl text-gray-400"></i>
                                </div>
                                <h4 class="mt-2 text-sm font-medium text-gray-900">No domains configured</h4>
                                <p class="mt-1 text-sm text-gray-500">This tenant doesn't have any custom domains set up
                                    yet.</p>
                            </div>
                        @endif
                    </div>
                </div>