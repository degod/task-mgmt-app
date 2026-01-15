<?php

namespace App\Http\Controllers;

use App\Repository\Project\ProjectRepositoryInterface;
use App\Http\Requests\CreateProjectRequest;

class ProjectController extends Controller
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository
    ) {}

    public function store(CreateProjectRequest $request)
    {
        $data = $request->only(['name']);
        $success = $this->projectRepository->create($data);

        return $success ? redirect()->back()->with('success', 'Project created successfully.') : redirect()->route('home')->with('error', 'Failed to create project.');
    }
}
