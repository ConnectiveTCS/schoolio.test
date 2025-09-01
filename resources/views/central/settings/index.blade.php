@extends('central.layout')

@section('title', 'System Settings')

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">System Settings</h1>
                <p class="mt-1 text-sm text-gray-600">
                    Configure system-wide settings and preferences.
                </p>
            </div>

            <!-- Placeholder for future system settings -->
            <div class="rounded-lg bg-white shadow">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-medium text-gray-900">Configuration</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="py-12 text-center">
                        <i class="fas fa-cogs mb-4 text-6xl text-gray-400"></i>
                        <h3 class="mb-2 text-lg font-medium text-gray-900">System Settings</h3>
                        <p class="mb-4 text-sm text-gray-500">
                            Advanced system configuration options will be available in future updates.
                        </p>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>• Email configuration</p>
                            <p>• Payment gateway settings</p>
                            <p>• Security policies</p>
                            <p>• Backup and maintenance schedules</p>
                            <p>• Performance monitoring</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Environment Information -->
            <div class="mt-8 rounded-lg bg-white shadow">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-medium text-gray-900">Environment Information</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Environment</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ app()->environment() }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Laravel Version</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ app()->version() }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">PHP Version</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ PHP_VERSION }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Database</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ config('database.default') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
