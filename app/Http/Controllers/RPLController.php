<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RPLCase;
use Illuminate\Http\Request;

class RPLController extends Controller
{
    public function index()
    {
        return response()->json(RPLCase::latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student'         => 'required|string|max:120',
            'course'          => 'required|string|max:100',
            'credits_applied' => 'required|integer|min:1',
        ]);
        $data['status'] = 'Under Review';
        $data['date']   = now()->toDateString();
        return response()->json(RPLCase::create($data), 201);
    }

    public function show(RPLCase $rpl)   { return response()->json($rpl); }

    public function update(Request $request, RPLCase $rpl)
    {
        $rpl->update($request->validate([
            'status'           => 'sometimes|in:Under Review,Approved,Rejected',
            'credits_approved' => 'nullable|integer|min:0',
        ]));
        return response()->json($rpl);
    }

    public function destroy(RPLCase $rpl)
    {
        $rpl->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
