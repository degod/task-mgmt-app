<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.delete', $task->id));

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Task deleted successfully.');

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
