@extends('layouts.app')

@section('content')
    <div class="bg-white w-75 mx-auto p-5 rounded shadow">
        <h1 class="text-center mb-5">Let's start something new</h1>
        <form
            method="POST"
            action="/projects"
        >
        @include('projects.form', [
            'project' => new App\Models\Project,
            'buttonText' => 'Create Project'
        ])
        </form>
    </div>
@endsection
