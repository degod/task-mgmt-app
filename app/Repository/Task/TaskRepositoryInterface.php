<?php

namespace App\Repository\Task;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function create(array $data): Task;

    public function update(int $id, array $data): bool;

    public function reorder(int $id, int $priority): bool;

    public function delete(int $id): bool;

    public function find(int $id): ?Task;

    public function getAll(): iterable;
}
