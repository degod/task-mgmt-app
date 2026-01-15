<?php

namespace App\Http\Controllers;

use App\Repository\Task\TaskRepositoryInterface;
use App\Repository\Project\ProjectRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository,
        private ProjectRepositoryInterface $projectRepository
    ) {}

    public function __invoke(Request $request)
    {
        $projectFilter = $request->query('project_id');

        $projects = $this->projectRepository->getAll();
        $tasks = $this->taskRepository->getAll();

        if ($projectFilter) {
            $tasks = $tasks->where('project_id', $projectFilter);
        }

        return view('home', [
            'tasks' => $tasks,
            'projects' => $projects
        ]);
    }
}
