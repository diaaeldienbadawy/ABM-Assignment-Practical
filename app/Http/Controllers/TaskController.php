<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tasks')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('tasks.*', 'users.name as user_name')
            ->get();
        $response = TaskResource::collection($tasks);
        return response()->json($response);
    }

    public function store(TaskRequest $request)
    {
        $validatedData = $request->validated();

        $task = Task::create([
            'title' => $validatedData['title'],
            'status' => $validatedData['status'],
            'user_id' => $validatedData['user_id'],
        ]);
        $task->load('user');
        $response = new TaskResource($task);
        return response()->json($response, 201);
    }

    public function show(string $id)
    {
        $task = Task::with('user')
            ->where('id', $id)
            ->first();

        if (!$task) {
            return response()->json(['message' => __('response.task_not_found', ['id' => $id])], 404);
        }
        $response = new TaskResource($task);
        return response()->json($response);
    }

    public function update(TaskRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => __('response.task_not_found', ['id' => $id])], 404);
        }

        $task->update([
            'title' => $validatedData['title'],
            'status' => $validatedData['status'],
            'user_id' => $validatedData['user_id'],
        ]);
        $task->load('user');
        $response = new TaskResource($task);
        return response()->json($response);
    }

    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => __('response.task_not_found', ['id' => $id])], 404);
        }

        $task->delete();
        return response()->json(['message' => __('response.task_deleted_successfully')]);
    }
}
