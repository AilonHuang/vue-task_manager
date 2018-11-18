@extends('layouts.app')

@section('content')
    <div class="container">
        @include('projects._createModel')

        <div class="card-deck">
            @each('projects._card', $projects, 'project')
        </div>

    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function () {
            $('.icon-bar').hide()
            $('.project-card').hover(function () {
                $(this).find('.icon-bar').toggle()
            })
        })
    </script>
@endsection