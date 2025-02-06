<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::filter()->sort()->getOrPaginate();
        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $request)
    {
        $task = new Task();

        $task->title = $request->TaskTitle;
        $task->description = $request->TaskDescription;
        $task->status = $request->TaskStatus;
        $task->user_id = $request->TaskUser_id;

        try {
            $task->save();
            return response()->json([
                'message' => 'Tarea creada correctamente',
                'data' => TaskResource::make($task)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la tarea',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->title = $request->TaskTitle ?? $task->title;
        $task->description = $request->TaskDescription ?? $task->description;
        $task->status = $request->TaskStatus ?? $task->status;
        $task->user_id = $request->TaskUser_id ?? $task->user_id;

        try {
            $task->save();
            return response()->json([
                'message' => 'Tarea actualizada correctamente',
                'data' => TaskResource::make($task)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la tarea',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return response()->json([
                'message' => 'Tarea eliminada correctamente'    
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la tarea',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
