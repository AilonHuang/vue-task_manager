<?php

namespace App\Http\Controllers;

use App\Http\Requests\createStep;
use App\Step;
use App\Task;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        $steps = $task->steps;
        $todos = $steps->where('completion', 0)->values();
        $dones = $steps->where('completion', 1)->values();
        return view('steps.show', compact('task', 'todos', 'dones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task, createStep $request)
    {
        $task->steps()->create($request->only('name'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, Step $step)
    {
        $step->update($request->only('name'));
    }

    public function toggle(Request $request, Task $task, Step $step)
    {
        $step->update($request->only('completion'));
    }

    public function completeAll(Task $task)
    {
        $task->steps()->update([
            'completion' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Step $step)
    {
        $step->delete();
    }

    public function clear(Task $task)
    {
        $task->steps()->where('completion', '=', 1)->delete();
    }
}
