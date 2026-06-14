<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::query();
        if ($request->status) $query->where('status', $request->status);
        return response()->json($query->latest()->paginate(30));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'to'      => 'required|string|max:150',
            'subject' => 'required|string|max:255',
            'body'    => 'required|string',
            'type'    => 'required|in:Email,SMS,Notice,Push Notification',
        ]);
        $data['status']  = 'Sent';
        $data['sent_at'] = now()->toDateString();
        return response()->json(Message::create($data), 201);
    }

    public function show(Message $message)   { return response()->json($message); }
    public function update(Request $request, Message $message)
    {
        $message->update($request->only(['status']));
        return response()->json($message);
    }
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
