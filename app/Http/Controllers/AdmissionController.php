<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Admission::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('course', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        if ($request->status && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        return response()->json($query->latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:120',
            'email' => 'required|email|max:120',
            'course'=> 'required|string|max:100',
            'batch' => 'required|string|max:20',
        ]);

        $data['status']     = 'Pending';
        $data['applied_on'] = now()->toDateString();

        $admission = Admission::create($data);

        return response()->json($admission, 201);
    }

    public function show(Admission $admission)
    {
        return response()->json($admission);
    }

    public function update(Request $request, Admission $admission)
    {
        $data = $request->validate([
            'name'   => 'sometimes|string|max:120',
            'email'  => 'sometimes|email|max:120',
            'course' => 'sometimes|string|max:100',
            'batch'  => 'sometimes|string|max:20',
            'status' => 'sometimes|in:Pending,Approved,Under Review,Rejected',
        ]);

        $admission->update($data);

        return response()->json($admission);
    }

    public function destroy(Admission $admission)
    {
        $admission->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function updateStatus(Request $request, Admission $admission)
    {
        $request->validate(['status' => 'required|in:Pending,Approved,Under Review,Rejected']);
        $admission->update(['status' => $request->status]);
        return response()->json($admission);
    }
}
