<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskStatusController extends Controller
{
    public function __invoke(UpdateTaskStatusRequest $request, Task $task): TaskResource
    {
        $task->update($request->validated());

        return new TaskResource($task->refresh()->load('assignee.role'));
    }
}
