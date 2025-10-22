<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class UserTest extends TestCase
{


    /** @test */

    public function test_user_endpoint_returns_authenticated_user()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/user');
        $response->assertStatus(200)
                 ->assertJsonStructure(['id', 'name', 'email', 'role', 'created_at', 'updated_at'])
                 ->assertJson(['id' => $user->id, 'email' => $user->email]);
    }
}
