<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_project()
    {
        $response = $this->post(route('projects.store'), [
            'name' => 'New Project',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Project created successfully.');

        $this->assertDatabaseHas('projects', [
            'name' => 'New Project',
        ]);
    }
}