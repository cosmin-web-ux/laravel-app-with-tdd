@extends('layouts.app')

@section('content')
    <header class="d-flex align-items-center mb-3">
        <div class="d-flex justify-content-between align-items-center w-100">
            <p class="text-muted mt-3">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>
            <div>
                @foreach($project->members as $member)
                    <img
                        src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-circle mr-2"
                        style="width: 40px"
                    >
                @endforeach

                    <img
                        src="{{ gravatar_url($project->owner->email) }}"
                        alt="{{ $project->owner->email }}'s avatar"
                        class="rounded-circle mr-2"
                        style="width: 40px"
                    >

                <a href="{{ $project->path() . '/edit' }}" class="btn btn-info text-white ml-3">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="row">
            <div class="col-md-9 px-3 mb-4">
                <div class="mb-5">
                    <h2 class="text-muted mb-2">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="bg-white px-3 py-4 rounded shadow px-3 mb-2">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf

                                <div class="d-flex align-items-center">
                                    <input type="text" name="body" value="{{ $task->body }}" class="w-100 {{ $task->completed ? 'text-muted' : '' }}">
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="bg-white px-3 py-4 rounded shadow px-3 mb-2">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input placeholder="Add a new task..." class="w-100" name="body">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-muted mb-2">General Notes</h2>

                    <form action="{{ $project->path() }}" method="POST">
                        @method('PATCH')
                        @csrf

                        <textarea
                            name="notes"
                            class="bg-white px-3 py-4 mb-3 rounded shadow w-100"
                            style="height: 200px"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>

                        <button type="submit" class="btn btn-info text-white">Save</button>
                    </form>
                    @include('errors')
                </div>
            </div>

            <div class="col-md-3 py-3">
                <div class="bg-white px-3 py-4 mt-4 rounded shadow">
                    <div class="d-flex flex-column" style="height: 200px">
                        <h3 class="mb-3 title">
                            <a href="{{ $project->path() }}" class="text-dark">{{ $project->title }}</a>
                        </h3>

                        <div class="flex-shrink-0 flex-grow-1 text-muted">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>

                        <div>
                            <form method="POST" action="{{ $project->path() }}" class="text-right">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn bg-transparent"><small>Delete</small></button>
                            </form>
                        </div>
                    </div>
                </div>
                @include ('projects.activity.card')

                @can ('manage', $project)
                    @include ('projects.invite')
                @endcan
            </div>
        </div>
    </main>

@endsection
