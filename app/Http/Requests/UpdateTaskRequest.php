<?php

namespace App\Http\Requests;

use App\Models\Task;
use App\Models\User;
use App\RoleName;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        $task = $this->route('task');

        return $task instanceof Task && ($this->user()?->can('update', $task) ?? false);
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'assigned_to' => ['sometimes', 'required', 'integer', 'exists:users,id'],
            'title' => ['sometimes', 'required', 'string', 'max:50'],
            'description' => ['sometimes', 'nullable', 'string', 'max:300'],
        ];
    }

    /** @return array<callable(Validator): void> */
    public function after(): array
    {
        return [function (Validator $validator): void {
            if (! $this->has('assigned_to') || $validator->errors()->has('assigned_to')) {
                return;
            }

            $task = $this->route('task');
            $assignee = User::query()->with('role')->find($this->integer('assigned_to'));

            if (! $assignee?->hasRole(RoleName::TeamMember)) {
                $validator->errors()->add('assigned_to', 'La tarea solo puede asignarse a un miembro del equipo.');

                return;
            }

            if ($task instanceof Task && ! $task->project->members()->whereKey($assignee->id)->exists()) {
                $validator->errors()->add('assigned_to', 'El usuario debe pertenecer al proyecto.');
            }
        }];
    }
}
