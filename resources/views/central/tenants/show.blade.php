@extends('central.layout')

@section('title', 'Tenant Details - ' . $tenant->name)

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <!-- Navigation and Title -->
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('central.tenants.index') }}"
                        class="inline-flex items-center text-blue-600 transition-colors duration-200 hover:text-blue-900">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span class="text-sm font-medium">Back to Tenants</span>
                    </a>
                </div>
                @if (auth('central_admin')->user()->canManageTenants())
                    <div class="flex space-x-3">
                        <a href="{{ route('central.tenants.edit', $tenant) }}"
                            class="inline-flex items-center rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-all duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-edit mr-2"></i>Edit Tenant
                        </a>
                    </div>
                @endif
            </div>

            <!-- Title and Status -->
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="mb-2 text-3xl font-bold text-gray-900">{{ $tenant->name }}</h1>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <span class="flex items-center">
                            <i class="fas fa-id-card mr-1"></i>
                            ID: {{ $tenant->id }}
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-1"></i>
                            Created {{ $tenant->created_at->format('M j, Y') }}
                        </span>
                    </div>
                </div>
                <div>
                    <span
                        class="{{ $tenant->status === 'active' ? 'bg-green-100 text-green-800 border-green-200' : '' }} {{ $tenant->status === 'suspended' ? 'bg-yellow-100 text-yellow-800 border-yellow-200' : '' }} {{ $tenant->status === 'inactive' ? 'bg-red-100 text-red-800 border-red-200' : '' }} inline-flex items-center rounded-full border px-3 py-1 text-sm font-semibold">
                        <span
                            class="{{ $tenant->status === 'active' ? 'bg-green-400' : '' }} {{ $tenant->status === 'suspended' ? 'bg-yellow-400' : '' }} {{ $tenant->status === 'inactive' ? 'bg-red-400' : '' }} mr-2 inline-block h-2 w-2 rounded-full"></span>
                        {{ ucfirst($tenant->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
            <!-- Main Information Column -->
            {{-- <div class="space-y-8 lg:col-span-2"> --}}
            <div class="col-span-3 row-start-1">
                @include('central.tenants.partials.basic-info')
            </div>
            <div class="col-span-3 row-start-2">
                @include('central.tenants.partials.configurations')
            </div>
            <div class="col-span-3 row-start-3">
                @include('central.tenants.partials.domains')
            </div>
            <div class="col-span-3 row-start-4">
                @include('central.tenants.partials.tenant-admin-users')
            </div>
            {{-- </div> --}}

            <!-- Sidebar -->
            {{-- <div class="space-y-8 lg:col-span-2"> --}}
            <div class="col-span-1 row-span-2 row-start-1">
                @include('central.tenants.partials.usage-stats')
            </div>
            <!-- Actions -->
            <div class="col-span-1 row-start-3">
                @include('central.tenants.partials.quick-actions')
            </div>
            <div class="col-span-4">
                @include('central.tenants.partials.users-roles')
            </div>
            {{-- </div> --}}
        </div>
    @endsection
