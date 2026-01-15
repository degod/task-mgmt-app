<?php

namespace App\Repository\Project;

use App\Models\Project;

interface ProjectRepositoryInterface
{
    public function create(array $data): Project;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function find(int $id): ?Project;

    public function getAll(): iterable;
}
