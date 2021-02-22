<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = app(ProjectFactory::class)->withTasks(1)->create();

//        $project = Project::factory()->create();
//
//        $task = $project->addTask('test task');

        $this->patch($project->tasks[0]->path(), ['body' => 'changed task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed task']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->signIn();

        // first solution
//        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        // second solution
//        $project = auth()->user()->projects()->create(
//            Project::factory()->raw()
//        );

        // third solution
        $project = app(ProjectFactory::class)->ownedBy($this->signIn())->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = app(ProjectFactory::class)
//            ->ownedBy($this->signIn())
            ->withTasks(1)
            ->create();

//        $this->signIn();
//
//        $project = auth()->user()->projects()->create(
//            Project::factory()->raw()
//        );
//
//        $task = $project->addTask('Task for testing');

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'Edited task'
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Edited task'
        ]);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = app(ProjectFactory::class)
            ->withTasks(1)
            ->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'Edited task',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Edited task',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_can_be_marked_as_incomplete()
    {
        $this->withoutExceptionHandling();
        $project = app(ProjectFactory::class)
            ->withTasks(1)
            ->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'Edited task',
                'completed' => true
            ]);

        $this->patch($project->tasks->first()->path(), [
            'body' => 'Edited task',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Edited task',
            'completed' => false
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
//        $this->signIn();
//
//        $project = auth()->user()->projects()->create(
//            Project::factory()->raw()
//        );

        $project = app(ProjectFactory::class)->create();

        $attributes = Task::factory()->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
