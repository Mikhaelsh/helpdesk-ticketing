@props(['status'])

@php
    $statusColor = match($status) {
        'Open' => 'bg-yellow-100 text-yellow-700',
        'On Progress' => 'bg-blue-100 text-blue-700',
        'Resolved' => 'bg-green-100 text-green-700',
        'Closed' => 'bg-gray-200 text-gray-500',
        default => 'bg-gray-100 text-gray-500',
    };
@endphp

<span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColor }}">{{ $status }}</span>