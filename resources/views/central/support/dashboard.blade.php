@extends('central.layout')

@section('title', 'Support Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Support Dashboard</h1>
            <p class="mt-2 text-gray-600">Manage and track support tickets from all tenants</p>
        </div>

        <!-- Statistics Cards -->
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-5">
            <div class="rounded-lg bg-white p-6 shadow-md">
                <div class="flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Tickets</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_tickets'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-md">
                <div class="flex items-center">
                    <div class="rounded-full bg-red-100 p-3 text-red-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Open Tickets</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['open_tickets'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-md">
                <div class="flex items-center">
                    <div class="rounded-full bg-yellow-100 p-3 text-yellow-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">In Progress</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['in_progress_tickets'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-md">
                <div class="flex items-center">
                    <div class="rounded-full bg-green-100 p-3 text-green-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Resolved</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['resolved_tickets'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-md">
                <div class="flex items-center">
                    <div class="rounded-full bg-orange-100 p-3 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">High Priority</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['high_priority_tickets'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tickets -->
        <div class="rounded-lg bg-white shadow-md">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Tickets</h2>
                    <a href="{{ route('central.support.index') }}" class="text-blue-600 hover:text-blue-800">
                        View All Tickets →
                    </a>
                </div>
            </div>
            <div class="px-6 py-4">
                @if ($recent_tickets->count() > 0)
                    <div class="space-y-4">
                        @foreach ($recent_tickets as $ticket)
                            <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4">
                                <div class="flex items-center space-x-4">
                                    <div class="shrink-0">
                                        <span
                                            class="bg-{{ $ticket->status_color }}-100 text-{{ $ticket->status_color }}-800 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $ticket->ticket_number }}</p>
                                        <p class="text-sm text-gray-600">{{ $ticket->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $ticket->tenant->name ?? 'Unknown Tenant' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="bg-{{ $ticket->priority_color }}-100 text-{{ $ticket->priority_color }}-800 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                    <a href="{{ route('central.support.show', $ticket) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        View
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="py-8 text-center text-gray-500">No tickets found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
