<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Tickets</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        <a href="{{ route('tickets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ New Ticket</a>

        @if(session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        <table class="w-full mt-6 border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Ticket No</th>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Category</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr>
                    <td class="p-2 border">{{ $ticket->ticket_no }}</td>
                    <td class="p-2 border">{{ $ticket->title }}</td>
                    <td class="p-2 border">{{ $ticket->category->name }}</td>
                    <td class="p-2 border text-center align-middle">
                        <x-status-badge :status="$ticket->status" />
                    </td>
                    <td class="p-2 border">{{ $ticket->created_at->format('d M Y') }}</td>
                    <td class="p-2 border text-center">
                        <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-500">View</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-2 text-center">No tickets found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>