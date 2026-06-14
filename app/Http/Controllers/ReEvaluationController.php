<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReEvaluation;
use Illuminate\Http\Request;

class ReEvaluationController extends Controller
{
    public function index()
    {
        return response()->json(ReEvaluation::latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student'       => 'required|string|max:120',
            'subject'       => 'required|string|max:150',
            'exam'          => 'required|string|max:100',
            'current_marks' => 'required|integer|min:0',
        ]);
        $data['status']     = 'Pending';
        $data['applied_on'] = now()->toDateString();
        return response()->json(ReEvaluation::create($data), 201);
    }

    public function show(ReEvaluation $reEvaluation)   { return response()->json($reEvaluation); }

    public function update(Request $request, ReEvaluation $reEvaluation)
    {
        $reEvaluation->update($request->validate([
            'status'        => 'sometimes|in:Pending,Under Review,Completed,Rejected',
            'revised_marks' => 'nullable|integer|min:0',
        ]));
        return response()->json($reEvaluation);
    }

    public function destroy(ReEvaluation $reEvaluation)
    {
        $reEvaluation->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
