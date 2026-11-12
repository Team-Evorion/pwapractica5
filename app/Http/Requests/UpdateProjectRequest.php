<?php

namespace App\Http\Requests;

use App\Models\Project;
use App\Models\User;
use App\RoleName;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        $project = $this->route('project');

        return $project instanceof Project && ($this->user()?->can('update', $project) ?? false);
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'manager_id' => ['sometimes', 'required', 'integer', 'exists:users,id'],
            'name' => ['sometimes', 'required', 'string', 'max:100'],
            'description' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'member_ids' => ['sometimes', 'array'],
            'member_ids.*' => ['integer', 'distinct', 'exists:users,id'],
        ];
    }

    /** @return array<callable(Validator): void> */
    public function after(): array
    {
        return [function (Validator $validator): void {
            if ($this->has('manager_id') && ! $validator->errors()->has('manager_id')) {
                $manager = User::query()->with('role')->find($this->integer('manager_id'));

                if (! $manager?->hasRole(RoleName::ProjectManager)) {
                    $validator->errors()->add('manager_id', 'El responsable debe tener el rol Gerente de proyecto.');
                }
            }

            if (! $this->has('member_ids') || $validator->errors()->has('member_ids')) {
                return;
            }

            $invalidMembers = User::query()
                ->with('role')
                ->whereIn('id', $this->input('member_ids', []))
                ->get()
                ->contains(fn (User $user): bool => ! $user->hasRole(RoleName::TeamMember));

            if ($invalidMembers) {
                $validator->errors()->add('member_ids', 'Todos los integrantes deben tener el rol Miembro del equipo.');
            }
        }];
    }
}
