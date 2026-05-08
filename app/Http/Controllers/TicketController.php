<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'ticket_no' => 'TKT-' . strtoupper(uniqid()),
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Open',
        ]);

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'Ticket created',
            'note' => null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Ticket submitted successfully.');
    }

    public function show(Ticket $ticket)
    {
        $logs = $ticket->logs()->with('user')->latest()->get();
        return view('tickets.show', compact('ticket', 'logs'));
    }
}