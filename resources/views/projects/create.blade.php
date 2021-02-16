@extends('layouts.app')

@section('content')
    <form method="POST" action="/projects">
        @csrf
        <h1 class="text-uppercase">Create a Project</h1>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" class="form-control" placeholder="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Project</button>
        <a href="/projects">Cancel</a>
    </form>
@endsection
