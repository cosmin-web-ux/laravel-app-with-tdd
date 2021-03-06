<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use App\Models\Project;
use App\Models\User;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project, ProjectInvitationRequest $request)
    {
        // authorization and validation replaced by FormRequest using Gate::allows
//        $this->authorize('update', $project);
//
//        \request()->validate([
//            'email' => ['required', 'exists:users,email']
//        ], [
//            'email.exists' => 'The user you are inviting must have a Birdboard account.'
//        ]);

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}
