<?php

namespace App\Repository\Task;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(private Task $task)
    {
    }

    public function create(array $data): Task
    {
        return $this->task->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $task = $this->find($id);

        return $task ? $task->update($data) : false;
    }

    public function reorder(int $id, int $priority): bool
    {
        $task = $this->find($id);

        return $task ? $task->update(['priority' => $priority]) : false;
    }

    public function delete(int $id): bool
    {
        $task = $this->find($id);

        return $task ? $task->delete() : false;
    }

    public function find(int $id): ?Task
    {
        return $this->task->find($id);
    }

    public function getAll(): iterable
    {
        return $this->task->orderBy('priority')->orderBy('task_name')->get();
    }
}
