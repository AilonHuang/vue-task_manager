<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;

class TaskCountComposer
{
    public function compose(View $view)
    {
        return $view->with([
            'total' => 30,
            'todoCount' => 20,
            'doneCount' => 20
        ]);
    }
}