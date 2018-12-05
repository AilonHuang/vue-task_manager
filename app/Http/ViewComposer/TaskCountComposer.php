<?php

namespace App\Http\ViewComposer;

use App\Repositories\TasksRepository;
use Illuminate\View\View;

class TaskCountComposer
{
    protected $repository;
    public function __construct(TasksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function compose(View $view)
    {
        if (auth()->user()) {
            return $view->with([
                'total' => $this->repository->totalCount(),
                'todoCount' => $this->repository->todoCount(),
                'doneCount' => $this->repository->doneCount()
            ]);
        }
    }
}