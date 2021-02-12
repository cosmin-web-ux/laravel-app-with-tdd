<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <form method="POST" action="/projects" class="container pt-3 text-uppercase">
        @csrf
        <h1>Create a Project</h1>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" class="form-control" placeholder="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
</body>
</html>
