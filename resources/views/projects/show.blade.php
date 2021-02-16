@extends('layouts.app')

@section('content')
    <header class="d-flex align-items-center mb-3">
        <div class="d-flex justify-content-between align-items-center w-100">
            <p class="text-muted mt-3">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>
            <a href="/projects/create" class="btn btn-info text-white">New Project</a>
        </div>
    </header>

    <main>
        <div class="row">
            <div class="col-md-9 px-3 mb-4">
                <div class="mb-5">
                    <h2 class="text-muted mb-2">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="bg-white px-3 py-4 rounded shadow px-3 mb-2">{{ $task->body }}</div>
                    @endforeach
                </div>
                <div>
                    <h2 class="text-muted mb-2">General Notes</h2>

                    <textarea class="bg-white px-3 py-4 rounded shadow w-100" style="height: 200px">Lorem ipsum</textarea>
                </div>
            </div>

            <div class="col-md-3 py-3">
                <div class="bg-white px-3 py-4 mt-4 rounded shadow">
                    <h3 class="mb-3 title">
                        <a href="{{ $project->path() }}" class="text-dark">{{ $project->title }}</a>
                    </h3>

                    <div class="text-muted">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>
                </div>
            </div>
        </div>
    </main>


@endsection
