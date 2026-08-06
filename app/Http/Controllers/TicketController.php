<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Store a newly created support ticket from a customer.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            abort(401);
        }

        $request->validate([
            'topic' => ['required', 'string'],
            'message' => ['required', 'string'],
            'priority' => ['required', 'string', 'in:low,medium,high,urgent'],
        ]);

        // Create the Ticket
        $ticket = SupportTicket::create([
            'user_id' => Auth::id(),
            'topic' => $request->topic,
            'message' => $request->message,
            'priority' => $request->priority,
            'status' => 'open',
        ]);

        // Initialize the message thread with the ticket description
        SupportTicketMessage::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->route('dashboard')->with('success', 'Support ticket submitted successfully! Check your thread below.');
    }

    /**
     * Append a new reply message to the support ticket thread.
     */
    public function storeMessage(Request $request, SupportTicket $ticket)
    {
        if (!Auth::check()) {
            abort(401);
        }

        // Authorize: sender must be ticket owner or platform administrator
        if (Auth::id() !== $ticket->user_id && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'message' => ['required', 'string'],
        ]);

        // Create the reply message
        SupportTicketMessage::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Auto-update ticket status:
        // Admin reply sets status to 'resolved'. Client reply returns it to 'open'.
        $ticket->update([
            'status' => Auth::user()->is_admin ? 'resolved' : 'open',
        ]);

        $redirectRoute = Auth::user()->is_admin ? 'admin.dashboard' : 'dashboard';
        return redirect()->route($redirectRoute)->with('success', 'Reply posted successfully!');
    }

    /**
     * Update the internal notes for a ticket (Admin Only).
     */
    public function updateNote(Request $request, SupportTicket $ticket)
    {
        // Enforce Admin Role Check
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'internal_note' => ['nullable', 'string'],
        ]);

        $ticket->update([
            'internal_note' => $request->internal_note,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Internal notes updated successfully!');
    }
}
