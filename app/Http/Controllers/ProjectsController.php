<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use App\Repositories\ProjectsRepository;

class ProjectsController extends Controller
{
    protected $repository;

    public function __construct(ProjectsRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
    }


    public function index()
    {
        $projects = $this->repository->list();
        return view('welcome', compact('projects'));
    }

    public function store(CreateProjectRequest $request)
    {
        $this->repository->create($request);
        return back();
    }

    public function show(Project $project)
    {
//        $project = $this->repository->find($id);
        $todos = $this->repository->todos($project);
        $dones = $this->repository->dones($project);
        $projects = request()->user()->projects()->pluck('name', 'id');
        return view('projects.show', compact('project', 'todos', 'dones', 'projects'));
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $this->repository->update($request, $id);
        return back();
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return back();
    }
}
