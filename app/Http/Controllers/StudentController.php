<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable|string',
            'course' => 'required|string',
            'status' => 'in:active,inactive',
            'enrollment_date' => 'required|date',
        ]);

        $student = Student::create($request->all());

        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student
        ], 201);
    }

    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->update($request->all());

        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student
        ]);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}