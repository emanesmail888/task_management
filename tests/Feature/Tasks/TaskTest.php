<?php

namespace Tests\Feature\Tasks;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Tasks\Models\Task;
use App\Models\User;



class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user, 'sanctum')->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'Test description',
            'status' => 'pending',
            'due_date' => '2025-10-30',
            'priority' => 'medium',
        ]);
        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'title', 'description', 'status', 'due_date', 'priority', 'user_id']);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task', 'user_id' => $user->id]);
    }

    public function test_user_can_read_own_task()
    {
        $user = User::factory()->create(['role' => 'user']);
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/tasks/{$task->id}");
        $response->assertStatus(200)
                 ->assertJson(['id' => $task->id, 'title' => $task->title]);
    }



    public function test_user_cannot_access_others_task()
    {
        $user = User::factory()->create(['role' => 'user']);
        $otherUser = User::factory()->create(['role' => 'user']);
        $task = Task::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/tasks/{$task->id}");
        $response->assertStatus(403);
    }

    public function test_admin_can_access_all_tasks()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $task = Task::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')->getJson('/api/tasks');
        $response->assertStatus(200)->assertJsonCount(1, 'data');
    }

    public function test_user_can_update_own_task()
    {
        $user = User::factory()->create(['role' => 'user']);
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Task',
            'status' => 'in_progress',
        ]);
        $response->assertStatus(200)
                 ->assertJson(['title' => 'Updated Task', 'status' => 'in_progress']);
    }

    public function test_user_can_delete_own_task()
    {
        $user = User::factory()->create(['role' => 'user']);
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/tasks/{$task->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }


    public function test_filter_by_status_and_priority()
    {
        $user = User::factory()->create(['role' => 'user']);
        Task::factory()->create(['user_id' => $user->id, 'status' => 'pending', 'priority' => 'high']);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/tasks?status=pending&priority=high');
        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data');
    }

    public function test_filter_by_due_date_range()
    {
        $user = User::factory()->create(['role' => 'user']);
        Task::factory()->create(['user_id' => $user->id, 'due_date' => '2025-10-25']);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/tasks?due_date_start=2025-10-24&due_date_end=2025-10-26');
        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data');
    }

    public function test_pagination_and_sorting()
    {
        $user = User::factory()->create(['role' => 'user']);
        Task::factory()->count(15)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/tasks?per_page=10&sort=title&direction=desc');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'links'])
                 ->assertJsonCount(10, 'data');
    }


    public function test_search_tasks()
    {
        $user = User::factory()->create(['role' => 'user']);
        Task::factory()->create(['title' => 'Test Task', 'user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/search_tasks?query=Test');
        $response->dump(); // Print response for debugging
        $response->assertStatus(200)->assertJsonCount(13);
    }

}
