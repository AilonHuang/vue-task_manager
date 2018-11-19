{!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'DELETE']) !!}
<button type="submit" class="btn">
    <i class="fa fa-btn fa-times"></i>
</button>
{!! Form::close() !!}