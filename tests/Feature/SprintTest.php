<?php

namespace Tests\Feature;

use App\Models\Sprint;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SprintTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can view their tasks and Sprints.
     */
    public function test_user_can_view_tasks_and_sprints(): void
    {
        $user = User::factory()->create();

        $sprint = Sprint::create([
            'user_id' => $user->id,
            'name' => 'Sprint 1: Auth Integration',
            'goal' => 'Set up user log in and log out',
            'duration_weeks' => 2,
            'project_name' => 'My Project',
        ]);

        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'Implement Auth routes',
            'sprint_id' => $sprint->id,
            'story_points' => 5,
            'priority' => 'high',
        ]);

        $response = $this->actingAs($user)->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertSee('Sprint 1: Auth Integration');
        $response->assertSee('Implement Auth routes');
    }

    /**
     * Test that the AI Backlog import automatically creates Sprints and links tasks.
     */
    public function test_ai_backlog_import_creates_sprints_and_links_tasks(): void
    {
        $user = User::factory()->create();

        $payload = [
            'tasks' => [
                [
                    'title' => 'Story 1: User Login',
                    'description' => 'As a user, I want to login to my account',
                    'priority' => 'high',
                    'sprint_name' => 'Sprint 1: Auth & Core',
                    'sprint_goal' => 'Implement authentication flow',
                    'sprint_duration_weeks' => 2,
                    'story_points' => 5,
                    'project_name' => 'Auth System',
                    'sprint_index' => 0,
                    'due_time' => '17:00',
                ],
                [
                    'title' => 'Story 2: User Profile',
                    'description' => 'As a user, I want to manage my profile details',
                    'priority' => 'medium',
                    'sprint_name' => 'Sprint 1: Auth & Core',
                    'sprint_goal' => 'Implement authentication flow',
                    'sprint_duration_weeks' => 2,
                    'story_points' => 3,
                    'project_name' => 'Auth System',
                    'sprint_index' => 0,
                    'due_time' => '17:00',
                ],
                [
                    'title' => 'Story 3: Database setup',
                    'description' => 'As a developer, I want to set up tables',
                    'priority' => 'low',
                    'sprint_name' => 'Sprint 2: DB & API',
                    'sprint_goal' => 'Setup DB schema and API wrappers',
                    'sprint_duration_weeks' => 1,
                    'story_points' => 8,
                    'project_name' => 'Auth System',
                    'sprint_index' => 1,
                    'due_time' => '17:00',
                ]
            ]
        ];

        $response = $this->actingAs($user)->post(route('ai.import.backlog'), $payload);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseCount('sprints', 2);
        $this->assertDatabaseCount('tasks', 3);

        $this->assertDatabaseHas('sprints', [
            'name' => 'Sprint 1: Auth & Core',
            'goal' => 'Implement authentication flow',
            'duration_weeks' => 2,
            'project_name' => 'Auth System',
        ]);

        $this->assertDatabaseHas('sprints', [
            'name' => 'Sprint 2: DB & API',
            'goal' => 'Setup DB schema and API wrappers',
            'duration_weeks' => 1,
            'project_name' => 'Auth System',
        ]);

        // Check task sprint association
        $firstSprint = Sprint::where('name', 'Sprint 1: Auth & Core')->first();
        $this->assertDatabaseHas('tasks', [
            'title' => 'Story 1: User Login',
            'sprint_id' => $firstSprint->id,
            'story_points' => 5,
        ]);
    }
}
