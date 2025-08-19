<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        try {
        $tasks = Task::with('creator')->get();
        return response()->json([
            'data' => $tasks,
        ], 200);
    }catch(\Exception $e) {
        return $e;
    }
    }

    public function store(TaskRequest $request)
    {
      
        // $validated = $request->validated();

        $task = Task::create($request);
        $task->assignedUsers()->attach([1 ]);

        return response()->json([
            'message' => 'Task created successfully',
            'data' => $task,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required|string|unique:tasks,title,' . $task->id,
            'created_by' => 'required|integer',
            'description' => 'nullable|string|max:255',
            'assigned_at' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_at' => $request->assigned_at,
            'created_by' => $request->created_by,
        ]);

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task,
        ]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }

    public function show($id)
   
    {
        $task = Task::with('creator')->findOrFail($id);

        return response()->json([
            'data' => $task,
        ]);
    }
}