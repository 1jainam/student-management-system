<?php
// ProjectController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(Project::latest()->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:200',
            'department' => 'required|string|max:100',
            'lead'       => 'required|string|max:100',
            'deadline'   => 'required|date',
        ]);
        $data['progress'] = 0;
        $data['status']   = 'Planning';
        $data['members']  = 1;
        return response()->json(Project::create($data), 201);
    }

    public function show(Project $project)    { return response()->json($project); }

    public function update(Request $request, Project $project)
    {
        $project->update($request->validate([
            'title'    => 'sometimes|string|max:200',
            'progress' => 'sometimes|integer|min:0|max:100',
            'status'   => 'sometimes|string|max:50',
        ]));
        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
