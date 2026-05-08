<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ticket: {{ $ticket->ticket_no }}</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="{{ route('dashboard') }}" class="text-indigo-600 text-sm mb-6 inline-block">← Back to My Tickets</a>

        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Title</p>
                    <p class="font-medium text-gray-800">{{ $ticket->title }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Category</p>
                    <p class="font-medium text-gray-800">{{ $ticket->category->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Status</p>
                    <x-status-badge :status="$ticket->status" />
                </div>
                <div>
                    <p class="text-gray-500">Submitted</p>
                    <p class="font-medium text-gray-800">{{ $ticket->created_at->format('d M Y H:i') }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-gray-500">Description</p>
                    <p class="font-medium text-gray-800">{{ $ticket->description }}</p>
                </div>
            </div>
        </div>

        <h3 class="font-semibold text-gray-700 mb-3">Activity Log</h3>
        <div class="space-y-3">
            @forelse($logs as $log)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-sm">
                <div class="flex justify-between items-center mb-1">
                    <span class="font-medium text-gray-800">{{ $log->user->name }}</span>
                    <span class="text-xs text-gray-400">{{ $log->created_at->format('d M Y H:i') }}</span>
                </div>
                <p class="text-gray-600">{{ $log->action }}</p>
                @if($log->note)
                    <p class="text-gray-400 mt-1 italic">{{ $log->note }}</p>
                @endif
            </div>
            @empty
            <p class="text-gray-400 text-sm">No activity yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>