@extends('layouts.app')

@section('content')
    <div class="container">
        @include('projects._createModel')

        <div class="card-deck">
            @each('projects._card', $projects, 'project')
        </div>

    </div>
@endsection