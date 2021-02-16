@extends('layouts.app')

@section('content')
    <header class="d-flex align-items-center mb-3">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h2 class="text-muted">My Projects</h2>
            <a href="/projects/create" class="btn btn-info text-white">New Project</a>
        </div>
    </header>

    <main class="row">
        @forelse($projects as $project)
            <div class="col-md-4 py-3">
                <div class="bg-white px-3 py-4 h-100 rounded shadow">
                    <h3 class="mb-3 title">
                        <a href="{{ $project->path() }}" class="text-dark">{{ $project->title }}</a>
                    </h3>

                    <div class="text-muted">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>
                </div>
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </main>
@endsection
