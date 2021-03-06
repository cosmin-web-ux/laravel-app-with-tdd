@if ($errors->{ $bag ?? 'default' }->any())
    <ul class="mt-3 list-unstyled">
        @foreach ($errors->{ $bag ?? 'default' }->all() as $error)
            <li class="text-danger small">{{ $error }}</li>
        @endforeach
    </ul>
@endif
