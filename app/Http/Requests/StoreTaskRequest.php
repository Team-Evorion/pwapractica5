<?php

namespace App\Http\Requests;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\RoleName;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        $project = $this->route('project');

        return $project instanceof Project && ($this->user()?->can('create', [Task::class, $project]) ?? false);
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'assigned_to' => ['required', 'integer', 'exists:users,id'],
            'title' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:300'],
        ];
    }

    /** @return array<callable(Validator): void> */
    public function after(): array
    {
        return [function (Validator $validator): void {
            if ($validator->errors()->has('assigned_to')) {
                return;
            }

            $project = $this->route('project');
            $assignee = User::query()->with('role')->find($this->integer('assigned_to'));

            if (! $assignee?->hasRole(RoleName::TeamMember)) {
                $validator->errors()->add('assigned_to', 'La tarea solo puede asignarse a un miembro del equipo.');

                return;
            }

            if ($project instanceof Project && ! $project->members()->whereKey($assignee->id)->exists()) {
                $validator->errors()->add('assigned_to', 'El usuario debe pertenecer al proyecto.');
            }
        }];
    }
}
