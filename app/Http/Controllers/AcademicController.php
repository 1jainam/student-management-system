<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function index()
    {
        return response()->json(Course::latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:150',
            'code'    => 'required|string|max:20|unique:courses,code',
            'duration'=> 'required|string|max:30',
            'seats'   => 'required|integer|min:1',
            'faculty' => 'required|string|max:100',
        ]);
        $data['enrolled'] = 0;
        return response()->json(Course::create($data), 201);
    }

    public function show(Course $course)
    {
        return response()->json($course);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->validate([
            'name'    => 'sometimes|string|max:150',
            'code'    => 'sometimes|string|max:20',
            'duration'=> 'sometimes|string|max:30',
            'seats'   => 'sometimes|integer|min:1',
            'faculty' => 'sometimes|string|max:100',
        ]));
        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function timetable()
    {
        // Extend with a Timetable model when ready
        return response()->json(['data' => [], 'message' => 'Connect timetable data here']);
    }

    public function faculty()
    {
        return response()->json(['data' => [], 'message' => 'Connect faculty data here']);
    }

    public function syllabus()
    {
        return response()->json(['data' => [], 'message' => 'Connect syllabus data here']);
    }
}
