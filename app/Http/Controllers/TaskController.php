<?php

namespace App\Http\Controllers;

use App\Repository\Task\TaskRepositoryInterface;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {}

    public function update(UpdateTaskRequest $request, int $id)
    {
        $data = $request->only(['task_name', 'priority', 'project_id']);
        $success = $this->taskRepository->update($id, $data);

        return $success ? redirect()->back()->with('success', 'Task updated successfully.') : redirect()->route('home')->with('error', 'Failed to update task.');
    }

    public function destroy(int $id)
    {
        $success = $this->taskRepository->delete($id);

        return $success ? redirect()->back()->with('success', 'Task deleted successfully.') : redirect()->route('home')->with('error', 'Failed to delete task.');
    }

    public function store(CreateTaskRequest $request)
    {
        $data = $request->only(['task_name', 'priority', 'project_id']);
        $success = $this->taskRepository->create($data);

        return $success ? redirect()->back()->with('success', 'Task created successfully.') : redirect()->route('home')->with('error', 'Failed to create task.');
    }

    public function reorder(Request $request)
    {
        $tasks = $request->input('tasks', []);

        foreach ($tasks as $task) {
            $this->taskRepository->reorder($task['id'], $task['priority']);
        }

        return response()->json(['success' => true]);
    }
}
