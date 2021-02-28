<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use function PHPUnit\Framework\at;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->accessibleProjects();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // not necessary with route model binding
//      $project = Project::findOrFail(\request('project'));

//        if (auth()->id() != $project->owner_id) {
//            abort(403);
//        }

//        if (auth()->user()->isNot($project->owner)) {
//            abort(403);
//        }

        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
//        $attributes['owner_id'] = auth()->id();

        $project = auth()->user()->projects()->create($this->validateRequest());

        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateRequest());

        return redirect($project->path());
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project);

        $project->delete();

        return redirect('/projects');
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);
    }
}
