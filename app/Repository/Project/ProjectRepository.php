<?php

namespace App\Repository\Project;

use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(private Project $project)
    {
    }

    public function create(array $data): Project
    {
        return $this->project->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $project = $this->find($id);

        return $project ? $project->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $project = $this->find($id);

        return $project ? $project->delete() : false;
    }

    public function find(int $id): ?Project
    {
        return $this->project->find($id);
    }

    public function getAll(): iterable
    {
        return $this->project->orderBy('name')->get();
    }
}
