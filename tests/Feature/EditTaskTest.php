<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_task()
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this->put(route('tasks.update', $task->id), [
            'task_name' => 'Updated Task',
            'priority' => 5,
            'project_id' => $project->id,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Task updated successfully.');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'task_name' => 'Updated Task',
            'priority' => 5,
            'project_id' => $project->id,
        ]);
    }
}
