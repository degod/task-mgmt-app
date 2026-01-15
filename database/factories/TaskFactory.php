<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        // Create a project if none exists
        $project = Project::find(rand(1, 5)) ?? Project::factory()->create();

        return [
            'task_name' => $this->faker->sentence(),
            'priority' => $this->faker->numberBetween(1, 10),
            'project_id' => $project->id,
        ];
    }
}
