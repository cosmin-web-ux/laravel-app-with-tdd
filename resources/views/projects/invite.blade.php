<div class="bg-white px-3 py-4 mt-4 rounded shadow">
    <div class="d-flex flex-column">
        <h3 class="mb-3 title">
            Invite a user
        </h3>

        <div>
            <form method="POST" action="{{ $project->path() . '/invitations' }}" class="text-right">
                @csrf
                <div class="mb-2">
                    <input type="email" name="email" class="border-secondary rounded w-100 py-1 px-1" placeholder="Email address">
                </div>
                <button type="submit" class="btn btn-info text-white">Invite</button>
            </form>
            @include('errors', ['bag' => 'invitations'])
        </div>
    </div>
</div>
