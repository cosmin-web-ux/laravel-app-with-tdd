<?php

namespace Tests\Feature;

use App\Http\Controllers\ProjectTasksController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_owners_may_not_invite_users()
    {
        $project = app(ProjectFactory::class)->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post($project->path() . '/invitations', [
                'email' => User::first()->email
            ])
            ->assertStatus(403);

    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = app(ProjectFactory::class)->create();

        $userToInvite = User::factory()->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => $userToInvite->email
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    public function the_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
        $project = app(ProjectFactory::class)->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'notauser@example.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have a Birdboard account.'
            ]);
    }

    /** @test */
    public function invited_users_can_update_project_details()
    {
        $project = app(ProjectFactory::class)->create();

        $project->invite($newUser = User::factory()->create());

        $this->signIn($newUser);
        $this->post($project->path() . '/tasks', $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
