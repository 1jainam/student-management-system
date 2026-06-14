<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query();
        if ($request->status) $query->where('status', $request->status);
        return response()->json($query->latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'student'  => 'required|string|max:120',
            'category' => 'required|in:Finance,Technical,Academic,Admin,Other',
            'priority' => 'required|in:High,Medium,Low',
        ]);
        $data['status']     = 'Open';
        $data['created_at'] = now()->toDateString();
        return response()->json(Ticket::create($data), 201);
    }

    public function show(Ticket $ticket)   { return response()->json($ticket); }

    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update($request->validate([
            'status' => 'sometimes|in:Open,In Progress,Resolved,Closed',
        ]));
        return response()->json($ticket);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate(['status' => 'required|in:Open,In Progress,Resolved,Closed']);
        $ticket->update(['status' => $request->status]);
        return response()->json($ticket);
    }
}
