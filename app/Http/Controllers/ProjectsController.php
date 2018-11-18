<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function store(Request $request) {
        $request->user()->projects()->create([
            'name' => $request->name,
            'thumbnail' => $request->thumbnail
        ]);
    }
}
