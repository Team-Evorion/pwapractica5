<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    public function __invoke(UpdateTaskStatusRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return back()->with('success', 'Estado de la tarea actualizado.');
    }
}
