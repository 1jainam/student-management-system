<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Transaction;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents    = Admission::where('status', 'Approved')->count();
        $activeCourses    = Course::count();
        $revenueThisMonth = Transaction::where('status', 'Paid')
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        $recentAdmissions = Admission::latest()
            ->take(5)
            ->get(['id', 'name', 'course', 'applied_on', 'status']);

        // Month-over-month growth
        $lastMonthStudents = Admission::where('status', 'Approved')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();
        $thisMonthStudents = Admission::where('status', 'Approved')
            ->whereMonth('created_at', now()->month)
            ->count();
        $growth = $lastMonthStudents > 0
            ? round((($thisMonthStudents - $lastMonthStudents) / $lastMonthStudents) * 100)
            : 0;

        return response()->json([
            'stats' => [
                'total_students' => $totalStudents,
                'active_courses' => $activeCourses,
                'revenue'        => '₹' . number_format($revenueThisMonth / 100000, 1) . 'L',
                'growth'         => $growth,
            ],
            'recent_admissions' => $recentAdmissions,
        ]);
    }
}
