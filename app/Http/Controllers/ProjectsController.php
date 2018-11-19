<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Repositories\ProjectsRepository;
use Illuminate\Http\Request;
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

    public function destroy($id)
    {
        $this->repository->delete($id);
        return back();
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        return back();
    }
}
