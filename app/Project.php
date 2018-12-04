<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'thumbnail'
    ];

    public function user()
    {
        // $project->user
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getThumbnailAttribute($vaule)
    {
        return $value ?? 'default.jpeg';
    }
}
