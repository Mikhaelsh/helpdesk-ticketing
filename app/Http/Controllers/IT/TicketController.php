<?php

namespace App\Http\Controllers\IT;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'category'])->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $tickets = $query->get();
        $categories = \App\Models\Category::all();

        return view('it.tickets.index', compact('tickets', 'categories'));
    }

    public function show(Ticket $ticket)
    {
        $logs = $ticket->logs()->with('user')->latest()->get();
        return view('it.tickets.show', compact('ticket', 'logs'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:On Progress,Resolved,Closed',
            'note' => 'nullable|string',
        ]);

        $ticket->update(['status' => $request->status]);

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'Status updated to ' . $request->status,
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Ticket updated successfully.');
    }
}