@extends('layouts.app')

@section('content')
    <div class="bg-white w-75 mx-auto p-5 rounded shadow">
        <h1 class="text-center mb-5">Edit Your Project</h1>
        <form
            method="POST"
            action="{{ $project->path() }}"
        >
            @method('PATCH')

            @include('projects.form', [
                'buttonText' => 'Update Project'
            ])
        </form>
    </div>
@endsection
