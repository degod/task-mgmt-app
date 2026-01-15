<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_task()
    {
        $project = Project::factory()->create();

        $response = $this->post(route('tasks.store'), [
            'task_name' => 'New Task',
            'priority' => 1,
            'project_id' => $project->id,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Task created successfully.');

        $this->assertDatabaseHas('tasks', [
            'task_name' => 'New Task',
            'priority' => 1,
            'project_id' => $project->id,
        ]);
    }
}
