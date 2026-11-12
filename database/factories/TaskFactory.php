<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function configure(): static
    {
        return $this->afterCreating(function (Task $task): void {
            $task->project->members()->syncWithoutDetaching([$task->assigned_to]);
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'assigned_to' => User::factory()->teamMember(),
            'title' => fake()->sentence(4),
            'description' => fake()->optional()->text(250),
            'status' => TaskStatus::Pending,
        ];
    }
}
