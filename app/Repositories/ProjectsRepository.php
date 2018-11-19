<?php

namespace App\Repositories;

use App\Project;
use Image;

class ProjectsRepository
{
    public function create($request) {
        $request->user()->projects()->create([
            'name' => $request->name,
            'thumbnail' => $this->thumb($request)
        ]);
    }

    public function thumb($request)
    {
        if ($request->hasFile('thumbnail')) {
            $thumb = $request->thumbnail;
            $name = $thumb->hashName();
            // 保存图片
            $request->thumbnail->storeAs('public/thumbs/original', $name);
            $path = storage_path('app/public/thumbs/cropped/' . $name);
            // 处理图片
            Image::make($thumb)->resize(200, 90)->save($path);
            return $name;
        }
    }

    public function find($id)
    {
        return Project::findOrFail($id);
    }

    public function delete($id)
    {
        $project = $this->find($id);
        $project->delete();
    }

    public function update($request, $id)
    {
        $project = $this->find($id);
        $project->name = $request->name;
        if ($request->hasFile('thumbnail')) {
            $project->thumbnail = $this->thumb($request);
        }
        $project->save();
    }
}