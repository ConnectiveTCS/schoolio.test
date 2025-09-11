<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                {{ __('Reports Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="mb-6">
            <p
                class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                Generate and view various reports to analyze your school's performance and activities.
            </p>
        </div>

        <!-- Report Types Grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($reportTypes as $key => $report)
                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-sm transition-all duration-200 hover:shadow-md dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="@if ($report['color'] === 'blue') bg-blue-500 dark:bg-blue-600
                                    @elseif($report['color'] === 'green') bg-green-500 dark:bg-green-600
                                    @elseif($report['color'] === 'purple') bg-purple-500 dark:bg-purple-600
                                    @else bg-orange-500 dark:bg-orange-600 @endif flex h-12 w-12 items-center justify-center rounded-lg">
                                    <i class="{{ $report['icon'] }} h-6 w-6 text-white"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3
                                    class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    {{ $report['title'] }}
                                </h3>
                                <p
                                    class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    {{ $report['description'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="border-t border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-3 transition-colors duration-200 dark:border-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="flex items-center justify-between">
                            @if ($key === 'attendance')
                                <a href="{{ route('tenant.reports.attendance') }}"
                                    class="text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                    Generate Report
                                </a>
                            @elseif($key === 'enrollment')
                                <a href="{{ route('tenant.reports.enrollment') }}"
                                    class="text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                    Generate Report
                                </a>
                            @elseif($key === 'class_summary')
                                <a href="{{ route('tenant.reports.class-summary') }}"
                                    class="text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                    Generate Report
                                </a>
                            @else
                                <a href="{{ route('tenant.reports.activity') }}"
                                    class="text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                    Generate Report
                                </a>
                            @endif
                            <i
                                class="fas fa-arrow-right h-4 w-4 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Quick Stats -->
        <div class="mt-8">
            <h3
                class="mb-4 text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                Quick Statistics
            </h3>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- Total Reports Available -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i
                                class="fas fa-chart-bar h-8 w-8 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-brunswick-green)]"></i>
                        </div>
                        <div class="ml-4">
                            <p
                                class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Available Reports
                            </p>
                            <p
                                class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                {{ count($reportTypes) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Data Sources -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i
                                class="fas fa-database h-8 w-8 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-brunswick-green)]"></i>
                        </div>
                        <div class="ml-4">
                            <p
                                class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Data Sources
                            </p>
                            <p
                                class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                5+
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Export Formats -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i
                                class="fas fa-download h-8 w-8 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-brunswick-green)]"></i>
                        </div>
                        <div class="ml-4">
                            <p
                                class="text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Export Formats
                            </p>
                            <p
                                class="text-2xl font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                CSV
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reports Section -->
        <div class="mt-8">
            <h3
                class="mb-4 text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                Getting Started
            </h3>
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <h4
                            class="mb-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Popular Reports
                        </h4>
                        <ul class="space-y-2">
                            <li
                                class="flex items-center text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-chevron-right mr-2 h-3 w-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-brunswick-green)]"></i>
                                Monthly attendance summary
                            </li>
                            <li
                                class="flex items-center text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-chevron-right mr-2 h-3 w-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-brunswick-green)]"></i>
                                Student enrollment statistics
                            </li>
                            <li
                                class="flex items-center text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-chevron-right mr-2 h-3 w-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-brunswick-green)]"></i>
                                Class performance overview
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4
                            class="mb-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Export Options
                        </h4>
                        <ul class="space-y-2">
                            <li
                                class="flex items-center text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-file-csv mr-2 h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-brunswick-green)]"></i>
                                CSV format for spreadsheet analysis
                            </li>
                            <li
                                class="flex items-center text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-filter mr-2 h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-brunswick-green)]"></i>
                                Customizable date ranges and filters
                            </li>
                            <li
                                class="flex items-center text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-chart-line mr-2 h-4 w-4 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-brunswick-green)]"></i>
                                Visual charts and statistics
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
