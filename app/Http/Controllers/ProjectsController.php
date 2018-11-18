<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Project;
use App\Repositories\ProjectsRepository;
use Image;

class ProjectsController extends Controller
{
    protected $repository;
    public function __construct(ProjectsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(CreateProjectRequest $request)
    {
        $this->repository->create($request);
        return back();
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back();
    }
}
