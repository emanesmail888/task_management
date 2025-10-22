<?php

namespace Tests\Feature\AuditLogs;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Tasks\Models\Task;
use Modules\AuditLogs\Models\AuditLog;
use App\Models\User;

class LogsTest extends TestCase
{

    public function test_admin_can_access_audit_logs()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user, 'sanctum')->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'Test description',
            'status' => 'pending',
            'due_date' => '2025-10-30',
            'priority' => 'medium',
        ]);

        $response = $this->actingAs($admin, 'sanctum')->getJson('/api/audit-logs');
        $response->assertStatus(200);

    }

    public function test_non_admin_cannot_access_audit_logs()
    {
        $user = User::factory()->create(['role' => 'user']);
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/audit-logs');
        $response->assertStatus(403);
    }
}
