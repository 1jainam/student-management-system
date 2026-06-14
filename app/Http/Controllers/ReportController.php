<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Transaction;
use App\Models\Course;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function enrollment()
    {
        $data = Course::withCount(['admissions as enrolled_count' => function ($q) {
            $q->where('status', 'Approved');
        }])->get(['id', 'name', 'code', 'seats']);

        return response()->json(['data' => $data]);
    }

    public function fees()
    {
        $data = Transaction::selectRaw("
            MONTH(created_at) as month,
            SUM(CASE WHEN status='Paid' THEN amount ELSE 0 END) as collected,
            SUM(CASE WHEN status='Pending' THEN amount ELSE 0 END) as pending
        ")->groupByRaw('MONTH(created_at)')->get();

        return response()->json(['data' => $data]);
    }

    public function attendance()
    {
        return response()->json(['data' => [], 'message' => 'Connect attendance module']);
    }

    public function results()
    {
        return response()->json(['data' => [], 'message' => 'Connect results module']);
    }

    public function faculty()
    {
        return response()->json(['data' => [], 'message' => 'Connect faculty module']);
    }

    public function placement()
    {
        return response()->json(['data' => [], 'message' => 'Connect placement module']);
    }
}
