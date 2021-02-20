@csrf

<div class="form-group">
    <label for="title">Title</label>
    <input
        type="text"
        name="title"
        id="title"
        class="form-control"
        placeholder="Title"
        value="{{ $project->title }}"
        required>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea
        type="text"
        name="description"
        id="description"
        class="form-control"
        placeholder="Description"
        required
    >{{ $project->description }}</textarea>
</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
<a href="{{ $project->path() }}">Cancel</a>

@if ($errors->any())
    <div class="mt-3">
        @foreach ($errors->all() as $error)
            <li class="text-danger small">{{ $error }}</li>
        @endforeach
    </div>
@endif
