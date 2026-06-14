<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RequestApproval;
use Illuminate\Http\Request;

class RequestApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = RequestApproval::query();
        if ($request->status && $request->status !== 'All') {
            $query->where('status', $request->status);
        }
        return response()->json($query->latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'       => 'required|string|max:100',
            'requester'  => 'required|string|max:120',
            'department' => 'required|string|max:100',
            'details'    => 'required|string',
        ]);
        $data['status'] = 'Pending';
        $data['date']   = now()->toDateString();
        return response()->json(RequestApproval::create($data), 201);
    }

    public function show(RequestApproval $request)   { return response()->json($request); }

    public function update(Request $request, RequestApproval $requestApproval)
    {
        $requestApproval->update($request->validate([
            'status' => 'sometimes|in:Pending,Approved,Rejected',
        ]));
        return response()->json($requestApproval);
    }

    public function destroy(RequestApproval $requestApproval)
    {
        $requestApproval->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function action(Request $request, RequestApproval $requestApproval)
    {
        $request->validate(['status' => 'required|in:Approved,Rejected']);
        $requestApproval->update(['status' => $request->status]);
        return response()->json($requestApproval);
    }
}
