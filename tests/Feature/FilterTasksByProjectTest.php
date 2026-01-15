<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterTasksByProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_filter_tasks_by_project()
    {
        $project1 = Project::factory()->create();
        $project2 = Project::factory()->create();

        $task1 = Task::factory()->create(['project_id' => $project1->id]);
        $task2 = Task::factory()->create(['project_id' => $project2->id]);

        $response = $this->get(route('home', ['project_id' => $project1->id]));

        $response->assertStatus(200);
        $response->assertSee($task1->task_name);
        $response->assertDontSee($task2->task_name);
    }
}
