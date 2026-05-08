<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Tickets</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">

        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        {{-- Filters --}}
        <form method="GET" action="{{ route('it.tickets.index') }}" class="flex gap-3 mb-6">
            <select name="status" class="border rounded px-3 py-2 text-sm">
                <option value="">All Status</option>
                @foreach(['Open', 'On Progress', 'Resolved', 'Closed'] as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>

            <select name="category_id" class="border rounded px-3 py-2 text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ request('date') }}" class="border rounded px-3 py-2 text-sm">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Filter</button>
            <a href="{{ route('it.tickets.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm">Reset</a>
        </form>

        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Ticket No</th>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Submitted By</th>
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
                    <td class="p-2 border">{{ $ticket->user->name }}</td>
                    <td class="p-2 border">{{ $ticket->category->name }}</td>
                    <td class="p-2 border text-center align-middle">
                        <x-status-badge :status="$ticket->status" />
                    </td>
                    <td class="p-2 border">{{ $ticket->created_at->format('d M Y') }}</td>
                    <td class="p-2 border text-center">
                        <a href="{{ route('it.tickets.show', $ticket) }}" class="text-blue-500">View</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="p-2 text-center">No tickets found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>