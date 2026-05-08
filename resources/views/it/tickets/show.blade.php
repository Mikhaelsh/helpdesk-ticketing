<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ticket: {{ $ticket->ticket_no }}</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="{{ route('it.tickets.index') }}" class="text-indigo-600 text-sm mb-6 inline-block">← Back to All Tickets</a>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Title</p>
                    <p class="font-medium text-gray-800">{{ $ticket->title }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Submitted By</p>
                    <p class="font-medium text-gray-800">{{ $ticket->user->name }}</p>
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

        @if($ticket->status !== 'Closed')
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h3 class="font-semibold text-gray-700 mb-4">Update Status</h3>
            <form action="{{ route('it.tickets.updateStatus', $ticket) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Status</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @if($ticket->status === 'Open')
                            <option value="On Progress">On Progress</option>
                        @elseif($ticket->status === 'On Progress')
                            <option value="Resolved">Resolved</option>
                        @elseif($ticket->status === 'Resolved')
                            <option value="Closed">Closed</option>
                        @endif
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                    <textarea name="note" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white text-sm px-5 py-2 rounded-lg transition">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
        @endif

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